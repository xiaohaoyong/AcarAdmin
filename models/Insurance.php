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

    public static  $liability=[
        "0"=>'不投保',
        "50000"=>'5万',
        "100000"=>'10万',
        "150000"=>'15万',
        "200000"=>'20万',
        "300000"=>'30万',
        "500000"=>'50万',
        "1000000"=>'100万',
        "1500000"=>'150万',
        "2000000"=>'200万',
        "2500000"=>'250万',
        "3000000"=>'300万',
        "5000000"=>'500万',
    ];
    public static $dseat=[
        "0"=>'不投保',
        "10000"=>'1万',
        "20000"=>'2万',
        "30000"=>'3万',
        "40000"=>'4万',
        "50000"=>'5万',
        "100000"=>'10万',
        "200000"=>'20万',
        "250000"=>'25万',
        "300000"=>'30万',
    ];
    public static   $huahen=[
        "0"=>'不投保',
        "2000"=>'2000',
        "5000"=>'5000',
        "10000"=>'1万',
        "20000"=>'2万',
    ];
    public static $xiulichanga=[
        "0"=>'上浮系数',
        "10"=>'10',
        "15"=>'15',
        "20"=>'20',
        "30"=>'30',
        "40"=>'40',
        "50"=>'50',
        "60"=>'60',

    ];
    public static  $xiulichangb=[0=>"不投保",1=>'进口',2=>'国产'];
    public static  $boli=[0=>"不投保",1=>'进口玻璃',2=>'国产玻璃'];

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
            [['idimgz', 'idimgb', 'xsimgz', 'xsimga', 'xsimgb', 'bdimg', 'phone', 'userid', 'boli', 'issheshui'], 'required'],
            [['starttime'],'date'],

            [['phone', 'userid', 'level', 'offer', 'addtime', 'lossdanger', 'islossdanger', 'liability', 'isliability', 'dseat', 'isdseat', 'cseat', 'iscseat', 'daoqiang', 'isdaoqiang', 'huahen', 'ishuahen', 'boli', 'ziran', 'isziran', 'sheshui', 'issheshui', 'wufa', 'xiulichanga', 'xiulichangb'], 'integer'],
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
            'userid' => '用户',
            'level' => '类型',
            'offer' => '报价',
            'addtime' => '添加时间',
            'starttime' => '商业险起保时间',
            'lossdanger' => '车辆损失险',
            'islossdanger' => '不计免赔',
            'liability' => '第三者责任险',
            'isliability' => '不计免赔',
            'dseat' => '司机座位',
            'isdseat' => '不计免赔',
            'cseat' => '乘客座位',
            'iscseat' => '不计免赔',
            'daoqiang' => '全车盗抢险',
            'isdaoqiang' => '不计免赔',
            'huahen' => '划痕险',
            'ishuahen' => '不计免赔',
            'boli' => '玻璃单独破碎险',
            'ziran' => '自然损失险',
            'isziran' => '不计免赔',
            'sheshui' => '涉水行驶损失险',
            'issheshui' => '不计免赔',
            'wufa' => "交强险",
            'xiulichanga'=>"指定修理厂"
        ];
    }

    public function beforeSave($insert)
    {
        if($this->getIsNewRecord())
        {
            $this->addtime=time();
        }

        if($this->starttime) {
            $this->starttime = strtotime($this->starttime);
        }else{
            unset($this->starttime);
        }

        return parent::beforeSave($insert);
    }
}
