<?php
use TF\TFcore;
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if(!isadmin($userrow->uid)){showmsg('这不是你该来的地方~我想你可能是走错地方了');exit();}
$robot = TFcore::Get('http://robot.yunsign.net/?key=123456');
//var_dump($robot);
if($robot)
{
    $robot = json_decode($robot,true);
    if($robot['code']==200){
        $robot =$robot['data']['ret'];
        list($robot_name,$robot_qq,$robot_state,$robot_rat,$robot_recive,$robot_send,$robot_lasttime)=explode('|',$robot);
    }
}
//if(TFcore::CSRF()){showmsg("CSRF防御,如有疑问请联系站长");exit;}
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>机器人管理控制中心</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>名称</th>
                                        <th>QQ</th>
                                        <th>在线状态</th>
                                        <th>速率</th>
                                        <th>实收</th>
                                        <th>实发</th>
                                        <th>持续在线时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=$robot_name?></td>
                                        <td><?=$robot_qq?></td>
                                        <td><font class="label label-success editable editable-click"><?=$robot_state?></font></td>
                                        <td>
                                            <font class="text-success"><?=$robot_rat?></font>
                                        </td>
                                        <td><?=$robot_recive?>条</td>
                                        <td><?=$robot_send?>条</td>
                                        <td><?=$robot_lasttime?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="#!" title=""
                                                    data-toggle="tooltip" data-original-title="编辑"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default" href="#!" title=""
                                                    data-toggle="tooltip" data-original-title="查看"><i
                                                        class="mdi mdi-eye"></i></a>
                                                <a class="btn btn-xs btn-default" href="#!" title=""
                                                    data-toggle="tooltip" data-original-title="删除"><i
                                                        class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
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