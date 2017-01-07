<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->radioList([0=>'乘客','1'=>'司机']) ?>

    <?= $form->field($model, 'level')->radioList(['-1'=>'不通过',0=>'未审核','1'=>'通过']) ?>

    <?= $form->field($model, 'sex')->radioList(['1'=>'男','0'=>'女']) ?>

    <?= $form->field($model, 'idnum')->textInput(['maxlength' => true]) ?>

    <div class="field-order-addtime required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-addtime">创建时间</label>
        <?=date('Y-m-d H:i:s',$model->addtime)?>
        <div class="help-block"></div>
    </div>

    <div class="field-order-openid required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-openid">微信Openid</label>
        <?=$model->openid?>
        <div class="help-block"></div>
    </div>

    <div class="field-order-authKey required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-authKey">authKey</label>
        <?=$model->authKey?>
        <div class="help-block"></div>
    </div>

    <div class="field-order-accessToken required" style="height: 44px">
        <label class="col-lg-3 control-label" for="order-accessToken">Access Token</label>
        <?=$model->accessToken?>
        <div class="help-block"></div>
    </div>

    <div class="field-users-idimg required">
        <label class="col-lg-3 control-label" for="users-idimg">驾驶证照片</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->idimg,true)?>' width='50%'>
        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
