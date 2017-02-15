<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '司机资料';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-index">

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'userid',
                'value' => function($data)
                {
                    $Users=\app\models\Users::findOne($data->userid);
                    return $Users->name;
                }
            ],
            [
                'attribute' => 'city',
                'value' => function($data)
                {
                    $route=\app\models\City::findOne($data->city);
                    return $route->city;
                }
            ],
            'plates',
            'owner',
            [
                'attribute' => 'addtime',
                'format' => ['date', 'php:Y-m-d']
            ],

            // 'starttime',
            // 'addtime',
            // 'licenseimg',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {routes}',
                'buttons'=>[
                    'routes' => function ($url, $model, $key) {
                     return Html::a('司机路线管理', ['driver-route/index','userid'=>$model->userid]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
