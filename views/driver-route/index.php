<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriverRouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$userid=\Yii::$app->request->get('userid',0);
$Users=\app\models\Users::findOne($userid);


$this->title = $Users->name."的路线";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-route-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加路线', ['create','userid'=>$userid], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [                      // the owner name of the model
                'attribute' => 'routeid',
                'value' => function($data)
                {
                    $route=\app\models\Route::findOne($data->routeid);
                    return $route->saddr."-".$route->eaddr;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>
