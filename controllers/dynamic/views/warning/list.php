<?php
use yii\grid\GridView;
use yii\bootstrap\Alert;
$this->title = "肝友汇-用户警告列表";
// 获取当前请求页的每一行数据
//$rows = $provider->getModels();
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
<?php
echo \app\components\widgets\SearchWidget::widget([
    'model' => $model,
]);
$totalCount = $provider->getTotalCount();
echo GridView::widget([
    // 'layout' =>'{items}<div class="text-right tooltip-demo">{pager}</div>',
    'pager' => [
        //'options'=>['class'=>'hidden']//关闭分页
        'firstPageLabel' => "第一页",
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
        'lastPageLabel' => '最后一页',
    ],
    'dataProvider' => $provider,
    "rowOptions" =>['class'=>'text-center'],
    'columns' => [
        [
            'label' => '用户名',
            'value' =>'username',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '用户iD',
            'value' =>'userId',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '警告次数',
            'value' =>'warningNum',
            'headerOptions' => ['class' => 'text-center']
        ],
       /* [
            'label' => '禁言时间',
            'value' =>'stopSays',
            'headerOptions' => ['class' => 'text-center']
        ],*/
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'headerOptions' => ['class' => 'text-center'],
            "contentOptions" => ['class' => 'text-center  dropup'],
            'template' => '<a class="btn btn-circle btn-default btn-sm" href="javascript:" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i> 操作<i class="fa fa-angle-up  fa-gear"></i></a> <ul class="dropdown-menu pull-right" role="menu"><li>{reset}</li>',
            'buttons' => [
                'reset' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa fa-eye-slash"></i> 清除警告次数',['reset','userid'=>$model['userId'],'click'=>$model['warningNum']],
                        [
                            'data' => ['confirm' => '你确定要清除该用户的警告次数吗？',],
                        ]);
                },
                'clearance' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa  fa-history"></i> 清除警告时间',['clearance','userid'=>$model['userId']],
                        [
                            'data' => ['confirm' => '你确定要清除该用户的禁言时间吗？',],
                        ]);
                },
            ],
        ],

    ],
]);
?>