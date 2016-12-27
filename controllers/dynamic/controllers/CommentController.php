<?php
/**
 * Created by PhpStorm.
 * User: xywy
 * Date: 2016/9/8
 * Time: 17:44
 */
namespace app\controllers\dynamic\controllers;

use app\models\dynamic\DcComment;
use app\controllers\BaseController;
use app\models\user;
use app\models\dynamic\CommentSearch;
use app\models\dynamic\CommentForm;
use Yii;

class CommentController extends BaseController
{

    public function actionList()
    {
        $searchModel = new CommentSearch();
        $CommentForm = new CommentForm();
        $data=Yii::$app->request->get();
        $dataProvider = $searchModel->search($data);
        return $this->render('list', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'commentForm' => $CommentForm,'data'=>$data]);
    }


    public function actionDelete()
    {
        $post = Yii::$app->request->post();
        $Model = new DcComment();
        return $Model->Del($post);
    }


    public function actionWarning()
    {
        $post = Yii::$app->request->post();
        $Model = new DcComment();
        return $Model->Warning($post);
    }

    public function actionRecovery()
    {
        $data = Yii::$app->request->get();
        $da= DcComment::updateAll(['level' => 0], ['id' => $data['id']]);
        if ($da) {
            \Yii::$app->getSession()->setFlash('success', '动态恢复成功！');
        } else {
            Yii::$app->getSession()->setFlash('error', '动态恢复失败，请重新操作！');
        }
        return $this->redirect('list');
    }


}