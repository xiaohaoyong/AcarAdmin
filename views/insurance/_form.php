<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Insurance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insurance-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="field-insurance-userid required" style="height: 44px">
        <label class="control-label" for="insurance-userid">司机姓名:</label>
        <?php
        $users=\app\models\Users::findOne($model->userid);
        echo $users->name;
        ?>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'offer')->textInput() ?>


    <div class="field-insurance-lossdanger danger">
        <label class="control-label" for="insurance-lossdanger">商业险</label>
    </div>

    <hr>

    <?= $form->field($model, 'starttime')->dateInput(['value' => NULL]) ?>

    <hr>


    <div class="field-insurance-wufa">
        <label class="control-label" for="insurance-wufa">交强险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'wufa',['value'=>1,'class'=>'icheck','uncheck'=>NULL,'label'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>


    <div class="field-insurance-lossdanger">
        <label class="control-label" for="insurance-lossdanger">机动车损失保险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'islossdanger',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>

    <div class="field-insurance-liability">
        <label class="control-label" for="insurance-liability">第三者责任保险</label>
        <div style="float:right">

            <?php
            $liability=[
                "0"=>'不投保',
                "50000"=>'5万',
                "100000"=>'10万',
                "150000"=>'15万',
                "200000"=>'20万',
                "300000"=>'30万',
                "500000"=>'50万',
                "1000000"=>'100万',
                "1500000"=>'150万',
                "2000000"=>'200万',
                "2500000"=>'250万',
                "3000000"=>'300万',
                "5000000"=>'500万',
            ];
            ?>
            <label><?=Html::activeCheckbox($model,'isliability',['value'=>1,'class'=>'icheck','uncheck'=>NULL,'label'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'liability',\app\models\Insurance::$liability,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>


    <div class="field-insurance-daoqiang">
        <label class="control-label" for="insurance-daoqiang">全车盗抢保险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'isdaoqiang',['value'=>1,'class'=>'icheck','uncheck'=>NULL,'label'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>

    <div class="field-insurance-dseat">
        <label class="control-label" for="insurance-dseat">车上人员责任保险(司机) </label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'isdseat',['value'=>1,'class'=>'icheck','uncheck'=>NULL,'label'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'dseat',\app\models\Insurance::$dseat,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>

    <div class="field-insurance-cseat">
        <label class="control-label" for="insurance-cseat">车上人员责任保险(乘客) </label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'iscseat',['value'=>1,'class'=>'icheck','uncheck'=>NULL,'label'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'cseat',\app\models\Insurance::$dseat,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>

    <div class="field-insurance-boli">
        <label class="control-label" for="insurance-boli">玻璃单独破碎险</label>
        <div style="float:right">
            <?=Html::activeDropDownList($model,'boli',\app\models\Insurance::$boli,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>

    <div class="field-insurance-huahen">
        <label class="control-label" for="insurance-huahen">车身划痕损失险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'ishuahen',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'huahen',\app\models\Insurance::$huahen,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>


    <div class="field-insurance-ziran">
        <label class="control-label" for="insurance-ziran">自燃损失险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'isziran',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>

    <div class="field-insurance-sheshui">
        <label class="control-label" for="insurance-sheshui">发动机涉水损失险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'issheshui',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    <hr>


    <div class="field-insurance-xiulichanga">
        <label class="control-label" for="insurance-xiulichanga">指定修理厂险</label>
        <div style="float:right">
            <?=Html::activeDropDownList($model,'xiulichanga',\app\models\Insurance::$xiulichanga,['label'=>false])?>
            <?=Html::activeDropDownList($model,'xiulichangb',\app\models\Insurance::$xiulichangb,['label'=>false])?>

        </div>
        <div class="help-block"></div>
    </div>
    <hr>


    <div class="field-insurance-idimgz required">
        <label class="col-lg-3 control-label" for="insurance-idimgz">身份证正面</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->idimgz,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-idimgb required">
        <label class="col-lg-3 control-label" for="insurance-idimgb">身份证背面</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->idimgb,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-xsimgz required">
        <label class="col-lg-3 control-label" for="insurance-xsimgz">行驶证正本</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->xsimgz,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-xsimga required">
        <label class="col-lg-3 control-label" for="insurance-xsimga">行驶证A面副本</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->xsimga,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-xsimgb required">
        <label class="col-lg-3 control-label" for="insurance-xsimgb">行驶证B面副本</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->xsimgb,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>
    <div class="field-insurance-bdimg required">
        <label class="col-lg-3 control-label" for="insurance-bdimg">保单</label>
        <img src='<?=\yii\helpers\Url::to(ACAR_IMGURL.$model->bdimg,true)?>' width='300px'>
        <div class="help-block"></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
