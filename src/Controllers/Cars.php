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
}
