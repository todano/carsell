<?php
namespace Tod\Controllers;

class Controller
{
  public function renderView($file, $dir,array $data=[]){
    extract($data);//extract key values of the array into variables
    include BASE_PATH.DS.'src'.DS.'Views'.DS.$dir.DS.$file.'.php';
  }
}
