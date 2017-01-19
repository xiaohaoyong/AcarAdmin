<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Insurance */

$this->title = '车险报价';
$this->params['breadcrumbs'][] = ['label' => 'Insurances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insurance-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
