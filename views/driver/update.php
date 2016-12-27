<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = '修改司机: ' . $model->driver;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userid, 'url' => ['view', 'id' => $model->userid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
