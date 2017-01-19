<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Insurance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insurance-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="field-insurance-userid required" style="height: 44px">
        <label class="control-label" for="insurance-userid">司机姓名:</label>
        <?php
        $users=\app\models\Users::findOne($model->userid);
        echo $users->name;
        ?>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'offer')->textInput() ?>

    <div class="field-insurance-idimgz required">
        <label class="col-lg-3 control-label" for="insurance-idimgz">身份证正面</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->idimgz,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-idimgb required">
        <label class="col-lg-3 control-label" for="insurance-idimgb">身份证背面</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->idimgb,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-xsimgz required">
        <label class="col-lg-3 control-label" for="insurance-xsimgz">行驶证正本</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->xsimgz,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-xsimga required">
        <label class="col-lg-3 control-label" for="insurance-xsimga">行驶证A面副本</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->xsimga,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-xsimgb required">
        <label class="col-lg-3 control-label" for="insurance-xsimgb">行驶证B面副本</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->xsimgb,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-bdimg required">
        <label class="col-lg-3 control-label" for="insurance-bdimg">保单</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->bdimg,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
