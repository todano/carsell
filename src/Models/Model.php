<?php
namespace Tod\Models;
use Tod\Helpers\Database as DB;
abstract class Model
{
    protected $db;
    protected $response = [
        'msg' => [],
        'errors' => false,
        'data' => []
      ];
    
    abstract public function countPages($perPage = 6, $role = 'user');  
    public function __construct()
    {
        $this->db = DB::getConnection();
    }

    public function setResponse($msg = '', $errors = []){
        $this->response['msg'] = $msg;
        $this->response['errors'] = $errors;
    }

    public function getResponse(){
        return $this->response;
    }

    public function except($data = [], $except = []){
        $result = [];
        foreach ($data as $key => $item){
            if(in_array($key, $except)) continue;
            $result[$key] = $item;
        }
        return $result;
    }

    protected function imgVer($name, $tmpName, $size, $dir, $id)
    {
      $maxSize = 2097152;
      $location = 'src'.DS.'img'.DS.$dir.DS. $id; //directory to save imges
      $extension = strtolower(substr($name, strpos($name, '.') + 1)); //takes file extention and makes it with small letter
      $imgName = uniqid() . '.' . $extension;
      $imgPath = $location . DS . $imgName;
  
      if (!empty($name)) {
        //condition if the file extention and size are as they should be.
        if (in_array($extension, ['jpg', 'jpeg', 'image/jpeg']) && $size < $maxSize) {
          if (!is_dir($location)) {
            mkdir($location);
          }
          if (!move_uploaded_file($tmpName, $imgPath)) {
            $this->response['errors'][] = 'File cannot be moved';
          }
        } else {
          $this->response['errors'][] = "The image should be less than 2Mb!";
        }
      } else {
        $this->response['errors'][] = "Please choose a file!";
      }
      $this->response['msg'] = "Successfully uploaded";
  
      return $imgName;
    }

    public function delete($dir, $id){
      $location = 'src'.DS.'img'.DS.$dir.DS. $id;
      if($dir == 'cars'){
        try{
          $sql = "DELETE FROM `cars` WHERE car_id = ?";
          $query = $this->db->prepare($sql);
          $query->execute([$id]);
        } catch (PDOException $e){
          $this->response['msg'] = 'This add cannot be deleted!';
          $this->response['errors'] = $sql . "<br>" . $e->getMessage();
        }
      } 
      if($dir == 'users'){
        try{
          $sql = "DELETE FROM `users` WHERE id = ?";
          $query = $this->db->prepare($sql);
          $query->execute([$id]);
        } catch (PDOException $e){
          $this->response['msg'] = 'This add cannot be deleted!';
          $this->response['errors'] = $sql . "<br>" . $e->getMessage();
        }
      } 
      
      if(is_dir($location) && empty($this->response['errors'])){
        $files = scandir($location);
        foreach ($files as $file){
          if(is_file($location.DS.$file)){
            unlink($location.DS.$file);
          }
        }
        if(is_dir($location)){
          rmdir($location);
        }
      }  
      return $this->response;
    }
}