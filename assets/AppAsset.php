<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'metronic/plugins/font-awesome/css/font-awesome.min.css'                  ,
        'metronic/plugins/simple-line-icons/simple-line-icons.min.css'            ,
        'metronic/css/components.css'                                             ,

        'metronic/plugins/bootstrap/css/bootstrap.min.css'                        ,
        'metronic/plugins/uniform/css/uniform.default.css'                        ,
        'metronic/plugins/bootstrap-switch/css/bootstrap-switch.min.css'          ,
        'metronic/css/plugins.css'                                                ,
        'metronic/layout/css/layout.css'                                          ,
        'metronic/layout/css/themes/darkblue.css'                                 ,
        'metronic/layout/css/custom.css'                                          ,
    ];
    public $js = [
        'metronic/plugins/jquery-migrate.min.js',
        'metronic/plugins/jquery-ui/jquery-ui.min.js'                                                 ,
        'metronic/plugins/bootstrap/js/bootstrap.js'                                              ,
        'metronic/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'                   ,
        'metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js'                                 ,
        'metronic/plugins/jquery.blockui.min.js'                                                      ,
        'metronic/plugins/jquery.cokie.min.js'                                                        ,
        'metronic/plugins/uniform/jquery.uniform.min.js'                                              ,
        'metronic/plugins/bootstrap-switch/js/bootstrap-switch.min.js'                                ,
        'metronic/plugins/bootbox/bootbox.min.js',
        'metronic/layout/scripts/metronic.js',
        'metronic/layout/scripts/layout.js',
        'metronic/layout/scripts/quick-sidebar.js',
        'metronic/layout/scripts/demo.js',
    ];
    public $depends = [
    ];
}
