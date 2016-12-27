<?php
namespace app\models\dynamic;
use yii\db\ActiveRecord;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class DcDynamicSeminar extends ActiveRecord
{

    public static function tableName()
    {


            return 'dc_dynamic_seminar';

    }


    public static function getDb() {

        return Yii::$app->get('dbdc');
    }






    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户id',
            'type' => '实名（匿名）',
            'level' => '状态',
            'createtime' => '动态发布时间',
        ];
    }


}