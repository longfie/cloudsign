<?php
require_once('../core.php');
/*if(!defined('AUTHOR'))
{
    exit('我想你肯定是走错了地方');

}*/
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}

if($_POST['uset']=='ok'){
    $cardkey = trim($_POST['cardkey']);
    $cardrow = $db->get_row("select quota,month,isuse from {$prefix}cardkey where cardkey='{$cardkey}' limit 1");

    if($cardrow){
        
        if($cardrow->isuse){
            showmsg('此卡已被使用!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;

        }
        elseif($cardrow->quota==$userrow->quota){

            $db->query("update {$prefix}cardkey set isuse='1',user='{$userrow->user}',uid={$userrow->uid} where cardkey='{$cardkey}'");
            if($userrow->vip){

                $time=24*60*60*30*$cardrow->month;
                $db->query("update {$prefix}user set vipendtime=vipendtime+'{$time}' where uid = '{$userrow->uid}'");

                          showmsg('充值成功!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;
            }else{
                $time =strtotime('+'.$cardrow->month.' month');
                $db->query("update {$prefix}user set vipendtime='{$time}',vip='1' where uid = '{$userrow->uid}'");
  showmsg('充值成功!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;

            }


        }else{

             showmsg('这张卡密可用配额数与你不符!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;
        }


    }else{
                     showmsg('请输入正确卡密!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;
    }


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
                        <h4>卡密充值</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            在这里,你可以使用py到的卡密自主充值
                        </div>
                        <form action="?" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-xs-12">卡密</label>
                                <div class="col-xs-12">
                                    <input name="cardkey" class="form-control" type="text" placeholder="请输入卡密">
                                    <input type="hidden" name="uset" value="ok">
                                    <div class="help-block">注意:请在这里输入你获取到的卡密</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary" type="submit">立即使用</button>
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

</body>

</html>