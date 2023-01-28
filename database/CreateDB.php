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
        $createDb->createDb();
        $createDb->createTables();
    }

    protected function createDb()
    {
        $sql = "CREATE DATABASE if not exists final";

        $this->db->query($sql);
    }

    protected function createTables()
    {
        $users = "CREATE TABLE if not exists final.users 
                (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                    login VARCHAR(60) NOT NULL, 
                    pass VARCHAR(255) NOT NULL,
                    main TINYINT(1) DEFAULT 0 NOT NULL,
                    created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
                )";

        $this->db->query($users);

        $authors = "CREATE TABLE IF NOT EXISTS final.authors
                    (
                        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(255) NOT NULL,
                        surname VARCHAR(255) NOT NULL,  
                        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
                    )";

        $this->db->query($authors);

        $phones = "CREATE TABLE IF NOT EXISTS final.phones
                   (
                        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        number VARCHAR(13),
                        author_id BIGINT UNSIGNED NOT NULL,
                        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                        FOREIGN KEY (author_id) REFERENCES final.authors(id)
                   )";

        $this->db->query($phones);

        $ads = "CREATE TABLE IF NOT EXISTS final.ads
                (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    text TEXT NOT NULL,
                    author_id BIGINT UNSIGNED NOT NULL,  
                    created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    FOREIGN KEY (author_id) REFERENCES final.authors(id)
                )";

        $this->db->query($ads);

        $photos = "CREATE TABLE IF NOT EXISTS final.photos
                   (
                       id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       name VARCHAR(255) NOT NULL,
                       url VARCHAR(2083) NOT NULL,
                       ad_id BIGINT UNSIGNED NOT NULL,
                       created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                       FOREIGN KEY (ad_id) REFERENCES final.ads(id)
                   )";

        $this->db->query($photos);
    }
}