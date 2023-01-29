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
        $this->model = new AdsModel();
        $this->validate = new Validator();
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

        $file = $_FILES['photos[]'];
        if(count($file)>1){
            for($i=1;$i<count($file);$i++){

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
            //$this->model->textDbAdd($headline, $description, $author, $phone);
            //$this->model->photoDbAdd();
            $this->model->photoDirAdd($file);
            var_dump($_REQUEST);
            var_dump($_FILES);
            //Route::redirect('index', 'index');
        }
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