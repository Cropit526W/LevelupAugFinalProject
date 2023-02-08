<?php

namespace app\controllers;

use app\core\Route;
use app\core\Session;
use app\core\Validator;
use app\models\UserModel;

class UserController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
        $this->validate = new Validator();
    }

    /**
     * Display all users
     * @return void
     */
    public function index() : void
    {
        $users = $this->model->all();
        $errors = Session::all('Delete user');
        $this->view->render(
            'user_index',
            [
                'users' => $users,
                'errors' => $errors,
            ],
        );
    }

    /**
     * Display the form for creating the new user
     * @return void
     */
    public function create() : void
    {
        $errors = Session::all('Add new user');
        $this->view->render(
            'user_create',
            [
                'errors' => $errors,
            ]
        );
    }

    /**
     * Saving the new user
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

        $errors = $this->validate->validateAddUser($user);

        if (count($errors) > 0) {
            Route::redirect('user', 'create');
        } else if (empty($this->model->get($user['login']))) {
            $this->model->add($user);
            Route::redirect('user', 'index');
        }
    }

    /**
     * Deleting the user by id
     * @return void
     */
    public function destroy() : void
    {
        $id = filter_input(INPUT_POST, 'id');
        $result = $this->model->delete($id);

        if (!$result) {
            $msg = "An error occurred while executing a query to the database";
            $this->validate->validateDeleteUser($msg);
        }

        Route::redirect('user', 'index');
    }
}