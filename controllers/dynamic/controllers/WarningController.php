<?php
namespace app\controllers\dynamic\controllers;

use app\models\dynamic\Warning;
use app\controllers\BaseController;
use app\models\dynamic\ThemeSearch;
use  app\models\dynamic\ThemeForm;
use Yii;

class WarningController extends BaseController
{

    public function actionList()
    {

        $model = new Warning();
        $provider = $model->warning(Yii::$app->request->get());
        return $this->render('list', ['provider' => $provider,'model'=>$model]);
    }

    public function actionReset()
    {
        $userid = $keyword = Yii::$app->request->get('userid');
        $click = $keyword = Yii::$app->request->get('click');
        $model = new Warning();
        if ($model->reset($userid, $click)) {
            \Yii::$app->getSession()->setFlash('success', '警告清除成功！');
            return $this->redirect('list');
        } else {
            \Yii::$app->getSession()->setFlash('error', '警告清除失败！');
            return $this->redirect('list');
        }

    }

    public function actionClearance()
    {
        $model = new Warning();
        $data = $keyword = Yii::$app->request->get();
        if ($model->clearTime($data)) {
            \Yii::$app->getSession()->setFlash('success', '禁言时间清除成功！');
            return $this->redirect('list');
        } else {
            \Yii::$app->getSession()->setFlash('error', '禁言清除失败！');
            return $this->redirect('list');
        }

    }

}
