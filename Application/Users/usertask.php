<?php
use TF\TFcore;
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if(!isadmin($userrow->uid)){showmsg('这不是你该来的地方~我想你可能是走错地方了');exit();}
if(TFcore::CSRF()){showmsg("CSRF防御,如有疑问请联系站长");exit;}
$p=is_numeric($_GET['p'])?$_GET['p']:'1';
$pp=$p+8;
$pagesize=15;
$start=($p-1)*$pagesize;
$pages=ceil(get_count('info','1=1','id')/$pagesize);
if($pp>$pages) $pp=$pages;
if($p==1){
    $prev=1;
}else{
    $prev=$p-1;
}
if($p==$pages){
    $next=$p;
}else{
    $next=$p+1;
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>挂机管理</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>所属用户UID</th>
                                        <th>百度名称</th>
                                        <th>状态</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($rows=$db->get_results("select * from {$prefix}info order by id desc limit $start,$pagesize")){ foreach($rows as $row){?>
                                    <tr>
                                        <td><?=$row->id?></td>
                                        <td><?=$row->uid?></td>
                                        <td><?=$row->user?></td>
                                        <td>
                                            <!--由于数据库设置错误,0为正常...-->
                                            <? if($row->zt){echo '<span class="label label-danger">失效</span>';}else{echo '<span class="label label-success">正常</span>';}?>
                                        </td>
                                        <td><?=$row->addtime?></td>
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

                                <?php }}?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <ul class="pagination">
                                <li <?php if($p==1){echo'class="disabled"';}?>><a href="?p=1">首页</a></li>
                                <li <?php if($prev==$p){echo'class="disabled"';}?>><a href="?p=<?=$prev?>">&laquo;</a></li>
                                <?php for($i=$p;$i<=$pp;$i++){?>
                                    <li <?php if($i==$p){echo'class="active"';}?>><a href="?p=<?=$i?>"><?=$i?></a></li>
                                <?php }?>
                                <li <?php if($next==$p){echo'class="disabled"';}?>><a href="?p=<?=$next?>">&raquo;</a></li>
                                <li <?php if($p==$pages){echo'class="disabled"';}?>><a href="?p=<?=$pages?>">尾页</a></a></li>
                            </ul>
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