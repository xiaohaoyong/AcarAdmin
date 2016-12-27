<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%route}}".
 *
 * @property string $id
 * @property string $price
 * @property string $bprice5
 * @property string $bprice7
 * @property string $bprice9
 * @property string $saddr
 * @property string $saddrname
 * @property string $slat
 * @property string $slng
 * @property string $eaddr
 * @property string $eaddrname
 * @property string $elng
 * @property string $elat
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%route}}';
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
            [['price', 'bprice5', 'bprice7', 'bprice9'], 'integer'],
            [['saddr', 'saddrname', 'slat', 'slng', 'eaddr', 'eaddrname', 'elng', 'elat'], 'required'],
            [['saddr', 'saddrname', 'slat', 'slng', 'eaddr', 'eaddrname', 'elng', 'elat'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => '单价',
            'bprice5' => '五座包车价格',
            'bprice7' => '七座包车价格',
            'bprice9' => '九座包车价格',
            'saddr' => '起始城市',
            'saddrname' => '起始城市详情',
            'slat' => '开始纬度',
            'slng' => '开始经度',
            'eaddr' => '结束位置',
            'eaddrname' => '结束位置详情',
            'elng' => '结束经度',
            'elat' => '结束纬度',
        ];
    }
}
