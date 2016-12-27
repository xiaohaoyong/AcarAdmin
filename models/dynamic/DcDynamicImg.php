<?php
namespace app\models\dynamic;
use yii\db\ActiveRecord;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class DcDynamicImg extends ActiveRecord
{
    static public $dynamicId;
    public static function tableName()
    {
        $tm = (self::$dynamicId) % 50;
        return 'dc_dynamic_img_' . $tm;
    }
    public static function getDb() {

        return Yii::$app->get('dbdc');
    }

}