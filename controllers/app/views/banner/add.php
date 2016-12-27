<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '轮播图';
\app\components\helper\HeaderActionHelper::$action = [
    ['url' => ['banner/index'], 'name' => "轮播图列表"],
    ['url' => ['banner/add'], 'name' => "添加轮播图"],
];
?>

<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal',], 'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">\n{hint}\n{error}</div>",
                'labelOptions' => ['class' => 'col-lg-2 control-label'],
            ],]);
?>
<?= $form->field($model, 'status')->textInput()->dropDownList(['h5', '资讯', '医圈']) ?>
<?= $form->field($model, 'params')->textInput()->dropDownList(['正常', '发现']) ?>
<?= $form->field($model, 'type')->textInput()->dropDownList([2 => '肝友汇']) ?>
<?= $form->field($model, 'title')->textInput(['value' => $row->title]) ?>
<?= $form->field($model, 'description')->textInput(['value' => $row->description]) ?>
<?= $form->field($model, 'url')->textInput(['value' => $row->url]) ?>

<!--imgurl-->
<?= $form->field($uploadModel, 'imageFile')->fileInput()->label('上传小图')->hint('') ?>
<?php if ($row->imgurl): ?>
    <div class="form-group">
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-5">
            <?= Html::tag('img', '', ['src' => $row->imgurl, 'width' => 150]) ?>
        </div>
        <div class="col-lg-5">
        </div>
    </div>
<?php endif; ?>

<?= $form->field($model, 'orderby')->textInput(['value' => $row->orderby]) ?>
<?= $form->field($model, 'extra_id')->textInput(['value' => $row->extra_id])->hint('当类型是医圈时请填此项') ?>

<!--articleImageUrl-->
<?= $form->field($uploadModel, 'imageFile2')->fileInput()->label('分享图标')->hint('') ?>
<?php if ($row->articleImageUrl): ?>
    <div class="form-group">
        <label class="col-lg-2 control-label"></label>
        <div class="col-lg-5">
            <?= Html::tag('img', '', ['src' => $row->articleImageUrl, 'width' => 150]) ?>
        </div>
        <div class="col-lg-5">
        </div>
    </div>

<?php endif; ?>

<input name="YimaiBanner[imgurl]" type="hidden" value="<?= $row->imgurl ?>"　/>
<input name="YimaiBanner[articleImageUrl]" type="hidden" value="<?= $row->articleImageUrl ?>"　/>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-11">
        <?= Html::submitButton('Submit', ['class' => 'btn green']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
