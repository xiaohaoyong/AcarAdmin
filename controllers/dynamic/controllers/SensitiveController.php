<?php
/**
 * Created by PhpStorm.
 * User: xywy
 * Date: 2016/9/8
 * Time: 17:44
 */
namespace app\controllers\dynamic\controllers;
use app\models\dynamic\Sensitive;
use app\controllers\BaseController;
use Yii;

class SensitiveController extends   BaseController
{

    public function actionList()
    {

        $model = new Sensitive();
        $data = $model->keywords();
        return $this->render('list', ['data' => $data,'model'=>$model]);
    }

    public function actionDelete()
    {
        $keyword=Yii::$app->request->get('keyword',0);
        $model = new Sensitive();
        if($model->delete($keyword))
        {
            \Yii::$app->getSession()->setFlash('success', '敏感词删除成功！');
            return $this->redirect('list');
        }else{
            Yii::$app->getSession()->setFlash('error', '删除失败，请重新操作！');
            return $this->redirect('list');
        }
    }


    public function actionAdd()
    {
        $keyword=Yii::$app->request->post();
        $model = new Sensitive();
        if($model->add($keyword)) {
            \Yii::$app->getSession()->setFlash('success', '敏感词添加成功！');
            return $this->redirect('list');
        }else{
            Yii::$app->getSession()->setFlash('error', '添加失败，请重新操作！');
            return $this->redirect('list');
        }
    }


}