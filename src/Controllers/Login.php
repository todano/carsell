<?php
namespace Tod\Controllers;

class Login extends Controller
{
  // public function __construct(){
  //   echo 'You are in login controller!';
  // }

  public function create(){
    $this->renderView('users','register');
  }
  public function store(){
    // echo '<pre>'; print_r($_POST);
    $credentials = $_POST;
    $con = \Tod\Helpers\Database::getConnection();
    $user = new \Tod\Models\Login;
    $response = $user->storeToDB($credentials, $con);
    if(!$response['errors']){
      header('loction:/');
    } else{
      $this->renderView('users','register',$response);
    }
  }
  public function sign(){
    $this->renderView('users','signIn');
  }
  public function signIn(){
    $userCredit = $_POST;
    $con = \Tod\Helpers\Database::getConnection();
    $user = new \Tod\Models\Login;
    $user->checkUser($userCredit, $con);
  }
  public function destroy(){
    session_start();
    session_destroy();
    header('location: /index.php');
  }
}
