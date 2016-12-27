<?php
namespace app\models\club;
use yii\db\ActiveRecord;
use Yii;


class UserDoctorNew extends ActiveRecord
{
   // public $charset = 'latin1';

    public static function tableName()
    {
        return  'user_doctor_new';



    }


    public static function getDb() {
        return Yii::$app->get('dbclub');
    }

    
}