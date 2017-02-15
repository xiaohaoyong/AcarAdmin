<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="field-order-cartime required" style="height: 44px">
        <label class="control-label" for="order-cartime">司机姓名:</label>
        <?php
        $users=\app\models\Users::findOne($model->userid);
        echo $users->name;
        ?>
        <div class="help-block"></div>
    </div>


    <?= $form->field($model, 'city')->dropDownList(\app\models\City::find()->select(['city'])->indexBy('id')->column(), ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'plates')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Bnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Baccount')->textInput(['maxlength' => true]) ?>
    <div class="field-order-cartime required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-cartime">车辆注册时间</label>
        <?=date('Y-m-d H:i:s',$model->cartime)?>
        <div class="help-block"></div>
    </div>

    <div class="field-order-starttime required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-starttime">初次领取驾照日期</label>
        <?=date('Y-m-d H:i:s',$model->starttime)?>
        <div class="help-block"></div>
    </div>

    <div class="field-order-addtime required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-addtime">注册时间</label>
        <?=date('Y-m-d H:i:s',$model->addtime)?>
        <div class="help-block"></div>
    </div>



    <div class="field-order-licenseimg required">
        <label class="col-lg-3 control-label" for="order-licenseimg">驾驶证照片</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->licenseimg,true)?>' width='50%'>
        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
