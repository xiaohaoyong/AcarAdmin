<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->dropDownList(\app\models\City::find()->select(['city'])->indexBy('id')->column(), ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'plates')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cartime')->textInput() ?>

    <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'starttime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addtime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'licenseimg')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
