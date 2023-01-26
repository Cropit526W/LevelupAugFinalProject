<?php

namespace app\controllers;

use app\models\AdsModel;

class AdsController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new AdsModel();
    }

    public function index()
    {
//        $this->model->getAll();
        $this->view->render('ads_index');
    }

    public function create()
    {
        $this->view->render('ads_create');
    }

    public function store()
    {
        //TODO
//        $this->model->add();
    }

    public function destroy()
    {
        //TODO
//        $this->model->del();
    }

    public function edit()
    {
        //TODO
//        $this->model->edit();
    }
}