<?php
namespace app\controllers\dynamic\controllers;

use app\controllers\BaseController;
use  app\models\data\Retention;
use app\models\data\Chart;
use Yii;

class DataController extends BaseController
{

    public function actionRetention()
    {

        $startdate = Yii::$app->request->post('startdate', date('Ymd', strtotime('-1 month')));
        $enddate = Yii::$app->request->post('enddata', date('Ymd', strtotime('+1 day')));
        $model = new Retention();
        $data = $model->userRetention($startdate, $enddate);
        return $this->render('retention', ['data' => $data]);

    }

    public function actionChart()
    {
        $startDate = Yii::$app->request->post('startDate', date('Ymd', strtotime('-1 month')));
        $endDate = Yii::$app->request->post('endData', date('Ymd', time()));
        $model = new Chart();
        $data = $model->DataLine($startDate, $endDate);
        return $this->render('chart', ['data' => $data,]);

    }

    public function actionCharts()
    {
        $startDate = Yii::$app->request->post('startDate', date('Ymd', strtotime('-1 month')));
        $endDate = Yii::$app->request->post('endData', date('Ymd', time()));
        $model = new Chart();
        $data = $model->DataHide($startDate, $endDate);
        return $this->render('charts', ['data' => $data]);
    }

    public function actionClick()
    {

        $searchModel = new Chart();
        $data = $searchModel->DataClick(Yii::$app->request->get());
        return $this->render('click', ['data' => $data, 'searchModel' => $searchModel]);
    }

    public function actionRelease()
    {
        $searchModel = new Chart();
        $data = $searchModel->DataRelease(Yii::$app->request->get());
        return $this->render('release', ['data' => $data, 'searchModel' => $searchModel]);
    }

}
