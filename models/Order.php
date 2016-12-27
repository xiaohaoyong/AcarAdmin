<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $id
 * @property string $orderid
 * @property string $userid
 * @property string $driverid
 * @property string $addtime
 * @property string $routeid
 * @property integer $status
 * @property integer $type
 * @property string $saddr
 * @property string $saddrname
 * @property string $slat
 * @property string $slng
 * @property string $eaddr
 * @property string $eaddrname
 * @property string $elat
 * @property string $elng
 * @property integer $num
 * @property string $phone
 * @property string $bespeaktime
 * @property integer $paytype
 * @property integer $paystatus
 * @property integer $trmb
 * @property integer $prmb
 * @property integer $paytime
 * @property string $payid
 */
class Order extends \yii\db\ActiveRecord
{
    public static $paytypetext=[1=>'现金支付',2=>'微信支付'];
    public static $paystatustext=[0=>'未支付',1=>'已支付',2=>'已退款'];
    public static $typetext=[0=>'合乘',1=>'包车'];
    public static  $statustext=[0=>'待接单',2=>'已接单',3=>'正在进行',4=>'已完成',5=>'已取消'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
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
            [['orderid', 'saddr', 'saddrname', 'slat', 'slng', 'eaddr', 'elat', 'elng', 'bespeaktime', 'payid'], 'required'],
            [['userid', 'driverid', 'routeid', 'status', 'type', 'num', 'phone', 'paytype', 'paystatus', 'trmb', 'prmb', 'paytime'], 'integer'],
            [['orderid'], 'string', 'max' => 20],
            [['bespeaktime','addtime'],'datetime','Y-m-d H:i:s'],
            [['saddr', 'saddrname', 'slat', 'slng', 'eaddr', 'eaddrname', 'elat', 'elng', 'payid'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderid' => '订单ID',
            'userid' => '下单用户',
            'driverid' => '司机',
            'addtime' => '创建时间',
            'routeid' => '路线',
            'status' => '订单状态',
            'type' => '订单类型',
            'saddr' => '起始位置',
            'saddrname' => '起始位置详情',
            'slat' => '开始纬度',
            'slng' => '开始经度',
            'eaddr' => '结束位置',
            'eaddrname' => '结束位置详情',
            'elat' => '结束纬度',
            'elng' => '结束经度',
            'num' => '乘车人数',
            'phone' => '联系电话',
            'bespeaktime' => '预约时间',
            'paytype' => '支付类型',
            'paystatus' => '支付状态',
            'trmb' => '订单价格',
            'prmb' => '支付金额',
            'paytime' => '支付时间',
            'payid' => '支付id',
        ];
    }

}
