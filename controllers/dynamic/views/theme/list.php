<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\widgets\SearchWidget;
use app\components\widgets\DatePicker;
use \app\models\user;


?>
<!--搜索-->
<?php
/*DatePicker::widget([
    'clientOptions'=>[
        'format'=>'mm/dd/yyyy',
        'startDate'=> '-3d'
    ]
]);*/
?>

<?=
SearchWidget::widget([
    'model' => $searchModel,

]);
?>

<!--数据展示-->
<?php
$this->title = "肝友汇-医圈话题列表";
echo GridView::widget([
    'dataProvider' => $dataProvider,
    // "rowOptions" =>['class'=>'text-center'],
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
        'id',
        'theme',
        'userid',

        [
            // 'class' => 'yii\grid\DataColumn', //默认可省略
            'label' => '创建人',
            'headerOptions' => ['width' => '60', 'class' => 'text-center'],
            'value' => function ($data) {
                $doctor = new user\Doctor();
               $doctors = $doctor->get($data->userid,1);
               return $doctors ? $doctors['nickname'] : '';
            },
        ],

        [
            'label' => '图像',
            'format' => [
                'image',
                [
                    'height' => 30,
                    'width' => 30,
                ]
            ],
            'value' => function ($model) {
                return $model->image;
            }
        ],


        [
            // 'class' => 'yii\grid\DataColumn', // 默认可省略
            'label' => '分类',
            'attribute' => 'name',
            'value' => function ($data) {
                $category='';
                foreach ($data->dcthemecategory as $v) {
                    $category .= $v->name." ";
                }
                return trim($category);
            },
            'headerOptions' => ['width' => '90'],
        ],


        [
            // 'class' => 'yii\grid\DataColumn', // 默认可省略
            'label' => '描述',
            'value' => function ($data) {
                return $data->description;
            },
            'format' => 'raw',
        ],


        [
            'attribute' => 'createtime',
            'label' => '创建时间',
            'value' => function ($model) {
                return date('Y-m-d H:i:s', $model->createtime);
            },
            'headerOptions' => ['width' => '170'],
        ],


        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'headerOptions' => ['width' => '130'],
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'headerOptions' => ['class'=>'text-center'],
            "contentOptions" => ['class' => 'text-center  dropup'],
            'template' => '<a class="btn btn-circle btn-default btn-sm" href="javascript:;" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i> 操作<i class="fa fa-angle-up  fa-gear"></i></a> <ul class="dropdown-menu pull-right" role="menu"><li>{delete}</li><li>{warning}{push}{screen}</ul></li>',

            'buttons' => [
                'delete' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa fa-trash-o"></i>删除', $url,
                        [
                            //  'class' => 'btn btn-default btn-xs', //样式（案例为按钮样式）
                            'data-toggle' => "modal", //定义为模拟框 触发按钮
                            'data-target' => "#delete",//关联模拟框(模拟框的ID)
                            'xywy_id' => $model->id, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                            // 'xywy_name'=>$model->id, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                        ]);
                },
//<span class="glyphicon glyphicon-plus  btn btn-warning btn-sm"></span>
                'warning' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa fa-exclamation-circle"></i>警告', $url,
                        [
                            // 'class' => 'btn btn-default btn-xs', //样式（案例为按钮样式）
                            'data-toggle' => "modal", //定义为模拟框 触发按钮
                            'data-target' => "#warning",//关联模拟框(模拟框的ID)
                            'xywy_id' => $model->id, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                            // 'xywy_name'=>$model->id, //自定义属性(根据模拟框属性xywy_attr 获取此值)
                        ], ['title' => '审核']);
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
    'xywy_attr' => ['id'], //需要进行传输的字段改name值
]);
?>
<?php $form = ActiveForm::begin([
    'action' => ['delete'],
    'method' => 'post',
]); ?>
<?= $form->field($themeForm, 'type')->dropDownList(['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'], ['prompt' => '请选择', 'style' => 'width:120px'])->label('删除理由选取：') ?>
<?= $form->field($themeForm, 'deleteContent')->textarea(['rows' => 3])->label('删除理由：') ?>
<?= "<input type='hidden'    name='id'>" ?>
<?php ActiveForm::end(); ?>
<?php
\app\components\widgets\ModalWidget::end();
?>


<!--警告-->
<?php
\app\components\widgets\ModalWidget::begin([
    'id' => 'warning',//弹出层ID
    'xywy_attr' => ['id'], //需要进行传输的字段改name值
]);
?>
<?php $form = ActiveForm::begin([
    'action' => ['warning'],
    'method' => 'post',
]); ?>
<?= $form->field($themeForm, 'type')->dropDownList(['1' => '广告等垃圾内容', '2' => '不友善内容', '3' => '违反法律法规内容', '4' => '无意义内容', '5' => '其他'], ['prompt' => '请选择', 'style' => 'width:120px'])->label('警告理由选取：') ?>
<?= $form->field($themeForm, 'deleteContent')->textarea(['rows' => 3])->label('警告理由：') ?>
<?= "<input type='hidden'    name='id'>" ?>
<?php ActiveForm::end(); ?>
<?php
\app\components\widgets\ModalWidget::end();
?>



