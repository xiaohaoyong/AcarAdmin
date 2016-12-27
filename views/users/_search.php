<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],

    ]); ?>



    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'type')->dropDownList([0=>'乘客','1'=>'司机'], ['prompt'=>'请选择']) ?>


    <?php  echo $form->field($model, 'level')->dropDownList(['-1'=>'不通过',0=>'未审核','1'=>'通过'], ['prompt'=>'请选择']) ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php  echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'idnum') ?>

    <?php // echo $form->field($model, 'idimg') ?>

    <?php // echo $form->field($model, 'authKey') ?>

    <?php // echo $form->field($model, 'accessToken') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
