<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL ^ E_NOTICE);
$ACARSRVCONFIG = parse_ini_file(__DIR__.'/../system/XYWYSRV_CONFIG');

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

define('ACAR_IMGURL','http://img.acar.xuexiq.com/');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
