<?php

namespace app\controllers;

use app\models\Driver;
use app\models\Users;
use Yii;
use app\models\Order;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $p=Yii::$app->request->post();
        if($p) {

            $p['Order']['bespeaktime'] = strtotime($p['Order']['bespeaktime']);
        }

        if ($model->load($p) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->bespeaktime=$model->bespeaktime?date('Y-m-d h:i:s',$model->bespeaktime):"尽快出发";
            $model->addtime=date('Y-m-d h:i:s',$model->addtime);
            $model->paytime=date('Y-m-d h:i:s',$model->paytime);
            $model->trmb=$model->trmb/100;

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDownload()
    {
        if(Yii::$app->request->queryParams) {
            require(__DIR__ . '/../components/helper/excel/PHPExcel.php');
            require(__DIR__ . '/../components/helper/excel/PHPExcel/Writer/Excel2007.php');

            $objPHPExcel = new \PHPExcel();
            $objPHPExcel->getActiveSheet()->setCellValue('A1','订单号' );
            $objPHPExcel->getActiveSheet()->setCellValue('B1','乘客');
            $objPHPExcel->getActiveSheet()->setCellValue('C1','司机');
            $objPHPExcel->getActiveSheet()->setCellValue('D1','司机银行卡号');
            $objPHPExcel->getActiveSheet()->setCellValue('E1','开户行');
            $objPHPExcel->getActiveSheet()->setCellValue('F1','支付时间');
            $objPHPExcel->getActiveSheet()->setCellValue('G1','支付金额');
            $objPHPExcel->getActiveSheet()->setCellValue('H1','支付ID');

            $model=new OrderSearch();
            $list=$model->search(Yii::$app->request->queryParams);
            $models = array_values($list->getModels());
            $i=2;
            foreach($models as $k=>$v)
            {
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i,$v->orderid);

                $user=Users::findOne($v->userid);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i,$user->name);
                $userdriver=Users::findOne($v->driverid);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i,$userdriver->name);

                $driver=Driver::findOne(['userid'=>$v->driverid]);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i,$driver->Bnumber);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i,$driver->Baccount);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i,$v->paytime?date('Y-m-d H:i:s',$v->paytime):"未支付");
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i,$v->prmb/100);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i," ".$v->payid);
                $i++;
            }
            $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-execl");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");;
            header('Content-Disposition:attachment;filename="'.date('Y-m-d').'.xls"');
            header("Content-Transfer-Encoding:binary");
            $objWriter->save("php://output");
        }
        $searchModel = new OrderSearch();

        return $this->render('download', [
            'model' => $searchModel,
        ]);
    }

}
