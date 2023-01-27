<?php
namespace app\controllers;

use app\core\AbstractController;
use app\models\UserModel;

class AdminController extends AbstractController
{

    public function __construct()
    {
        parent::__construct('admin');
        $this->addAdmin();
    }

    public function index()
    {
        $this->view->render(
            'admin',
            [
                'user' => [],
            ]
        );
    }

    public function login()
    {
        $this->view->render(
            'admin',
            [
                'user' => [1],
            ]
        );
    }

    /**
     * Let's add the admin user to the databases
     * @return void
     */
    public function addAdmin() : void
    {
        $userModel = new UserModel();
        $userModel->add(
            [
                'login' => 'admin',
                'pass' => 'admin',
                'main' => 1,
            ]
        );
    }
}