<?php
namespace Tod\Controllers;

use Exception;
use \Tod\Models\Login as MLogin;

class Login extends Controller
{
  public function __construct()
  {
    parent::__construct(MLogin::class);
  }
  
  public function create(){
    $this->renderView('users','register');
  }
  public function store(){
    $credentials = $_POST;  
    $response = $this->model->storeToDB($credentials);
    $user = $response['data'];
    $_SESSION = $this->model->except($user, ['password']);
    
    if(!$response['errors']){
      header('location:/');
    } else{
      $this->renderView('users','register',$response);
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
      $this->setResponse($e->getMessage());
      $this->renderView('users','signIn',$this->getResponse());
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
    session_destroy();
    header('location: /');
  }
}
