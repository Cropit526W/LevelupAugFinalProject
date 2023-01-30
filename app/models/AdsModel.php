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
        $sql = 'SELECT * FROM ads';
        $result = $this->db->query($sql);
        $ads = [];
        while ($row = $result->fetch_assoc()) {
            $ads[] = $row;
        }
        return $ads;
    }

    public function photoDirAdd($files){

        $photoErrors = $this->validate->fileValidate($files);
        if (count($photoErrors) == 0) {
            foreach ($files as $file) {
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileName = uniqid().'.'.$extension;
                $filePath = self::PHOTO_UPLOAD_DIR . '/' . $fileName;
                self::photoDbAdd($fileName, $filePath);
                if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                    $photoErrors[] = 'Tmp file was not moved';
                }
            }
            //TODO excemptions and logs
        }

    }

    public function photoDbAdd($name, $path){
        $sql = "insert into photos (name, url) values ('{$name}', '{$path}')";
        $this->db->query($sql);
        //TODO validation
    }

    public function textDbAdd($headline, $description, $author, $phone)
    {
        $sql = "insert into ads (name, description, author, phone) values ('{$headline}', '{$description}', '{$author}', '{$phone}')";
        $this->db->query($sql);
        //TODO validation
    }

    public function del()
    {
        $stmt = $this->db->prepare("DELETE FROM ads WHERE id = ?");
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
    }

    public function edit()
    {
        //TODO
    }

}