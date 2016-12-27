<?php
/**
 * Created by PhpStorm.
 * User: xywy
 * Date: 2016/9/8
 * Time: 17:44
 */
namespace app\controllers\dynamic\controllers;

use app\models\dynamic\DcDynamic;
use app\controllers\BaseController;
use app\models\dynamic\DynamicSearch;
use app\models\dynamic\DynamicForm;
use Yii;

class DynamicController extends BaseController
{



    public function actionList()
    {
        $searchModel = new DynamicSearch();
        $dynamicForm = new DynamicForm();
        $data = Yii::$app->request->get();
        //Yii::$app->dbclub->createCommand('select * from user_doctor_new where realname="'.iconv('utf-8','gbk','张高丽').'"')->queryAll();
        //exit;
   /*     $t=Yii::$app->dbclub->createCommand("show variables like 'character_set_%'")->queryAll();
        $s=Yii::$app->dbclub->createCommand("show variables like 'collation_%'")->queryAll();
        var_dump($s);
        var_dump($t);exit;*/

        $dataProvider = $searchModel->search($data);
        return $this->render($this->action->id, ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'dynamicForm' => $dynamicForm, 'data' => $data]);
    }


    public function actionDelete()
    {
        $post = Yii::$app->request->post();
        $Model = new DcDynamic();
        return $Model->Del($post);
    }


    public function actionWarning()
    {
        $post = Yii::$app->request->post();
        $Model = new DcDynamic();
        return $Model->Warning($post);
    }

    public function actionPush()
    {
        $id = Yii::$app->request->get('id', 0);
        $Model = new DcDynamic();
        if ($Model->Push($id)) {
            \Yii::$app->getSession()->setFlash('success', '动态推送成功！');
        } else {
            Yii::$app->getSession()->setFlash('error', '动态推送失败，请重新操作！');
        }
        return $this->redirect('list');
    }


    public function actionScreen()
    {

        $id = Yii::$app->request->get('id', 0);
        $Model = new DcDynamic();
        if ($Model->Screen($id)) {
            \Yii::$app->getSession()->setFlash('success', '动态屏蔽成功！');
        } else {
            Yii::$app->getSession()->setFlash('error', '动态屏蔽失败，请重新操作！');
        }
        return $this->redirect('list');
    }

    public function actionRecovery()
    {
        $id = Yii::$app->request->get();
        $data = DcDynamic::find()->select(['userid'])->where(['id' => $id])->asArray()->one();
        $data['id'] = $id['id'];
        $Model = new DcDynamic();
        if ($Model->Recovery($data)) {
            \Yii::$app->getSession()->setFlash('success', '动态恢复成功！');
        } else {
            Yii::$app->getSession()->setFlash('error', '动态恢复失败，请重新操作！');
        }
        return $this->redirect('list');
    }
}