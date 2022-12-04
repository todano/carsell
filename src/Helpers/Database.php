<?php
namespace Tod\Helpers;

class Database
{
  private $con = null;
  private $host;
  private $database;
  private $user;
  private $password;
  // private $host;
  // private $database;
  // private $user;
  // private $password;
  private static $instance = null;

  private function __construct()
  {
    $this->host = $_ENV['DB_HOST'];
    $this->database = $_ENV['DB_DATABASE'];
    $this->user = $_ENV['DB_USERNAME'];
    $this->password = $_ENV['DB_PASSWORD'];
    try {
      $dsn = "mysql:host=$this->host;dbname=$this->database";
      $this->con = new \PDO($dsn, $this->user, $this->password);
      // trqbva da ima obratna naklonena cherta, za da my ykaja, che e global PDO!!
    } catch (\PDOException $e){
      die($e->getMessage());
    }
  }
  private function __clone()
  {}

  public static function getConnection()
  {
      if(is_null(self::$instance))
      {
        self::$instance = new self();
      }
      return self::$instance->con;
  }
}
