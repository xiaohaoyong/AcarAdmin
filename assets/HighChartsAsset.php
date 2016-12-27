<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/27
 * Time: 17:04
 */

namespace app\assets;
use yii\web\AssetBundle;
class HighChartsAsset extends AssetBundle
{

    public $js=[
        'metronic/plugins/highcharts.js',
        'metronic/plugins/exporting.js',
    ];
}