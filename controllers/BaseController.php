<?php

namespace app\controllers;

use app\models\rbac\Rbac;

class BaseController extends \yii\web\Controller {

    /**
     * 不需要检测的 [权限节点/动作]
     * @var type 
     */
    private $notCheckAccess = ['/rbac/access-error', 'site/index'];

    public function init() {
        parent::init();
    }

    public function beforeAction($action) {
        parent::beforeAction($action);

        $adminInfo = \Yii::$app->session->get('_ADMININFO');

        $moduleId = \Yii::$app->controller->module->id === \Yii::$app->id ? '' : \Yii::$app->controller->module->id . '/';
        $controllerId = \Yii::$app->controller->id . '/';
        $actionId = \Yii::$app->controller->action->id;

        $permissionName = $moduleId . $controllerId . $actionId;
        $notCheckAccess = join('|', $this->notCheckAccess);

        // 如果是登录或退出动作
        if (stripos('/site/login|/site/logout', $permissionName) !== false) {
            return true;
        }
        
        // 验证登录
        if (empty($adminInfo)) {
            header("Location:". \yii\helpers\Url::to(['/site/login']));
            exit;
        }
        
        // 不需要检测的 [权限节点/动作]
        if (stripos($notCheckAccess, $permissionName) !== false) {
            return true;
        }

        // 验证是否是超级管理员
        if ($adminInfo['is_admin'] == 1) {
            return true;
        }

        // 验证权限
        $rbac = new Rbac();
        if (!$rbac->checkAccess($adminInfo['id'], $permissionName)) {
            header("Content-type:text/html;charset=utf-8");
            exit("<script>alert('暂无权限');history.back();</script>");
            //header("Location:". \yii\helpers\Url::to(['rbac/access-error']));
            //return false;
        }

        return true;
    }
    
    /**
     * 权限错误提示
     * @return type
     */
    public function actionAccessError() {
        $error = '暂无权限，你可以联系管理员.';
        return $this->render('/site/error', ['name' => 'Error', 'message' => $error]);
    }

}
