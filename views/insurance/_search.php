<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InsuranceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insurance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?php echo $form->field($model, 'level')->dropDownList(\app\models\Insurance::$leveltext, ['prompt'=>'请选择']) ?>

    <?php // echo $form->field($model, 'xsimgb') ?>

    <?php // echo $form->field($model, 'bdimg') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'offer') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
