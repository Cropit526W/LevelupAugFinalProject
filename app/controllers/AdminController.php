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
        $this->model = new UserModel();
    }


    public function index()
    {
        $this->view->render('admin');
    }

    public function login()
    {
        $result = $this->model->get();
        Route::redirect('admin', 'main');
    }

    public function main()
    {
        $this->view->render('admin_main');
    }
}