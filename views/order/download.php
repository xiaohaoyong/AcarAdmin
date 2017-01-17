<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = '导出订单';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="order-search">

        <?php $form = ActiveForm::begin([
            'action' => ['download'],
            'method' => 'get',
            'options' => ['class' => 'form-inline'],

        ]); ?>

        <?php echo $form->field($model, 'status')->dropDownList(\app\models\Order::$statustext, ['prompt'=>'请选择']) ?>

        <?php echo $form->field($model, 'type')->dropDownList(\app\models\Order::$typetext, ['prompt'=>'请选择']) ?>

        <?php // echo $form->field($model, 'saddr') ?>

        <?php // echo $form->field($model, 'saddrname') ?>

        <?php // echo $form->field($model, 'slat') ?>

        <?php // echo $form->field($model, 'slng') ?>

        <?php // echo $form->field($model, 'eaddr') ?>

        <?php // echo $form->field($model, 'eaddrname') ?>

        <?php // echo $form->field($model, 'elat') ?>

        <?php // echo $form->field($model, 'elng') ?>

        <?php // echo $form->field($model, 'num') ?>

        <?php // echo $form->field($model, 'phone') ?>

        <?php // echo $form->field($model, 'bespeaktime') ?>

        <?php echo $form->field($model, 'paytype')->dropDownList(\app\models\Order::$paytypetext, ['prompt'=>'请选择']) ?>

        <?php echo $form->field($model, 'paystatus')->dropDownList(\app\models\Order::$paystatustext,['prompt'=>'请选择']) ?>

        <?php // echo $form->field($model, 'trmb') ?>

        <?php // echo $form->field($model, 'prmb') ?>

        <?php echo $form->field($model, 'start')->widget(\app\components\widgets\DatePicker::className(),['options'=>['placeholder' => '开始时间']]) ?>
        <?php echo $form->field($model, 'end')->widget(\app\components\widgets\DatePicker::className(),['options'=>['placeholder' => '结束时间']]) ?>

        <?php // echo $form->field($model, 'payid') ?>

        <div class="form-group">
            <?= Html::submitButton('导出', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>