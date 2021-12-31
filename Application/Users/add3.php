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
                        <h4>QQ扫码登录</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group text-center">
                            <div class="list-group-item list-group-item-info" style="font-weight: bold;" id="login">
                                <span id="loginmsg">使用QQ手机版扫描二维码</span><span id="loginload"
                                    style="padding-left: 10px;color: #790909;">.</span>
                            </div>
                            <div class="list-group-item" id="qrimg">
                            </div>
                            <div class="list-group-item" id="mobile" style="display:none;"><button type="button"
                                    id="mlogin" onclick="mloginurl()"
                                    class="btn btn-warning btn-block">跳转QQ快捷登录</button><br /><button type="button"
                                    onclick="loadScript()" class="btn btn-success btn-block">我已完成登录</button>
                            </div>
                            <br /><a class="multitabs" href="add3.html">点此重新登录</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
    <script>
        var interval1, interval2;

        function showresult(arr) {
            $('#login').html('<div class="alert alert-success">添加挂机任务成功!欢迎吧名为:' + decodeURIComponent(arr.displayname) +
                ' 的老哥回家</div><div class="text-center"><a class="multitabs" href="tasklist.php">点击进入管理页面</a></div>');
        }

        function setCookie(name, value) {
            var exp = new Date();
            exp.setTime(exp.getTime() + 30 * 1000);
            document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
        }

        function getCookie(name) {
            var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
            if (arr = document.cookie.match(reg))
                return unescape(arr[2]);
            else
                return null;
        }

        function getqrpic(force) {
            force = force || false;
            cleartime();
            var qrsig = getCookie('qrsig');
            var qrimg = getCookie('qrimg');
            if (qrsig != null && qrimg != null && force == false) {
                $('#qrimg').attr('qrsig', qrsig);
                $('#qrimg').html('<img id="qrcodeimg" onclick="getqrpic(true)" src="data:image/png;base64,' + qrimg +
                    '" title="点击刷新">');
                if (/Android|SymbianOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Midp/i.test(
                        navigator
                        .userAgent) && navigator.userAgent.indexOf("QQ/") == -1) {
                    $('#mobile').show();
                }
                interval1 = setInterval(loginload, 1000);
                interval2 = setInterval(qrlogin, 3000);
            } else {
                var getvcurl = 'api/qqlogin.php?do=getqrpic&r=' + Math.random(1);
                $.get(getvcurl, function (d) {
                    if (d.code == 0) {
                        setCookie('qrsig', d.qrsig);
                        setCookie('qrimg', d.data);
                        $('#qrimg').attr('qrsig', d.qrsig);
                        $('#qrimg').html(
                            '<img id="qrcodeimg" onclick="getqrpic(true)" src="data:image/png;base64,' +
                            d.data + '" title="点击刷新">');
                        if (/Android|SymbianOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Midp/i
                            .test(navigator.userAgent) && navigator.userAgent.indexOf("QQ/") == -1) {
                            $('#mobile').show();
                        }
                        interval1 = setInterval(loginload, 1000);
                        interval2 = setInterval(qrlogin, 3000);
                    } else {
                        alert(d.msg);
                    }
                }, 'json');
            }
        }

        function qrlogin() {
            if ($('#login').attr("data-lock") === "true") return;
            var qrsig = $('#qrimg').attr('qrsig');
            var url = '<?=Domain().'TFcore/class_lib/';?>qqlogin.php?do=qrlogin&qrsig=' + decodeURIComponent(qrsig) + '&r=' + Math.random(1);
            $.get(url, function (d) {
                if (d.code == 0) {
                    $('#loginmsg').html('正在登录百度，请稍候...');
                    cleartime();
                    qqconnect(d.redirect_uri, d.mkey);
                } else if (d.code == 1) {
                    getqrpic(true);
                    $('#loginmsg').html('请重新扫描二维码');
                } else if (d.code == 2) {
                    $('#loginmsg').html('使用QQ手机版扫描二维码');
                } else if (d.code == 3) {
                    $('#loginmsg').html('扫描成功，请在手机上确认授权登录');
                } else {
                    cleartime();
                    $('#loginmsg').html(d.msg);
                }
            }, 'json');
        }

        function qqconnect(redirect_uri, mkey) {
            $.ajax({
                type: "POST",
                url: "api/qqlogin.php?do=qqconnect",
                data: {
                    redirect_uri: redirect_uri,
                    mkey: mkey
                },
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        showresult(data);
                        $('#qrimg').hide();
                        $('#submit').hide();
                        $('#mobile').hide();
                        $('#login').attr("data-lock", "true");
                    } else {
                        $('#loginmsg').html(data.msg);
                    }
                }
            });
        }

        function loginload() {
            if ($('#login').attr("data-lock") === "true") return;
            var load = document.getElementById('loginload').innerHTML;
            var len = load.length;
            if (len > 2) {
                load = '.';
            } else {
                load += '.';
            }
            document.getElementById('loginload').innerHTML = load;
        }

        function cleartime() {
            clearInterval(interval1);
            clearInterval(interval2);
        }

        function mloginurl() {
            var imagew = $('#qrcodeimg').attr('src');
            imagew = imagew.replace(/data:image\/png;base64,/, "");
            $('#mlogin').html("正在跳转...");
            $.post("<?=Domain().'TFcore/class_lib/';?>qrcode.php?r=" + Math.random(1), "image=" + encodeURIComponent(imagew), function (arr) {
                if (arr.code == 0) {
                    $('#loginmsg').html('跳转到QQ登录后请返回此页面');
                    window.location.href = 'mqqapi://forward/url?version=1&src_type=web&url_prefix=' + window
                        .btoa(arr
                            .url);
                } else {
                    alert(arr.msg);
                }
                $('#mlogin').html("跳转QQ快捷登录");
            }, 'json');
        }
        $(document).ready(function () {
            getqrpic();
            $('#submit').click(function () {
                qrlogin();
            });
        });
    </script>
</body>

</html>