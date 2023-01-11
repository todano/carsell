<?php
namespace Tod\Models;
use Tod\Helpers\Database as DB;
class Model
{
    protected $db;
    public function __construct()
    {
        $this->db = DB::getConnection();
    }
}