<?php
namespace app\controllers;

use app\core\AbstractController;
use app\core\Route;
use app\models\UserModel;

class AdminController extends AbstractController
{

    public function __construct()
    {
        parent::__construct('admin');
    }

    /**
     * Let's display view admin_index.php
     * @return void
     */
    public function index() : void
    {
        $this->view->render(
            'admin_index'
        );
    }

    /**
     * Let's display template admin.php
     * @return void
     */
    public function login() : void
    {
        $this->view->render('admin');
    }

    /**
     * Let's add the admin user to the databases
     * @return void
     */
    public static function addAdmin() : void
    {
        $login = 'admin';

        $userModel = new UserModel();
        if (empty($userModel->get($login))){
            $userModel->add(
                [
                    'login' => $login,
                    'pass' => 'admin',
                    'main' => 1,
                ]
            );
            Route::redirect('admin', 'index');
        }
    }
}