<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $phone
 * @property string $openid
 * @property integer $type
 * @property string $addtime
 * @property integer $level
 * @property integer $sex
 * @property string $name
 * @property string $idnum
 * @property string $idimg
 * @property string $authKey
 * @property string $accessToken
 */
class Users extends \yii\db\ActiveRecord
{
    public static $typetext=[0=>'乘客',2=>'司机'];
    public static $leveltext=[-1=>'不通过',0=>'未审核',1=>'通过'];
    public static $sextext=[1=>'男',0=>'女'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
            [['phone', 'type', 'addtime', 'level', 'sex'], 'integer'],
            [['openid', 'name', 'idimg'], 'required'],
            [['openid'], 'string', 'max' => 40],
            [['name'], 'string', 'max' => 10],
            [['idnum'], 'string', 'max' => 18],
            [['idimg'], 'string', 'max' => 30],
            [['authKey', 'accessToken'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'phone' => '手机号',
            'openid' => '微信openid',
            'type' => '用户类型',
            'addtime' => '添加时间',
            'level' => '用户状态',
            'sex' => '性别',
            'name' => '姓名',
            'idnum' => '身份证号',
            'idimg' => '身份证照片',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
}
