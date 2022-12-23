<?php
namespace Tod\Controllers;

class Cars
{
  public static function getCars($id = NULL, $page = 1){
    $from = ($page-1)*3;
    $con = \Tod\Helpers\Database::getConnection();
    $sql = "SELECT * FROM `cars`";
    if($id){
      $sql.=" WHERE `car_id` = {$id}";
    }
    $sql.=" LIMIT 3";
    $query = $con->prepare($sql);
    $query->execute();
    $cars = $query->fetchAll(\PDO::FETCH_ASSOC);

    return $cars;
  }
}
