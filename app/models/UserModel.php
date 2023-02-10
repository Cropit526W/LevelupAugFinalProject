<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    /**
     * Database table name
     * @var string
     */
    protected string $table = 'users';

    /**
     * Let's get all users from the database
     * @return array
     */
    public function all() : array
    {
        $sql = "SELECT * FROM $this->table";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        return $users;
    }

    /**
     * Let's get the user from the database
     * @param string $login
     * @return array
     */
    public function get(string $login) : array
    {
        $sql = "SELECT * FROM $this->table WHERE login = '$login' LIMIT 1";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }

    /**
     * Add the new user to the database
     * @param array $user
     * @return void
     */
    public function add(array $user): void
    {
        $user['main'] = $user['main'] ?? 0;
        $user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (login, pass, main) 
                    VALUES ('{$user['login']}', '{$user['pass']}', '{$user['main']}');";
        $this->db->query($sql);
        $result = mysqli_affected_rows($this->db) !== 1;
        // TODO validate?
    }

    /**
     * Let's delete the user by id from the database
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $sql = "DELETE FROM $this->table WHERE id = $id;";
        return $this->db->query($sql);
    }


}