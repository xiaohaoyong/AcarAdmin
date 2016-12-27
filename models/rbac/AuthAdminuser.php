<?php

namespace app\models\rbac;

use Yii;
use app\components\validators\UniqueCustomValidator;

/**
 * This is the model class for table "auth_adminuser".
 *
 * @property integer $id
 * @property string $name
 * @property string $userlogin
 * @property string $password
 * @property integer $createtime
 * @property integer $status
 * @property integer $is_admin
 * @property string $phone
 * @property string $email
 * @property string $mark
 */
class AuthAdminuser extends \yii\db\ActiveRecord
{
    public $_oldUniqueId = NULL;
    
    // 是否修改管理员密码
    public $isUpdatePassword = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_adminuser';
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
            [['userlogin', 'name', 'password'], 'required'],
            [['createtime', 'status', 'is_admin', 'isUpdatePassword'], 'integer'],
            [['name', 'userlogin', 'email', 'mark'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 11],
            [['userlogin'], UniqueCustomValidator::className()],
            ['email', 'email'],
            ['phone', 'match', 'pattern'=>'/^1[0-9]{10}$/', 'message'=>'请填写正确的手机号码'],
            
            ['password', 'filter', 'filter'=>function($value){
                return md5($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '管理员姓名',
            'userlogin' => '登录名称',
            'password' => 'Password',
            'createtime' => '创建时间',
            'status' => '状态',
            'is_admin' => '超管',
            'phone' => '手机号',
            'email' => '邮箱',
            'mark' => '备注',
        ];
    }
    
    /**
     * 检测 unique key 是否存在
     * @param type $name 检测的名称
     * @param type $notName 不包含的名称
     * @return type
     */
    public function hasName($name, $notName = NULL) {
        $query = $this->find();
        $query->andWhere(['userlogin' => $name]);
        if ($notName) {
            $query->andWhere(['!=', 'name', $notName]);
        }

        return $query->one();
    }
}
