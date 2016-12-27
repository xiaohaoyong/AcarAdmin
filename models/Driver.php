<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%driver}}".
 *
 * @property string $userid
 * @property string $city
 * @property string $plates
 * @property string $owner
 * @property integer $cartime
 * @property string $driver
 * @property string $starttime
 * @property string $addtime
 * @property string $licenseimg
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%driver}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbacar');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'plates', 'owner', 'driver'], 'required'],
            [['userid', 'city', 'cartime', 'starttime', 'addtime'], 'integer'],
            [['plates', 'licenseimg'], 'string', 'max' => 20],
            [['owner', 'driver'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => '用户ID',
            'city' => '所在城市',
            'plates' => '车牌号',
            'owner' => '车主姓名',
            'cartime' => '车辆注册日期',
            'driver' => '司机姓名',
            'starttime' => '初次领取驾照日期',
            'addtime' => '注册时间',
            'licenseimg' => '驾驶证照片',
        ];
    }
}
