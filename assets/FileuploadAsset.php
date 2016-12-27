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
class FileuploadAsset extends AssetBundle
{
    public $css = [
        'metronic/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
        'metronic/plugins/jquery-file-upload/css/jquery.fileupload.css',
        'metronic/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
    ];
    public $js= [
        "metronic/plugins/fancybox/source/jquery.fancybox.pack.js",
        "metronic/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js",
        "metronic/plugins/jquery-file-upload/js/vendor/tmpl.min.js",
        "metronic/plugins/jquery-file-upload/js/vendor/load-image.min.js",
        "metronic/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js",
        "metronic/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js",
        "metronic/plugins/jquery-file-upload/js/jquery.iframe-transport.js",
        "metronic/plugins/jquery-file-upload/js/jquery.fileupload.js",
        "metronic/plugins/jquery-file-upload/js/jquery.fileupload-process.js",
        "metronic/plugins/jquery-file-upload/js/jquery.fileupload-image.js",
        "metronic/plugins/jquery-file-upload/js/jquery.fileupload-audio.js",
        "metronic/plugins/jquery-file-upload/js/jquery.fileupload-video.js",
        "metronic/plugins/jquery-file-upload/js/jquery.fileupload-validate.js",
        "metronic/plugins/jquery-file-upload/js/jquery.fileupload-ui.js",
        "metronic/plugins/jquery-file-upload/form-fileupload.js",

    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}