<?php

namespace app\controllers;

class IndexController extends \app\core\AbstractController
{
    public function __construct()
    {
        parent::__construct('main');
    }


    public function index()
    {
        $this->view->render('index_index');
    }
}