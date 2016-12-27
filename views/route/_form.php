<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Route */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=yf5Io8fsw7Dg0rUYGO6hcu50"></script>

<div class="route-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bprice5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bprice7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bprice9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saddr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saddrname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slng')->textInput(['maxlength' => true]) ?>


    <div id="allmap" class="form-group" style="width: auto;height: 300px;"></div>
    <script type="text/javascript">
        // 百度地图API功能
        var map = new BMap.Map("allmap");
        $('#route-saddr').blur(function(){
            map.centerAndZoom($(this).val(),15);      // 初始化地图,用城市名设置地图中心点
        });
        function showInfo(e){
            alert(e.point.lng + ", " + e.point.lat);
        }
        map.addEventListener("click", showInfo);
    </script>
    <?= $form->field($model, 'eaddr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eaddrname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'elat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elng')->textInput(['maxlength' => true]) ?>
    <div id="allmap2" class="form-group" style="width: auto;height: 300px;"></div>
    <script type="text/javascript">
        // 百度地图API功能
        var map = new BMap.Map("allmap2");
        map.centerAndZoom("上海",15);      // 初始化地图,用城市名设置地图中心点
        function showInfo(e){
            alert(e.point.lng + ", " + e.point.lat);
        }
        map.addEventListener("click", showInfo);
    </script>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
