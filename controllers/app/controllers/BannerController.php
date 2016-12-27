<?php
/**
 * 轮播图
 */
namespace app\controllers\app\controllers;

use app\models\yimaiBanner\YimaiBanner;
use app\models\yimaiBanner\UploadForm;
use yii\web\UploadedFile;

class BannerController extends \app\controllers\BaseController {

    public function actionIndex() {
        $query = YimaiBanner::find();
        $query->where(['type'=>2]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'orderby' => SORT_ASC,
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd() {
        $model = new YimaiBanner();
        $uploadModel = new UploadForm();

        // 场景
        $uploadModel->scenario = 'createImg';

        if (!\Yii::$app->request->isPost) {
            return $this->render('add', ['model' => $model, 'uploadModel' => $uploadModel, 'row' => $model]);
        }

        $model->load(\Yii::$app->request->post(), 'YimaiBanner');

        // 图片
        $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');
        $uploadModel->imageFile2 = UploadedFile::getInstance($uploadModel, 'imageFile2');
        $model->imgurl = $uploadModel->upload();
        if($uploadModel->imageFile2){
            $model->articleImageUrl = $uploadModel->upload2();
        }

        // 表单字段验证
        $model->validate();
        if ($model->hasErrors()) {
            $error = array_values($model->FirstErrors)[0];
            return "<script>alert('$error');history.back();</script>";
            //return $this->render('@app/views/site/error', ['name' => 'Error', 'message' => $error]);
        }

        $model->save(false);
        
        return \Yii::$app->response->redirect(["app/banner/index"]);
    }

    public function actionUpdate() {
        $model = new YimaiBanner();
        $uploadModel = new UploadForm();

        $id = \Yii::$app->request->get('id', 1);

        if (!\Yii::$app->request->isPost) {

            $model= $row = $model->find()->where(['id' => $id])->one();

            return $this->render('add', ['model' => $model, 'uploadModel' => $uploadModel, 'row' => $row]);
        }

        $query = $model->findOne($id);
        $query->load(\Yii::$app->request->post());

        // **BEGIN** 图片上传
        
        $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');
        $uploadModel->imageFile2 = UploadedFile::getInstance($uploadModel, 'imageFile2');

        if ($uploadModel->imageFile) {
            // 场景
            $uploadModel->scenario = 'updateImg';
        }

        if ($uploadModel->imageFile2) {
            // 场景
            $uploadModel->scenario = 'updateImg2';
        }

        if ($uploadModel->imageFile || $uploadModel->imageFile2) {
            $uploadModel->validate();
            if ($uploadModel->hasErrors()) {
                $error = array_values($uploadModel->FirstErrors)[0];
                return $this->render('/site/error', ['name' => 'Error', 'message' => $error]);
            }
        }

        if ($uploadModel->imageFile) {
            $query->imgurl = $uploadModel->upload();
        }

        if ($uploadModel->imageFile2) {
            $query->articleImageUrl = $uploadModel->upload2();
        }
        
        // **END** 图片上传

        // 表单字段验证
        $query->validate();

        if ($query->getErrors()) {
            $error = array_values($query->FirstErrors)[0];
            return $this->render('/site/error', ['name' => 'Error', 'message' => $error]);
        }

        $query->save(false);

        return $this->redirect('index');
    }

    public function actionDelete() {
        $model = new YimaiBanner();

        $id = \Yii::$app->request->get('id', 1);

        // 表单字段验证
        $query = $model->findOne($id);
        $query->delete();

        return "<script>alert('完成');history.back()</script>";
    }

}
