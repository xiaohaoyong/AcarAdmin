<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/22
 * Time: 15:55
 */

namespace app\components;
use app\components\helper\UploadHelper;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;  //file 对象
    public $options;    //验证参数
    public $parameter;  //图片参数设置

    public function rules()
    {
        $rules=[['imageFile'], 'file', 'skipOnEmpty' => false];
        if(is_array($this->options))
        {
            $return = array_merge($rules,$this->options);
        }else{
            $return = $rules;
        }
        return [$return];
    }

    public function upload()
    {
        if ($this->validate()) {
            $ui=new UploadHelper();
            return $ui->updateImage($this->imageFile);
        } else {
            return "";
        }
    }
}