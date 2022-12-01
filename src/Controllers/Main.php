<?php
namespace Tod\Controllers;

class Main extends Controller
{
  public function index(){
    $var=1;//all variables will be passed to the view
    // include BASE_PATH.DS.'src'.DS.'Views'.DS.'main'.DS.'index.php';
    $this->renderView('index','main',[
      'var' => 1,
      'test' => ['0' => 1],
      'oshte' => 'massiv'
    ]);
  }
}
