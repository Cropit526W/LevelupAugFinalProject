<?php

namespace app\controllers;

use app\core\Route;
use app\core\Validator;


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


    /**
     * @return void
     */
    public function create()
    {
        $this->view->render('ads_create');
    }

    /**
     * @return void
     */
    public function store()
    {
        if (!empty($_FILES['photos'])) {
            $file = $_FILES['photos'];
            $fileTest = [];
            $file_count = count($file['name']);
            $file_keys = array_keys($file);
            for ($i = 0; $i < $file_count; $i++) {
                foreach ($file_keys as $key) {
                    $fileTest[$i][$key] = $file[$key][$i];
                }
            }
            //TODO validate
            $requestStr = explode('/', $_SERVER['HTTP_REFERER']);
            $desiredStr = '/'."$requestStr[3]".'/'."$requestStr[4]";
            if ($desiredStr != url('ads', 'create')) {
                $adsPhotoErrors = $this->validate->fileValidate($file);
                $ad_id = array_key_first($_POST);
                if (count($adsPhotoErrors) !== 0) {
                    $this->validate->setErrors($adsPhotoErrors);
                    Route::redirect('ads', 'index#'.$ad_id);
                }
                $vendorCode = current($_POST);

                $this->model->updatedPhotoDirAdd($fileTest, $vendorCode);
                Route::redirect('ads', 'index#'.$ad_id);
            } else {
                //TODO array
                $headline = filter_input(INPUT_POST, 'headline');
                $description = filter_input(INPUT_POST, 'description');
                $author = filter_input(INPUT_POST, 'author');
                $phone = filter_input(INPUT_POST, 'phone');
                $adsTextErrors = $this->validate->textValidator($headline, $description, $author, $phone);
                $adsPhotoErrors = $this->validate->fileValidate($file);
                if (count($adsTextErrors) > 0 || count($adsPhotoErrors) > 0) {
                    $this->validate->setErrors($adsTextErrors, $adsPhotoErrors);
                    Route::redirect('ads', 'create');
                }
            }
            $this->model->photoDirAdd($fileTest, $headline, $description, $author, $phone);
            Route::redirect('index', 'index');
        }
    }

    /**
     * delete selected ad
     * @return void
     */
    public function destroy()
    {
        if (empty($_POST['id'])) {
            // TODO validate
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
        $headline = filter_input(INPUT_GET, 'headline');
        $description = filter_input(INPUT_GET, 'description');
        $author = filter_input(INPUT_GET, 'author');
        $phone = filter_input(INPUT_GET, 'phone');
        $ad_id = filter_input(INPUT_GET, 'id');
        $adsTextErrors = $this->validate->textValidator($headline, $description, $author, $phone);
        if (count($adsTextErrors) !== 0) {
            $this->validate->setErrors($adsTextErrors);
            Route::redirect('ads', 'index#'.$ad_id);
        }
        $this->model->edit();
        Route::redirect('ads', 'index');
    }
}