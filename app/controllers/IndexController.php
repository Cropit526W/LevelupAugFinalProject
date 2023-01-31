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
        $allAdsForIndexPage = $this->model->getAll();
        $allPhotos = $this->model->getAllPthotos();
        $this->view->render('index_index',
            [
                'allAdsForIndexPage' => $allAdsForIndexPage,
                'allPhotos' => $allPhotos,
            ]
        );
    }


}