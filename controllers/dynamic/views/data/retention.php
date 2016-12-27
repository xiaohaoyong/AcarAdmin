<?php
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
$this->title = "肝友汇-用户留存率表";
$provider = new ArrayDataProvider([
    'allModels' => $data,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
// 获取当前请求页的每一行数据
//$rows = $provider->getModels();
?>

<?php
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
            'label' => '时间',
            'value' =>'date',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '新增用户',
            'value' =>'new',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '1天后',
            'value' =>'one',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '2天后',
            'value' =>'two',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '3天后',
            'value' =>'three',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '3天后',
            'value' =>'three',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '4天后',
            'value' =>'four',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '6天后',
            'value' =>'five',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '7天后',
            'value' =>'six',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '15天后',
            'value' =>'seven',
            'headerOptions' => ['class' => 'text-center']
        ],
        [
            'label' => '30天后',
            'value' =>'six',
            'headerOptions' => ['class' => 'text-center']
        ],

        // 更复杂的列数据
       /* [
            'label' => 'ID',
            'headerOptions' => ['class' => 'text-center'],
            'value' => function ($data) {
                $url = 'http://yimai.api.xywy.com/app/1.2/index.interface.php?m=dynamic_row_h5&a=dynamic&dynamicid=' . $data->id;
                return \yii\helpers\Html::a($data->id, $url, '');
            },
        ],*/
    ],
]);
?>