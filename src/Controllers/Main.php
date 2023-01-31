<?php
namespace Tod\Controllers;
use Tod\Models\Car as MCar;

class Main extends Controller
{
  protected $carsController;

  public function __construct()
  {
    $this->carsController = new Cars;
    parent::__construct(MCar::class);
  }
  
  public function index(){
    //all variables will be passed to the view
    $page = $_GET['page'] ?? 1;
    $perPage = $_GET['perPage'] ?? 6;
    $pages = $this->carsController->model->countPages($perPage);
    $cars = $this->carsController->getCars();
    // include BASE_PATH.DS.'src'.DS.'Views'.DS.'main'.DS.'index.php';
    $this->renderView('main','index',[
      'cars' => $cars,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages,
      'controller' => 'main',
      'method' => 'index'
    ]);
  }
  public function show($id){
    $car = $this->carsController->getCars($id)[0];
    $user = Login::getUser($car['user_id'])[0];
    $this->renderView('main', 'show',[
      'car' => $car,
      'user' => $user,
      'controller' => 'main',
      'method' => 'show'
    ]);
  }
  public function deleteCar(int $id){
    $this->carsController->delete($id);
  }
}
