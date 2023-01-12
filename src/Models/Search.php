<?php
namespace Tod\Models;

class Search extends Model
{
    private $search;
    private $response = [
        'message' => '',
        'errors' => []
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index($search, $page, $perPage){
        if (isset($_GET['page'])) {
            $page = (int) $_GET['page'];
          }
          if (isset($_GET['perPage'])) {
            $perPage = (int) $_GET['perPage'];
          }
      
          $from = ($page - 1);
          if ($from > 0) {
            $from *= $perPage;
          }
      
        $sql = "SELECT * FROM `cars` WHERE 
        brand LIKE '%{$search}%' OR
        model LIKE '%{$search}%' OR
        date_production LIKE '%{$search}%' OR
        mileage LIKE '%{$search}%' OR
        price LIKE '%{$search}%' OR
        fuel LIKE '%{$search}%' OR
        hp LIKE '%{$search}%' OR
        cubic LIKE '%{$search}%' OR
        category LIKE '%{$search}%' OR
        transmission LIKE '%{$search}%'";

        $sql .= " LIMIT {$from},{$perPage}";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        if(!$result){
          $this->response['message'] = 'Nothing found!';
          return $this->response;
        }
        return $result;
    }
    public function countPages($search, $perPage){
      $sql = "SELECT * FROM `cars` WHERE 
        brand LIKE '%{$search}%' OR
        model LIKE '%{$search}%' OR
        date_production LIKE '%{$search}%' OR
        mileage LIKE '%{$search}%' OR
        price LIKE '%{$search}%' OR
        fuel LIKE '%{$search}%' OR
        hp LIKE '%{$search}%' OR
        cubic LIKE '%{$search}%' OR
        category LIKE '%{$search}%' OR
        transmission LIKE '%{$search}%'";

        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $count = count($result);
        $pages = $count / $perPage;

        if (is_float($pages)) {
          $pages = (int)$pages + 1;
        }
        return $pages;
    }
}