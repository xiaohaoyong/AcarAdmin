<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\dynamic;
use \app\models\user;
use app\components\widgets\SearchWidget;
use app\components\widgets\DatePicker;
use yii\bootstrap\Alert;

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
?>


<!--搜索-->
<?php
/*DatePicker::widget([
'model'=>$searchModel,
    //'attribute'=>'createtime',
    'template'=>'{start}{end}',
    ['start','textInput',[]],
    ['end','textInput',[]],
    'clientOptions'=>[
        'format'=>'mm/dd/yyyy',
        'startDate'=> '-3d'
    ],
]);
*/ ?>

<?=
SearchWidget::widget([
    'model' => $searchModel,
]);
?>

<!--数据展示-->
<?php
$this->title = "肝友汇-医圈评论列表";
echo GridView::widget([
    'dataProvider' => $dataProvider,
    // "rowOptions" =>['class'=>'text-center'],
    // 'filterModel' =>$searchModel,

    // 'layout' => '{items}<div class="text-right tooltip-demo">{pager}</div>',

    'pager' => [
        //'options'=>['class'=>'hidden']//关闭分页
        'firstPageLabel' => "第一页",
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
        'lastPageLabel' => '最后一页',
    ],


    'columns' => [
        [
            'class' => 'yii\grid\DataColumn', // 默认可省略
            'label' => 'ID',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $url = 'http://test.api.liver.xywy.com/app/1.2/index.interface.php?m=dynamic_row_h5&a=dynamic&dynamicid=' . $data->id;
                return \yii\helpers\Html::a($data->id, $url, '');
            },
            'format' => 'raw',
        ],


        [
            // 'attribute' =>'type',
            'label' => '实(匿)名',
            'value' => function ($data) {
                $doctor = new user\Doctor();
                $doctors = $doctor->get($data->userid, 1);
                if ($data->type == 1) {
                    return $doctors ? $doctors['nickname'] : '';
                } else {
                    $anonymous = $doctor->get($data->userid, $data->type);
                    return $doctors['nickname'] . "(" . $anonymous['nickname'] . ")";
                }
            },
            'headerOptions' => ['width' => '120', 'class' => 'text-center']
        ],


        [
            'label' => '用户名',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $username = \app\models\club\UserNew::find()->select(['username'])->where(['id' => $data->userid])->asArray()->one();
                return $username['username'];
            },
        ],
        'userid',
        [
            // 'class' => 'yii\grid\DataColumn', // 默认可省略
            'label' => '评论',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                dynamic\DcComment::$commentId = $data->id;
                $content = dynamic\DcComment::find()->select(['content'])->where(['commentid' => $data->id])->asArray()->one();
                return  yii\helpers\HtmlPurifier::process($content['content']);
            },
            'format' => 'raw',
        ],

        [
            'label' => '警',
            'value' => function ($data) {
                $redis = Yii::$app->rdmp;
                $click = $redis->ZSCORE('club:mp:warning:' . $data['userid'], $data['userid']);
                return  $click?$click:0;
            },
        ],

        [
            'attribute' => 'createtime',
            'headerOptions' => ['class' => 'text-center'],
            'visible'=>in_array($data['CommentSearch']['level'],[2,3,5]),
            'label' => '删除',
            'value' => function ($model) {
                $redis = Yii::$app->rdmp;
                $manage = $redis->hget('dc:comment:manage', $model->id);
                $manages = explode('-|-', $manage);
                return $manages[0] == 1 ? $manages[1] : '';
            },
        ],

        [
            'attribute' => 'createtime',
            'headerOptions' => ['class' => 'text-center'],
            'visible'=>in_array($data['CommentSearch']['level'],[2,3,5]),
            'label' => '警告',
            'value' => function ($model) {
                $redis = Yii::$app->rdmp;
                $manage = $redis->hget('dc:comment:manage', $model->id);
                $manages = explode('-|-', $manage);
                return $manages[0] ==2 ? $manages[1] : '';
            },
        ],

        [
            'attribute' => 'createtime',
            'headerOptions' => ['class' => 'text-center'],
            'label' => '更新时间',
            'value' => function ($model) {
                return date('Y-m-d H:i:s', $model->createtime);
            },
        ],


        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'headerOptions' => ['class' => 'text-center'],
            "contentOptions" => ['class' => 'text-center  dropup'],
            'template' =>in_array($data['CommentSearch']['level'],[2,3,4])?'{recovery}': '<a class="btn btn-circle btn-default btn-sm" href="javascript:" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i> 操作<i class="fa fa-angle-up  fa-gear"></i></a> <ul class="dropdown-menu pull-right" role="menu"><li>{delete}</li><li>{recovery}{warning}{push}{screen}</ul></li>',
            'buttons' => [
                'recovery'=> function ($url, $model, $key) {
                    switch($model['level'])
                    {
                        case -1:
                            $color='label-success';
                            $span='用户删除';
                            break;
                        case -2:
                            $color='label-warning';
                            $span='管理员删除';
                            break;
                    }
                    return Html::a('<span class="label '.$color.'">'.$span.'</span>',['recovery','id'=>$key],
                        [
                            'data' => ['confirm' => '你确定要恢复此条评论吗？',],
                            'data-toggle' => "modal", //定义为模拟框 触发按钮
                            'visible' => false,
                            'xywy_id' => $model->id, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                        ]);
                },
                'delete' => function ($url, $model, $key) {
                    return $model->level>-1? \yii\helpers\Html::a('<i class="fa fa-trash-o"></i>删除', null,
                        [
                            //  'class' => 'btn btn-default btn-xs', //样式（案例为按钮样式）
                            'data-toggle' => "modal", //定义为模拟框 触发按钮
                            'data-target' => "#delete",//关联模拟框(模拟框的ID)
                            'xywy_id' => $model->id, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                            'xywy_userid' => $model->userid, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                            'xywy_type' => $model->type, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                        ], ['title' => '审核']):'';
                },
//<span class="glyphicon glyphicon-plus  btn btn-warning btn-sm"></span>
                'warning' => function ($url, $model, $key) {
                    $redis = Yii::$app->rdmp;
                    $click = $redis->ZSCORE('club:mp:warning:' . $model->userid, $model->userid);
                    return  $model->level>-1? \yii\helpers\Html::a('<i class="fa fa-exclamation-circle"></i>警告', null,
                        [
                            // 'class' => 'btn btn-default btn-xs', //样式（案例为按钮样式）
                            'data-toggle' => $click > 2 ? '' : "modal", //定义为模拟框 触发按钮
                            'data' => $click > 2 ? ['confirm' => '当前用户已被警告3次，请清除警告后再进行此操作',] : '',
                            'data-target' => "#warning",//关联模拟框(模拟框的ID)
                            'xywy_id' => $model->id, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                            'xywy_userid' => $model->userid,
                            'xywy_type' => $model->type,
                        ], ['title' => '审核']):'';
                },
            ],

        ],
    ],

]);

?>




<!--删除-->
<?php
\app\components\widgets\ModalWidget::begin([
    'id' => 'delete',//弹出层ID
    'xywy_attr' => ['id','type','userid'], //需要进行传输的字段改name值

]);
?>
<?php $form = ActiveForm::begin([
    'action' => ['delete'],
    'method' => 'post',
]); ?>
<?= $form->field($commentForm, 'delInfo')->dropDownList(['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'], ['prompt' => '请选择', 'style' => 'width:170px'])->label('删除理由选取：') ?>
<?= $form->field($commentForm, 'delete')->textarea(['rows' => 3, 'readonly' => 'readonly'])->label('删除理由：') ?>
<input type="hidden" name="id">
<input type="hidden" name="userid">
<input type="hidden" name="type">
<?php ActiveForm::end(); ?>
<?php
\app\components\widgets\ModalWidget::end();
?>


<!--警告-->
<?php
\app\components\widgets\ModalWidget::begin([
    'id' => 'warning',//弹出层ID
    'xywy_attr' => ['id','type','userid'], //需要进行传输的字段改name值

]);
?>
<?php $form = ActiveForm::begin([
    'action' => ['warning'],
    'method' => 'post',
]); ?>
<?= $form->field($commentForm, 'warInfo')->dropDownList(['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'], ['prompt' => '请选择', 'style' => 'width:150px'])->label('警告理由选取：') ?>
<?/*= $form->field($commentForm, 'warningNum')->dropDownList(['0' => '警告一次', '1' => '禁言一天，警告一次', '3' => '禁言三天，警告一次', '7' => '禁言七天，警告一次'], ['prompt' => '请选择', 'style' => 'width:200px'])->label('警告类型：') */?>
<?= $form->field($commentForm, 'warning')->textarea(['rows' => 2, 'readonly' => 'readonly'])->label('警告理由：') ?>
<input type="hidden" name="id">
<input type="hidden" name="userid">
<input type="hidden" name="type">
<?php ActiveForm::end(); ?>
<?php
\app\components\widgets\ModalWidget::end();
?>


<!--搜索选项框-->
<?php
$this->registerJs("
$('#dynamicsearch-style').change(function(){
var style=$(this).val();
if(style==1){
$('#dynamicsearch-level').hide();
$('#dynamicsearch-type').hide();
}else{
$('#dynamicsearch-level').show();
$('#dynamicsearch-type').show();
}
});
  $('#commentform-delinfo').change(function () {
       var val=$(this).val();
            if (val == 5) {
                $('#commentform-delete').removeAttr('readonly');
            } else {
                $('#commentform-delete').attr('readonly', 'readonly');
                $('#commentform-delete').val('');
            }
        })
   $('#commentform-warinfo').change(function () {
       var val=$(this).val();
            if (val == 5) {
                $('#commentform-warning').removeAttr('readonly');
            } else {
                $('#commentform-warning').attr('readonly', 'readonly');
                $('#commentform-warning').val('');
            }
        })
", \yii\web\View::POS_END);
?>




