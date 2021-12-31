<?php
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>首页 - <?=TF_Data('name');?></title>
    <link rel="icon" href="<?=$Userstatic.'images/';?>favicon.ico" type="image/ico">
    <meta name="keywords" content="<?=TF_Data('keywords');?>">
    <meta name="description" content="<?=TF_Data('description');?>">
    <meta name="author" content="<?=AUTHOR;?>">
    <link href="<?=$Userstatic;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header">
                        <h4>扫码登录</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group text-center">
                            <div class="list-group-item list-group-item-info" style="font-weight: bold;" id="load">
                                <span id="loginmsg">正在加载</span><span id="loginload"
                                    style="padding-left: 10px;color: #790909;">.</span>
                            </div>
                            <div class="list-group-item" id="login" style="display:none;">
                                <div class="" id="qrimg">
                                </div>
                                <div class="list-group-item" id="mobile" style="display:none;"><button type="button"
                                        id="mlogin" onclick="mloginurl()"
                                        class="btn btn-warning btn-block">跳转百度APP登录</button><br /><button type="button"
                                        onclick="qrlogin()" class="btn btn-success btn-block">我已完成登录</button></div>
                            </div>
                            <br /><a class="multitabs" href="add1.php">点此重新登录</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
    <script>
        function getqrcode() {
            var getvcurl = '<?=Domain().'TFcore/class_lib/';?>login.php?do=getqrcode&r=' + Math.random(1);
            $.get(getvcurl, function (d) {
                if (d.code == 0) {
                    $('#qrimg').attr('sign', d.sign);
                    $('#qrimg').attr('link', d.link);
                    $('#qrimg').html('<img id="qrcodeimg" onclick="getqrcode()" src="https://' + d.imgurl +
                        '" title="点击刷新">');
                    $('#login').show();
                    $('#loginmsg').html(
                        '请使用<a href="http://xbox.m.baidu.com/mo/" target="_blank" rel="noreferrer">手机百度App</a>扫码登录'
                    );
                    if (/Android|SymbianOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Midp/i
                        .test(
                            navigator.userAgent) && navigator.userAgent.indexOf("QQ/") == -1) {
                        $('#mobile').show();
                    }
                    if ($('#qrimg').attr('lock') == undefined) {
                        setTimeout(qrlogin, 2000);
                        setInterval(loginload, 1000);
                    }
                } else {
                    alert(d.msg);
                }
            }, 'json');
        }

        function qrlogin() {
            $('#qrimg').attr('lock', 'true');
            var sign = $('#qrimg').attr('sign');
            if (sign == '') return;
            var loginurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=qrlogin";
            $.ajax({
                type: "POST",
                url: loginurl,
                async: true,
                dataType: 'json',
                timeout: 15000,
                data: "sign=" + sign + "&r=" + Math.random(1),
                cache: false,
                success: function (data, status) {
                    if (data.code == 0) {
                        $('#login').hide();
                        showresult(data);
                    } else {
                        qrlogin();
                    }
                },
                error: function (error) {
                    qrlogin();
                }
            });

        }

        function loginload() {
            var load = document.getElementById('loginload').innerHTML;
            var len = load.length;
            if (len > 2) {
                load = '.';
            } else {
                load += '.';
            }
            document.getElementById('loginload').innerHTML = load;
        }

        function showresult(arr) {
            $('#load').html('<div class="alert alert-success">添加挂机任务成功!欢迎吧名为:' + decodeURIComponent(arr.displayname) +
                ' 的老哥回家</div><div class="text-center"><a class="multitabs" href="tasklist.php">点击进入管理页面</a></div>');
        }

        function mloginurl() {
            var url = $('#qrimg').attr('link');
            window.location.href = 'baiduboxapp://v1/easybrowse/open?upgrade=1&type=video&newbrowser=1&url=' +
                encodeURIComponent(url);
        }
        $(document).ready(function () {
            getqrcode();
            $('#submit').click(function () {
                qrlogin();
            });
        });
    </script>
</body>

</html>