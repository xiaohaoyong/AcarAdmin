<?php

namespace app\controllers;

use app\models\Zhuli;

class AppController extends \app\controllers\BaseController {

    private $_list_name = 'yimai:list:task';

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionZhuli() {
        $model = new Zhuli();
        
        if (!\Yii::$app->request->isPost) {
            return $this->render('zhuli', ['model' => $model]);
        }

        $model->load(\Yii::$app->request->post(), 'Zhuli');

        // 推送信息内容
        $data['msg'] = $model->content;

        // 推送用户类型
        $data['type'] = $this->_getUserType($model->usertype);

        // 自定义用户
        $data['userid'] = $model->userid;

        $task = json_encode($data);
        
        \Yii::$app->rdtask->rpush($this->_list_name, 'assistant|%push|@' . $task);

        return "<script>alert('完成');history.back();</script>";
    }  

    /**
     * 推送用户类型
     * @param type $usertype
     * @return string
     */
    private function _getUserType($usertype) {
        switch ($usertype) {
            case 1:
                $str = 'UserIdByOneself';
                break;
            case 2:
                $str = '_all_user';
                break;
            case 3:
                $str = '_test_user';
                break;
            case 4:
                $str = '_test_test_user';
                break;
            case 5:
                $str = '_liver_user';
                break;
            case 6:
                $str = '_liver_n_user';
                break;
            default:
                $str = '_test_test_user';
                break;
        }
        return $str;
    }

}
