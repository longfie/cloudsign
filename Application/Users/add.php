<?php
require_once('../core.php');
/*if(!defined('AUTHOR'))
{
    exit('我想你肯定是走错了地方');

}*/
require_once ('head.php');
//判断是否登录

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
                        <h4>短信验证码登录</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <div id="load" class="alert alert-info" style="display:none;"></div>
                            <div id="login">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">手机号</div>
                                        <input type="text" id="phone" value="" class="form-control"
                                            onkeydown="if(event.keyCode==13){submit.click()}" />
                                    </div>
                                </div>
                                <div class="form-group" id="sms" style="display:none;">
                                    <div class="input-group">
                                        <div class="input-group-addon">验证码</div>
                                        <input type="text" id="smscode" value="" class="form-control"
                                            onkeydown="if(event.keyCode==13){submit.click()}" placeholder="输入短信验证码" />
                                        <div class="input-group-addon" id="sendcode_button"><button type="button"
                                                id="sendcode">获取验证码</button></div>
                                    </div>
                                </div>
                                <div class="form-group code" style="display:none;">
                                    <div class="form-group form-inline">
                                        <div class="input-group">
                                            <div class="input-group-addon">验证码</div>
                                            <input class="form-control" type="text" id="code"
                                                onkeydown="if(event.keyCode==13){submit.click()}"
                                                placeholder="请输入验证码..">
                                        </div>
                                        <div class="form-group">
                                            <div id="codeimg"></div>
                                        </div>
                                    </div>

                                </div>

                                <button type="button" id="submit" class="btn btn-primary btn-block">提交</button>
                            </div>
                            <br>
                            <a class="multitabs" href="add.php">点此重新登录</a>

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

        function login(phone, smsvc) {
            $('#load').html('正在登录，请稍等...');
            var loginurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=login3&r=" + Math.random(1);
            ajax.post(loginurl, {
                phone: phone,
                smsvc: smsvc
            }, 'json', function (d) {
                if (d.code == 0) {
                    $('#login').hide();
                    $('.code').hide();
                    $('#submit').hide();
                    $('#sms').hide();
                    showresult(d);
                } else {
                    $('#load').html(d.msg + " (" + d.code + ")");
                    $('.code').hide();
                    $('#login').show();
                }
            });

        }

        function sendsms(phone, vcode, vcodestr, vcodesign) {
            vcode = vcode || null;
            vcodestr = vcodestr || null;
            vcodesign = vcodesign || null;
            $('#load').html('正在发送验证码...');
            var loginurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=sendsms&r=" + Math.random(1);
            ajax.post(loginurl, {
                phone: phone,
                vcode: vcode,
                vcodestr: vcodestr,
                vcodesign: vcodesign
            }, 'json', function (d) {
                if (d.code == 0) {
                    $('.code').hide();
                    $('#sms').show();
                    $('#submit').attr('do', 'smscode');
                    $('#smscode').focus();
                    $('#load').html('请输入短信验证码');
                    invokeSettime("#sendcode");
                    alert('已发送验证码到 ' + phone);
                } else if (d.code == 50020) {
                    $('#load').html(d.msg);
                    $('#codeimg').attr('vcodesign', d.vcodesign);
                    $('#sms').hide();
                    $('#submit').attr('do', 'code');
                    getvc(d.vcodestr);
                } else if (d.code == 500002 || d.code == 500001) {
                    $('#load').html('请输入验证码');
                    $('#submit').attr('do', 'code');
                    alert(d.msg);
                } else if (d.code == 50014) {
                    $('#load').html('提示：60秒内只能发送一次验证码，否则会提示频繁');
                    $('.code').hide();
                    alert(d.msg);
                } else {
                    $('.code').hide();
                    alert(d.msg);
                }
            });

        }

        function getphone(phone) {
            $('#load').html('正在检测手机号是否存在...');
            var getvcurl = "<?=Domain().'TFcore/class_lib/';?>login.php?do=getphone&r=" + Math.random(1);
            ajax.post(getvcurl, {
                phone: phone
            }, 'json', function (d) {
                if (d.code == 0) {
                    sendsms(phone);
                } else if (d.code == 3) {
                    $('#load').html('');
                    $('.code').hide();
                    $('#submit').attr('do', 'submit');
                    alert('该手机号不存在，请重新输入！');
                } else {
                    $('#load').html(d.msg + " (" + d.code + ")");
                    $('#submit').attr('do', 'submit');
                    $('.code').hide();
                }
            });
        }

        function getvc(vcodestr) {
            $('#codeimg').attr('vcodestr', vcodestr);
            $('#codeimg').html('<img onclick="this.src=\'<?=Domain().'TFcore/class_lib/';?>login.php?do=getvcpic&vcodestr=' + vcodestr +
                '&r=\'+Math.random();" src="<?=Domain().'TFcore/class_lib/';?>login.php?do=getvcpic&vcodestr=' + vcodestr + '&r=' + Math.random(
                    1) +
                '" title="点击刷新">');
            $('#submit').attr('do', 'code');
            $('#code').val("");
            $('.code').show();
        }

        function showresult(arr) {
            $('#load').html('<div class="alert alert-success">添加挂机任务成功!欢迎吧名为:' + decodeURIComponent(arr.displayname) +
                ' 的老哥回家</div><div class="text-center"><a class="multitabs" href="tasklist.php">点击进入管理页面</a></div>');
        }
        $(document).ready(function () {
            $('#submit').click(function () {
                var self = $(this);
                var phone = trim($('#phone').val()),
                    smscode = trim($('#smscode').val());
                if (phone == '') {
                    alert("手机号不能为空！");
                    return false;
                }
                $('#load').show();
                if (self.attr("data-lock") === "true") return;
                else self.attr("data-lock", "true");
                if (self.attr('do') == 'smscode') {
                    if (smscode == '') {
                        alert("验证码不能为空！");
                        return false;
                    }
                    login(phone, smscode);
                } else if (self.attr('do') == 'code') {
                    if (code == '') {
                        alert("验证码不能为空！");
                        return false;
                    }
                    var code = trim($('#code').val()),
                        vcodestr = $('#codeimg').attr('vcodestr'),
                        vcodesign = $('#codeimg').attr('vcodesign');
                    sendsms(phone, code, vcodestr, vcodesign);
                } else {
                    getphone(phone);
                }
                self.attr("data-lock", "false");
            });
            $('#sendcode').click(function () {
                var self = $(this);
                var phone = trim($('#phone').val());
                if (phone == '') {
                    alert("手机号不能为空！");
                    return false;
                }
                $('#load').show();
                if (self.attr("data-lock") === "true") return;
                else self.attr("data-lock", "true");
                var code = trim($('#code').val()),
                    vcodestr = $('#codeimg').attr('vcodestr'),
                    vcodesign = $('#codeimg').attr('vcodesign');
                sendsms(phone, code, vcodestr, vcodesign);
                self.attr("data-lock", "false");
            });
        });
    </script>
</body>

</html>