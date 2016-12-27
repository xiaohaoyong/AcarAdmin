<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RouteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>



    <?= $form->field($model, 'saddr') ?>

    <?= $form->field($model, 'saddrname') ?>

    <?php // echo $form->field($model, 'slat') ?>

    <?php // echo $form->field($model, 'slng') ?>

    <?= $form->field($model, 'eaddr') ?>

    <?= $form->field($model, 'eaddrname') ?>

    <?php // echo $form->field($model, 'elng') ?>

    <?php // echo $form->field($model, 'elat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
