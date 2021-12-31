<?php
require_once('../core.php');
/*if(!defined('AUTHOR'))
{
    exit('我想你肯定是走错了地方');

}*/
require_once ('head.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
?>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header">
                        <h4>微信扫码登录</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group text-center">
                            <div class="list-group-item list-group-item-info" style="font-weight: bold;" id="login">
                                <span id="loginmsg">请使用微信扫描二维码登录</span><span id="loginload"
                                    style="padding-left: 10px;color: #790909;">.</span>
                            </div>
                            <div class="list-group-item" id="qrimg">
                            </div>
                            <br /><a class="multitabs" href="add4.html">点此重新登录</a>
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
            var getvcurl = '<?=Domain().'TFcore/class_lib/';?>qqlogin.php?do=getwxpic&r=' + Math.random(1);
            $.get(getvcurl, function (d) {
                if (d.code == 0) {
                    $('#qrimg').attr('uuid', d.uuid);
                    $('#qrimg').html('<img id="qrcodeimg" onclick="getqrcode()" style="max-width:240px" src="' +
                        d
                        .imgurl + '" title="点击刷新">');
                    if ($('#qrimg').attr('lock') == undefined) {
                        setTimeout(qrlogin, 2000);
                        setInterval(loginload, 1000);
                    }
                } else {
                    alert(d.msg);
                }
            }, 'json');
        }

        function qrlogin(last) {
            last = last || null;
            $('#qrimg').attr('lock', 'true');
            var uuid = $('#qrimg').attr('uuid');
            if (uuid == '') return;
            if (last != null) {
                var loginurl = "<?=Domain().'TFcore/class_lib/';?>qqlogin.php?do=wxlogin&uuid=" + uuid + "&last=" + last + "&r=" + Math.random(1);
            } else {
                var loginurl = "<?=Domain().'TFcore/class_lib/';?>qqlogin.php?do=wxlogin&uuid=" + uuid + "&r=" + Math.random(1);
            }
            $.ajax({
                type: "GET",
                url: loginurl,
                async: true,
                dataType: 'json',
                timeout: 15000,
                success: function (data, status) {
                    if (data.code == 0) {
                        $('#qrimg').hide();
                        $('#submit').hide();
                        showresult(data);
                    } else if (data.code == 1) {
                        qrlogin();
                    } else if (data.code == 2) {
                        $('#loginmsg').html('请在微信中点击确认即可登录');
                        qrlogin('404');
                    } else if (data.code == 3) {
                        $('#loginmsg').html('请使用微信扫描二维码登录');
                        getqrcode();
                    } else {
                        alert(data.msg)
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
            $('#login').html('<div class="alert alert-success">添加挂机任务成功!欢迎吧名为:' + decodeURIComponent(arr.displayname) +
                ' 的老哥回家</div><div class="text-center"><a class="multitabs" href="tasklist.php">点击进入管理页面</a></div>');
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