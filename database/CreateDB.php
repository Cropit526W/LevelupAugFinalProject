<?php

namespace database;

use mysqli;

class CreateDB
{
    protected mysqli $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, '');
    }

    public static function create()
    {
        $createDb = new CreateDB();
        $dbName = DB_NAME;
        $createDb->createDb($dbName);
        $createDb->createTables($dbName);
    }

    protected function createDb($dbName)
    {
        $sql = "CREATE DATABASE if not exists $dbName";

        $this->db->query($sql);
    }

    protected function createTables($dbName)
    {
        $users = "CREATE TABLE if not exists $dbName.users
                (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    login VARCHAR(60) NOT NULL,
                    pass VARCHAR(255) NOT NULL,
                    main TINYINT(1) DEFAULT 0 NOT NULL,
                    created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
                )";

        $this->db->query($users);

//        $authors = "CREATE TABLE IF NOT EXISTS $dbName.authors
//                    (
//                        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//                        name VARCHAR(255) NOT NULL,
//                        surname VARCHAR(255) NOT NULL,
//                        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
//                    )";
//
//        $this->db->query($authors);
//
//        $phones = "CREATE TABLE IF NOT EXISTS $dbName.phones
//                   (
//                        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//                        number VARCHAR(13),
//                        author_id BIGINT UNSIGNED NOT NULL,
//                        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
//                        FOREIGN KEY (author_id) REFERENCES $dbName.authors(id)
//                   )";
//
//        $this->db->query($phones);

        $ads = "CREATE TABLE IF NOT EXISTS $dbName.ads
                (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    description TEXT NOT NULL,
                    author VARCHAR(255) NOT NULL,
                    phone VARCHAR(16) NOT NULL,
                    created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
                )";

        $this->db->query($ads);

        $photos = "CREATE TABLE IF NOT EXISTS $dbName.photos
                   (
                       id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(255) NOT NULL,
                       url VARCHAR(2083) NOT NULL,
                       created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
                   )";

        $this->db->query($photos);
    }
}