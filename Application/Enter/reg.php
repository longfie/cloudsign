<?php

/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/16 16:53
 *                             _ooOoo_
 *                            o8888888o
 *                            88" . "88
 *                            (| -_- |)
 *                            O\  =  /O
 *                         ____/`---'\____
 *                       .'  \\|     |//  `.
 *                      /  \\|||  :  |||//  \
 *                     /  _||||| -:- |||||-  \
 *                     |   | \\\  -  /// |   |
 *                     | \_|  ''\---/''  |   |
 *                     \  .-\__  `-`  ___/-. /
 *                   ___`. .'  /--.--\  `. . __
 *                ."" '<  `.___\_<|>_/___.'  >'"".
 *               | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *               \  \ `-.   \_ __\ /__ _/   .-` /  /
 *          ======`-.____`-.___\_____/___.-`____.-'======
 *                             `=---='
 *                     佛祖保佑，永不出BUG
 */

session_start();
if(!defined('AUTHOR'))
{
    exit('我猜这肯定不是你想看到的页面');
}
if($_SESSION['TFcodetime']<time()){
    unset($_SESSION['TFcode']);
    unset($_SESSION['TFcodetime']);
}
?>


<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>注册页面 - <?=TF_Data('name');?></title>
  <link rel="icon" href="<?=$Userstatic.'images/';?><?=$Userstatic.'images/';?>favicon.ico" type="image/ico">
    <meta name="keywords" content="<?=TF_Data('keywords');?>">
    <meta name="description" content="<?=TF_Data('description');?>">
    <meta name="author" content="<?=AUTHOR;?>">
  <link href="<?=$Userstatic;?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=$Userstatic;?>css/materialdesignicons.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?=Domain()?>Others/check/tn_code.js?v=35"></script>
  <link rel="stylesheet" type="text/css" href="<?=Domain()?>Others/check/style.css?v=27" />
  <link href="<?=$Userstatic;?>css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=$Userstatic;?>css/slider.css">
  <style>
    .lyear-wrapper {
      position: relative;
    }

    .lyear-login {
      display: flex !important;
      min-height: 100vh;
      align-items: center !important;
      justify-content: center !important;
    }

    .lyear-login:after {
      content: '';
      min-height: inherit;
      font-size: 0;
    }

    .login-center {
      background: rgb(255 255 255 / 60%);
      min-width: 39rem;
      padding: 2.14286em 3.57143em;
      border-radius: 3px;
      margin: 2.85714em;
    }

    .login-header {
      margin-bottom: 1.5rem !important;
    }

    .login-center .has-feedback.feedback-left .form-control {
      padding-left: 38px;
      padding-right: 12px;
    }

    .login-center .has-feedback.feedback-left .form-control-feedback {
      left: 0;
      right: auto;
      width: 38px;
      height: 38px;
      line-height: 38px;
      z-index: 4;
      color: #dcdcdc;
    }

    .login-center .has-feedback.feedback-left.row .form-control-feedback {
      left: 15px;
    }

  </style>
</head>

<body>
  <div class="row lyear-wrapper" style="background-image: url(<?=$Userstatic;?>images/login-bg-3.jpg); background-size: cover;">
    <div class="lyear-login">
      <div class="login-center">
        <div class="login-header text-center">
          <h3>用户注册</h3>
        </div>
        <form action="" method="post">
          <div class="alert alert-success" role="alert" style="display: none">
            <p id="msg"></p>
          </div>
          <div class="form-group has-feedback feedback-left">
            <input type="text" placeholder="请输入您的用户名" class="form-control" name="user" />
            <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
          </div>
          <div class="form-group has-feedback feedback-left">
            <input type="text" placeholder="请输入您QQ" class="form-control" name="qq"/>
            <span class="mdi mdi-qqchat form-control-feedback" aria-hidden="true"></span>
          </div>
          <div class="form-group has-feedback feedback-left">
            <input type="password" placeholder="请输入密码" class="form-control" name="pwd" />
            <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
          </div>
          <div class="form-group has-feedback feedback-left">
            <input type="password" placeholder="确认密码" class="form-control"  name="cpwd" />
            <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
          </div>
            <div class="form-group has-feedback feedback-left">
                <div class="btn btn-block btn btn-warning" >
                    <div class="tncode"></div>
                </div>
                <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
            </div>
          <div class="form-group">
            <label class="lyear-checkbox checkbox-primary m-t-10">
              <input type="checkbox" checked><span>我已阅读并同意<a href="javascript:;'"> 用户协议</a></span>
            </label>
          </div>
          <div class="form-group">
            <button class="btn btn-block btn-primary" type="button" id="login">立即注册</button>
          </div>
            <!-- QQ登录 -->
            <h2 class="text-center">
                <a href="/Application/Enter/qqlogin.php">
                    <i class="mdi mdi-qqchat"></i>
                </a>
            </h2>
          <p class="text-center">
            已有账号，去<a href="?main=login">登录</a>
          </p>
        </form>
        <!-- <hr>
        <footer class="col-sm-12 text-center">
          <p class="m-b-0">Copyright © 2019 <a href="http://lyear.itshubao.com">IT书包</a>. All right reserved</p>
        </footer> -->
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
  <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
  <script src="<?=$Userstatic;?>js/bootstrap-notify.min.js"></script>
  <script src="<?=$Userstatic;?>js/lightyear.js"></script>
  <script src="<?=$Userstatic;?>js/jquery.sliderVerification.min.js"></script>
  <script>
    
      $("#login").on('click', function (){
        let user = $('[name="user"]').val();
				let qq = $('[name="qq"]').val();
				let pwd = $('[name="pwd"]').val();
				let cpwd = $('[name="cpwd"]').val();
        $('#msg').parent('.alert').show()
        // if(user.val() || qq.val() || pwd.val() || cpwd.val() || ){
        //   $('#msg').html('所有选项不能为空');
        //     return setTimeout(function () {                        
        //       location.reload();                
        //     },500) 
        // }
        if(pwd !== cpwd){
            $('#msg').html('两次输入的密码不同');
            return setTimeout(function () {                        
              location.reload();                
            },500)  
        }
				
				var data_reg = {
					reg:"ok",
					user:user,
					qq:qq,
					pwd:pwd,
				}
				$('#msg').html('正在处理...');
				$.ajax({
					url:'/Application/Control/reg.php',
					type: 'post',
					data:data_reg,
					dataType: 'json',
					success:function(data){
            $('#msg').html(data.msg);
            if(data.status !== 0){
              $('#msg').html(data.msg);
              return setTimeout(function () {                        
                location.reload();                
              },1000) 
            }
						$('#msg').html(data.msg);
            setTimeout(function () {                        
                location.href='/Application/Enter'                  
            },2000)
					},
					error:function(e){
						$('#msg').html('服务器内部错误，请求失败！');
						return setTimeout(function () {                        
                location.reload();                    
            },1000)
					}
				});
			})

  </script>
</body>

</html>