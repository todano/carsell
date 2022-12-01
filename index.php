<?php
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
//
// $users = new CreateSQL();
// connect('localhost','catalog','todano','todanopak');
// $users->select('users')->get();
//

// echo password_hash('4321',PASSWORD_DEFAULT);
$url = $_SERVER['REQUEST_URI'];
// var_dump($url);die;

$url = str_replace(BASE_URL,'',$url);
$urlParts = array_filter(explode('/',$url));
$controller = $urlParts[0] ?? DEFAULT_CONTROLLER;
$controller = ucFirst(strtolower($controller));
$controllerFile = $controller.'.php';
// echo '<pre>'; print_r($controller);  die;

$method = $urlParts[1] ?? DEFAULT_METHOD;
unset($urlParts[0],$urlParts[1]);
if(!file_exists(CONTROLLER_PATH.$controllerFile))
{
  $controller = DEFAULT_CONTROLLER;
}
$initController = "Tod\\Controllers\\".$controller;
$app = new $initController();

//call method from the object with params
call_user_func_array(array($app, $method), $urlParts);



$con = Tod\Helpers\Database::getConnection();

$sql = "SELECT * FROM `users`";
$query = $con->prepare($sql);
$query->execute();
$users = $query->fetchAll();
echo '<pre>'; print_r($users);



?>
