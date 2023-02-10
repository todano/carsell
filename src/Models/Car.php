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

  
}
