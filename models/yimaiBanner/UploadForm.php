<?php

namespace app\models\yimaiBanner;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\components\helper\UploadHelper;

class UploadForm extends Model {

    /**
     * @var UploadedFile
     */
    public $imageFile;
    
    public $imageFile2;

    public function rules() {
        return [
            [['imageFile'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 1,  'on' => ['createImg', 'updateImg']],
            [['imageFile2'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 1,  'on' => ['createImg', 'updateImg2']],
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $ui = new UploadHelper();
            return $ui->updateImage($this->imageFile);
        }

        return "";
    }
    
    public function upload2() {
        if ($this->validate()) {
            $ui = new UploadHelper();
            return $ui->updateImage($this->imageFile2);
        }

        return "";
    }
}
