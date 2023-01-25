<?php
namespace app\controllers;
use app\core\AbstractController;

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