<?php
require_once('../core.php');
require_once(ROOT.'TFcore/class_lib/crypt.php');

$qq = $db->get_var("select qq from {$prefix}user where uid=1");

$payid = Mcrypt::encode($userrow->uid,'123456');//支付的用户uid,使用对称加密，防止用户更改!
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
    <link rel="stylesheet" href="<?=$Userstatic;?>css/pay.css">

</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header">
                        <h4>在线充值</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            提示: 如果在充值过程中请联系QQ <a
                                href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$qq?>>&amp;site=qq&amp;menu=yes"
                                class="alert-link">1790716272</a>
                        </div>
                        <form class="form-horizontal" action="?" method="post">
                            <div class="form-group">
                                <label class="col-xs-12">充值金额</label>
                                <div class="col-xs-12">
                                    <input class="form-control" name="money" type="number" value="24" placeholder="充值金额">
                                    <input  name="name" value="<?=$userrow->user;?>-天方云签VIP充值"  type="hidden">
                                    <input  name="payid" value="<?=$payid;?>"  type="hidden">
                                    <div class="help-block">注意:充值公式为 充值金额/挂机配额数=充值月数</div>
                                    <div class="help-block">如开通一年你需要支付:<?=$userrow->quota*12;?>元</div>
                                </div>
                            </div>
                            <div class="text-center"><img src="<?=$Userstatic;?>images/ali.jpg" height="50%" width="40%"></div>
                            <div class="form-group">
                                <label class="col-xs-12">充值方式</label>
                                <p class="list-chose col-xs-12">
                                    <span class="label label-outline-primary active"><input type="radio" value="1"
                                            name="paytype" min="1"
                                            oninput="javascript:this.value=this.value.replace(/[^\d]/g,'')"
                                            checked />支付宝</span>
                                </p>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary" type="submit">立即支付</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
    <script>
        let deploy = $('input[name="deploy"]:checked').val();
        console.log(deploy); //deploy为支付方式的值
    </script>
</body>

</html>