<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DriverRoute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-route-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'routeid')->dropDownList(\app\models\Route::find()->select(['CONCAT(saddr,eaddr)'])->indexBy('id')->column(), ['prompt'=>'请选择']) ?>
    <?= Html::activeHiddenInput($model,'userid') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
