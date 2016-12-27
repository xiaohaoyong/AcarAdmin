<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\rbac\AuthAdminuser;
use yii\bootstrap\Modal;
use yii\helpers\HtmlPurifier;
?>

<?php

$this->title = "轮播图列表";
\app\components\helper\HeaderActionHelper::$action = [
    ['url' => ['banner/index'], 'name' => "轮播图列表"],
    ['url' => ['banner/add'], 'name' => "添加轮播图"],
];

echo GridView::widget(['dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'id',
            'headerOptions' => [
                'width' => 60,
            ],
        ],
        [
            'class' => 'yii\grid\DataColumn', // 默认可省略
            'attribute' => 'imgurl',
            'label' => '图片',
            'format' => ['image', ['width' => 80]],
            'value' => function($data) {
        return $data->imgurl;
    },
        ],
        [
            'class' => 'yii\grid\DataColumn', // 默认可省略
            'attribute' => 'url',
            'label' => '调整链接',
            'value' => function($data) {
                return substr($data->url, 0, 80);
            },
            'headerOptions' => [
                'width' => 80,
            ],
        ],
        'title',
        'orderby',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'headerOptions' => [
                'width' => '100',
            ],
            'template' => '{update} {delete}',
        ],
    ]
]);
?>