<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <div class="col-lg-6 field-order-orderid required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-orderid">订单ID</label>
        <?=$model->orderid?>
        <div class="help-block"></div>
    </div>
    <div class="col-lg-6 field-order-userid required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-userid">下单用户</label>
        <?php
            $user=\app\models\Users::findOne($model->userid);
            echo $user->name;
        ?>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'driverid',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Users::find()->where(['type'=>1])->select(['name'])->indexBy('id')->column(), ['prompt'=>'分配司机请选择']) ?>
    <div class="col-lg-6 field-order-addtime required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-addtime">创建时间</label>
        <?=$model->addtime?>
        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'routeid',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Route::find()->select(['CONCAT(saddr,eaddr)'])->indexBy('id')->column(), ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$statustext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'type',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$typetext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'saddr',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saddrname',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slat',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slng',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>
    <div class="col-lg-6 field-order-orderid required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-addtime"></label>
        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'eaddr',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eaddrname',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elat',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elng',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput() ?>

    <?= $form->field($model, 'phone',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <div class="col-lg-6 field-order-bespeaktime required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-bespeaktime">预约时间</label>
        <?=$model->bespeaktime?>
        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'paytype',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$paytypetext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'paystatus',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$paystatustext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'trmb',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput() ?>

    <?= $form->field($model, 'prmb',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput() ?>

    <div class="col-lg-6 field-order-paytime required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-paytime">支付时间</label>
        <?=$model->paytime?>
        <div class="help-block"></div>
    </div>
    <div class="col-lg-6 field-order-payid required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-payid">支付ID</label>
        <?=$model->payid?>
        <div class="help-block"></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
