<?php

namespace app\models\app; 

use Yii;
use yii\base\Model;

class Zhuli extends Model
{
    public $usertype;
    //public $userid;
    public $content;
    
    public function rules()
    {
        return [
            [['content', 'usertype'], 'required'],
            //['userid', 'match', 'pattern' => '/^[0-9](,*[0-9])*$/', 'message'=>'请正确填写用户id, ^_^ '],
        ];
    }
    
    public function attributeLabels() {
        return [
            'usertype' => '推送用户',
            //'userid'   => '自定义用户',
            'content'  => '推送内容',
        ];
    }
}