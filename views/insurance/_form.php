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

    <?= $form->field($model, 'userid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'offer')->textInput() ?>

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

    <div class="field-insurance-lossdanger danger">
        <label class="control-label" for="insurance-lossdanger">商业险</label>
    </div>

    

    <?= $form->field($model, 'starttime')->dateInput(['value' => NULL]) ?>


    
    <div class="field-insurance-lossdanger">
        <label class="control-label" for="insurance-lossdanger">车辆损失险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'islossdanger',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    

    <div class="field-insurance-liability">
        <label class="control-label" for="insurance-liability">第三者责任险</label>
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
            <label><?=Html::activeCheckbox($model,'isliability',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'liability',$liability,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    

    <?php
    $dseat=[
        "0"=>'不投保',
        "10000"=>'1万',
        "20000"=>'2万',
        "30000"=>'3万',
        "40000"=>'4万',
        "50000"=>'5万',
        "100000"=>'10万',
        "200000"=>'20万',
        "250000"=>'25万',
        "300000"=>'30万',
    ];
    ?>
    <div class="field-insurance-dseat">
        <label class="control-label" for="insurance-dseat">司机座位险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'isdseat',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'dseat',$dseat,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    

    <div class="field-insurance-cseat">
        <label class="control-label" for="insurance-cseat">乘客座位险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'iscseat',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'cseat',$dseat,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    

    <div class="field-insurance-daoqiang">
        <label class="control-label" for="insurance-daoqiang">全车盗抢险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'isdaoqiang',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    
    <?php
    $huahen=[
        "0"=>'不投保',
        "2000"=>'2000',
        "5000"=>'5000',
        "10000"=>'1万',
        "20000"=>'2万',
    ];
    ?>
    <div class="field-insurance-huahen">
        <label class="control-label" for="insurance-huahen">划痕险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'ishuahen',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
            <?=Html::activeDropDownList($model,'huahen',$huahen,['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    

    <div class="field-insurance-boli">
        <label class="control-label" for="insurance-boli">玻璃单独破碎险</label>
        <div style="float:right">
            <?=Html::activeDropDownList($model,'boli',[0=>"不投保",1=>'进口玻璃',2=>'国产玻璃'],['label'=>false])?>
        </div>
        <div class="help-block"></div>
    </div>
    

    <div class="field-insurance-ziran">
        <label class="control-label" for="insurance-ziran">自燃损失险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'isziran',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    

    <div class="field-insurance-sheshui">
        <label class="control-label" for="insurance-sheshui">涉水行驶损失险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'issheshui',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    

    <div class="field-insurance-wufa">
        <label class="control-label" for="insurance-wufa">交强险</label>
        <div style="float:right">
            <label><?=Html::activeCheckbox($model,'wufa',['value'=>1,'class'=>'icheck','uncheck'=>NULL])?></label>
        </div>
        <div class="help-block"></div>
    </div>
    

    <?php
    $xiulichanga=[
        "0"=>'上浮系数',
        "10"=>'10',
        "15"=>'15',
        "20"=>'20',
        "30"=>'30',
        "40"=>'40',
        "50"=>'50',
        "60"=>'60',

    ];
    ?>
    <div class="field-insurance-xiulichanga">
        <label class="control-label" for="insurance-xiulichanga">指定修理厂险</label>
        <div style="float:right">
            <?=Html::activeDropDownList($model,'xiulichanga',$xiulichanga,['label'=>false])?>
            <?=Html::activeDropDownList($model,'xiulichangb',[0=>"不投保",1=>'进口',2=>'国产'],['label'=>false])?>

        </div>
        <div class="help-block"></div>
    </div>
    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
