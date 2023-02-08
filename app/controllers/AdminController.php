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

}