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

    public function index()
    {
        $this->view->render(
            'login',
            [
                'user' => [],
            ]
        );
    }

    public function login()
    {
        if(!empty($_POST['login']) && !empty($_POST['pass'])){
            $user = $this->userModel->getByLogin($_POST['login']);
            if(!empty($user)){
                $user = $user[0];
            } else {
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

    public function logout(){
        session_destroy();
        Route::redirect('login', 'index');
    }
}