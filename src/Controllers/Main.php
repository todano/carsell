<?php
namespace Tod\Controllers;

class Main extends Controller
{
  public function index(){
    //$var=1;
    //all variables will be passed to the view
     $cars = Cars::getCars();

    // include BASE_PATH.DS.'src'.DS.'Views'.DS.'main'.DS.'index.php';
    $this->renderView('index','main',[
      'cars' => $cars,
      'test' => ['0' => 1],
      'oshte' => 'massiv'
    ]);
  }
}
