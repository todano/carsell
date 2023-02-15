<?php
namespace Tod\Controllers;
use Tod\Models\Car as MCar;
use Tod\Models\Login as Mlog;

class Main extends Controller
{
  protected $carsController;
  protected $loginController;

  public function __construct()
  {
    $this->carsController = new Cars;
    parent::__construct(MCar::class);

    $this->loginController = new Login;
    parent::__construct(Mlog::class);
  }
  
  public function index(){
    //all variables will be passed to the view
    $page = $_GET['page'] ?? 1;
    $perPage = $_GET['perPage'] ?? 6;
    $pages = $this->carsController->model->countPages($perPage);
    $cars = $this->carsController->index(page: $page, perPage: $perPage);
    // include BASE_PATH.DS.'src'.DS.'Views'.DS.'main'.DS.'index.php';
    $this->getResponse();
    //echo '<pre>'; print_r($this->response); die;
    $this->renderView('main','index',[
      'cars' => $cars,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages,
      'controller' => 'main',
      'method' => 'index',
      'msg' => $this->response['msg'],
      'error' => $this->response['errors']
    ]);
  }
  public function show($id){
    $car = $this->carsController->show($id)[0];
    $user = $this->loginController->model->getUser($car['user_id']);
    if(!$this->response){
      $this->renderView('main', 'show',[
        'car' => $car,
        'user' => $user['data'],
        'controller' => 'main',
        'method' => 'show'
      ]);
    } else {
      $this->renderView('main', 'show',[
        'car' => $car,
        'user' => $user['data'],
        'controller' => 'main',
        'msg' => $this->response['msg']
      ]);
    }
    
  }

  public function edit(int $id){
    $car = $this->carsController->edit($id)[0];
    $this->renderView('cars', 'edit', [
      'car' => $car
    ]);
  }

  public function update(int $id){
    $response = $this->carsController->update($id);
    if(!$response['errors']){
      $this->setResponse('Your add is updated!');
      $this->getResponse();
      $this->show($id);
    } else {
      $car = $this->model->getCar($id)[0];
      $this->renderView('cars', 'edit', [
        'car' => $car,
        'msg' => $this->response['msg'],
        'errors' => $this->response['errors']
      ]);
    }
  }
  public function deleteCar(int $id){
    $car = $this->carsController->model->getCar($id)[0];
    $user = $this->loginController->model->getUser($car['user_id']);
    $result = $this->carsController->delete($id);
    $this->setResponse($result['msg'], $result['errors']);
    $this->getResponse();
    
    if($this->response['errors'] != true){
      $this->setResponse('Your add is deleted!');
      $this->index();
    } else {
      $this->renderView('main', 'show', [
        'car' => $car,
        'user' => $user['data'],
        'controller' => 'main',
        'method' => 'show',
        'msg' => $this->response['msg'],
        'error' => $this->response['errors']
      ]);
    } 
  }

  public function deleteUser(int $id){
    $user = $this->loginController->model->getUser($id);
    $result = $this->loginController->delete($id);
    $this->setResponse($result['msg'], $result['errors']);
    $this->getResponse();
    if($this->response['errors'] != true){
      $this->setResponse('Your account is deleted!');
      $this->loginController->destroy();
    } else {
      $this->renderView('main', 'show', [
        'car' => $car,
        'user' => $user['data'],
        'controller' => 'main',
        'method' => 'show',
        'msg' => $this->response['msg'],
        'error' => $this->response['errors']
      ]);
    } 
  }
}
