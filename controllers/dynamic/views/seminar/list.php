<?php
use yii\grid\GridView;
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
$this->title = "肝友汇-医圈病例研讨班病例列表";
\app\components\helper\HeaderActionHelper::$action=[
    ['url'=>['seminar/add'],'name'=>"添加病例"],
];


echo \app\components\widgets\SearchWidget::widget([
    'model' => $searchModel,
]);


echo GridView::widget([
    'dataProvider' => $data,
     "rowOptions" =>['class'=>'text-center'],
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
            'label' => '期号',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
               $seminar=$data->dcdynamicseminar;
                return $seminar['phase'];
            },
        ],
        [
            'label' => '名称',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $seminar=$data->dcdynamicseminar;
                return $seminar['title'];
            },
            'format' => 'raw',
        ],
        [
            'label' => '公众号',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $seminar=$data->subscription;
                return $seminar['name'];
            },
        ],
        [
            'label' => '状态',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $seminar=$data->dcdynamicseminar;
                switch($seminar['state'])
                {
                    case 1:
                        $color='label-info';
                        $span='未发布';
                        break;
                    case 2:
                        $color='label-success';
                        $span='发布成功';
                        break;
                    case 0:
                        $color='label-warning';
                        $span='发布中..';
                        break;
                    case -1:
                        $color='label-danger';
                        $span='发布失败';
                        break;
                }
                return '<span class="label '.$color.'">'.$span.'</span>';
            },
            'format' => 'raw',
        ],
        [
            'label' => '是否结束',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $seminar=$data->dcdynamicseminar;
                return $seminar['end_state']==1?'是':'否';
            },
        ],
        [
            'label' => '添加时间',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                return date('Y-m-d H:i:s', $data->createtime);
            },
        ],



        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'headerOptions' => ['class' => 'text-center'],
            "contentOptions" => ['class' => 'text-center  dropup'],
            'template' => '<a class="btn btn-circle btn-default btn-sm" href="javascript:" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i> 操作<i class="fa fa-angle-up  fa-gear"></i></a> <ul class="dropdown-menu pull-right" role="menu"><li>{answer}{edit}{delete}{publish}{image-upload}{release}</li></ul></li>',

            'buttons' => [
                'answer' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="icon-list"></i> 回答列表',['answer','id'=>$key]);
                },
                'edit' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa fa-edit"></i> 编辑',['edit','id'=>$key]);
                },
                'delete' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="icon-close"></i> 删除',['delete','id'=>$key],
                        [
                            'data' => ['confirm' => '你确定要删除此条数据吗？',],
                        ]);
                },
                'publish' => function ($url, $model, $key) {
                    $seminar=$model->dcdynamicseminar;
                    return  $seminar['state']==2?'':\yii\helpers\Html::a('<i class="fa fa-mail-reply-all"></i> 发布动态',['publish','id'=>$key],
                        [
                            'data' => ['confirm' => '你确定要发布动态吗？',],
                        ]);
                },
                'release' => function ($url, $model, $key) {
                    $seminar=$model->dcdynamicseminar;
                    return $seminar['end_state']==1?'': \yii\helpers\Html::a('<i class="fa fa-check-circle"></i> 发布答案',['release','id'=>$key],
                        [
                            'data' => ['confirm' => '你确定要发布答案吗？',],
                        ]);
                },
                'image-upload' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa fa-file-image-o"></i> 上传图片',['image-upload','id'=>$key],
                        [
                          //  'data' => ['confirm' => '你确定要发布答案吗？',],
                        ]);
                },


            ],

        ],
    ],

]);

?>











