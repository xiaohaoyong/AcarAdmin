<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'orderid',
            [                      // the owner name of the model
                'attribute' => 'userid',
                'value' => function($data)
                {
                    $route=\app\models\Users::findOne($data->userid);
                    return $route->name;
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'driverid',
                'value' => function($data)
                {
                    $route=\app\models\Users::findOne($data->driverid);
                    return $route->name;
                }
            ],
            [
                'attribute' => 'addtime',
                'format' => ['date', 'php:Y-m-d']
            ],
            [                      // the owner name of the model
                'attribute' => 'bespeaktime',
                'value' => function($data)
                {
                    if($data->bespeaktime){
                        return date('m月d日 H:i',$data->bespeaktime);
                    }else{
                        return "尽快出发";
                    }
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'routeid',
                'value' => function($data)
                {
                    $route=\app\models\Route::findOne($data->routeid);
                    return $route->saddr."-".$route->eaddr;
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'status',
                'value' => function($data)
                {
                    return \app\models\Order::$statustext[$data->status];
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'type',
                'value' => function($data)
                {
                    return \app\models\Order::$typetext[$data->type];

                }
            ],
            // 'saddr',
            // 'saddrname',
            // 'slat',
            // 'slng',
            // 'eaddr',
            // 'eaddrname',
            // 'elat',
            // 'elng',
            // 'num',
            // 'phone',
            // 'bespeaktime',

            [                      // the owner name of the model
                'attribute' => 'paytype',
                'value' => function($data)
                {
                    return \app\models\Order::$paytypetext[$data->paytype];
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'paystatus',
                'value' => function($data)
                {
                    return \app\models\Order::$paystatustext[$data->paystatus];
                }
            ],
            [                      // the owner name of the model
                'attribute' => 'trmb',
                'value' => function($data)
                {
                    return $data->trmb/100;
                }
            ],
            // 'prmb',
            // 'paytime:datetime',
            // 'payid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
