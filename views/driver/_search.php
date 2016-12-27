<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DriverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['class' => 'form-inline'],
    ]); ?>


    <?= $form->field($model, 'city')->dropDownList(\app\models\City::find()->select(['city'])->indexBy('id')->column(), ['prompt'=>'请选择']) ?>


    <?= $form->field($model, 'owner') ?>


    <?php echo $form->field($model, 'driver') ?>

    <?php // echo $form->field($model, 'starttime') ?>

    <?php // echo $form->field($model, 'addtime') ?>

    <?php // echo $form->field($model, 'licenseimg') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
