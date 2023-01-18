<?php
namespace Tod\Models;
use Tod\Helpers\Database as DB;
class Model
{
    protected $db;
    protected $response = [
        'msg' => '',
        'errors' => []
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
}