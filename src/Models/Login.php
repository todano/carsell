<?php

namespace Tod\Models;

use Exception;

class Login extends Model
{
  private $role = 'user';
  private $name;
  private $lastName;
  private $username;
  private $email;
  private $password;
  private $repassword;
  private $city;


  public function __construct()
  {
    parent::__construct();
  }

  public function storeToDB($params)
  {
    // if (($this->response['msg'] = $this->validate($params)) == true) {
    //   $this->response['errors'] = true;
    //   return $this->response;
    // }
    $this->validate($params);
    $this->validateEmail($params['email']);
    $this->validatePassword($params['password'], $params['repassword']);
    if($this->response['errors'] != false){
      return $this->response;
    }
    try {
      $this->fillData($params);
      // $date = date('Y-m-d H:i:s');
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
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                NOW(),
                NOW())";
      $query = $this->db->prepare($sql);
      $query->execute([
        $this->role,
        $this->name,
        $this->lastName,
        $this->username,
        $this->email,
        $this->password,
        $this->city
      ]);
      $userId = $this->db->lastInsertId();
      $sql = "SELECT *
              FROM `users`
              WHERE `email` = :email
              ";
      $query = $this->db->prepare($sql);
      $query->execute([':email' => $this->email]);
      $this->response['data'] = $query->fetch(\PDO::FETCH_ASSOC);
      $this->response['msg'] = "Account has ben created successfully!";
    } catch (\PDOException $e) {
      $this->response['msg'] = "There was some error, please contact with us.";
      $this->response['errors'][] = $sql . "<br>" . $e->getMessage();
    }
    
    if(!empty($params['img']) && !empty($this->response['errors'])) {
      $defaultImg = NULL;
      $dir = 'users';
      foreach ($params['img']['name'] as $key => $val) {
        $name = $params['img']['name'][$key];
        $tmpName = $params['img']['tmp_name'][$key];
        $size = $params['img']['size'][$key];
        $imgPath = $this->imgVer($name, $tmpName, $size, $dir, $userId);
        if(!$defaultImg){
          $defaultImg = $imgPath;
        }
      }
      if($defaultImg){
        $sql = "UPDATE `users` SET default_img = :defaultImg WHERE id = :userId";
        $query = $this->db->prepare($sql);
        // $query->bindParam(':defaultImg', $defaultImg, \PDO::PARAM_STR,
        //                   ':userId', $userId, \PDO::PARAM_INT);
        $query->execute([':defaultImg' => $defaultImg,
                          ':userId' => $userId
        ]);
      }
    }
    return $this->response;
  }  

  private function validate($params)
  {
    if (isset($params)) {
      //validate name
      if(isset($params['name'])){
        if(!mb_strlen($params['name'])){
          $this->response['msg']['name'] = "Please input a name.";
        }else if (mb_strlen($params['name']) > 32) {
          $this->response['msg']['name'] = "The maximum lenth of the name is 32 symbols.";
        }
      }  
      //validate lastName
      if(isset($params['lastName'])){  
        if(!mb_strlen($params['lastName'])) {
          $errors['lastName'] = "Please input a name.";
        }else if (mb_strlen($params['lastName']) > 32) {
          $errors['lastName'] = "The maximum lenth of the name is 32 symbols.";
        }
      }  
      //validate username
      if(isset($params['username'])){  
        if (!mb_strlen($params['username'])) {
          $this->response['msg']['username'] = "Please input a name.";
        } else if (mb_strlen($params['username']) > 32) {
          $this->response['msg']['username'] = "The maximum lenth of the name is 32 symbols.";
        }
      }  
      //validate city
      if(isset($params['city'])){  
        if (!mb_strlen($params['city'])) {
          $this->response['msg']['city'] = "Type a city.";
        } else if (mb_strlen($params['city']) > 32) {
          $this->response['msg']['city'] = "Maximum lenth of a city is 32 letters.";
        }
      }  
    }
    if($this->response['msg']){
      $this->response['errors'] = true;
    }
    return; //$this->response;
  }
  private function validatePassword($password, $repassword){ 
    if (!mb_strlen($password)) {
      $this->response['msg'] = "Type a password.";
    } else if (mb_strlen($password) < 8 || mb_strlen($password) > 100) {
      $this->response['msg'] = "Password should be between 8 and 100 letters.";
    }
    if (!mb_strlen($repassword)) {
      $this->response['msg'] = "Repeat password.";
    } else if ($password !== $repassword) {
      $this->response['msg'] = "Two passwords doesnt match up.";
    }
    if($this->response['msg']){
      $this->response['errors'] = true;
    }
    return; 
  }

  private function validateEmail(string $email){ 
      if (!mb_strlen($email)) {
        $this->response['msg']['email'] = "Please input an email address.";
      } else if (mb_strlen($email) > 64) {
        $this->response['msg']['email'] = "The maximum lenth of the email is 64 symbols.";
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->response['msg']['email'] = "Input a valid email address.";
      } else {
        $sql = "SELECT *
                  FROM `users`
                  WHERE `email` = :email
                  ";
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();
        $result = $query->fetchColumn();
        if ($result) {
          $this->response['msg'] = "There is already a user with that email.";
        }
      }  
      if($this->response['msg']){
        $this->response['errors'] = true;
      }
      return;
  }
  
  private function fillData($params)
  {
    $this->name = $params['name'];
    $this->lastName = $params['lastName'];
    $this->username = $params['username'];
    $this->email = $params['email'];
    $this->password = password_hash($params['password'], PASSWORD_DEFAULT);
    $this->repassword = $params['repassword'];
    $this->city = $params['city'];
  }

  public function checkUser($credits)
  {
    $sql = "SELECT *
            FROM `users`
            WHERE `email` = '{$credits['email']}'
            ";
    $query = $this->db->prepare($sql);
    $query->execute();
    $user = $query->fetch(\PDO::FETCH_ASSOC);

    if (!password_verify($credits['password'], $user['password'])) {
      throw new Exception('Password is incorrect');
    }
    return $user;
  }

  public function getUsers($page = 1, $perPage = 6, $role = 'user'){
    $from = ($page - 1);
    if ($from > 0) {
      $from *= $perPage;
    }
    $sql = "SELECT * FROM `users`";
    if($role != 'admin'){
      $sql.= " WHERE verified != 0";
    }
    $sql .= " LIMIT {$from},{$perPage}"; 
    $query = $this->db->prepare($sql);
    $query->execute();
    $users = $query->fetchAll(\PDO::FETCH_ASSOC);
    return $users;
  }

  public function getUser($id){
    $sql = "SELECT * FROM `users` WHERE id = ?";
    $query = $this->db->prepare($sql);
    $query->execute([$id]);
    $user['data'] = $query->fetchAll(\PDO::FETCH_ASSOC)[0];
    $sql = "SELECT * FROM `users` WHERE id = ? AND verified != 0";
    $query = $this->db->prepare($sql);
    $query->execute([$id]);
    $user['ver'] = $query->fetchColumn();
    return $user;
  }

  public function countPages($perPage = 6, $role = 'user')
  {
    $sql = "SELECT COUNT('id') FROM `users`"; 
    if($role != 'admin'){
      $sql.= " WHERE verified != 0";
    }  
    
    $query = $this->db->prepare($sql);
    $query->execute();
    $count = implode($query->fetch(\PDO::FETCH_NUM));
    $pages = $count / $perPage;

    if (is_float($pages)) {
      $pages = (int)$pages + 1;
    }
    return $pages;
  }

  public function verifyUsers($verify){
    $userId = [];
    //TODO cast key value as int
    foreach ($verify as $key => $value){
      if($value == 'on'){
        $userId[] = $key ; 
      }
    }
    $userVer = join(',',$userId);
    $sql = "UPDATE `users` SET verified = 1 WHERE id IN ({$userVer})";
    $query = $this->db->prepare($sql);
    $query->execute();
    return;
  }  

  public function UpdateDB($id, $params){
    $this->validate($params);
    if($this->response['errors'] != true){
      try {
        $sql = "UPDATE `users` SET 
                        `name` = ?,
                        `last_name` = ?,
                        `username` = ?,
                        `city` = ?,
                        `last_update`= NOW()
                        WHERE id = ?
                      ";
        $query = $this->db->prepare($sql);
        $query->execute([$params['name'],
                         $params['lastName'],
                         $params['username'],
                         $params['city'],
                         $id
        ]);
        $this->response['msg'] = "Account has ben updated successfully!";
      } catch (\PDOException $e) {
        $this->response['msg'] = "There was some error, please contact with us.";
        $this->response['errors'][] = $sql . "<br>" . $e->getMessage();
      }
    }
    //echo '<pre>'; print_r($this->response); die;
    return $this->response;
  }

  public function updatePassword($id, $passwords){
    $sql = "SELECT *
            FROM `users`
            WHERE `id` = ?
            ";
    $query = $this->db->prepare($sql);
    $query->execute([$id]);
    $result = $query->fetch(\PDO::FETCH_ASSOC);

    if (!password_verify($passwords['oldPassword'], $result['password'])) {
      $this->response['msg'] = 'Password is incorect';
      $this->response['errors'] = true;
      return $this->response;
    }
    $this->validatePassword($passwords['newPassword'], $passwords['repassword']);
    
    $passwords['newPassword'] = password_hash($passwords['newPassword'], PASSWORD_DEFAULT);
    
    if(!$this->response['errors']){
      $sql = "UPDATE `users` SET `password`= ?, `last_update`= NOW() WHERE id = ?";
      $query = $this->db->prepare($sql);
      $query->execute([$passwords['newPassword'], $id]);
      $this->response['msg'] = 'Your password is successfuly changed!';
    }
    return $this->response;
  }

  public function updateEmail($id, $email){
    $this->validateEmail($email);
    if(!$this->response['errors']){
      try{
        $sql = "UPDATE `users` SET email = ?, `last_update`= NOW() WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$email, $id]);
      }catch (PDOException $e) {
        $this->response['msg'] = "There was some error, please contact with us.";
        $this->response['errors'][] = $sql . "<br>" . $e->getMessage();
      }  
    }
    if(!$this->response['errors']){
      $this->response['msg'] = 'Your email is updated!';
    }
    return $this->response;
  }
}
