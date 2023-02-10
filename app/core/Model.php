<?php

namespace app\core;

use database\CreateDB;
use mysqli;
use mysqli_sql_exception;

class Model
{
    /**
     * @var mysqli
     */
    protected mysqli $db;

    public function __construct()
    {
        try {
            $this->createDefaultDbClass();
        } catch (mysqli_sql_exception $exception) {
            if ($exception->getCode() === 1049) {
                CreateDB::create();
                $this->createDefaultDbClass();
            } else {
                exit('Some problem with connection to database');
            }
        }
    }

    /**
     * Create the new database
     * @return void
     */
    private function createDefaultDbClass(): void
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
}