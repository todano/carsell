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
    // echo '<pre>'; print_r($params);  die;

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

      // $sql = "SELECT * FROM `users`";
      $sql = "SELECT *
              FROM `users`
              WHERE `email` = '{$this->email}'
              ";
      $query = $con->prepare($sql);
      $query->execute();
      $user = $query->fetch(\PDO::FETCH_ASSOC);
      $this->session($user);
      $this->response['message'] = "Потребителят е записан успешно!";
      // echo '<pre>'; print_r($query);  die;
      // header("Location: index.php");
    } catch (PDOException $e){
      $this->response['message'] = "Възникна грешка, моля свържете се с нас.";
      $this->response['errors'][] = $sql . "<br>" . $e->getMessage();
    }
    return $this->response;
  }

  private function validate($params, $con){
    // echo '<pre>'; print_r($params);  die;

    if(isset($params)) {
     $errors=[];
      //validate name
      if(!mb_strlen($params['name'])) {
          $errors['name'] = "Въведете име.";
      } else if(mb_strlen($params['name']) > 32) {
          $errors['name'] = "Максималната дължина на името е 32 символа.";
      }
      //validate lastName
      if(!mb_strlen($params['lastName'])) {
          $errors['lastName'] = "Въведете име.";
      } else if(mb_strlen($params['lastName']) > 32) {
          $errors['lastName'] = "Максималната дължина на името е 32 символа.";
      }
      //validate username
      if(!mb_strlen($params['username'])) {
          $errors['username'] = "Въведете име.";
      } else if(mb_strlen($params['username']) > 32) {
          $errors['username'] = "Максималната дължина на името е 32 символа.";
      }
      //validate email address
      if(!mb_strlen($params['email'])) {
          $errors['email'] = "Въведете имейл адрес.";
      } else if(mb_strlen($params['email']) > 64) {
          $errors['email'] = "Максималната дължина на имейл адрес е 64 символа";
      } else if(!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "Въведете коректен имейл адрес.";
      } else {
          $sql = "SELECT *
                  FROM `users`
                  WHERE `email` = '{$params['email']}'
                  ";
          $query = $con->prepare($sql);
          $query->execute();
          $result = $query->fetchColumn();
          if($result) {
            $errors['email'] = "Съществува потребител с въведения имейл адрес.";
          }
      }
      // validate password
      if(!mb_strlen($params['password'])) {
          $errors['password'] = "Въведете парола.";
      } else if(mb_strlen($params['password']) < 8 || mb_strlen($params['password']) > 100) {
          $errors['password'] = "Паролата трябва да е между 8 и 100 символа.";
      }
      if(!mb_strlen($params['repassword'])) {
          $errors['repassword'] = "Повторете парола.";
      } else if($params['password'] !== $params['repassword']) {
          $errors['repassword'] = "Въведените пароли не съвпадат.";
      }
      //validate city
      if(!mb_strlen($params['city'])) {
          $errors['name'] = "Въведете град.";
      } else if(mb_strlen($params['city']) > 32) {
          $errors['name'] = "Максималната дължина на името на града е 32 символа.";
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
  private function session($user){
    session_start();
    $_SESSION['id'] = $user['id'];
    // echo '<pre>'; print_r($_SESSION['id']);  die;
    header('location:\index.php');
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
      $this->session($result);
    } else {
      echo 'sburkal si parolata'; die;
    }
  }
}
