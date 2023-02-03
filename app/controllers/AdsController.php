<?php

namespace app\controllers;

use app\core\Route;
use app\core\Validator;
use app\models\AdsModel;

class AdsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->validate = new Validator();
    }

    public function index()
    {
        $adsList = $this->model->getAll();
        $allPhotos = $this->model->getAllPthotos();
        $this->view->render('ads_index',
            [
                'adsList' => $adsList,
                'allPhotos' => $allPhotos,
            ]
        );
    }

//    public function modalWindowForEditAd()
//    {
//        $allPhotos = $this->model->getAllPthotos();
//        $this->view->render('ads');
//    }

    public function create()
    {
        $this->view->render('ads_create');
    }

    public function store()
    {
        $file = $_FILES['photos'];
        $fileTest = [];
        $file_count = count($file['name']);
        $file_keys = array_keys($file);
        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $fileTest[$i][$key] = $file[$key][$i];
            }
        }
        if ($_SERVER['HTTP_REFERER'] !== 'http://levelupaugfinalproject1/ads/create') {
            $adsPhotoErrors = $this->validate->fileValidate($file);
            if (count($adsPhotoErrors) !== 0) {
                $this->view->render(
                    'ads_create',
                    [
                        'adsPhotoErrors' => $adsPhotoErrors,
                    ]
                );
                Route::redirect('ads', 'create');
            }
            session_start();
            $vendorCode = $_SESSION['vendor_code'];
            $ad_id = $_SESSION['ad_id'];
            unset($_SESSION['vendor_code']);
            unset($_SESSION['ad_id']);
            $this->model->updatedPhotoDirAdd($fileTest, $vendorCode);
            Route::redirect('ads', 'index#'.$ad_id);
        } else {
            $headline = filter_input(INPUT_POST, 'headline');
            $description = filter_input(INPUT_POST, 'description');
            $author = filter_input(INPUT_POST, 'author');
            $phone = filter_input(INPUT_POST, 'phone');
            $adsTextErrors = $this->validate->textValidator($headline, $description, $author, $phone);
            $adsPhotoErrors = $this->validate->fileValidate($file);
            if (count($adsTextErrors) !== 0 || count($adsPhotoErrors) !== 0) {
                $this->view->render(
                    'ads_create',
                    [
                        'adsTextErrors' => $adsTextErrors,
                        'adsPhotoErrors' => $adsPhotoErrors,
                    ]
                );
                Route::redirect('ads', 'create');
            }
        }
        $this->model->photoDirAdd($fileTest);
        $this->model->textDbAdd($headline, $description, $author, $phone);
        Route::redirect('index', 'index');

    }

    public function destroy()
    {
        if (!empty($_POST)) {
            $url = current($_POST);
            $ad_id = array_key_first($_POST);
            $this->model->delPhotoFromAd($url);
            Route::redirect('ads', 'index#'.$ad_id);
        }
        $this->model->del();
        Route::redirect('ads', 'index');
    }

    public function edit()
    {
        $this->model->edit();
        Route::redirect('ads', 'index');
    }
}