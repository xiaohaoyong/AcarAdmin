<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DriverRoute */

$Users=\app\models\Users::findOne($model->userid);
$this->title = $Users->name.'的路线';
$this->params['breadcrumbs'][] = ['label' => 'Driver Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-route-view">
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            [                      // the owner name of the model
                'attribute' => 'routeid',
                'value' => function($data)
                {
                    $route=\app\models\Route::findOne($data->routeid);
                    return $route->saddr."-".$route->eaddr;
                }
            ],
        ],
    ]) ?>

</div>
