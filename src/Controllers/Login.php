<?php
namespace Tod\Controllers;
use \Tod\Models\Login as MLogin;
class Login extends Controller
{
  
  public function create(){
    $this->renderView('users','register');
  }
  public function store(){
    $credentials = $_POST;
    $con = \Tod\Helpers\Database::getConnection();
    $user = new MLogin;
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
    $user = new MLogin;
    $response = $user->checkUser($userCredit, $con);
    
    if(!$response['errors']){
      $user->session($response);
    } else{
      $this->renderView('users','signIn',$response);
    }
  }
  public static function getUser($id = NULL){
    $con = \Tod\Helpers\Database::getConnection();
    $sql = "SELECT * FROM `users`";
    if($id){
      $sql.=" WHERE `id` = {$id}";
    }
    $sql.=" LIMIT 3";
    $query = $con->prepare($sql);
    $query->execute();
    $users = $query->fetchAll(\PDO::FETCH_ASSOC);

    return $users;
  }
  public function destroy(){
    session_start();
    session_destroy();
    header('location: /index.php');
  }
}
