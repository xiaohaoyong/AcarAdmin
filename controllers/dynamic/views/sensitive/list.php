<!-- BEGIN FORM-->
<?php
use \app\models\dynamic;
use \app\models\user;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
//提示框
if (Yii::$app->getSession()->hasFlash('success')) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-success', //这里是提示框的class
        ],
        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
    ]);

}
//提示框
if (Yii::$app->getSession()->hasFlash('error')) {
    echo Alert::widget([
        'options' => [
            'class' => 'Metronic-alerts alert alert-danger fade in',
        ],
        'body' => Yii::$app->getSession()->getFlash('error'),
    ]);
}
$this->title = "肝友汇-医圈敏感词列表";
?>

    <div class="form-body">
        <h3 class="form-section">关键词（点击删除）：</h3>
        <div class="form-group has-warning">
            <div class="col-md-10 col-md-offset-1">
                <ul class="list-inline sidebar-tags">
                    <?php
                    foreach($data as $k=>$v){
                        ?>
                        <li>
                            <?php echo \yii\helpers\Html::a("<i class='fa fa-tags'></i>".\yii\helpers\Html::encode($v)."</i>",null, [
                                'data-toggle' => "modal", //定义为模拟框 触发按钮
                                'data-target' => "#delete",//关联模拟框(模拟框的ID)
                                'class' =>'sensitive', //自定义属性(根据模拟框属性xywy_attr 获取此值)
                                'url'=>'http://liver.com/dynamic/sensitive/delete?keyword='.$v,
                            ]);?>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>

        <?php $form = ActiveForm::begin([
            'action' => ['add'],
            'method' => 'post',
            'fieldConfig' => [
                'template' => '<div class="col-lg-3 control-label color666 fontweight">{label}:</div>
                                                    <div class="col-lg-5" style="padding-left: 15px;padding-right: 15px;">{input}</div>
                                                    <div class="col-lg-3">{error}</div>',
                'inputOptions' => ['class' => 'form-control'],
            ],
            'options' => ['class' => 'form-horizontal t-margin20 text-center', 'id' => 'form1', 'enctype' => "multipart/form-data"],
        ]); ?>
                <?= $form->field($model, 'keyword')->textarea(['rows' => 5,'style' => 'width:400px'])->label('关键词添加(自动去重)') ?>

<div class="text-center">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
    </div>
<?php ActiveForm::end(); ?>

<!--删除-->
<?php
Modal::begin([
    'id' => 'delete',
    'header' => '<h4 class="modal-title">删除提醒</h4>',
    'footer' => '<a href="#" id="btn" class="btn btn-primary" >确定</a>',
]);
$js = <<<JS
 $('.sensitive').click(function(){
url=$(this).attr('url');
$('#btn').attr('href',url);
});
JS;
$this->registerJs($js);
echo '您确定要删除该敏感词？';
Modal::end();
?>

<!--
$js = <<<JS
    $('.sensitive').click(function(){
url=$(this).attr('href');
$('#btn').attr('href',url);
});
JS;
$this->registerJs($js);-->