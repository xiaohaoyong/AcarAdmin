<?php
namespace app\models\club;
use yii\db\ActiveRecord;
use Yii;

class UserNew extends ActiveRecord
{


    public static function tableName()
    {
        return  'user_new';
    }


    public static function getDb() {
        return Yii::$app->get('dbclub');
    }



}