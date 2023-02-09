<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
DEFINE('DS',DIRECTORY_SEPARATOR);
DEFINE('BASE_URL','/');
DEFINE('DEFAULT_CONTROLLER','Main');
DEFINE('DEFAULT_METHOD','index');
DEFINE('BASE_PATH',__DIR__);
DEFINE('CONTROLLER_PATH',BASE_PATH.DS.'src'.DS.'Controllers'.DS);
// require_once 'db.php';
//
// $users = new CreateSQL();
// connect('localhost','catalog','todano','todanopak');
// $users->select('users')->get();

// echo password_hash('4321',PASSWORD_DEFAULT);
// echo '<pre>'; print_r($_SERVER);  die;
$url = $_SERVER['REQUEST_URI'];
$urlParts = array_filter(explode('/',$url));
// echo '<pre>'; print_r($urlParts); die; 
$controller = $urlParts[1] ?? DEFAULT_CONTROLLER;
$controller = ucFirst(strtolower($controller));
$controllerFile = $controller.'.php';

$method = $urlParts[2] ?? DEFAULT_METHOD;
unset($urlParts[1],$urlParts[2]);
if(!file_exists(CONTROLLER_PATH.$controllerFile))
{
  $controller = DEFAULT_CONTROLLER;
}

if((!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') && $controller == 'Admin'){
  header('location: /');
}
$initController = "Tod\\Controllers\\".$controller;
$app = new $initController();
// echo '<pre>'; print_r($urlParts); die;
//call method from the object with params
call_user_func_array(array($app, $method), $urlParts);




?>
