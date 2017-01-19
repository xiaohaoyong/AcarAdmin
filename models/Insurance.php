<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insurance".
 *
 * @property integer $id
 * @property string $idimgz
 * @property string $idimgb
 * @property string $xsimgz
 * @property string $xsimga
 * @property string $xsimgb
 * @property string $bdimg
 * @property string $phone
 * @property string $userid
 * @property integer $level
 * @property integer $offer
 */
class Insurance extends \yii\db\ActiveRecord
{
    public static $leveltext=[0=>'待报价',1=>'已报价'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insurance';
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
            [['idimgz', 'idimgb', 'xsimgz', 'xsimga', 'xsimgb', 'bdimg', 'phone', 'userid'], 'required'],
            [['phone', 'userid', 'level', 'offer'], 'integer'],
            [['idimgz', 'idimgb', 'xsimgz', 'xsimga', 'xsimgb', 'bdimg'], 'string', 'max' => 50],
            [['userid'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idimgz' => '身份证正面',
            'idimgb' => '身份证背面',
            'xsimgz' => '行驶证正本',
            'xsimga' => '行驶证A面副本',
            'xsimgb' => '行驶证B面副本',
            'bdimg' => '保单',
            'phone' => '手机号',
            'userid' => 'Userid',
            'level' => '状态',
            'offer' => 'Offer',
        ];
    }
}
