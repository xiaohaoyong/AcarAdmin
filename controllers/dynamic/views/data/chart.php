<?php
$this->title = "肝友汇-医圈用户数据曲线图";
$this->title = "肝友汇-医圈病例研讨班病例列表";
\app\components\helper\HeaderActionHelper::$action=[
    ['url'=>['click'],'name'=>"用户时间段点击量次数曲线图"],
    ['url'=>['release'],'name'=>"时间段发表动态数据曲线图"],
    ['url'=>['charts'],'name'=>"线下数据统计图"],

];
?>
<?php
echo \app\components\widgets\HighChartsWidgets::widget([
    'id'=>'Chart',
    'clientOptions'=>[
        "title"=> [
            "text"=> '肝友汇医圈线上数据曲线图',
            "x"=> -20 //center
        ],
        "subtitle"=> [
            "text"=> '统计条数',
            "x"=> -20
        ],
        "xAxis"=> [
            "categories"=>$data['date'],
        ],
        "yAxis"=> [
            "title"=> [
                "text"=> '寻医问药'
            ],
            "plotLines"=> [[
                "value"=> 0,
                "width"=> 1,
                "color"=> '#808080'
            ]]
        ],
        "tooltip"=> [
            "valueSuffix"=> '条'
        ],
        "legend"=> [
            "layout"=> 'vertical',
            "align"=> 'right',
            "verticalAlign"=> 'middle',
            "borderWidth"=> 0
        ],
        "series"=> [
            [
            "name"=> '全部动态',
            "data"=>$data['all'],
         ],
            [
                "name"=> '分享动态',
                "data"=>$data['share'],
            ],
            [
                "name"=> '线上动态',
                "data"=>$data['line'],
            ],
            [
                "name"=> '实名动态',
                "data"=>$data['real'],
            ],
            [
                "name"=> '匿名动态',
                "data"=>$data['anonymous'],
            ],

        ]
    ],
]);
?>
<div id="Chart">
</div>