<?php
namespace Tod\Controllers;

class Cars
{
  public static function getCars(){

    $con = \Tod\Helpers\Database::getConnection();

    $sql = "SELECT * FROM `cars`";
    $query = $con->prepare($sql);
    $query->execute();
    $cars = $query->fetchAll(\PDO::FETCH_ASSOC);

    return $cars;
  }
}
