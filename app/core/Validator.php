<?php

namespace app\core;

use app\models\UserModel;

class Validator
{

    const UPLOAD_ERROR_DESCRIPTION_LIST = [
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    ];

    const PHOTO_UPLOAD_AVAILABLE_TYPES = [
        'image/jpeg',
        'image/png',
        'image/gif',
    ];

    const PHOTO_UPLOAD_MAX_SIZE = 10 * 1024 * 1024;


    protected array $errors = [];

    protected array $adsPhotoErrors = [];

    protected array $adsTextErrors = [];

    public function __construct()
    {
        $this->model = new UserModel();
    }

    /**
     * Returns a list of errors about users
     * @param $user
     * @return array
     */
    public function userErrors($user): array
    {
        if ($this->model->is($user)) {
            $this->errors[] = 'This user already exists in the database';
        }
        return $this->errors;
    }

    /**
     * Returns a list of errors about photos
     * @param $files
     * @return array
     */
    public function fileValidate($files): ?array
    {
        if (!isset($files)) {
            if (!isset($file['name'])) {
                $this->adsPhotoErrors[] = 'Фото не загружено !';
            } else
                if ($file['error'] != UPLOAD_ERR_OK) {
                    $this->adsPhotoErrors[] = self::UPLOAD_ERROR_DESCRIPTION_LIST[$file['error']];
                } else {
                    if (!in_array($file['type'], self::PHOTO_UPLOAD_AVAILABLE_TYPES)) {
                        $this->adsPhotoErrors[] = 'Формат файла не соответствует разрешенному !';
                    }
                    if ($file['size'] > self::PHOTO_UPLOAD_MAX_SIZE) {
                        $this->adsPhotoErrors[] = 'Размер файла превышает разрешенный !';
                    }
                }
        }
//        foreach ($files as $file) {

//        }

        return $this->adsPhotoErrors;
    }

    /**
     * Returns a list of errors about bulletin description
     * @param $headline
     * @param $description
     * @return array
     */
    public function textValidator($headline, $description, $author, $phone): array
    {
        if (empty($headline)) {
            $this->adsTextErrors[] = 'Не введён заголовок !';
        }
        if (empty($description)) {
            $this->adsTextErrors[] = 'Не введено описание !';
        }
        if (empty($author)) {
            $this->adsTextErrors[] = 'Не введён автор объявления !';
        }
        if (empty($phone)) {
            $this->adsTextErrors[] = 'Не введён номер телефона автора !';
        }
        if ($phone < 10) {
            $this->adsTextErrors[] = 'Номер телефона должен состоять не менее чем из 10 символов !';
        }
        return $this->adsTextErrors;
    }


}
