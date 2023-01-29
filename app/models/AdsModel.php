<?php

namespace app\models;

use app\core\Model;
use app\core\Validator;

class AdsModel extends Model
{
    const PHOTO_UPLOAD_DIR = 'images/photos';

    protected object $validate;

    public function __construct()
    {
        parent::__construct();
        $this->validate = new Validator();
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM advertisements';

        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function photoDirAdd($file){

        $photoErrors = $this->validate->fileValidate($file);
        if (count($photoErrors) == 0) {

            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = uniqid().'.'.$extension;
            $filePath = self::PHOTO_UPLOAD_DIR . '/' . $fileName;
            //self::photoDbAdd($fileName, $filePath, 1);
            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                $photoErrors[] = 'Tmp file was not moved';
            }
        }

    }

    public function photoDbAdd($name, $path, $ad_id){
        $sql = "insert into photos (name, url, ad_id) values ('{$name}', '{$path}', '{$ad_id}')";
        $this->db->query($sql);
    }

    public function textDbAdd($headline, $description, $author, $phone)
    {
        $sql = "insert into ads (name, description, author, phone) values ('{$headline}', '{$description}', '{$author}', '{$phone}')";
        $this->db->query($sql);
    }

    public function del()
    {
        //TODO
    }

    public function edit()
    {
        //TODO
    }

}