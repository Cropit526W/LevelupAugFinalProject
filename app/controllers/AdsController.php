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
        $this->view->render('ads_index', [
            'adsList' => $adsList,
        ]
        );
    }

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
//        if(count($file)>1){
//            foreach ($file as $elem) {
//                foreach ($elem as $item) {
//                }
//            }
//        }
        for ($i = 0; $i<$file_count;$i++) {
            foreach ($file_keys as $key) {
                $fileTest[$i][$key] = $file[$key][$i];
            }
        }
        $headline = filter_input(INPUT_POST, 'headline');
        $description = filter_input(INPUT_POST, 'description');
        $author = filter_input(INPUT_POST, 'author');
        $phone = filter_input(INPUT_POST, 'phone');
        $adsTextErrors = $this->validate->textValidator($headline, $description, $author, $phone);
        $adsPhotoErrors = $this->validate->fileValidate($file);
        if(count($adsTextErrors) !== 0 || count($adsPhotoErrors) !== 0){
            $this->view->render(
                'ads_create',
                [
                    'adsTextErrors' => $adsTextErrors,
                    'adsPhotoErrors' => $adsPhotoErrors,
                ]
            );
            Route::redirect('ads', 'create');

        }else{
            $this->model->textDbAdd($headline, $description, $author, $phone);
//            $this->model->photoDbAdd();
            $this->model->photoDirAdd($fileTest);
//            var_dump($_REQUEST);
//            var_dump($_FILES);
            Route::redirect('index', 'index');
        }
    }

    public function destroy()
    {
        $this->model->del();
        Route::redirect('ads', 'index');
    }

    public function edit()
    {
        //TODO
//        $this->model->edit();
    }
}