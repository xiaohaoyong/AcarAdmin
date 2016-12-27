<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->orderid;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <p>
        <?= Html::a('修改订单', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除订单', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'orderid',
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
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [                      // the owner name of the model
                'attribute' => 'bespeaktime',
                'value' => function($data)
                {
                    if($data->bespeaktime){
                        return date('Y-m-d H:i:s',$data->bespeaktime);
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
             'saddr',
             'saddrname',
             'slat',
             'slng',
             'eaddr',
             'eaddrname',
             'elat',
             'elng',
             'num',
             'phone',

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
             'prmb',
             'paytime:datetime',
            [                      // the owner name of the model
                'attribute' => 'paytime',
                'value' => function($data)
                {
                    return $data->paytime?date('Y-m-d H:i:s',$data->paytime):0;
                }
            ],
             'payid',
        ],
    ]) ?>

</div>
