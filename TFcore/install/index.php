<?php
error_reporting(0);
header('Content-Type: text/html; charset=UTF-8');
define('SYSTEM_ROOT', dirname(__FILE__) . '/');
define('TFCORE_ROOT', dirname(SYSTEM_ROOT) . '/');
$step=isset($_GET['step'])?$_GET['step']:1;
if (file_exists(SYSTEM_ROOT.'TFlock.lock')) exit('系统检测到您已经安装本程序，如需重新安装，请删除TFcore下的install下的TF.lock文件即可,注意,重装将会导致数据丢失，请先备份，数据无价');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/Static/Users/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:400,700%7CMontserrat:300,400,600,700">
    <title>程序安装 - 天方云签系统</title>
    <style>
    .registration-steps-page-container,.registration-social-login-or{
      background: rgb(255 255 255 / 60%);
    }
    </style>
</head>
<body>
<?php if($step=='1'){?>
    <div id="content-pro">
        <div class="container">
            <div class="centered-headings-pro pricing-plans-headings">
                <h6>天方云签</h6>
                <h1>程序安装</h1>
            </div>
        </div><!-- close .container -->
        <div>
            <div class="container">
                <div class="registration-steps-page-container">
                    <form class="registration-step-final-padding" style="padding:10px;">
                        <div class="registration-social-login-container">
                        <pre>   程序说明 V2.0
1.该程序由天方龙辉QQ1790716272独立开发,大部分前端部分由叽叽完成QQ9075512

2.如果你对该程序感兴趣，可以加入交流QQ群：936838495

3.开发不易，互相尊重，版权所有，侵权必究

V1.0功能介绍
1.该程序使用的是PHP+MYSQL+光年后台模板+部分AJAX开发，3种设备自适应兼容手机 平板 电脑平台自适应页面,达到最佳显示效果提升用户体验

2.炫酷的人性化模板设计，后台可以更换首页、登录、注册、找回密码、用户中心、后台管理、的各种界面的模板，多套高端大气炫酷的模板任你选

3.支持对接QQ机器人,支持多种平台的云签到
</pre>
                        </div><!-- close .registration-social-login-container -->
                        <div class="registration-social-login-options">
                            <h6>天方云签</h6>
                            <div class="centered-headings-pro pricing-plans-headings">1.作者龙辉 QQ1790716272</div>
                            <div class="centered-headings-pro pricing-plans-headings">2.如果要使网站正常运行，请先阅读readme</div>
                            <div class="centered-headings-pro pricing-plans-headings">3.因为太懒，目前主要以贴吧云签为主。下个版本更新</div>
                            <div class="centered-headings-pro pricing-plans-headings">4.加群即可体验QQ机器人对接云签</div>
                            <div class="centered-headings-pro pricing-plans-headings">5.如果你也喜欢这套程序,欢迎加入</div>
                        </div><!-- close .registration-social-login-options -->
                        <div class="clearfix"></div>
                        <div class="registration-step-final-footer">
                            <a href="?step=2" class="btn btn-green-pro">开始安装</a>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div><!-- close .registration-steps-page-container -->
            </div><!-- close .container -->
        </div><!-- close #pricing-plans-background-image -->
    </div><!-- close #content-pro -->
<?php }else if($step=='2'){?>
    <div id="content-pro">
        <div class="container">
            <div class="centered-headings-pro pricing-plans-headings">
                <h6>天方云签</h6>
                <h1>程序安装</h1>
            </div>
        </div><!-- close .container -->
        <div>
            <div class="container">
                <div class="registration-steps-page-container">
                    <form class="registration-step-final-padding" style="padding:10px;">
                        <div class="registration-social-login-container">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>函数检测</th>
                                    <th>需求</th>
                                    <th>当前</th>
                                    <th>用途</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>PHP 5.3+</td>
                                    <td>必须</td>
                                    <td><?php echo phpversion(); ?></td>
                                    <td>PHP版本支持</td>
                                </tr>
                                <tr>
                                    <td>curl_exec()</td>
                                    <td>必须</td>
                                    <td><?php echo checkfunc('curl_exec', true); ?></td>
                                    <td>抓取网页</td>
                                </tr>
                                <tr>
                                    <td>file_get_contents()</td>
                                    <td>必须</td>
                                    <td><?php echo checkfunc('file_get_contents', true); ?></td>
                                    <td>读取文件</td>
                                </tr>
                                <tr>
                                    <td>fsockopen()</td>
                                    <td>必须</td>
                                    <td><?php echo checkfunc('fsockopen'); ?></td>
                                    <td>发送邮件</td>
                                </tr>
                                <tr>
                                    <td>ZipArchive</td>
                                    <td>推荐</td>
                                    <td><?php echo checkclass('ZipArchive'); ?></td>
                                    <td>Zip 解包和压缩</td>
                                </tr>
                                <tr>
                                    <td>写入权限</td>
                                    <td>推荐</td>
                                    <td><?php if (is_writable('./')) {
                                            echo '<font color="green">可用</font>';
                                        } else {
                                            echo '<font color="black">不支持</font>';
                                        } ?></td>
                                    <td>写入文件(1/2)</td>
                                </tr>
                                <tr>
                                    <td>file_put_contents()</td>
                                    <td>推荐</td>
                                    <td><?php echo checkfunc('file_put_contents'); ?></td>
                                    <td>写入文件(2/2)</td>
                                </tr>
                                </tbody>
                            </table>
                            <code>* 如有一项不通过，则程序无法正常使用。</code>
                            <div class="registration-social-login-or">AND</div>
                        </div><!-- close .registration-social-login-container -->
                        <div class="registration-social-login-options">
                            <h6>天方云签</h6>
                            <div class="centered-headings-pro pricing-plans-headings">1.该程序由龙辉独立编写,部分页面由叽叽编写.</div>
                            <div class="centered-headings-pro pricing-plans-headings">2.云签交流群Q群936838495</div>
                            <div class="centered-headings-pro pricing-plans-headings">3.            </div>
                            <div class="centered-headings-pro pricing-plans-headings">4.请尊重作者版权</div>
                            <div class="centered-headings-pro pricing-plans-headings">5.如果遇到问题请联系作者！</div>
                        </div><!-- close .registration-social-login-options -->
                        <div class="clearfix"></div>
                        <div class="registration-step-final-footer">
                            <a href="?step=3" class="btn btn-green-pro">确定，下一步</a>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div><!-- close .registration-steps-page-container -->
            </div><!-- close .container -->
        </div><!-- close #pricing-plans-background-image -->
    </div><!-- close #content-pro -->
<?php }else if($step=='3'){?>
    <div id="content-pro">
        <div class="container">
            <div class="centered-headings-pro pricing-plans-headings">
                <h6>天方云签</h6>
                <h1>程序安装</h1>
            </div>
        </div><!-- close .container -->
        <div style="padding: 20px 0px 120px 0px">
            <div class="container">
                <div class="registration-steps-page-container">
                    <div class="registration-billing-form" style="padding:40px;">
                        <div class="row">
                            <div class="col-md" onclick="choice(0)">
                                <div class="jumbotron jumbotron-fluid jumbotron-pro edition0 jumbotron-selected">
                                    <div class="container edition_choice_0">
                                        <img src="images/genres/drama.png" style="height: 30px;width: 30px;">
                                        <h6 class="light-weight-heading">开源版</h6>
                                        <i class="fas fa-check-circle edition_fa_0"></i>
                                    </div>
                                </div><!-- close .jumbotron -->
                            </div><!-- close .col-md -->
                            <div class="col-md" onclick="alert('等下个版本')">
                                <div class="jumbotron jumbotron-fluid jumbotron-pro edition1">
                                    <div class="container edition_choice_0">
                                        <img src="images/genres/comedy.png" style="height: 30px;width: 30px;">
                                        <h6 class="light-weight-heading">带机器人,支付版</h6>
                                        <i class="fas fa-check-circle edition_fa_1" style="display:none;"></i>
                                    </div>
                                </div><!-- close .jumbotron -->
                            </div><!-- close .col-md -->
                        </div><!-- close .row -->
                        <div class="row">
                            <div class="billing-form-pro" style="margin-top: -40px">
                                <form action="?step=4" method="POST">
                                    <input type="hidden" name="TFinstall" value="ok">
                                    <div class="form-group">
                                        <label for="cardholder" class="col-form-label">数据库地址:</label>
                                        <input type="text" class="form-control" name="DB_HOST" value="localhost" placeholder="请输入数据库地址">
                                    </div>
                                    <div class="form-group">
                                        <label for="cardnumber" class="col-form-label">数据库端口:</label>
                                        <input type="text" class="form-control" name="DB_PORT" value="3306" placeholder="请输入数据库端口">
                                    </div>
                                    <div class="row adjust-margin-top adjust-margin-bottom">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="expire" class="col-form-label">数据库名称:</label>
                                                <input type="text" class="form-control" name="DB_NAME" placeholder="请输入数据库名称">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="ccv" class="col-form-label">数据库用户名:</label>
                                                <input type="text" class="form-control" name="DB_USER" placeholder="请输入数据库用户名">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="zip" class="col-form-label">数据库密码:</label>
                                                <input type="text" class="form-control" name="DB_PWD" placeholder="请输入数据库密码">
                                            </div>
                                        </div>
                                    </div><!-- close .row -->
                                    <div class="form-group">
                                        <label for="cardholder" class="col-form-label">站长qq:</label>
                                        <input type="text" class="form-control" name="qq" placeholder="请输入你的QQ(用于公益版正版授权)">
                                    </div>
                                    <div class="form-group">
                                        <div class="billing-plan-container">
                                            <h5>版本: <a href="#" class="edition_name">开源</a></h5>
                                        </div><!-- close .billing-plan-container -->
                                        <button type="submit" class="btn btn-green-pro">我已经配置好了，下一步</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- close .row -->
                    </div><!-- close .registration-billing-form -->
                </div><!-- close .registration-steps-page-container -->
            </div><!-- close .container -->
        </div><!-- close #pricing-plans-background-image -->
    </div><!-- close #content-pro -->
<?php }else if($step=='4'){?>
<?php
if($_POST['TFinstall']=='ok'){
		if(!$_POST['DB_HOST'] || !$_POST['DB_PORT'] || !$_POST['DB_NAME'] || !$_POST['DB_USER'] || !$_POST['DB_PWD']){
			echo'<script language=\'javascript\'>alert(\'所有项都不能为空\');history.go(-1);</script>';
		}else{
			if(!$con=mysqli_connect($_POST['DB_HOST'].':'.$_POST['DB_PORT'],$_POST['DB_USER'],$_POST['DB_PWD'])){
				echo'<script language=\'javascript\'>alert("连接数据库失败，'.mysqli_error().'");history.go(-1);</script>';
			}else if(!mysqli_select_db($con,$_POST['DB_NAME'])){
				echo'<script language=\'javascript\'>alert("选择的数据库不存在，'.mysqli_error().'");history.go(-1);</script>';
			}else{
				mysqli_query($con,"set names utf8");
				$date = date("Y-m-d");
				$data="
<?php
return [
	'DB_HOST'               =>  '{$_POST['DB_HOST']}',
	'DB_NAME'               =>  '{$_POST['DB_NAME']}',
	'DB_USER'               =>  '{$_POST['DB_USER']}',
	'DB_PWD'                =>  '{$_POST['DB_PWD']}',
	'DB_PORT'               =>  '{$_POST['DB_PORT']}',
	'DB_PREFIX'             =>  'tieba_',
	'SITE_TIME'             =>  '{$date}',
];";
				if(file_put_contents(TFCORE_ROOT.'class_function/database.php',$data)) {
                    $sqls = file_get_contents("install.sql");
                    $explode = explode(";", $sqls);
                    $num = count($explode);
                    setcookie("num",$num, time()+60);
                    foreach ($explode as $sql) {
                        if ($sql = trim($sql)) {
                            mysqli_query($con, $sql);
                        }
                    }
                    if (mysqli_error()) {
                        echo '<script language=\'javascript\'>alert("导入数据表时错误，' . mysqli_error() . '");history.go(-1);</script>';
                    } else {
                        @file_put_contents(SYSTEM_ROOT . 'TFlock.lock', '程序安装锁如需重新安装请删除此文件！作者QQ：1790716272');
                    }
                }}}}
?>
    <div id="content-pro">
        <div class="container">
            <div class="centered-headings-pro pricing-plans-headings">
                <h6>天方云签</h6>
                <h1>程序安装</h1>
            </div>
        </div><!-- close .container -->
        <div>
            <div class="container">
                <div class="registration-steps-page-container">
                    <div class="registration-step-final-padding welcome-page-styles">
                        <div class="centered-headings-pro pricing-plans-headings">
                            <h6>安装完成!</h6>
                            <h1>欢迎使用天方云签系统</h1>
                        </div>
                        <h6 class="welcome-style-summary">第一个注册的用户为管理员账户</h6>
                        <h6 class="welcome-style-summary">官方网站www.yunsign.net</h6>
                        <h6 class="welcome-style-summary">如有问题，请联系作者QQ1790716272！</h6>
                        <h6 class="welcome-style-summary">注意:网站正常运行需要监控:域名/Monitor/task.work.php?cron=你后台设置的密匙,监控频率按网站用户数来看,建议30分钟.</h6>
                        <div class="clearfix"></div>
                        <div class="registration-step-final-footer">
                            <a href="/" class="btn btn-green-pro">完成安装</a>
                            
                        </div>
                    </div><!-- close .registration-step-final-padding -->
                </div><!-- close .registration-steps-page-container -->
            </div><!-- close .container -->
        </div><!-- close #pricing-plans-background-image -->
    </div><!-- close #content-pro -->
<?php }?>
<a href="#0" id="pro-scroll-top"><i class="fas fa-chevron-up"></i></a>
<!-- Required Framework JavaScript -->
<script src="js/libs/jquery-3.3.1.min.js"></script><!-- jQuery -->
<script src="js/libs/popper.min.js" defer></script><!-- Bootstrap Popper/Extras JS -->
<script src="js/libs/bootstrap.min.js" defer></script><!-- Bootstrap Main JS -->
<!-- All JavaScript in Footer -->
<!-- Additional Plugins and JavaScript -->
<script src="js/navigation.js" defer></script><!-- Header Navigation JS -->
<script src="js/jquery.flexslider-min.js" defer></script><!-- Custom Document Ready JS -->
<script src="js/script.js" defer></script><!-- Custom Document Ready JS -->
</body>
</html>
<?php
function checkfunc($a, $b = false){
	if (function_exists($a)) {
		return '<font color="green">可用</font>';
	} else {
		if ($b == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}

/**
 * php函数检测2
 */
function checkclass($a, $b = false){
	if (class_exists($a)) {
		return '<font color="green">可用</font>';
	} else {
		if ($b == false) {
			return '<font color="black">不支持</font>';
		} else {
			return '<font color="red">不支持</font>';
		}
	}
}?>