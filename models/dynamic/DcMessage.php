<?php
namespace app\models\dynamic;
use yii\db\ActiveRecord;
use Yii;
class DcMessage extends ActiveRecord
{


    public static function tableName()
    {

            return 'dc_message';

    }


    public static function getDb() {

        return Yii::$app->get('dbdc');
    }



}