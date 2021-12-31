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
    <link href="<?=$Userstatic?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$Userstatic?>css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?=$Userstatic?>css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header">
                        <h4>我的资料</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="text-center">
                                    <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$userrow->qq?>&spec=100" alt=""
                                        style="border-radius: 50%;width: 100px;box-shadow: 0 0 10px 1px;">
                                </div>

                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-cellphone-android"></span> UID <span
                                    class="label label-success pull-right "><?=$userrow->uid?></span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-account"></span> 用户名 <span
                                    class="label label-dark pull-right "><?=$userrow->user?></span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-account"></span> QQ <span
                                    class="label label-primary pull-right "><?=$userrow->qq?></span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-account"></span> 邮箱 <span
                                    class="label label-yellow pull-right "><?=$userrow->qq.'@qq.com'?></span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-shield"></span> 状态 <span
                                    class="label label-info pull-right "><?if(!$userrow->active){echo '正常';};?></span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-shield-outline"></span> 用户权限 <span
                                    class="label label-purple pull-right ">普通用户</span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-timelapse"></span> 会员时长 <span
                                    class="label label-danger pull-right "><? if($userrow->vipendtime>time())echo  ceil(($userrow->vipendtime-time())/84600).'天';else echo '然而并没有开通';?></span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-timelapse"></span> 配额 <span
                                    class="label label-pink pull-right "><?=$userrow->quota?>个</span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-timelapse"></span> 注册时间 <span
                                    class="label label-secondary pull-right "><?=$userrow->regtime;?></span>
                            </li>
                            <li class="list-group-item">
                                <span class="mdi mdi-timelapse"></span> 上次登录 <span
                                    class="label label-secondary pull-right "><?=$userrow->lasttime;?></span>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>






        </div>



    </div>

    <script type="text/javascript" src="<?=$Userstatic?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic?>js/bootstrap.min.js"></script>

</body>

</html>