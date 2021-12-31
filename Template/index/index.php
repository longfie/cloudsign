<?php
if(!defined('AUTHOR'))exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=Domain().'html'?>/assets/img//apple-icon.png">
    <link rel="icon" type="image/png" href="<?=Domain()?>Static/Users/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="keywords" content="<?=TF_Data('keywords');?>">
    <meta name="description" content="<?=TF_Data('describe');?>">
    <meta property="og:title" content="天方云签-更懂你的云签到" />
    <meta property="og:description" content="<?=TF_Data('describe');?>" />
    <meta property="og:image" content="https://blog.eirds.cn/usr/uploads/2018/10/3253916472.jpg" />
    <meta name="author" content="<?=AUTHOR;?>">
    <title>
        天方云签-更懂你的云签到
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?=Domain().'Static/index'?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=Domain().'Static/index'?>/assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?=Domain().'Static/index'?>/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="landing-page sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="300">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="<?=Domain()?>" rel="tooltip" title="Coded by Creative Tim" data-placement="bottom" target="_blank">
                天方夜谭
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?=TF_lH?>&site=qq&menu=yes" class="nav-link"><i class="nc-icon nc-layout-11"></i>联系站长</a>
                </li>
                <li class="nav-item">
                    <a href="https://blog.eirds.cn/338.html" target="_blank" class="nav-link"><i class="nc-icon nc-book-bookmark"></i>问题反馈</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="登录" data-placement="bottom" href="/Application/Enter/" target="_blank">
                        <i class="fa fa-twitter"></i>
                        <p class="d-lg-none">登录</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="登录" data-placement="bottom" href="/Application/Enter/" target="_blank">
                        <i class="fa fa-twitter"></i>
                        <p class="d-lg-none">登录</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="注册" data-placement="bottom" href="/Application/Enter/?main=reg" target="_blank">
                        <i class="fa fa-facebook-square"></i>
                        <p class="d-lg-none">注册</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" title="用户中心" data-placement="bottom" href="/Application/Users/" target="_blank">
                        <i class="fa fa-instagram"></i>
                        <p class="d-lg-none">用户中心</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header" data-parallax="true" style="background-image: url('<?=Domain().'Static/index'?>/assets/img/daniel-olahh.jpg');">
    <div class="filter"></div>
    <div class="container">
        <div class="motto text-center">
            <h1>天方云签</h1>
            <h3>更懂你的云签到~</h3>
            <br />
            <? if(TF_Data('login_state')):?>

            <a href="/Application/Users/" class="btn btn-outline-neutral btn-round">老哥.欢迎回家~</a>

            <?else: ?>
            <a href="/Application/Enter/" class="btn btn-outline-neutral btn-round">登录</a>
            <a href="/Application/Enter/?main=reg" class="btn btn-outline-neutral btn-round">注册</a>
            <?endif;?>
        </div>
    </div>
</div>
<div class="main">
    <div class="section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="title">以下是我们的特点</h2>
                    <h5 class="description">高效, 多功能 & 无需挂机
                        无人值守全自动签到，支持多个平台签到,如百度贴吧,爱奇艺,B站等...完全解放双手，麻麻再也不用担心我断签
                        完全可以单手开法拉利,多台服务器不间断工作确保任务进行</h5>
                    <br>
                    <a href="#paper-kit" class="btn btn-danger btn-round">你好</a>
                </div>
            </div>
            <br/>
            <br/>
            <div class="row">
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-album-2"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">全图形化</h4>
                            <p class="description">无需安装app,只需要一个浏览器即可</p>
                            <a href="javascript:;" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-bulb-63"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">全自动化</h4>
                            <p>只需要进行简单的操作之后即可使用服务,多台服务器随时待命，确保正常签到</p>
                            <a href="javascript:;" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-chart-bar-32"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">高速高效</h4>
                            <p>采用高速,高性能服务器24小时在线执行签到任务.完全不用担心漏签问题</p>
                            <a href="javascript:;" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-sun-fog-29"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">其他功能</h4>
                            <p>更多精彩功能期待你来探索噢~老哥们已经等候你多时.</p>
                            <a href="javascript:;" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-dark text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-profile card-plain">
                        <div class="card-body">
                            <div class="author">
                                <h4 class="card-title">使用人数</h4>
                            </div>
                            <h3 class="card-description text-center">
                                <?=get_count('user','uid')?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile card-plain">

                        <div class="card-body">

                            <div class="author">
                                <h4 class="card-title">今日签到用户数</h4>
                            </div>

                            <h3 class="card-description text-center">
                                <?=get_count('info','id')?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile card-plain">

                        <div class="card-body">

                            <div class="author">
                                <h4 class="card-title">运行天数</h4>
                            </div>

                            <h3 class="card-description text-center">
                                <?=site_time(TF_Data('SITE_TIME'))?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer   footer-white ">
    <div class="container">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="https://www.eirds.cn/" target="_blank">天方-龙辉</a>
                    </li>
                    <li>
                        <a href="https://blog.eirds.cn/" target="_blank">博客</a>
                    </li>
                    <li>
                        <a href="https://beian.miit.gov.cn/#/Integrated/recordQuery" id="bg-link" target="_blank"><?=TF_Data('Icp')?></a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto">
          <span class="copyright">
            ©2016-
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="fa fa-heart heart"></i> by 龙辉 QQ1790716272
          </span>
            </div>
        </div>
    </div>
</footer>
<!--   Core JS Files   -->

<script src="<?=Domain().'Static/index'?>/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="<?=Domain().'Static/index'?>/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?=Domain().'Static/index'?>/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?=Domain().'Static/index'?>/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?=Domain().'Static/index'?>/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="<?=Domain().'Static/index'?>/assets/js/plugins/moment.min.js"></script>
<script src="<?=Domain().'Static/index'?>/assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
<script src="<?=Domain().'Static/index'?>/assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
<script type="text/javascript" src="https://s4.cnzz.com/z_stat.php?id=1280575970&web_id=1280575970"></script>
<!--  Google Maps Plugin    -->
<? if(TF_Data('Music')):?><script id="ilt" src="https://music.caojiefeng.com/player/js/player.js" key=<?=MusicKey?>></script><?endif;?>
</body>

</html>

