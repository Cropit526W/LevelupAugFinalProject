<?php

namespace app\models;
use app\core\Model;
use app\core\Route;
use mysqli;
class UserModel extends Model
{
    public function get()
    {
        if (!empty($_POST['login']))
        {
            $stmt = $this->db->prepare("SELECT login FROM users");
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_assoc();
        }else {
            exit('oops!');
        }
        return $result;
    }
}