<?php
namespace app\controllers;
use app\core\AbstractController;
use app\core\Route;

class AdminController extends AbstractController
{

    public function __construct()
    {
        parent::__construct('admin');
    }


    public function index()
    {
        $this->view->render('admin');
    }
}