<?php

namespace app\controllers;

use app\core\AbstractController;
use app\core\Route;
use app\models\UserModel;

class LoginController extends AbstractController
{
    protected UserModel $userModel;

    public function __construct()
    {
        parent::__construct('admin');
        $this->userModel = new UserModel();
    }

    /**
     * Let's display view login.php
     * @return void
     */
    public function index() : void
    {
        $this->view->render('login');
    }

    /**
     * Redirect to method Index of AdminController.php or method Index of LoginController.php with error
     * @return void
     */
    public function login() : void
    {
        if(!empty($_POST['login']) && !empty($_POST['pass'])){

            $user = $this->userModel->get($_POST['login']);

            if(is_null($user)){
                Route::redirect('login', 'index', 'error=2');
            }

            if(password_verify($_POST['pass'], $user['pass'])){
                $_SESSION['authorized'] = true;
                $_SESSION['userId'] = $user['id'];
                Route::redirect('admin', 'index');
            } else {
                Route::redirect('login', 'index', 'error=1');
            }
        }
    }

    /**
     * Redirect to method Index of LoginController.php
     * @return void
     */
    public function logout() : void
    {
        session_destroy();
        Route::redirect('login', 'index');
    }
}