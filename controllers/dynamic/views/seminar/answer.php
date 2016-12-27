<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\dynamic;
use \app\models\club;
use \app\models\dynamic\DcComment;
use \app\models\user;
use app\components\widgets\SearchWidget;
use app\components\widgets\DatePicker;
use app\models\dynamic\Seminar;
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

<!--数据展示-->
<?php
$this->title = "肝友汇-医圈病例研讨班回答列表";
\app\components\helper\HeaderActionHelper::$action=[
    ['url'=>['list'],'name'=>"病例列表"],


];
echo GridView::widget([
    'dataProvider' => $data,
    "rowOptions" => ['class' => 'text-center'],
    // 'filterModel' =>$searchModel,
    'layout' => '{items}<div class="text-right tooltip-demo">{pager}</div>',
    'pager' => [
        //'options'=>['class'=>'hidden']//关闭分页
        'firstPageLabel' => "第一页",
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
        'lastPageLabel' => '最后一页',
    ],
    'columns' => [
        [
            'label' => '内容',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                DcComment::$commentId = $data->id;
                $content = dynamic\DcComment::find()->select(['content'])->where(['commentid' => $data->id])->asArray()->one();
                return $content['content'];
            },
            'format' => 'raw',
        ],
        [
            'label' => '用户ID',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                return $data->userid;
            },
        ],
        [
            'label' => '回答人',
            'value' => function ($data) {
                $doctor = new user\Doctor();
                $doctors = $doctor->get($data->userid, 1);
                return $doctors ? $doctors['nickname']: '';
            },
            'headerOptions' => ['width' => '100', 'class' => 'text-center']
        ],
        [
            'label' => '是否正确',
            'headerOptions' => ['width' => '100', 'class' => 'text-center'],
            'format' => 'raw',
            'value' => function ($data) {
                switch ($data->level) {
                    case 2:
                        $color = 'badge-success';
                        $span = 'glyphicon glyphicon-ok';
                        break;
                    case 0:
                        $color = 'badge-info';
                        $span = 'icon-question';
                        break;
                    case -1:
                        $color = 'badge-danger';
                        $span = 'icon-close';
                        break;
                }
                return '<i class="' . $span . '"></i>';

            },
        ],
        [
            'label' => '回答时间',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                return date('Y-m-d H:i:s', $data->createtime);
            },
        ],
       [
            'label' => '楼层',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                DcComment::$commentId = 0;
                $floor = DcComment::find()->andWhere(['dynamicid' => $data->dynamicid])->andWhere(['<', 'id', $data->id])->andWhere(['>', 'level',-1])->count('id');
                return $data->level>-1?($floor+1):'';
            },
        ],
        /*
    [
        'label' => '排名',
        'headerOptions' => ['class' => 'text-center'],
        'value' => function ($data) {
            $model = new Seminar();
            $t=$model->ranking($data->dynamicid, 1, $data->userid);
            return $t;
        },
    ],*/

       /* [
            'label' => '积分',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $model = new Seminar();
              $t=$model->ranking($data->dynamicid, 2, $data->userid);
              return $t;
            },
        ],*/

      /*  [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'headerOptions' => ['class' => 'text-center'],
            "contentOptions" => ['class' => 'text-center  dropup'],
            'template' => '<span class="btn btn-success">{right}</span> ',
            'buttons' => [
                'right' => function ($url, $model, $key) {
                    $seminar = new Seminar();
                    $ranking = $seminar->ranking($model->dynamicid, 1, $model->userid);
                    $integral = $seminar->ranking($model->dynamicid, 2, $model->userid);
                    return \yii\helpers\Html::a('正确答案', null,
                        [
                            //  'class' => 'btn btn-default btn-xs', //样式（案例为按钮样式）
                            'data' => ['confirm' => '你确定要该用户回答正确吗？',],
                            'data-toggle' => "modal", //定义为模拟框 触发按钮
                            //'data-target' => "#right",//关联模拟框(模拟框的ID)
                            'xywy_dynamicid' => $model->dynamicid,
                            'xywy_commentid' => $model->id,
                            'xywy_userid' => $model->userid,
                            'xywy_type' => $model->type,
                            'xywy_deleteTop' => $ranking,
                            'class' => 'model',
                            'ranking' =>$ranking,
                            'integral' => $integral,
                        ]);
                },

            ],

        ],*/
    ],

]);

?>


<?php
\app\components\widgets\ModalWidget::begin([
    'id' => 'right',//弹出层ID
    'xywy_attr' => ['commentid', 'userid', 'type', 'dynamicid','deleteTop'], //需要进行传输的字段改name值
]);
?>
<?php $form = ActiveForm::begin([
    'action' => ['right'],
    'method' => 'post',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => '<div class="col-lg-3 control-label color666 fontweight">{label}:</div>
                                                    <div class="col-lg-5" style="padding-left: 15px;padding-right: 15px;">{input}</div>
                                                    <div class="col-lg-3">{error}</div>',
        'inputOptions' => ['class' => 'form-control'],
    ],
]); ?>
<?= $form->field($model, 'ranking')->textInput(['style' => 'width:200px'])->label('排名') ?>
<?= $form->field($model, 'integral')->textInput(['style' => 'width:200px'])->label('奖励积分数') ?>

<?php ActiveForm::end(); ?>
<?php
\app\components\widgets\ModalWidget::end();
?>

<?php
/*$this->registerJs("
 $('.model').on('click',function(event){
          var ranking=$(this).attr('ranking');
          var integral=$(this).attr('integral');
          $('#seminar-ranking').val(ranking)
          $('#seminar-integral').val(integral)
        });
", \yii\web\View::POS_END);
*/?>






