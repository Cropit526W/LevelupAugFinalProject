<?php

namespace app\core;

use app\controllers\AdminController;
use database\CreateDB;
use mysqli;
use mysqli_sql_exception;

class Model
{
    protected $db;

    public function __construct()
    {
        try{
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        } catch (mysqli_sql_exception){
            CreateDB::create();
            AdminController::addAdmin();
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
    }
}