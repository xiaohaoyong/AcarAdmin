<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = $model->driver;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-view">


    <p>
        <?= Html::a('修改', ['update', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->userid], [
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
            'userid',
            [
                'attribute' => 'driver',
                'value' => function($data)
                {
                    $Users=\app\models\Users::findOne($data->userid);
                    return $Users->name;
                }
            ],
            [
                'attribute' => 'addtime',
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
            [
                'attribute' => 'starttime',
                'format' => ['date', 'php:Y-m-d']
            ],
             'licenseimg',
        ],
    ]) ?>

</div>
