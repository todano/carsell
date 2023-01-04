<?php
namespace Tod\Controllers;

class Main extends Controller
{
  public function index(){
    //all variables will be passed to the view
    $page = $_GET['page'] ?? NULL;
    $perPage = $_GET['perPage'] ?? 6;
    $pages = Cars::countPages($perPage);
   
    $cars = Cars::getCars();
    // include BASE_PATH.DS.'src'.DS.'Views'.DS.'main'.DS.'index.php';
    $this->renderView('main','index',[
      'cars' => $cars,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages
    ]);
  }
  public function show($id){
    $car = Cars::getCars($id)[0];
    $user = Login::getUser($car['user_id'])[0];
    $this->renderView('main', 'show',[
      'car' => $car,
      'user' => $user
    ]);
  }
}
