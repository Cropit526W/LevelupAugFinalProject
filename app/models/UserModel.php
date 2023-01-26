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

    public function add(array $user)
    {
        //TODO get func with elements from $_POST
        //TODO I suggest do it with prepared queries
    }

    public function del()
    {
        //TODO del func and use $stmt->bind_param cause we have a variable in the query
        //TODO $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        //        $stmt->bind_param('i', $_POST['id']);
        //        $stmt->execute();
    }
}