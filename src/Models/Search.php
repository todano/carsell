<?php
namespace Tod\Models;

class Search extends Model
{
    private $search;

    public function __construct()
    {
        parent::__construct();
    }

    public function index($search, $page, $perPage, $role){
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

        $search = array_fill(0,14, "%$search%");
        $sql = "SELECT * FROM `cars` c
                INNER JOIN `users` u
                ON c.user_id=u.id
                WHERE 
                (c.brand LIKE ? OR
                c.model LIKE ? OR
                c.date_production LIKE ? OR
                c.mileage LIKE ? OR
                c.price LIKE ? OR
                c.fuel LIKE ? OR
                c.hp LIKE ? OR
                c.cubic LIKE ? OR
                c.category LIKE ? OR
                u.`name` LIKE ? OR
                u.`last_name` LIKE ? OR
                u.`username` LIKE ? OR
                u.`city` LIKE ? OR
                c.transmission LIKE ?)";
        if($role != 'admin'){
          $sql.= " AND c.verified != 0 ";
        } 
        $sql .= " LIMIT {$from},{$perPage}";
        $query = $this->db->prepare($sql);
        $query->execute($search);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        // serach by users ;
        if(!$result){
          $this->response['msg'] = 'Nothing found!';
          return $this->response;
        }
        return $result;
    }
    public function countPages($search, $perPage){
      $search = array_fill(0,14, "%$search%");
      $sql = "SELECT * FROM `cars` c
                  INNER JOIN `users` u
                  ON c.user_id=u.id
                  WHERE 
                  c.brand LIKE ? OR
                  c.model LIKE ? OR
                  c.date_production LIKE ? OR
                  c.mileage LIKE ? OR
                  c.price LIKE ? OR
                  c.fuel LIKE ? OR
                  c.hp LIKE ? OR
                  c.cubic LIKE ? OR
                  c.category LIKE ? OR
                  u.`name` LIKE ? OR
                  u.`last_name` LIKE ? OR
                  u.`username` LIKE ? OR
                  u.`city` LIKE ? OR
                  c.transmission LIKE ?";

        $query = $this->db->prepare($sql);
        $query->execute($search);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $count = count($result);
        $pages = $count / $perPage;

        if (is_float($pages)) {
          $pages = (int)$pages + 1;
        }
        return $pages;
    }
}