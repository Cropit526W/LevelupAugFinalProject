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

    /**
     * Display all by user
     * @return void
     */
    public function index() : void
    {
        $users = $this->model->all();
        $this->view->render(
            'user_index',
            [
                'users' => $users,
            ]
        );
    }

//    public function login()
//    {
//        var_dump('UserController');
//        exit();
//
//        $result = $this->model->get();
//
//        //TODO validation
//        Route::redirect('user', 'index'); #if validation ok
//    }

    /**
     * Opening the form for creating a new user
     * @return void
     */
    public function create() : void
    {
        $this->view->render('user_create');
    }

    /**
     * Saving a new user
     * @return void
     */
    public function store() : void
    {
        $user = filter_input_array(INPUT_POST,
            [
                'login'=>FILTER_DEFAULT,
                'pass'=>FILTER_DEFAULT,
            ]
        );

        $this->model->add($user);
        Route::redirect('user', 'index');
    }

    /**
     * Deleting a user by id
     * @return void
     */
    public function destroy() : void
    {
        $id = filter_input(INPUT_POST, 'id');
        $this->model->delete($id);
        Route::redirect('user', 'index');
    }
}