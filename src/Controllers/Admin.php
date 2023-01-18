<?php
namespace Tod\Controllers;
use Tod\Models\Admin as AdminM;
use Tod\Models\Car as Mcar;

class Admin extends Controller
{ 
  protected $carsController;

  public function __construct()
  {
    $this->carsController = new Cars;
    parent::__construct(MCar::class);
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
      'pages' => $pages
    ]);
  }

  public function verCars(){
    $verify = $_POST['verified'] ?? '';
    $this->carsController->verify($verify);
    $this->cars(); //TODO return response 
  }

  // public function getCars($id = NULL, $page = 1, $perPage = 6){
  //   $page = $_GET['page'] ?? 1;
  //   $perPage = $_GET['perPage'] ?? 6;
  //   $pages = $this->carsController->model->countPages($perPage);
    
  //   $cars = $this->carsController->getCars();
  //   $this->model->getCars();
  // }
}