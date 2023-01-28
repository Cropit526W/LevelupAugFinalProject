<?php

namespace app\controllers;

use app\core\Route;
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
     * Display all by user
     * @return void
     */
    public function index() : void
    {
        $sql = $this->model->queryAll();
        $users = $this->model->get($sql);
        $this->view->render(
            'user_index',
            [
                'users' => $users,
                'errors' => [],
            ],
        );
    }

    /**
     * Opening the form for creating a new user
     * @return void
     */
    public function create() : void
    {
        $this->view->render(
            'user_create',
            [
                'errors' => [],
            ]
        );
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

        $errors = $this->validate->userErrors($user);

        if (count($errors) > 0) {
            $this->view->render(
                'user_create',
                [
                    'errors' => $errors,
                ]
            );
        } else {
            $this->model->add($user);
            Route::redirect('user', 'index');
        }
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