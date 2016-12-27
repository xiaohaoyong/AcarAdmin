
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '我的助理发送消息';
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'usertype')->textInput()->dropDownList([6 => '肝友汇测试用户', 5 => '肝友汇用户',7=>"肝友汇正式线测试账号"]) ?>
<?php // $form->field($model, 'userid')->textarea(['value' => $model->content])->hint('多个用户请使用英文逗号“,”分割.') ?>
<?= $form->field($model, 'content')->textarea(['value' => $model->content])->hint('') ?>

<br/>
<?= Html::submitButton('Submit', ['data'=>['confirm'=>'确定发此消息给用户?']]) ?>

<?php ActiveForm::end(); ?>
