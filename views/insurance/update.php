<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Insurance */

$this->title = '车险报价';
$this->params['breadcrumbs'][] = ['label' => 'Insurances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="insurance-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
