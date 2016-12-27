<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "肝友汇-病例添加";
\app\components\helper\HeaderActionHelper::$action = [
    ['url' => ['seminar/list'], 'name' => "病例列表"],
];
?>

<?php $form = ActiveForm::begin([
    'action' => ['edit'],
    'id'=>$id,
    'method' => 'post',
    'fieldConfig' => [
        'template' => '<div class="col-lg-3 control-label color666 fontweight">{label}</div>
                                                    <div class="col-lg-5" style="padding-left: 15px;padding-right: 15px;">{input}</div>
                                                    <div class="col-lg-3">{error}</div>',
        'inputOptions' => ['class' => 'form-control'],
    ],
    'options' => ['class' => 'form-horizontal t-margin20 text-center', 'id' => 'form1', 'enctype' => "multipart/form-data"],
]); ?>
<?/*= $form->field($model, 'phase', ['labelOptions' => ['label' => '研讨班账号：']])->textInput(['style' => 'width:400px ', 'readonly' => 'readonly', 'value' => '肝胆科病例研讨班']) */?>
<?= $form->field($model, 'title', ['labelOptions' => ['label' => '标题：']])->textInput(['style' => 'width:400px']) ?>
<?= $form->field($model, 'phase',['labelOptions' => ['label' => '期号：']])->textInput(['style' => 'width:400px']) ?>
<?= $form->field($model, 'complain')->textarea(['rows' => 2])->label('主诉：') ?>
<?= $form->field($model, 'now_history')->textarea(['rows' => 2])->label('现病史：') ?>
<?= $form->field($model, 'past_history')->textarea(['rows' => 2])->label('既病史：') ?>
<?= $form->field($model, 'physical')->textarea(['rows' => 2])->label('体格体检：') ?>
<?= $form->field($model, 'sup_exa')->textarea(['rows' => 2])->label('辅助体检：') ?>
<?= $form->field($model, 'diagnosis')->textarea(['rows' => 2])->label('诊断：') ?>
<?= $form->field($model, 'basis')->textarea(['rows' => 2])->label('诊断依据：') ?>
<?= $form->field($model, 'further_exa')->textarea(['rows' => 2])->label('进一步检查：') ?>
<?= $form->field($model, 'treatment')->textarea(['rows' => 2])->label('治疗：') ?>
    <hr/>
<?= $form->field($model, 'question')->textarea(['rows' => 2])->label('问题：') ?>
<?= $form->field($model, 'answer')->textarea(['rows' => 2])->label('答案：') ?>

<?= Html::activeHiddenInput($model,'dynamicid') ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

<?php
$cssString = "div.required label:after {
    content: \" *\";
    color: red;
}";
$this->registerCss($cssString);
?>
