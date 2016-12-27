<?php
/**
 * Created by PhpStorm.
 * User: xywy
 * Date: 2016/9/28
 * Time: 16:46
 */
namespace app\models\plat;
use yii\db\ActiveRecord;
use Yii;
class Subscription extends ActiveRecord
{

    static public $dynamicId;
    /**
     * @return array|string
     */
    public static function tableName()
    {

            return 'subscription';

    }


    public static function getDb() {

        return Yii::$app->get('dbud');
    }



}