<?php
namespace Tod\Controllers;
use Tod\Models\Admin as AdminM;
use Tod\Models\Car as Mcar;
use Tod\Models\Login as Mlog;

class Admin extends Controller
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
  // public function index(){
  //     $this->renderView('admin', 'index');
  // }

  public function cars(){   
    $page = $_GET['page'] ?? 1;
    $perPage = $_GET['perPage'] ?? 6;
    $pages = $this->carsController->model->countPages($perPage, $role = 'admin');
    $cars = $this->carsController->getCars(role: 'admin');
    $this->renderView('admin', 'indexCar', [
      'cars' => $cars,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages,
      'controller' => 'admin',
      'method' => 'cars'
    ],
    'admin');
  }
  public function showCar(int $id){
    $car = $this->carsController->getCars( id: $id, role:'admin')[0];
    $user = $this->loginController->model->getUser($car['user_id'], $page = 1, $perPage = 6, $role = 'admin')[0];
    $this->renderView('admin', 'showCar',[
    'car' => $car,
    'user' => $user,
    'controller' => 'admin',
    'method' => 'showCar'
    ],
    'admin');
  }
  public function verCars(){
    $verify = $_POST['verified'] ?? '';
    $this->carsController->verify($verify);
    $this->cars(); //TODO return response 
  }

  public function deleteCar(int $id){
    $this->carsController->delete($id);
  }

  public function users($response = ''){
    $page = $_GET['page'] ?? 1;
    $perPage = $_GET['perPage'] ?? 6;
    // echo '<pre>'; print_r($page); die;
    $pages = $this->loginController->model->countPages($perPage, $role = 'admin');
    $users = $this->loginController->model->getUsers($page, $perPage, $role);
    $this->renderView('admin', 'indexUser', [
      'users' => $users,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages,
      'controller' => 'admin',
      'method' => 'users'
    ],
    'admin');
  }
  public function showUser(int $id){
    $user = $this->loginController->model->getUser($id);
    $this->renderView('admin', 'showUser', [
      'user' => $user['data'],
      'controller' => 'admin',
      'method' => 'users'
    ],
    'admin');
  }

  public function verUsers(){
    $verify = $_POST['verified'] ?? '';
    $this->loginController->verifyUsers($verify);
    $this->users(); //TODO return response 
  }

  public function deleteUser(int $id){
    $this->loginController->delete($id);
    $this->users();
  }
}