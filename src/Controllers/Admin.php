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

  public function cars($response = ''){
    $page = $_GET['page'] ?? 1;
    $perPage = $_GET['perPage'] ?? 6;
    $pages = $this->carsController->model->countPages($perPage, $role = 'admin');
    $cars = $this->carsController->getCars(role: 'admin');

    $this->renderView('admin', 'index', [
      'cars' => $cars,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages,
      'controller' => 'admin',
      'method' => 'cars'
    ]);
  }
  public function showCar(int $id){
    $car = $this->carsController->getCars( id: $id, role:'admin')[0];
    $user = $this->loginController->getUser($car['user_id'])[0];
    $this->renderView('admin', 'show',[
      'car' => $car,
      'user' => $user,
      'controller' => 'admin',
      'method' => 'showCar'
    ]);
  }
  public function verCars(){
    $verify = $_POST['verified'] ?? '';
    $this->carsController->verify($verify);
    $this->cars(); //TODO return response 
  }

  public function deleteCar(int $id){
    $this->carsController->delete($id);
  }
  // public function getCars($id = NULL, $page = 1, $perPage = 6){
  //   $page = $_GET['page'] ?? 1;
  //   $perPage = $_GET['perPage'] ?? 6;
  //   $pages = $this->carsController->model->countPages($perPage);
    
  //   $cars = $this->carsController->getCars();
  //   $this->model->getCars();
  // }
}