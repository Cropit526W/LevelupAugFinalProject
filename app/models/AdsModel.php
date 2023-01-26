<?php

namespace app\models;

use app\core\Model;

class AdsModel extends Model
{
    public function getAll()
    {
        $sql = 'SELECT * FROM advertisements';

        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function add()
    {
        //TODO
    }

    public function del()
    {
        //TODO
    }

    public function edit()
    {
        //TODO
    }
}