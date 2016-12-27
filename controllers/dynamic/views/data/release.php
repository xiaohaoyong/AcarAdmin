<?php
$this->title = "肝友汇-医圈用户发布动态曲线图";
\app\components\helper\HeaderActionHelper::$action=[
    ['url'=>['click'],'name'=>"用户时间段点击量次数曲线图"],
    ['url'=>['charts'],'name'=>"线下数据统计图"],
    ['url'=>['chart'],'name'=>"线上数据统计图"],


];
?>

<?=
\app\components\widgets\SearchWidget::widget([
    'model' => $searchModel,
]);
?>
<?php
echo \app\components\widgets\HighChartsWidgets::widget([
    'id'=>'Click',
    'clientOptions'=>[
        "title"=> [
            "text"=> '肝友汇医圈时间段发表动态数据曲线图',
            "x"=> -20 //center
        ],
        "subtitle"=> [
            "text"=> '发布条数',
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
            "align"=> 'left',
            "verticalAlign"=> 'middle',
            "borderWidth"=> 0
        ],
        "series"=> [
            [
                "name"=> '0点',
                "data"=>$data['one'],
            ],
            [
                "name"=> '1点',
                "data"=>$data['two'],
            ],
            [
                "name"=> '2点',
                "data"=>$data['three'],
            ],
            [
                "name"=> '3点',
                "data"=>$data['four'],
            ],
            [
                "name"=> '4点',
                "data"=>$data['five'],
            ],
            [
                "name"=> '5点',
                "data"=>$data['six'],
            ],
            [
                "name"=> '6点',
                "data"=>$data['seven'],
            ],
            [
                "name"=> '7点',
                "data"=>$data['eight'],
            ],
            [
                "name"=> '8点',
                "data"=>$data['nine'],
            ],
            [
                "name"=> '9点',
                "data"=>$data['ten'],
            ],
            [
                "name"=> '10点',
                "data"=>$data['eleven'],
            ],
            [
                "name"=> '11点',
                "data"=>$data['twelve'],
            ],
            [
                "name"=> '12点',
                "data"=>$data['thirteen'],
            ],
            [
                "name"=> '13点',
                "data"=>$data['fourteen'],
            ],
            [
                "name"=> '14点',
                "data"=>$data['fiveteen'],
            ],
            [
                "name"=> '15点',
                "data"=>$data['sixteen'],
            ],
            [
                "name"=> '16点',
                "data"=>$data['seventeen'],
            ],
            [
                "name"=> '17点',
                "data"=>$data['eighteen'],
            ],
            [
                "name"=> '18点',
                "data"=>$data['nineteen'],
            ],
            [
                "name"=> '19点',
                "data"=>$data['twenty'],
            ],
            [
                "name"=> '20点',
                "data"=>$data['twenty-one'],
            ],
            [
                "name"=> '21点',
                "data"=>$data['twenty-two'],
            ],
        ]
    ],
]);
?>
<div id="Click">
</div>