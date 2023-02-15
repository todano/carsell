<?php
namespace Tod\Controllers;

use Exception;
use \Tod\Models\Login as MLogin;

class Login extends Controller implements Methods
{
  public function __construct()
  {
    parent::__construct(MLogin::class);
  }
  
  public function index($page = 1, $perPage = 6, $role = 'user'){
    if (isset($_GET['page'])) {
      $page = (int) $_GET['page'];
    }
    if (isset($_GET['perPage'])) {
      $perPage = (int) $_GET['perPage'];
    }
    $pages = $this->model->countPages($perPage, $role = 'user');
    $users = $this->model->getUsers(page: $page, perPage: $perPage, role: $role);
    foreach ($users as $key => $user){
        $location = 'src'.DS.'img'.DS.'users'.DS. $user['id'].DS.$user['default_img'];
        if(!is_file($location)){
          $users[$key]['imgPath'] = 'src'.DS.'img'.DS.'users'.DS.'default.jpg';
        } else {
          $users[$key]['imgPath'] = $location;
        }
    }
    
    $this->renderView('users', 'index', [
      'users' => $users,
      'page' => $page,
      'perPage' => $perPage,
      'pages' => $pages,  
      'controller' => 'login',
      'method' => 'index',
    ]);
  }
  public function show(int $id, $response = []){
    $user = $this->model->getUser(id: $id);  
    $imgPath = 'src'.DS.'img'.DS.'users'.DS. $user['data']['id'].DS.$user['data']['default_img'];
    
    if(is_file($imgPath)){
      $user['data']['imgPath'] = $imgPath;
    } else {
      $user['data']['imgPath'] = 'src'.DS.'img'.DS.'users'.DS.'default.jpg';
    }
   
    if($response){
      $this->renderView('users', 'show', [
        'user' => $user['data'],
        'msg' => $response['msg'],
        'controller' => 'login',
      ]);
    } else if(!$user['ver']){
      $this->renderView('users', 'show', [
        'msg' => 'Your account isnt confirm yet!',
        'user' => $user['data'],
        'errors' => true,
        'controller' => 'login',
      ]);
    } else {
      $this->renderView('users', 'show', [
        'user' => $user['data'],
      ]);
    }
  }

  public function create(){
    $this->renderView('users','register');
  }

  public function store(){
    $credentials = $_POST; 
    if($_FILES){
      $credentials['img'] = $_FILES['my_file'];
    }
    $response = $this->model->storeToDB($credentials);
    if($response['errors']){
      $this->renderView('users','register',[
        'msg' => $response['msg'],
        'errors' => $response['errors']
    ]);
    } else {
      $user = $response['data'];
      $_SESSION = $this->model->except($user, ['password']);
      $this->renderView('users', 'show',[
              'user' => $user
      ]);
    }
  }  

  public function edit(int $id){
    $user = $this->model->getUser(id: $id);
    $user = $this->model->except($user, ['password']);
    $this->renderView('users', 'edit', [
      'user' => $user['data']
    ]);
  }

  public function update(int $id){
    $credentials = $_POST;  
    $response = $this->model->UpdateDB($id, $credentials);
    if(!$response['errors']){
      $this->show($id, $response);
    } else{
      $user = $user = $this->model->getUser(id: $id);
      $this->renderView('users','edit', [
        'user' => $user['data'],
        'msg'=> $response['msg'],
        'errors' => $response['errors']
      ]);
    }
  }
  
  public function sign(){
    $this->renderView('users','signIn');
  }
  public function signIn(){
    $userCredit = $_POST;
    try{
      $user = $this->model->checkUser($userCredit);
      $_SESSION = $this->model->except($user, ['password']);
      header('location:\index.php');
    } catch (Exception $e){ 
      $this->setResponse($e->getMessage(), true);
      $this->renderView('users','signIn',$this->getResponse());
    } 
  }
  
  public function verifyUsers($verify){
    return $this->model->verifyUsers($verify);
  }
  public function destroy(){
    session_destroy();
    header('location: /');
  }

  public function editPassword(int $id){
    $user = $this->model->getUser(id: $id);
    $user = $this->model->except($user['data'], ['password']);
    $this->renderView('users', 'editPassword',[
      'user' => $user
    ]);
  }

  public function updatePassword(int $id){
    $passwords = $_POST; 
    $response = $this->model->updatePassword($id, $passwords);
    // echo '<pre>'; print_r($response); die;
    if(!$response['errors']){
      $this->show($id, $response);
    } else{
      $user = $this->model->getUser(id: $id);
      $this->renderView('users','editPassword', [
        'user' => $user['data'],
        'msg'=> $response['msg'],
        'errors' => $response['errors']
      ]);
    }
  }

  public function editEmail(int $id){
    $user = $this->model->getUser(id: $id);
    $user['data'] = $this->model->except($user['data'], ['password']);
    $this->renderView('users', 'editEmail',[
      'user' => $user['data']
    ]);
  }

  public function updateEmail(int $id){
    $email = $_POST['email']; 
    $response = $this->model->updateEmail($id, $email);
    if(!$response['errors']){
      $this->show($id, $response);
    } else{
      $user = $this->model->getUser(id: $id);
      $this->renderView('users','editEmail', [
        'user' => $user['data'],
        'msg'=> $response['msg'],
        'errors' => $response['errors']
      ]);
    }
  }

  public function delete(int $id, $dir = 'users'){
    return $this->model->delete(dir: $dir,id: $id);
  }
}
