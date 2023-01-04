<?php
namespace Tod\Controllers;

class Cars extends Controller
{
  public static function getCars($id = NULL, $page = 1, $perPage = 6){
    $con = \Tod\Helpers\Database::getConnection();
    if(isset($_GET['page'])){
      $page = (int) $_GET['page'];
    }
    if(isset($_GET['perPage'])){
      $perPage = (int) $_GET['perPage'];
    }
           
    $from = ($page-1);
    if($from>0){
      $from*=$perPage;
    }
    
    $sql = "SELECT * FROM `cars`";
    if($id){
      $sql.=" WHERE `car_id` = {$id}";
    }
    $sql.=" LIMIT {$from},{$perPage}";
    $query = $con->prepare($sql);
    $query->execute();
    $cars = $query->fetchAll(\PDO::FETCH_ASSOC);

    return $cars;
  }

  public function create(){
    $this->renderView('cars', 'new');
  }

  public static function countPages($perPage=6){
    $con = \Tod\Helpers\Database::getConnection();
    $sql = "SELECT COUNT('car_id') FROM `cars`";
    $query = $con->prepare($sql);
    $query->execute();
    $count = implode($query->fetch(\PDO::FETCH_NUM));
    $pages = $count/$perPage;
        
    if(is_float($pages)){
      $pages = (int)$pages+1;
    }
    return $pages;
  }
}
