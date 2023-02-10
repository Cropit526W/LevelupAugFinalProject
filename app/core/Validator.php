<?php

namespace app\core;

use app\models\UserModel;

class Validator
{

    /**
     * Upload error description list
     */
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

    /**
     * Acceptable photo types
     */
    const PHOTO_UPLOAD_AVAILABLE_TYPES = [
        'image/jpeg',
        'image/png',
        'image/gif',
    ];

    /**
     * The maximum size of the photo to be uploaded
     */
    const PHOTO_UPLOAD_MAX_SIZE = 10 * 1024 * 1024;

    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @var array
     */
    public array $adsPhotoErrors = [];

    /**
     * @var array
     */
    protected array $adsTextErrors = [];

    /**
     * @var Session
     */
    protected $session;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->session = new Session();

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
     * Check the presence of a new user in the database
     * @param $user
     * @return array
     */
    public function validateAddUser($user) : array
    {
        if (!empty($this->model->get($user['login']))) {
            $this->errors[] = 'This user already exists in the database';
        }

        if (count($this->errors) > 0) {
            $this->session->save('Add new user', $this->errors);
        }

        return $this->errors;
    }

    /**
     * Returns a list of errors about photos
     * @param $files
     * @return array
     */
    public function fileValidate($file): array
    {
            if (empty($file['name'][0])) {
                $this->adsPhotoErrors['no_photo'] = 'Фото не загружено !';
            } elseif (!in_array($file['type'][0], self::PHOTO_UPLOAD_AVAILABLE_TYPES)) {
                $this->adsPhotoErrors['extension'] = 'Формат файла не соответствует разрешенному !';
            } elseif (empty($file['size'][0]) > self::PHOTO_UPLOAD_MAX_SIZE) {
                $this->adsPhotoErrors['size'] = 'Размер файла превышает разрешенный !';
            }

//                if ($file['error'] != UPLOAD_ERR_OK) {
//                    $this->adsPhotoErrors['error'] = self::UPLOAD_ERROR_DESCRIPTION_LIST[$file['error']];

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
            $this->adsTextErrors['headline'] = 'Не введён заголовок !';
        }
        if (empty($description)) {
            $this->adsTextErrors['description'] = 'Не введено описание !';
        }
        if (empty($author)) {
            $this->adsTextErrors['author'] = 'Не введён автор объявления !';
        }
        if (empty($phone)) {
            $this->adsTextErrors['phone'] = 'Не введён номер телефона автора !';
        }
        if (strlen($phone) < 10) {
            $this->adsTextErrors['countNumbersInPhone'] = 'Номер телефона должен состоять не менее чем из 10 символов !';
        }
        return $this->adsTextErrors;
    }

    /**
     * An array of ad errors is filled
     * @param $errorsInFilesText
     * @param $errorsInTextList
     * @return void
     */
    public function setErrors($errorsInFilesText = [], $errorsInTextList = []): void
    {
        $errorsList = array_merge($errorsInFilesText, $errorsInTextList);
        session_start();
        $_SESSION['errorsList'] = $errorsList;
    }

    /**
     * Returns a list of errors about delete the user
     * @param string $msg
     * @return void
     */
    public function validateDeleteUser(string $msg) : void
    {
        $this->errors[] = $msg;
        $this->session->save('Delete user', $this->errors);
    }
}