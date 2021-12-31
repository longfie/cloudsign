<?php
use TF\TFcore;
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if(!isadmin($userrow->uid)){showmsg('这不是你该来的地方~我想你可能是走错地方了');exit();}
if(TFcore::CSRF()){showmsg("CSRF防御,如有疑问请联系站长");exit;}
if(GET('del')=='ok'){
    $uid = GET('uid');
    if($uid==1){
        showmsg('这是要打算删库跑路吗,把自己都删了.');
        exit();
    }else{
        $db->query("delete from {$prefix}user where uid='$uid'");
        showmsg('删除成功');
        exit();
    }
}
if(GET('ban')=='ok'){
    $uid=GET('uid');
    if($uid==1){


        showmsg('什么人间迷惑行为,狠起来自己打自己是吧?');
        exit();
    }elseif($db->query("update {$prefix}user set active = '1' where uid = '$uid'")){
        showmsg('已经给这家伙封号了');
        exit();
    }else{
        showmsg('不存在该用户或出现了未知的错误,鬼知道你在干嘛');
        exit();
    }
}
if(GET('status')=='ok'){
    $uid=GET('uid');
    $db->query("update {$prefix}user set active = '0' where uid = '$uid'");
    showmsg('已解封.');
    exit();
}
$p=is_numeric($_GET['p'])?$_GET['p']:'1';
$pp=$p+8;
$pagesize=15;
$start=($p-1)*$pagesize;
$pages=ceil(get_count('user','1=1','uid')/$pagesize);
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
                        <h4>用户管理</h4>
                    </div>
                    <div class="card-toolbar clearfix">
                        <form class="search-bar" method="get" action="#!" role="form">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <input type="hidden" name="search_field" id="search-field" value="title">
                                    <button class="btn btn-default dropdown-toggle" id="search-btn"
                                        data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                        用户名 <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a tabindex="-1" href="javascript:void(0)" data-field="title">用户名</a>
                                        </li>
                                        <li>
                                            <a tabindex="-1" href="javascript:void(0)" data-field="cat_name">QQ</a>
                                        </li>
                                    </ul>
                                </div>
                                <input type="text" class="form-control" value="" name="keyword" placeholder="请输入名称">
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>UID</th>
                                        <th>用户名</th>
                                        <th>QQ</th>
                                        <th>邮箱</th>
                                        <th>注册时间</th>
                                        <th>上次登录</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($rows=$db->get_results("select * from {$prefix}user order by uid desc limit $start,$pagesize")){ foreach($rows as $row){?>
                                    <tr>
                                        <td><?=$row->uid; if($row->uid==1){echo '<span class="label label-danger">——全站最牛逼</span>';}?></td>
                                        <td><?='<span class="label label-primary pull-right  ">'.$row->user.'</span>';?></td>
                                        <td><?=$row->qq?></td>
                                        <td><? if(empty($row->mail)){echo $row->qq.'@qq.com';}else{echo $row->mail;}?></td>
                                        <td><?=$row->regtime?></td>
                                        <td><?=$row->lasttime?></td>
                                        <td>
                                            <? if ($row->active==1)echo '<font class="text-danger">已被封';else echo '<font class="text-success">正常';?></font>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="#!" title=""
                                                    data-toggle="tooltip" data-original-title="编辑"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default" href="<? if($row->active==0): ?>?ban=ok&uid=<?=$row->uid?><?else:?>?status=ok&uid=<?=$row->uid?><?endif;?>" title=""
                                                    data-toggle="tooltip" data-original-title="<? if ($row->active==0)echo '封禁';else echo '解封';?>"><i
                                                        class="mdi mdi-eye"></i></a>
                                                <a class="btn btn-xs btn-default" href="?del=ok&uid=<?=$row->uid?>" title=""
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
                        <ul class="pagination pagination-circle">
                            <li <?php if($p==1){echo'class="disabled"';}?>><a href="?p=1">首页</a></li>
                            <li <?php if($prev==$p){echo'class="disabled"';}?>><a href="?p=<?=$prev?>">&laquo;</a></li>
                            <?php for($i=$p;$i<=$pp;$i++){?>
                                <li <?php if($i==$p){echo'class="active"';}?>><a href="?p=<?=$i?>"><?=$i?></a></li>
                            <?php }?>
                            <li <?php if($next==$p){echo'class="disabled"';}?>><a href="?p=<?=$next?>">&raquo;</a></li>
                            <li <?php if($p==$pages){echo'class="disabled"';}?>><a href="?p=<?=$pages?>">尾页</a></a></li>
                        </ul>
                    </div>
                    </div>>
                </div>

            </div>

        </div>

    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>

</body>

</html>