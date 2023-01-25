<?php

namespace app\models;

use app\core\Model;

class Advertisement extends Model
{
    public function getAll()
    {
        $sql = 'SELECT * FROM advertisements';

        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
}