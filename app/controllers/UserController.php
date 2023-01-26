<?php

namespace app\controllers;

use app\core\Route;
use app\models\UserModel;

class UserController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    public function index()
    {
        $this->view->render('user_index');
    }

    public function login()
    {
        $result = $this->model->get();
        //TODO validation
        Route::redirect('user', 'index'); #if validation ok
    }

    public function create()
    {
        $this->view->render('user_create');
    }

    public function store()
    {
        $user = filter_input_array(INPUT_POST,
        [
            'login'=>FILTER_DEFAULT,
        ]
        );
        $this->model->add($user);
        Route::redirect('user', 'create');
    }

    public function destroy()
    {
        $this->model->del();
        Route::redirect('user', 'index');
    }
}