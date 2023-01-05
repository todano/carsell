<?php
namespace Tod\Models;

Class Car
{
    private $brand;
    private $model;
    private $price;
    private $year;
    private $mileage;
    private $response = [
        'message' => '',
        'errors' => []
    ];

    public function validate($car){
                
        $car['brand'] = ucwords(trim($car['brand']));
        $car['model'] = ucwords(trim($car['brand']));
        $car['price'] = '$'.$car['price'];
        $this->imgVer($car['img']);
    }
    private function imgVer($image, $id){
        echo '<pre>'; print_r($image); die;
        if(!empty($image)){
            $name = $image['name'];
            $tmpName = $image['tmp_name'];
            $size = $image['size'];
            $extension = strtolower(substr($name,strpos($name,'.')+1));//takes file extention and makes it with small letter
          }
        //   $id = $_POST['id'] ?? $_GET['id']; TODO to get id of a add?
          $maxSize=2097152;
          if(isset($name)){
              if(!empty($name)){
                //condition if the file extention and size are as they should be.
                if($extention='jpg'||$extention='jpeg'||$extention='image/jpeg'&&$size<$maxSize){
                  $location='src/img/'; //directory to save imges
                    if(move_uploaded_file($tmpName,$location.$name)){
                      if(rename($location.$name,$location.$id.'.jpeg')){
                      }else{
                        $this->response['error'] = "The image could not be renamed!";
                      }
                    }
                }else{
                  $this->response['error'] = "The image should be less than 2Mb!";
                }
              }else{
                $this->response['error'] = "Please choose a file!";
              }
              $this->response['message'] = "Successfully uploaded";
          }
    }
}