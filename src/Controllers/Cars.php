<?php
namespace Tod\Controllers;
use Tod\Models\Car as MCar;

class Cars extends Controller implements Methods
{
 
  public function __construct()
  {
    //calling parrent construct, with dedicated model
    parent::__construct(MCar::class);
  }
  
  public function index($page = 1, $perPage = 6, $role = 'user'){
    if (isset($_GET['page'])) {
      $page = (int) $_GET['page'];
    }
    if (isset($_GET['perPage'])) {
      $perPage = (int) $_GET['perPage'];
    }
    return $this->model->getCars($page, $perPage, $role);
  }

  public function show(int $id){
      return $this->model->getCar($id);
  }

  public function create(){
    $this->renderView('cars', 'newAdd');
  }
  public function store(){
   $car = $_POST;
   if($_FILES){
     $car['img'] = $_FILES['my_file'];
   }
   $add = $this->model->store($car);  
   echo '<pre>'; print_r($add); die;  
   if(!$add['errors']){
    header('location:\index.php');
   }
   $this->renderView('cars', 'newAdd', $add);
  }

  public function edit(int $id){
    return $this->model->getCar($id);
  }

  public function update(int $id){
    $car = $_POST;
    return $this->model->update($id, $car);
  }

  public function verify($verify){
    return $this->model->verify($verify);
  }

  public function delete(int $id, $dir = 'cars'){
    return $this->model->delete(dir: $dir,id: $id);
  }
}
