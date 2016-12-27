<?php
$this->title = "肝友汇-医圈用户数据曲线图";
\app\components\helper\HeaderActionHelper::$action=[
    ['url'=>['click'],'name'=>"用户时间段点击量次数曲线图"],
    ['url'=>['chart'],'name'=>"线上数据统计图"],

];
?>
<?php
echo \app\components\widgets\HighChartsWidgets::widget([
    'id'=>'Chart',
    'clientOptions'=>[
        "title"=> [
            "text"=> '肝友汇医圈线下数据曲线图',
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
                "name"=> '敏感词屏蔽动态',
                "data"=>$data['sensitive'],
            ],
            [
                "name"=> '用户删除动态',
                "data"=>$data['user'],
            ],
            [
                "name"=> '后台删除动态',
                "data"=>$data['admin'],
            ],
            [
                "name"=> '后台屏蔽动态',
                "data"=>$data['hide'],
            ],
        ]
    ],
]);
?>
<div id="Chart">
</div>