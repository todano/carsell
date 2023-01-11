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
        engine LIKE '%{$search}%'";

        $sql .= " LIMIT {$from},{$perPage}";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result['cars'] = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        if(!$result){
           $this->response['message'] = 'Nothing found!';
           return $this->response;
        }
        return $result;
    }
}