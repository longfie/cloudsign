<?php
require_once('../core.php');
/*if(!defined('AUTHOR'))
{
    exit('我想你肯定是走错了地方');

}*/
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
    <script src="<?=$Userstatic;?>js/base.js"></script>
</head>
<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header">
                        <h4>账号密码登录</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div id="load" class="alert alert-info" style="display:none;"></div>
                            <div id="login">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">帐号</div>
                                        <input type="text" id="user" value="" class="form-control"
                                            onkeydown="if(event.keyCode==13){submit.click()}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">密码</div>
                                        <input type="password" id="pwd" value="" class="form-control"
                                            onkeydown="if(event.keyCode==13){submit.click()}" />
                                    </div>
                                </div>
                                <div class="form-group code" style="display:none;">
                                    <div class="form-group form-inline">
                                        <div class="input-group">
                                            <div class="input-group-addon">验证码</div>
                                            <input type="text" id="code" class="form-control"
                                                onkeydown="if(event.keyCode==13){submit.click()}" placeholder="输入验证码">
                                        </div>
                                        <div class="form-group">
                                            <div id="codeimg"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <pre>提示：验证码第一次输入必定错误，是正常现象</pre>
                                    </div>
                                </div>

                                <button type="button" id="submit" class="btn btn-primary btn-block">提交</button>
                            </div>
                            <div id="security" style="display:none;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">验证码</div>
                                        <input type="text" id="smscode" value="" class="form-control"
                                            onkeydown="if(event.keyCode==13){submit.click()}" />
                                        <div class="input-group-addon" id="sendcode_button"><button type="button"
                                                id="sendcode">获取验证码</button></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <pre>提示：60秒内只能发送一次验证码，否则会提示频繁</pre>
                                </div>
                                <button type="button" id="submit2" class="btn btn-primary btn-block">提交</button>
                            </div>
                            <br /><a href="./">点此重新登录</a>
                        </div>
                    </div>
                </div>
            </div>






        </div>



    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
    <script>
        var ajax = {
            get: function (url, dataType, callback) {
                dataType = dataType || 'html';
                $.ajax({
                    type: "GET",
                    url: url,
                    async: true,
                    dataType: dataType,
                    cache: false,
                    success: function (data, status) {
                        if (callback == null) {
                            return;
                        }
                        callback(data);
                    },
                    error: function (error) {
                        alert('创建连接失败');
                    }
                });
            },
            post: function (url, parameter, dataType, callback) {
                dataType = dataType || 'html';
                $.ajax({
                    type: "POST",
                    url: url,
                    async: true,
                    dataType: dataType,
                    data: parameter,
                    cache: false,
                    success: function (data, status) {
                        if (callback == null) {
                            return;
                        }
                        callback(data);
                    },
                    error: function (error) {
                        alert('创建连接失败');
                    }
                });
            }
        }

        function invokeSettime(obj) {
            var countdown = 60;
            settime(obj);

            function settime(obj) {
                if (countdown == 0) {
                    $(obj).attr("data-lock", "false");
                    $(obj).attr("disabled", false);
                    $(obj).text("获取验证码");
                    countdown = 60;
                    return;
                } else {
                    $(obj).attr("data-lock", "true");
                    $(obj).attr("disabled", true);
                    $(obj).text(countdown + "秒后重试");
                    countdown--;
                }
                setTimeout(function () {
                    settime(obj)
                }, 1000)
            }
        }

        function trim(str) { //去掉头尾空格
            return str.replace(/(^\s*)|(\s*$)/g, "");
        }

        function getpwd(pwd, time) {
            var passwd = pwd + time;
            var rsa =
                "B3C61EBBA4659C4CE3639287EE871F1F48F7930EA977991C7AFE3CC442FEA49643212E7D570C853F368065CC57A2014666DA8AE7D493FD47D171C0D894EEE3ED7F99F6798B7FFD7B5873227038AD23E3197631A8CB642213B9F27D4901AB0D92BFA27542AE890855396ED92775255C977F5C302F1E7ED4B1E369C12CB6B1822F";
            setMaxDigits(131);
            var key = new RSAKeyPair("10001", "", rsa);
            return encryptedString(key, passwd);
        }

        function gettime(user, pwd, vcode, vcodestr) {
            vcode = vcode || null;
            vcodestr = vcodestr || null;
            $('#load').html('正在获取Token，请稍等...');
            var getvcurl = "api/login.php?do=time";
            ajax.get(getvcurl, 'json', function (d) {
                if (d.code == 0) {
                    login(d.time, user, pwd, vcode, vcodestr);
                } else {
                    alert(d.msg);
                    $('#load').html('');
                }
            });
        }

        function login(time, user, pwd, vcode, vcodestr) {
            $('#load').html('正在登录，请稍等...');
            var p = getpwd(pwd, time);
            var BAIDUID = $('#user').attr('BAIDUID');
            //alert(p);return;
            var loginurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=login&r=" + Math.random(1);
            ajax.post(loginurl, {
                time: time,
                user: user,
                pwd: pwd,
                p: p,
                vcode: vcode,
                vcodestr: vcodestr,
                BAIDUID: BAIDUID
            }, 'json', function (d) {
                if (d.code == 0) {
                    $('#login').hide();
                    $('.code').hide();
                    $('#submit').hide();
                    $('#security').hide();
                    $('#submit2').hide();
                    showresult(d);
                } else if (d.code == 400023) {
                    if (d.type == 'phone' || d.type == 'mobile') {
                        $('#load').html("请验证密保后登录，密保手机是：" + d.account);
                    } else {
                        $('#load').html("请验证密保后登录，密保邮箱是：" + d.account);
                    }
                    $('#submit').hide();
                    $('.code').hide();
                    $('#code').val("");
                    $('#security').show();
                    $('#security').attr('type', d.type);
                    $('#security').attr('token', d.token);
                    $('#security').attr('lurl', d.lurl);
                } else if (d.code == 310006 || d.code == 500001 || d.code == 500002) { //需要验证码
                    $('#load').html(d.msg);
                    getvc(d.vcodestr);
                } else if (d.code == 230048 || d.code == 400010) {
                    $('#load').html("您输入的账号不存在，请重新输入");
                    $('#submit').attr('do', 'submit');
                    $('.code').hide();
                    $('#code').val("");
                    $('#user').focus();
                    $('#user').val("");
                } else if (d.code == 400011 || d.code == 400015) {
                    $('#load').html("您输入的密码有误，请重新输入");
                    $('#submit').attr('do', 'submit');
                    $('.code').hide();
                    $('#code').val("");
                    $('#pwd').focus();
                    $('#pwd').val("");
                } else {
                    $('#load').html(d.msg + " (" + d.code + ")");
                    $('#submit').attr('do', 'submit');
                    $('.code').hide();
                    $('#login').show();
                }
            });

        }

        function login2(type, token, lurl, BAIDUID, vcode) {
            $('#load').html('正在登录，请稍等...');
            var loginurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=login2&r=" + Math.random(1);
            ajax.post(loginurl, {
                type: type,
                token: token,
                lurl: lurl,
                BAIDUID: BAIDUID,
                vcode: vcode
            }, 'json', function (d) {
                if (d.code == 0) {
                    $('#login').hide();
                    $('.code').hide();
                    $('#submit').hide();
                    $('#security').hide();
                    $('#submit2').hide();
                    showresult(d);
                } else {
                    $('#load').html(d.msg + " (" + d.code + ")");
                    $('.code').hide();
                    $('#login').show();
                }
            });

        }

        function sendcode(type, token, lurl, BAIDUID) {
            var loginurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=sendcode&r=" + Math.random(1);
            ajax.post(loginurl, {
                type: type,
                token: token,
                lurl: lurl,
                BAIDUID: BAIDUID
            }, 'json', function (d) {
                if (d.code == 0) {
                    $('.code').hide();
                    $('#smscode').focus();
                    invokeSettime("#sendcode");
                    alert('验证码发送成功，请查收');
                } else {
                    $('.code').hide();
                    alert(d.msg);
                }
            });

        }

        function getvc(vcodestr) {
            $('#codeimg').attr('vcodestr', vcodestr);
            $('#codeimg').html('<img onclick="this.src=\'<?=Domain().'TFcore/class_lib/';?>login.php?do=getvcpic&vcodestr=' + vcodestr +
                '&r=\'+Math.random();" src="api/login.php?do=getvcpic&vcodestr=' + vcodestr + '&r=' + Math.random(
                    1) +
                '" title="点击刷新">');
            $('#submit').attr('do', 'code');
            $('#code').val("");
            $('.code').show();
        }

        function showresult(arr) {
            $('#load').html('<div class="alert alert-success">添加挂机任务成功！' + decodeURIComponent(arr.displayname) +
                '</div><div class="text-center"><a class="multitabs" href="tasklist.php">点击进入管理页面</a></div>');
        }

        function checkvc(user, pwd) {
            $('#load').html('登录中，请稍候...');
            var getvcurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=checkvc";
            ajax.post(getvcurl, {
                user: user
            }, 'json', function (d) {
                $('#user').attr('BAIDUID', d.BAIDUID);
                if (d.code == 0) {
                    gettime(user, pwd);
                } else if (d.code == 1) {
                    $('#load').html('请输入验证码。');
                    getvc(d.vcodestr);
                } else {
                    $('#load').html(d.msg + " (" + d.code + ")");
                    $('.code').hide();
                }
            });
        }
        $(document).ready(function () {
            $('#submit').click(function () {
                var self = $(this);
                var user = trim($('#user').val()),
                    pwd = trim($('#pwd').val());
                if (user == '' || pwd == '') {
                    alert("请确保每项不能为空！");
                    return false;
                }
                $('#load').show();
                if (self.attr("data-lock") === "true") return;
                else self.attr("data-lock", "true");
                if (self.attr('do') == 'code') {
                    var vcode = trim($('#code').val()),
                        vcodestr = $('#codeimg').attr('vcodestr');
                    gettime(user, pwd, vcode, vcodestr);
                } else {
                    checkvc(user, pwd);
                }
                self.attr("data-lock", "false");
            });
            $('#submit2').click(function () {
                var self = $(this);
                var code = trim($('#smscode').val());
                if (code == '') {
                    alert("验证码不能为空！");
                    return false;
                }
                $('#load').show();
                if (self.attr("data-lock") === "true") return;
                else self.attr("data-lock", "true");
                var type = $('#security').attr('type'),
                    token = $('#security').attr('token'),
                    lurl = $('#security').attr('lurl'),
                    BAIDUID = $('#user').attr('BAIDUID');
                login2(type, token, lurl, BAIDUID, code);
                self.attr("data-lock", "false");
            });
            $('#sendcode').click(function () {
                var self = $(this);
                $('#load').show();
                if (self.attr("data-lock") === "true") return;
                else self.attr("data-lock", "true");
                var type = $('#security').attr('type'),
                    token = $('#security').attr('token'),
                    lurl = $('#security').attr('lurl'),
                    BAIDUID = $('#user').attr('BAIDUID');
                sendcode(type, token, lurl, BAIDUID);
                self.attr("data-lock", "false");
            });
        });
    </script>
</body>

</html>