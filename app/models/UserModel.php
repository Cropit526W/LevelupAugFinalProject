<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    /**
     * User request
     * @param array $params
     * @return string
     */
    public function query(array $params = []) : string
    {
        $sql = "SELECT * FROM users";

        if (count($params) > 0) {
            $sql .= " WHERE ";
            foreach ($params as $param => $value) {
                $sql .= "$param = '$value' AND";
            }
            $sql = substr($sql,0,-4);
        }

        return $sql;
    }

    /**
     * Let's get users from the database
     * @param string $methodName
     * @return array
     */
    public function get(string $query): array
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        return $users;
    }

    /**
     * Check if the user is in the database
     * @param $user
     * @return bool
     */
    public function is($user): bool
    {
        $sql = $this->query(
            [
                'login'=> $user['login'],
            ]
        );
        $users = $this->get($sql);

        return in_array($user['login'], array_column($users, 'login'));
    }

    /**
     * Add a new user to the database
     * @param array $user
     * @return void
     */
    public function add(array $user): void
    {
        if (!$this->is($user)) {
            $user['main'] = $user['main'] ?? 0;
            $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (login, pass, main) 
                    VALUES ('{$user['login']}', '{$user['pass']}', '{$user['main']}');";
            $this->db->query($sql);
            $result = mysqli_affected_rows($this->db) !== 1;
            if ($result) {
                // TODO create log
                exit('some problem with insert user');
            } else {
                header('Location: /admin');
            }
        } else {
            // TODO have user;
        }
    }

    /**
     * Let's delete the user by id from the database
     * @param $id
     * @return void
     */
    public function delete($id): void
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
    }

}