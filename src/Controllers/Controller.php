<?php
namespace Tod\Controllers;
use Tod\Helpers\Database;

class Controller
{
  protected $model;
  protected $response = [
    'msg' => '',
    'errors' => []
  ];
  public function __construct($model)
  {
      $this->model = new $model;
  }
  public function renderView($dir, $file, array $data=[]){
    extract($data);//extract key values of the array into variables
    include BASE_PATH.DS.'src'.DS.'Views'.DS.$dir.DS.$file.'.php';
  }

  public function setResponse($msg = '', $errors = []){
    $this->response['msg'] = $msg;
    $this->response['errors'] = $errors;
  }
  
  public function getResponse(){
    return $this->response;
  }
}
