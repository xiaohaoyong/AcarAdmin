<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

//提示框
if(Yii::$app->getSession()->hasFlash('success'))
{
    echo Alert::widget([
        'options' => [
            'class' => 'alert-success', //这里是提示框的class
        ],
        'body' => Yii::$app->getSession()->getFlash('success'), //消息体
    ]);

}
//提示框
if(Yii::$app->getSession()->hasFlash('error')) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-danger',
        ],
        'body' => Yii::$app->getSession()->getFlash('error'),
    ]);
}

$this->title = empty($article->id) ? '资讯添加' : '资讯修改';
?>
<div class="site-article">
    <?php
        $form = ActiveForm::begin([
            'id' => 'article',
            'options' => [
                'class' => 'form-horizontal',
            ],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-3\">\n{hint}\n{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);
    ?>
    <div class="form-group">
        <label class="col-lg-1 control-label">主频道</label>
        <div class="col-lg-8">
            <input class="form-control" readonly value="医学进展">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-1 control-label">子频道</label>
        <div class="col-lg-8">
            <input class="form-control" readonly value="肝胆外科">
        </div>
    </div>
    <?= $form->field($article,'title',['enableAjaxValidation' => true])->textInput(['maxLength' => 50,'placeholder' => '请输入文章标题'])->label('文章标题') ?>
    <?= $form->field($article,'author')->textInput(['maxLength' => 20,'placeholder' => '请输入文章作者'])->label('文章作者') ?>
    <?= $form->field($article,'source')->textInput(['maxLength' => 50,'placeholder' => '请输入文章来源'])->label('文章来源') ?>
    <?php
        if(!empty($article->image))
        {
    ?>
        <div class="form-group">
            <label class="col-lg-1 control-label">文章封面</label>
            <div class="col-lg-8">
                <input class="form-control" readonly value="<?= $article->image ?>">
            </div>
        </div>
    <?php
        }
    ?>
    <?= $form->field($article,'image')->fileInput()->label('封面选择') ?>
    <?= $form->field($article,'style')->radioList($article->styleData)->label('文章类别') ?>
    <div class="form-group">
        <label class="col-lg-1 control-label">链接选取</label>
        <div class="col-lg-8">
            <input class="form-control" readonly value="普通模板">
        </div>
    </div>
    <?= Html::activeHiddenInput($article,'model',['value' => 0]) ?>
    <?= $form->field($article,'vector')->textarea(['rows' => 5,'maxLength' => 500])->label('文章导读') ?>
    <?= $form->field($article,'content')->widget('pjkui\kindeditor\KindEditor',[])->label('文章内容')//需要更改为编辑器 ?>
    <?= Html::activeHiddenInput($article,'catpid',['value' => 1]) ?>
    <?= Html::activeHiddenInput($article,'catid',['value' => 57]) ?>
    <?= Html::activeHiddenInput($article,'id') ?>
    <?= Html::activeHiddenInput($article,'level',['value' => -1]) ?>
    <?= $form->field($tag,'name')->textInput(['maxLength' => 15])->label('标签') ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('保存', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
            <?= Html::a(Html::button('取消', ['class'=>'btn btn-primary','name' =>'cancle-button']),['list']) ?>
        </div>
    </div>

<?php
$form = ActiveForm::end();
?>
</div>