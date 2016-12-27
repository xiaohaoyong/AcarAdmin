<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/19
 * Time: 16:45
 */
namespace app\assets;
use yii\web\AssetBundle;
class DatePickerAsset extends AssetBundle
{
    public $css=[
        'metronic/plugins/jquery-ui/jquery-ui.min.css',
        'metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'
    ];
    public $js=[
        'metronic/plugins/jquery-ui/jquery-ui.min.js' ,
        'metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        'metronic/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js',

    ];
}