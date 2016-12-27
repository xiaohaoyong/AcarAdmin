<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Route */

$this->title = '修改路线: ' . $model->saddr."-".$model->eaddr;
;
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="route-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
