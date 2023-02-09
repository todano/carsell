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
    $cars = $this->carsController->getCars();
    // include BASE_PATH.DS.'src'.DS.'Views'.DS.'main'.DS.'index.php';
    $this->renderView('main','index',[
      'cars' => $cars,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages,
      'controller' => 'main',
      'method' => 'index',
      'msg' => '',
      'error' => 0
    ]);
  }
  public function show($id){
    $car = $this->carsController->getCars($id)[0];
    $user = $this->loginController->model->getUser($car['user_id'])[0];
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
