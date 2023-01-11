<?php

namespace Tod\Models;

class Car extends Model
{
  private $brand;
  private $model;
  private $price;
  private $year;
  private $mileage;
  private $engine;
  private $response = [
    'message' => '',
    'errors' => []
  ];

  public function __construct()
  {
    parent::__construct();
  }
  public function validate($car)
  {
    $userId = $_SESSION['id'];
    $this->brand = ucwords(trim($car['brand']));
    $this->model = ucwords(trim($car['model']));
    $this->mileage = trim($car['mileage']);
    $this->year = trim($car['year']);
    $this->engine = trim($car['engine']);
    $this->price = '$' . trim($car['price']);

    // insert into db 
    //get car_id
    try{
      $sql = "INSERT INTO `cars`
                (`user_id`,
                  `brand`,
                  `model`,
                  `date_production`,
                  `mileage`, `price`,
                  `created_at`,
                  `last_update`,
                  `engine`) 
              VALUES 
                ('{$userId}',
                '{$this->brand}',
                '{$this->model}',
                '{$this->mileage}',
                '{$this->year}',
                '{$this->engine}',
                '{$this->price}',
                NOW(),
                NOW())";
    $query = $this->db->prepare($sql);
    // echo '<pre>'; print_r($query); die;
    $query->execute();
    $carId = $this->db->lastInsertId();
    } catch (PDOException $e){
      $this->response['message'] = "There was some error, please contact with us.";
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
        $sql = "UPDATE `cars` SET default_image = '{$defaultImg}' WHERE car_id = '{$carId}'";
        $query = $this->db->prepare($sql);
        $query->execute();
      }
    }
    return $this->response;
  }

  private function imgVer($name, $tmpName, $size, $id)
  {
    $maxSize = 2097152;
    $location = 'src' . DS . 'img' . DS . $id; //directory to save imges
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
    $this->response['message'] = "Successfully uploaded";

    return $imgName;
  }

  public function getCars($id, $page, $perPage)
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

    $sql = "SELECT * FROM `cars`";
    if ($id) {
      $sql .= " WHERE `car_id` = {$id}";
    }
    $sql .= " LIMIT {$from},{$perPage}";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function countPages($perPage = 6)
  {
    $sql = "SELECT COUNT('car_id') FROM `cars`";
    $query = $this->db->prepare($sql);
    $query->execute();
    $count = implode($query->fetch(\PDO::FETCH_NUM));
    $pages = $count / $perPage;

    if (is_float($pages)) {
      $pages = (int)$pages + 1;
    }
    return $pages;
  }
}
