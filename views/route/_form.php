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

    <?= $form->field($model, 'price',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bprice5',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bprice7',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bprice9',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saddr',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saddrname',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slat',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slng',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <span>点击拾取坐标（输入起始城市后自动刷新）</span>

    <div id="allmap" class="form-group" style="width: auto;height: 300px;"></div>

    <?= $form->field($model, 'eaddr',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eaddrname',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'elat',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elng',['options' => ['class' => 'col-lg-6'],'labelOptions' => ['class' => 'col-lg-3 control-label']])->textInput(['maxlength' => true]) ?>
    <span>点击拾取坐标（输入终点城市后自动刷新）</span>
    <div id="allmap2" class="form-group" style="width: auto;height: 300px;"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$jsform="
 // 百度地图API功能
    var map = new BMap.Map(\"allmap\");
    	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放

    $('#route-saddr').blur(function(){
        map.centerAndZoom($(this).val(),15);      // 初始化地图,用城市名设置地图中心点
    });
    function showInfo(e){
        map.clearOverlays();
        $('#route-slng').val(e.point.lng);
        $('#route-slat').val(e.point.lat);
        var point = new BMap.Point(e.point.lng, e.point.lat);
        map.centerAndZoom(point, 15);
        var marker = new BMap.Marker(point);  // 创建标注
        map.addOverlay(marker);               // 将标注添加到地图中
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    }
    map.addEventListener(\"click\", showInfo);

     // 百度地图API功能
    var map2 = new BMap.Map(\"allmap2\");
    	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放

    $('#route-eaddr').blur(function(){
        map2.centerAndZoom($(this).val(),15);      // 初始化地图,用城市名设置地图中心点
    });
    function showInfo2(e){
        map2.clearOverlays();
        $('#route-elng').val(e.point.lng);
        $('#route-elat').val(e.point.lat);
        var point = new BMap.Point(e.point.lng, e.point.lat);
        map2.centerAndZoom(point, 15);
        var marker = new BMap.Marker(point);  // 创建标注
        map2.addOverlay(marker);               // 将标注添加到地图中
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    }
    map2.addEventListener(\"click\", showInfo2);

";
$js[]=$jsform;
$this->registerJs(implode("\n",$js));

?>