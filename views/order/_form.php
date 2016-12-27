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

    <?= $form->field($model, 'orderid',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userid',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driverid',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Driver::find()->select(['driver'])->indexBy('userid')->column(), ['prompt'=>'分配司机请选择']) ?>

    <?= $form->field($model, 'addtime',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'routeid',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Route::find()->select(['CONCAT(saddr,eaddr)'])->indexBy('id')->column(), ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$statustext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'type',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$typetext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'saddr',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saddrname',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slat',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slng',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eaddr',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eaddrname',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elat',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elng',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput() ?>

    <?= $form->field($model, 'phone',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bespeaktime',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dateInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paytype',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$paytypetext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'paystatus',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->dropDownList(\app\models\Order::$paystatustext, ['prompt'=>'请选择']) ?>

    <?= $form->field($model, 'trmb',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput() ?>

    <?= $form->field($model, 'prmb',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput() ?>

    <?= $form->field($model, 'paytime',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput() ?>

    <?= $form->field($model, 'payid',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
