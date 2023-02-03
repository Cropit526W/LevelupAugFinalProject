<?php

namespace app\models;

use app\core\Model;
use app\core\Validator;

class AdsModel extends Model
{
    const PHOTO_UPLOAD_DIR = 'images/photos';

    public int $vendor_code;

    protected object $validate;


    public function __construct()
    {
        parent::__construct();
        $this->validate = new Validator();

    }

    public function getAll()
    {
        $sql = "SELECT * FROM ads";
        $result = $this->db->query($sql);
        $ads = [];
        while ($row = $result->fetch_assoc()) {
            $ads[] = $row;
        }
        return $ads;
    }

    public function getAllIndexPage($from, $elements)
    {
        $sql = "SELECT * FROM ads LIMIT {$from}, {$elements}";
        $result = $this->db->query($sql);
        $ads = [];
        while ($row = $result->fetch_assoc()) {
            $ads[] = $row;
        }
        return $ads;
    }

    public function getAllPthotos()
    {
        $sql = "SELECT photos.url, ads.name, photos.vendor_code FROM photos INNER JOIN ads ON ads.vendor_code = photos.vendor_code;";
        $result = $this->db->query($sql);
        $photos = [];
        while ($url = $result->fetch_assoc()) {
            $photos[] = $url;
        }
        return $photos;
    }


    public function photoDirAdd($files){

        $photoErrors = $this->validate->fileValidate($files);
        if (count($photoErrors) == 0) {
            $this->vendor_code = self::getRandom();
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

    public function updatedPhotoDirAdd($files, $vendorCode)
    {
        $this->vendor_code = $vendorCode;
        $photoErrors = $this->validate->fileValidate($files);
        if (count($photoErrors) == 0) {
        }
            foreach ($files as $file) {
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $extension;
                $filePath = self::PHOTO_UPLOAD_DIR . '/' . $fileName;
                self::photoDbAdd($fileName, $filePath);
                if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                    $photoErrors[] = 'Tmp file was not moved';
                }
            }
    }

    public function photoDbAdd($name, $path){
        $sql = "insert into photos (name, url, vendor_code) values ('{$name}', '{$path}', {$this->vendor_code})";
        $this->db->query($sql);
        //TODO validation
    }

    public function textDbAdd($headline, $description, $author, $phone)
    {
        $sql = "insert into ads (name, description, author, phone, vendor_code) values ('{$headline}', '{$description}', '{$author}', '{$phone}', {$this->vendor_code})";
        $this->db->query($sql);
        //TODO validation
    }

//    public function setPhotosId($id)
//    {
//        $sql = "INSERT INTO photos (ad_id) VALUES ({'$id'})";
//    }

    public function del()
    {
        $stmt = $this->db->prepare("DELETE FROM ads WHERE id = ?");
        $stmt->bind_param('i', $_POST['id']);
        $stmt->execute();
    }

    public function delPhotoFromAd($url)
    {
        $stmt = $this->db->prepare("DELETE FROM photos WHERE url = ?");
        $stmt->bind_param('s', $url);
        $stmt->execute();
    }

    public function edit()
    {
        $stmt = $this->db->prepare("UPDATE ads SET name = ?, description = ?, author = ?, phone = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $_GET['headline'], $_GET['description'], $_GET['author'], $_GET['phone'], $_GET['id']);
        $stmt->execute();
    }

//    public function getPhotos($author, $created_at)
//    {
////        $stmt = $this->db->prepare("SELECT photos.url FROM photos INNER JOIN");
//    }

    public function getRandom():int
    {
        return $this->vendor_code = rand(1, 9223372036854775807);
    }

}