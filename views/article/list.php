<?php
use yii\helpers\Html;
use app\components\widgets\SearchWidget;
use yii\grid\GridView;
use yii\bootstrap\Alert;
use app\components\widgets\DatePicker;
use app\components\helper\HeaderActionHelper;

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

$this->title = '资讯列表';

// actions
HeaderActionHelper::$action = [
    ['url' => 'add', 'name' => '资讯添加']
];
?>
<!-- 搜索项 -->
<?=
SearchWidget::widget([
    'model'=>$searchModel,
    'attribute'=>[
        ['id',['textInput' => ['placeholder' => '请输入资讯ID']]],
        ['start',['widget' => [DatePicker::className(),['options'=>['placeholder' => '开始时间']]]]],
        ['end',['widget' => [DatePicker::className(),['options'=>['placeholder' => '结束时间']]]]],
    ]
]);
?>
<!-- 列表配置 -->
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'layout'=>'{pager}',
    'pager' => [
        'firstPageLabel'=>"首页",
        'prevPageLabel'=>'上一页',
        'nextPageLabel'=>'下一页',
        'lastPageLabel'=>'末页',
    ],
    'columns' => [
        [
            'label' => 'id',
            'attribute' => 'id'
        ],
        [
            'label' => '标题',
            'attribute' => 'title'
        ],
        [
            'label' => '频道',
            'attribute' => 'catid',
            'headerOptions' => ['width' => '75'],
            'value' => function (){
                return "肝胆外科";
            }
        ],
        [
            'label' => '类别',
            'attribute' => 'style',
            'headerOptions' => ['width' => '50'],
            'value' => function($data){
                return $data->styleData[$data->style];
            }
        ],
        [
            'label' => '来源',
            'attribute' => 'source',
        ],
        [
            'label' => '标签',
            'attribute' => 'name',
            'value' => function($data){
                $tag = "";
                foreach ($data->tag as $key => $val){
                    $tag .= $val->name." ";
                }
                return trim($tag);
            }
        ],
        [
            'label' =>'发布时间',
            'attribute' => 'createtime',
            'format' => ['date','php:Y-m-d'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{manage} {update} {delete}',// {top}、只需要展示删除和更新
            'headerOptions' => ['width' => '200'],
            'buttons' => [
                'manage' => function($url, $model, $key){
                    if($model->level != 1)
                    {
                        return Html::a('<i class="icon-plus"></i> 发布',
                            ['publish', 'id' => $key],
                            [
                                'class' => 'btn btn-default btn-xs',
                                'data' => ['confirm' => '您确定要显示标题为【'.$model->title.'】的文章么？显示后将在前台可见！']
                            ]
                        );
                    }else{
                        return Html::a('<i class="icon-ban"></i> 隐藏',
                            ['hidden', 'id' => $key],
                            [
                                'class' => 'btn btn-default btn-xs',
                                'data' => ['confirm' => '您确定要隐藏标题为【'.$model->title.'】的文章么？隐藏后将在前台不可见！']
                            ]
                        );
                    }
                },
                'update' => function($url, $model, $key){
                    return Html::a('<i class="icon-pencil"></i> 编辑',
                        ['edit', 'id' => $key],
                        [
                            'class' => 'btn btn-default btn-xs',
                            'data' => []
                        ]
                    );
                },
                'delete' => function($url, $model, $key){
                    return Html::a('<i class="icon-trash"></i> 删除',
                        ['delete', 'id' => $key],
                        [
                            'class' => 'btn btn-default btn-xs',
                            'data' => ['confirm' => '你确定要删除文章吗？',]
                        ]
                    );
                },
            ],
        ]
    ]
]);
?>