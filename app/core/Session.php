<?php

namespace app\core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Write data to session
     * @param string $prop
     * @param array $data
     * @return void
     */
    public function save(string $prop, array $data) : void
    {
        $_SESSION[$prop] = $data;
    }

    /**
     * Return data from session
     * @param string $prop
     * @return array
     */
    public static function all(string $prop) : array
    {
        if (isset($_SESSION[$prop])) {
            $errors = $_SESSION[$prop];
            unset($_SESSION[$prop]);
            return $errors;
        }
        return [];
    }

}