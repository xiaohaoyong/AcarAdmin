<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DriverRoute */

$Users=\app\models\Users::findOne($model->userid);
$this->title = $Users->name.'的路线';
$this->params['breadcrumbs'][] = ['label' => 'Driver Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-route-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
