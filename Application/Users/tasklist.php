
<?php
use TF\TFcore;
require_once('../core.php');
/*if(!defined('AUTHOR'))
{
    exit('我想你肯定是走错了地方');

}*/
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if($db->get_results("select * from {$prefix}info where uid ={$userrow->uid}")==null){
    showmsg('还没有添加挂机账号请<a class="multitabs" href="add.php">点此去添加</a> ');
    exit();
}
if (GET('delete') == 'ok') {

    $id = GET('id');

    if(!$db->query("delete from {$prefix}info where uid='{$userrow->uid}' and id='$id'")){
        showmsg('你知道你在做什么傻事吗?<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
    }else{
        showmsg('成功删除<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
    }

    exit();
}
if (GET('test') == 'ok') {
    $id = GET('id');

    $ro = $db->get_row("select zt,bduss from {$prefix}info where uid={$userrow->uid} and id='$id'");

    if ($ro->zt == 1) {
        showmsg('请先更新状态~<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
        exit();
    } else {

        curl(Domain().'Monitor/tbsign.run.php?key='.TF_Data('cron').'&bduss='.$ro->bduss);
        showmsg('已经提交到服务器,请登录贴吧查看签到情况~<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
        exit();
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
    <link rel="stylesheet" href="<?=$Userstatic;?>css/myHang.css">

</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>我的挂机</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if ($rows = $db->get_results("select * from {$prefix}info where uid={$userrow->uid}")) {
                            foreach ($rows as $row) { ?> <div class="col-md-3">
                                <ul class="list-group">
                                    <li class="list-group-item active text-center">
                                        <a class="img-avatar img-avatar-pill">
                                            <img src="<?='https://gss0.bdstatic.com/6LZ1dD3d1sgCo2Kml5_Y_D3/sys/portrait/item/'.TFcore::getBDinfo($row->bduss)['data']['user']['portrait'];?>"
                                                alt="">
                                            <span><i class="mdi mdi-account"></i> <?= $row->user ?></span>
                                        </a>

                                        <span class="label label-danger "><? if($userrow->vip)echo 'VIP牛逼';else echo '普通用户';?></span>

                                    </li>
                                    <li class="list-group-item">
                                        <span class="mdi mdi-update"></span> 运行状态 <span <?if(!$row->zt):?>
                                            class="label label-primary pull-right ">正常<?else :?> class="label label-danger pull-right ">已过期,请更新<?endif;?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="mdi mdi-shield-outline"></span> BDUSS状态 <span <?if(!$row->zt):?> class="label label-primary pull-right ">正常<?else :?> class="label label-danger pull-right ">已过期,请更新<?endif;?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="mdi mdi-signal"></span> 签到状态 <span
                                            class="label label-primary pull-right ">正常</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="mdi mdi-timelapse"></span> 添加日期 <span
                                            class="label label-info pull-right "><?=$row->addtime?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="mdi mdi-timelapse"></span> 上次签到时间 <span
                                            class="label label-info pull-right "><?=$row->signtime?></span>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="btn-group btn-group-justified">
                                            <a class="btn btn-primary" href="?test=ok&id=<?= $row->id ?>">手动测试</a>
                                            <a class="btn btn-default" href="?delete=ok&id=<?=$row->id?>">删除账号</a>
                                        </div>
                                    </li>
                                </ul>

                            </div>  <?php }
                            } ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>



    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>

</body>

</html>