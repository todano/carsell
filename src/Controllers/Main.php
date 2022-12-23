<?php
namespace Tod\Controllers;

class Main extends Controller
{
  public function index(){
    //$var=1;
    //all variables will be passed to the view
    if(isset($_GET['page'])){
      $page = (int) $_GET['page'];
    }
     $cars = Cars::getCars(NULL, $page = NULL);
    // include BASE_PATH.DS.'src'.DS.'Views'.DS.'main'.DS.'index.php';
    $this->renderView('main','index',[
      'cars' => $cars
    ]);
  }
  public function show($id){
    $car = Cars::getCars($id)[0];
    $user = Login::getUser($id)[0];
    $this->renderView('main', 'show',[
      'car' => $car,
      'user' => $user
    ]);
  }
}
