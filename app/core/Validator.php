<?php

namespace app\core;

class Validator
{
    protected array $errors = [];

    public function validateName($name)
    {
        if (empty($name)) {
            $this->errors[] = 'Name can not be empty';
        }
        if (strlen($name)<5) {
            $this->errors[] = 'Name must be greatest then 10 characters';
        }
        if (count($this->errors)>0){
            return false;
        } else {
            return true;
        }
    }

    public function getErrors() {
        return$this->errors;
    }
}