<?php

namespace app\core;

use app\models\UserModel;

class Validator
{
    protected array $errors = [];

    public function __construct()
    {
        $this->model = new UserModel();
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
    public function userErrors($user) : array
    {
        if ($this->model->is($user)) {
            $this->errors[] = 'This user already exists in the database';
        }
        return $this->errors;
    }
}