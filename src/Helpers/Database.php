<?php
namespace Tod\Helpers;

class Database
{
  private $con = null;
  private $host = $_ENV['DB_HOST'];
  private $database = $_ENV['DB_DATABASE'];
  private $user = $_ENV['DB_USER'];
  private $password = $_ENV['DB_PASSWORD'];
  private static $instance = null;

  private function __construct()
  {
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
