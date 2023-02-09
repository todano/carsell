<?php
namespace Tod\Models;
use Tod\Helpers\Database as DB;
class Model
{
    protected $db;
    protected $response = [
        'msg' => [],
        'errors' => [],
        'data' => []
      ];

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

    protected function imgVer($name, $tmpName, $size,$dir, $id)
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
}