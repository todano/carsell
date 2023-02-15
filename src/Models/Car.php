<?php

namespace Tod\Models;

use PDOException;

class Car extends Model
{
  private $brand;
  private $model;
  private $price;
  private $dateproduction;
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
  public function store($car)
  {
    $userId = $_SESSION['id'];
    $this->validate($car);    

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
                ':dateproduction',
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
    $query->bindParam(':userId', $userId);
    $query->bindParam(':brand', $this->brand);
    $query->bindParam(':model', $this->model);
    $query->bindParam(':dateproduction', $this->dateproduction);
    $query->bindParam(':mileage', $this->mileage);
    $query->bindParam(':price', $this->price);
    $query->bindParam(':fuel', $this->fuel); 
    $query->bindParam(':hp', $this->hp); 
    $query->bindParam(':cubic', $this->cubic); 
    $query->bindParam(':category', $this->category); 
    $query->bindParam(':transmission', $this->transmission);
    $query->execute();
    $carId = $this->db->lastInsertId();
    } catch (PDOException $e){
      $this->response['msg'] = "There was some error, please contact with us.";
      $error = $sql . "<br>" . $e->getMessage();
      echo '<pre>'; print_r($error); die;
      $this->response['errors'] = true;
    }
    
    if (!empty($car['img'])) {
      $defaultImg = NULL;
      $dir = 'cars';
      foreach ($car['img']['name'] as $key => $val) {
        $name = $car['img']['name'][$key];
        $tmpName = $car['img']['tmp_name'][$key];
        $size = $car['img']['size'][$key];
        $imgPath = $this->imgVer($name, $tmpName, $size, $dir, $carId);
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

  public function validate($car){
    $this->brand = ucwords(strtolower(trim($car['brand'])));
    $this->model = ucwords(strtolower(trim($car['model'])));
    $this->dateproduction = trim($car['year']);
    $this->mileage = trim($car['mileage']);
    $this->price = '€' . trim((int)filter_var($car['price'], FILTER_SANITIZE_NUMBER_INT));
    $this->fuel = ucwords(strtolower(trim($car['fuel'])));
    $this->hp = (int) trim($car['hp']);
    if(is_float($car['cubic'])){
      return $this->response['msg'] = 'You must enter decimal number for cubic'; 
    }
    $this->cubic = (float) trim($car['cubic']);
    $this->category = ucwords(strtolower(trim($car['category'])));
    $this->transmission = ucwords(strtolower(trim($car['transmission'])));
    return $this;
  }

  public function getCars($page, $perPage, $role)
  {
    $from = ($page - 1);
    if ($from > 0) {
      $from *= $perPage;
    }
    $sql = "SELECT * FROM `cars`";
    if($role != 'admin'){
      $sql.= " WHERE verified != 0 ";
    } 
    $sql .= " LIMIT {$from},{$perPage}";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getCar($id)
  {
    $sql = "SELECT * FROM `cars` WHERE car_id = {$id}";
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

  public function update($id, $car){
    $this->validate($car);
    try{
      $sql = "UPDATE `cars` SET 
                brand = ?,
                model = ?,
                price = ?,
                date_production = ?,
                mileage = ?,
                fuel = ?,
                hp = ?,
                cubic = ?,
                category = ?,
                transmission = ?,
                last_update = NOW() 
              WHERE car_id = ?";
      $query = $this->db->prepare($sql);
      $query->execute([
        $this->brand,
        $this->model,
        $this->price,
        $this->dateproduction,
        $this->mileage,
        $this->fuel,
        $this->hp,
        $this->cubic,
        $this->category,
        $this->transmission,
        $id
      ]);        
    } catch (PRDOExceptiion $e){
      $this->response['msg'][] = "There was some error, please contact with us.";
      $this->response['errors'] = $sql . "<br>" . $e->getMessage();
    }
    return $this->response;
  }
  
}
