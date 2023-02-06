<?php
namespace Tod\Controllers;
use Tod\Models\Car as MCar;

class Cars extends Controller
{
  public function __construct()
  {
    //calling parrent construct, with dedicated model
    parent::__construct(MCar::class);
  }
  
  public function getCars($id = NULL, $page = 1, $perPage = 6, $role = 'user'){
    if (isset($_GET['page'])) {
      $page = (int) $_GET['page'];
    }
    if (isset($_GET['perPage'])) {
      $perPage = (int) $_GET['perPage'];
    }
    return $this->model->getCars($id, $page, $perPage, $role);
  }

  public function create(){
    $this->renderView('cars', 'new');
  }
  public function store(){
   $car = $_POST;
   if($_FILES){
     $car['img'] = $_FILES['my_file'];
   }
   $add = $this->model->validate($car);    
   if(!$add['errors']){
    header('location:\index.php');
   }
   $this->renderView('cars', 'new', $add);
  }

  public function verify($verify){
    return $this->model->verify($verify);
  }

  public function delete($id){
    $car = $this->getCars($id)[0];
    $user = Login::getUser($car['user_id'])[0];
    $result = $this->model->delete($id);
    
    $this->setResponse($result['msg'], $result['errors']);
    $this->getResponse();
    
    if(empty($this->response['errors'])){
      $this->renderView('main', 'index', ['msg' => 'Your add is deleted']);
    } 
    
    $this->renderView('main', 'show', [
      'car' => $car,
      'user' => $user,
      'controller' => 'main',
      'method' => 'show',
      'msg' => $this->response['msg'],
      'error' => 1
    ]);
  }
}
