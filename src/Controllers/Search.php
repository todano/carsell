<?php

namespace Tod\Controllers;

use Tod\Models\Search as SearchM;

class Search extends Controller
{
    private $search;

    public function __construct()
    {
        parent::__construct(SearchM::class);
    }

    public function index($search = NULL, $page = 1, $perPage = 6)
    {
        $search = $_POST['search'];
        if (!$search) {
            header('location:\index.php');
        }
        $result = $this->model->index($search, $page, $perPage);
        if (isset($result['message'])) {
            $this->renderView('main', 'index', $result);
        }
        $this->renderView('main', 'index', $result);
    }
}
