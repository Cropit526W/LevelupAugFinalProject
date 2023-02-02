<?php

namespace app\core;

use app\models\UserModel;

class Validator
{
    protected array $errors = [];

    protected $session;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->session = new Session();

    }

    public function validateName($name)
    {
        if (empty($name)) {
            $this->errors[] = 'Name can not be empty';
        }
        if (strlen($name)<5) {
            $this->errors[] = 'Name must be greater then 10 characters';
        }
        if (count($this->errors)>0){
            return false;
        } else {
            return true;
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    /**
     * Returns a list of errors about users
     * @param $user
     * @return array
     */
    public function validateAddUser($user) : array
    {
        if (!empty($this->model->get($user['login']))) {
            $this->errors[] = 'This user already exists in the database';
        }

        if (count($this->errors) > 0) {
            $this->session->save('Add new user', $this->errors);
        }

        return $this->errors;
    }

    /**
     * Returns a list of errors about delete the user
     * @param string $msg
     * @return void
     */
    public function validateDeleteUser(string $msg) : void
    {
        $this->errors[] = $msg;
        $this->session->save('Delete user', $this->errors);
    }
}