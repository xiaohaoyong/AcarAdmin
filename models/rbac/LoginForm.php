<?php

namespace app\models\rbac;

use Yii;
use app\models\rbac\AuthAdminuser;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends AuthAdminuser
{
    //public $rememberMe = true;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['userlogin', 'password'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            
            ['password', 'filter', 'filter'=>function($value){
                return md5($value);
            }],
        ];
    }
    
    public function login(){
        $query = $this->find();
        $res = $query->andWhere(['userlogin' => $this->userlogin, 'password' => $this->password, 'status' => 0])->exists();
        if(!$res){
            $this->addError('login', '登录失败');
            return false;
        }
        
        $one = $query->asArray()->one();
        
        \Yii::$app->session->set('_ADMININFO', $one);
        
        return true;
    }
}
