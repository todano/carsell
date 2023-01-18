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
      
        $sql = " SELECT * FROM `cars` c
                  INNER JOIN `users` u
                  ON c.user_id=u.id
                  WHERE 
                  c.brand LIKE '%{$search}%' OR
                  c.model LIKE '%{$search}%' OR
                  c.date_production LIKE '%{$search}%' OR
                  c.mileage LIKE '%{$search}%' OR
                  c.price LIKE '%{$search}%' OR
                  c.fuel LIKE '%{$search}%' OR
                  c.hp LIKE '%{$search}%' OR
                  c.cubic LIKE '%{$search}%' OR
                  c.category LIKE '%{$search}%' OR
                  u.`name` LIKE '%{$search}%' OR
                  u.`last_name` LIKE '%{$search}%' OR
                  u.`username` LIKE '%{$search}%' OR
                  u.`city` LIKE '%{$search}%' OR
                  c.transmission LIKE '%{$search}%';";

        $sql .= " LIMIT {$from},{$perPage}";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        // serach by users ;
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