<?php

namespace app\controllers;

use app\core\Paginator;

class IndexController extends \app\core\AbstractController
{

    protected Paginator $paginator;
    public function __construct()
    {
        parent::__construct('main');
        $this->paginator = new Paginator();
    }


    public function index()
    {
        $allAdsForIndexPage = $this->model->getAllIndexPage($this->paginator->fromId(), $this->paginator->elementsPerPage);
        $allPhotos = $this->model->getAllPthotos();
        $pagesLinks = $this->paginator->createPagesButtons();
        $this->view->render('index_index',
            [
                'allAdsForIndexPage' => $allAdsForIndexPage,
                'allPhotos' => $allPhotos,
                'pagesLinks' => $pagesLinks,
            ]
        );
    }


}