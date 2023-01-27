<?php

namespace Tod\Controllers;

use Tod\Models\Search as SearchM;

class Search extends Controller
{
    private $search;
    private $pages;

    public function __construct()
    {
        parent::__construct(SearchM::class);
    }

    public function index($search = NULL, $page = 1, $perPage = 6)
    {
        //all variables will be passed to the view
      
        $search = $_POST['search'] ?? $_GET['search'];
        
        if (!$search) {
            header('location:\index.php');
        }
        $perPage = $_GET['perPage'] ?? 6;
        $page = $_GET['page'] ?? 1;
        $result = $this->model->index($search, $page, $perPage);
        $pages = $this->model->countPages($search, $perPage); 

        
        if (isset($result['message'])) {
            $this->renderView('main', 'index', $result);
        }
        $this->renderView('main', 'index',[
            'cars' => $result,
            'page' => $page,
            'perPage' => $perPage,
            'search' => $search,
            'pages' => $pages
        ]);
    }
}
