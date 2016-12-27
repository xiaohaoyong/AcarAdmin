<!DOCTYPE html>
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
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>肝友汇app医生端管理平台</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/metronic/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/metronic/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/metronic/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/metronic/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/metronic/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="/metronic/layout/css/login-soft.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="/metronic/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="/metronic/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/metronic/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="/metronic/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
    <link href="/metronic/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="index.html">
        <img src="/metronic/layout/img/logo-big.png" alt=""/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="<?=\Yii::$app->urlManager->createUrl(['site/login'])?>" method="post">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <h3 class="form-title">请输入您的管理账号</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
			<span>请输入用户名和密码</span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">用户名:</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="用户名" name="userlogin"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">密码</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="密码" name="password"/>
            </div>
        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"/> 记住我 </label>
            <button type="submit" class="btn blue pull-right">
                登录 <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2016 &copy; GYHADMIN  BY XYWY.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/metronic/plugins/respond.min.js"></script>
<script src="/metronic/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/metronic/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/metronic/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/metronic/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/metronic/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/metronic/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/metronic/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/metronic/plugins/jquery-validation/js/localization/messages_zh.min.js" type="text/javascript"></script>

<script src="/metronic/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script src="/metronic/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/metronic/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/metronic/layout/scripts/metronic.js" type="text/javascript"></script>
<script src="/metronic/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/metronic/layout/scripts/demo.js" type="text/javascript"></script>
<script src="/metronic/layout/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
        // init background slide images
        $.backstretch([
                "/metronic/images/1.jpg",
                "/metronic/images/2.jpg",
                "/metronic/images/3.jpg",
                "/metronic/images/4.jpg"
            ], {
                fade: 1000,
                duration: 8000
            }
        );
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>