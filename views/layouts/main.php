<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\rbac\AuthMenu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?><!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= Yii::$app->language ?>">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <?php $this->head() ?>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
    <!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
    <!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
    <!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
    <!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
    <!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
    <!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
    <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="/">
                        <img src="/metronic/layout/img/logo.png" alt="logo" class="logo-default"/>
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="/metronic/layout/img/avatar3_small.jpg"/>
                                <span class="username username-hide-on-mobile">
                                    <?=\Yii::$app->session->get('_ADMININFO')['userlogin']?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?=\Yii::$app->urlManager->createUrl(['/site/logout'])?>">
                                        <i class="icon-key"></i> 退出 </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="margin-top:25px;">
                        <?php 
                        $authMenu = new AuthMenu();
                        foreach ($authMenu->getMenusAll(1) as $menu): ?>
                            <li class="start ">
                                <a href="javascript:;">
                                    <i class="<?=$menu['icon']?>"></i>
                                    <span class="title"><?= $menu['description'] ?></span>
                                    <span class="arrow "></span>
                                </a>
                                <?php if (!empty($menu['list2'])): ?>
                                    <ul class="sub-menu">
                                        <?php foreach ($menu['list2'] as $submenu): ?>
                                            <li>
                                                <a href="<?=\Yii::$app->urlManager->createUrl([$submenu['name']])?>">
                                                    <i class="<?=$submenu['icon']?>"></i>
                                                    <?=$submenu['description']?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bg-inverse">
                                <div class="portlet-title">
                                    <div class="caption font-green-sharp">
                                        <i class="icon-speech font-green-sharp"></i>
                                        <span class="caption-subject bold uppercase"> <?= $this->title ? Html::encode($this->title) : '$this->title未设置' ?> </span>
                                    </div>
                                    <?php

                                    if(is_array(\app\components\helper\HeaderActionHelper::$action)){?>
                                        <div class="page-toolbar">
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                                                    功能 <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <?php
                                                    $i=0;
                                                    foreach(\app\components\helper\HeaderActionHelper::$action as $k=>$v){?>
                                                        <li>
                                                            <a href="<?=\yii\helpers\Url::to($v['url'])?>"><?=$v['name']?></a>
                                                        </li>
                                                        <?php
                                                        if($i%3==0){
                                                            echo "<li class=\"divider\"></li>";
                                                        }
                                                    }?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="portlet-body form">
                                    <?= $content ?>
                                </div>

                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT-->
                </div>
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">
                2016 &copy; GYHADMIN  BY XYWY.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="/metronic/plugins/respond.min.js"></script>
        <script src="/metronic/plugins/excanvas.min.js"></script>
        <![endif]-->

<script src='/metronic/plugins/jquery.min.js'></script>

<?php $this->endBody();
$jsform="
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
";
$js[]=$jsform;
$this->registerJs(implode("\n",$js));

?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        //Hide the overview when click
        $('#someid').on('click', function () {
            $('#OverviewcollapseButton').removeClass("collapse").addClass("expand");
            $('#PaymentOverview').hide();
        });
        window.alert = function(msg){
            bootbox.alert({
                size: 'small',
                buttons: {
                    ok: {
                        label: '确定',
                    }
                },
                message: msg,
                title: "提醒",
            });
        };
        window.confirm = function(msg, callBack){
            bootbox.confirm({
                size: 'small',
                buttons: {
                    confirm: {label: '确定',},
                    cancel: {label: '取消',}
                },
                message: msg,
                title: "确认",
                callback: function(result){ return result;}
            });
        };
    });

</script>

</body>
</html>
<?php $this->endPage() ?>