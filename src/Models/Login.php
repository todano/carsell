<?php

namespace Tod\Models;

class Login
{
  private $role = 'user';
  private $name;
  private $lastName;
  private $username;
  private $email;
  private $password;
  private $repassword;
  private $city;
  private $response = [
    'message' => '',
    'errors' => []
  ];

  public function storeToDB($params, $con){
    if(($this->response['errors']=$this->validate($params, $con)) == true){
      return $this->response;
    }

    try{
      $this->fillData($params);
      $date = date('Y-m-d H:i:s');
      $sql = "INSERT INTO `users`(
                `id`,
                `role`,
                `name`,
                `last_name`,
                `username`,
                `email`,
                `password`,
                `city`,
                `created_at`,
                `last_update`)
               VALUES (
                NULL,
               '$this->role',
               '$this->name',
               '$this->lastName',
               '$this->username',
               '$this->email',
               '$this->password',
               '$this->city',
                NOW(),
               '$date')";
      $query = $con->prepare($sql);
      $query->execute();

      $sql = "SELECT *
              FROM `users`
              WHERE `email` = '{$this->email}'
              ";
      $query = $con->prepare($sql);
      $query->execute();
      $user = $query->fetch(\PDO::FETCH_ASSOC);
      $this->session($user);
      $this->response['message'] = "Account has ben created successfully!";
    } catch (PDOException $e){
      $this->response['message'] = "There was some error, please contact with us.";
      $this->response['errors'][] = $sql . "<br>" . $e->getMessage();
    }
    return $this->response;
  }

  private function validate($params, $con){
   
    if(isset($params)) {
     $errors=[];
      //validate name
      if(!mb_strlen($params['name'])) {
          $errors['name'] = "Please input a name.";
      } else if(mb_strlen($params['name']) > 32) {
          $errors['name'] = "The maximum lenth of the name is 32 symbols.";
      }
      //validate lastName
      if(!mb_strlen($params['lastName'])) {
          $errors['lastName'] = "Please input a name.";
      } else if(mb_strlen($params['lastName']) > 32) {
          $errors['lastName'] = "The maximum lenth of the name is 32 symbols.";
      }
      //validate username
      if(!mb_strlen($params['username'])) {
          $errors['username'] = "Please input a name.";
      } else if(mb_strlen($params['username']) > 32) {
          $errors['username'] = "The maximum lenth of the name is 32 symbols.";
      }
      //validate email address
      if(!mb_strlen($params['email'])) {
          $errors['email'] = "Please input an email address.";
      } else if(mb_strlen($params['email']) > 64) {
          $errors['email'] = "The maximum lenth of the email is 64 symbols.";
      } else if(!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "Input a valid email address.";
      } else {
          $sql = "SELECT *
                  FROM `users`
                  WHERE `email` = '{$params['email']}'
                  ";
          $query = $con->prepare($sql);
          $query->execute();
          $result = $query->fetchColumn();
          if($result) {
            $errors['email'] = "There is already a user with that email.";
          }
      }
      // validate password
      if(!mb_strlen($params['password'])) {
          $errors['password'] = "Type a password.";
      } else if(mb_strlen($params['password']) < 8 || mb_strlen($params['password']) > 100) {
          $errors['password'] = "Password should be between 8 and 100 letters.";
      }
      if(!mb_strlen($params['repassword'])) {
          $errors['repassword'] = "Repeat password.";
      } else if($params['password'] !== $params['repassword']) {
          $errors['repassword'] = "Two passwords doesnt match up.";
      }
      //validate city
      if(!mb_strlen($params['city'])) {
          $errors['name'] = "Type a city.";
      } else if(mb_strlen($params['city']) > 32) {
          $errors['name'] = "Maximum lenth of a city is 32 letters.";
      }
    }
    return $errors;
  }
  private function fillData($params){
      $this->name = $params['name'];
      $this->lastName = $params['lastName'];
      $this->username = $params['username'];
      $this->email = $params['email'];
      $this->password = password_hash($params['password'], PASSWORD_DEFAULT);
      $this->repassword = $params['repassword'];
      $this->city = $params['city'];
  }
  public function session($user){
    session_start();
    $_SESSION['id'] = $user['id'];
    header('location:\index.php');// Controller or model?
  }
  public function checkUser($credits, $con){
    $sql = "SELECT *
            FROM `users`
            WHERE `email` = '{$credits['email']}'
            ";
    $query = $con->prepare($sql);
    $query->execute();
    $result = $query->fetch(\PDO::FETCH_ASSOC);
    
    if(password_verify($credits['password'], $result['password'])){
      return $result;
    } else {
      $this->response['errors'] = 'Password is incorrect';
      return $this->response;
    }
  }
}
