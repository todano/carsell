<?php

namespace Tod\Models;

use PDOException;

class Car extends Model
{
  private $brand;
  private $model;
  private $price;
  private $year;
  private $mileage;
  private $fuel;
  private $hp;
  private $cubic;
  private $category;
  private $transmission;
  

  public function __construct()
  {
    parent::__construct();
  }
  public function validate($car)
  {
    $userId = $_SESSION['id'];
    $this->brand = ucwords(strtolower(trim($car['brand'])));
    $this->model = ucwords(strtolower(trim($car['model'])));
    $this->year = trim($car['year']);
    $this->mileage = trim($car['mileage']);
    $this->price = '€' . trim($car['price']);
    $this->fuel = ucwords(strtolower(trim($car['fuel'])));
    $this->hp = (int) trim($car['hp']);
    if(is_float($car['cubic'])){
      return $this->response['errors'][] = 'You must enter decimal number for cubic'; 
    }
    $this->cubic = (float) trim($car['cubic']);
    $this->category = ucwords(strtolower(trim($car['category'])));
    $this->transmission = ucwords(strtolower(trim($car['transmission'])));

    // insert into db 
    //get car_id
    try{
      $sql = "INSERT INTO `cars`
                (`user_id`,
                  `brand`,
                  `model`,
                  `date_production`,
                  `mileage`, 
                  `price`,
                  `created_at`,
                  `last_update`,
                  `fuel`,
                  `hp`,
                  `cubic`,
                  `category`,
                  `transmission`) 
              VALUES 
                (':userId',
                ':brand',
                ':model',
                ':year',
                ':mileage',
                ':price',
                  NOW(),
                  NOW(),
                ':fuel',
                ':hp',
                ':cubic',
                ':category',
                ':transmission'
                )";
    $query = $this->db->prepare($sql);
    $query->bindParam(':userId', $userId,
                      ':brand', $this->brand,
                      ':model', $this->model,
                      ':year', $this->year,
                      ':mileage', $this->mileage,
                      ':price', $this->price,
                      ':fuel', $this->fuel, 
                      ':hp', $this->hp, 
                      ':cubic', $this->cubic, 
                      ':category', $this->category, 
                      ':transmission', $this->transmission
                    );
    $query->execute();
    $carId = $this->db->lastInsertId();
    } catch (PDOException $e){
      $this->response['msg'] = "There was some error, please contact with us.";
      $this->response['errors'][] = $sql . "<br>" . $e->getMessage();
    }
    
    if (!empty($car['img'])) {
      $defaultImg = NULL;
      foreach ($car['img']['name'] as $key => $val) {
        $name = $car['img']['name'][$key];
        $tmpName = $car['img']['tmp_name'][$key];
        $size = $car['img']['size'][$key];
        $imgPath = $this->imgVer($name, $tmpName, $size, $carId);
        if(!$defaultImg){
          $defaultImg = $imgPath;
        }
      }

      if($defaultImg){
        $sql = "UPDATE `cars` SET default_image = ':defaultImg' WHERE car_id = ':carId'";
        $query = $this->db->prepare($sql);
        $query->bindParam(':defaultImg', $defaultImg,
                          ':carId', $carId);
        $query->execute();
      }
    }
    return $this->response;
  }

  private function imgVer($name, $tmpName, $size, $id)
  {
    $maxSize = 2097152;
    $location = 'src'.DS.'img'.DS.'cars'.DS. $id; //directory to save imges
    $extension = strtolower(substr($name, strpos($name, '.') + 1)); //takes file extention and makes it with small letter
    $imgName = uniqid() . '.' . $extension;
    $imgPath = $location . DS . $imgName;

    if (!empty($name)) {
      //condition if the file extention and size are as they should be.
      if (in_array($extension, ['jpg', 'jpeg', 'image/jpeg']) && $size < $maxSize) {
        if (!is_dir($location)) {
          mkdir($location);
        }
        if (!move_uploaded_file($tmpName, $imgPath)) {
          $this->response['errors'][] = 'File cannot be moved';
        }
      } else {
        $this->response['errors'][] = "The image should be less than 2Mb!";
      }
    } else {
      $this->response['errors'][] = "Please choose a file!";
    }
    $this->response['msg'] = "Successfully uploaded";

    return $imgName;
  }

  public function getCars($id, $page, $perPage, $role)
  {
    if (isset($_GET['page'])) {
      $page = (int) $_GET['page'];
    }
    if (isset($_GET['perPage'])) {
      $perPage = (int) $_GET['perPage'];
    }

    $from = ($page - 1);
    if ($from > 0) {
      $from *= $perPage;
    }

    $sql = "SELECT * FROM `cars` WHERE 1=1";
    if ($id) {
      $sql .= " AND car_id = {$id}";
    }
    if($role != 'admin'){
      $sql.= " AND verified != 0 ";
    } 
    
    $sql .= " LIMIT {$from},{$perPage}";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function countPages($perPage = 6, $role = 'user')
  {
    $sql = "SELECT COUNT('car_id') FROM `cars`"; 
    if($role != 'admin'){
      $sql.= " WHERE verified != 0";
    }  
    
    $query = $this->db->prepare($sql);
    $query->execute();
    $count = implode($query->fetch(\PDO::FETCH_NUM));
    $pages = $count / $perPage;

    if (is_float($pages)) {
      $pages = (int)$pages + 1;
    }
    return $pages;
  }

  public function verify($verify){
    $carId = [];
    //TODO cast key value as int
    foreach ($verify as $key => $value){
      if($value == 'on'){
        $carId[] = $key ; 
      }
    }
 
    $carVer = join(',',$carId);
    $sql = "UPDATE `cars` SET verified = 1 WHERE car_id IN ({$carVer})";
    $query = $this->db->prepare($sql);
    $query->execute();
    return;
  }

  public function delete($id){
    $location = 'src'.DS.'img'.DS.'cars'.DS. $id;
       
    try{
      $sql = "DELETE FROM `cars` WHERE car_id = ?";
      $query = $this->db->prepare($sql);
      $query->execute([$id]);
    } catch (PDOException $e){
      $this->response['msg'] = 'This add cannot be deleted!';
      $this->response['errors'] = $sql . "<br>" . $e->getMessage();
    } 
    
    if(is_dir($location) && empty($this->response['errors'])){
      $files = scandir($location);
      foreach ($files as $file){
        if(is_file($location.DS.$file)){
          unlink($location.DS.$file);
        }
      }
      if(is_dir($location)){
        rmdir($location);
      }
    }  
    return $this->response;
  }
}
