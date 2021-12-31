<?php
use TF\TFcore;
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if(!isadmin($userrow->uid)){showmsg('这不是你该来的地方~我想你可能是走错地方了<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');exit();}
if(TFcore::CSRF()){showmsg("CSRF防御,如有疑问请联系站长");exit;}

$p=is_numeric($_GET['p'])?$_GET['p']:'1';
$pp=$p+8;
$pagesize=20;
$start=($p-1)*$pagesize;
$pages=ceil(get_count('cardkey','1=1','id')/$pagesize);

if($_GET['del']==ok){
	$id = $_GET['id'];
	$db->query("delete from {$prefix}cardkey where id='$id'");
	 showmsg('删除成功~<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
	 exit;
}
if($_POST['uset']=='ok'){
	//程序开始
	$cardkey = get_randstr(16);
	$month = intval($_POST['month']);
	$number = intval($_POST['number']);
	$quota = intval($_POST['quota']);
	if(empty($month)){
		showmsg('请填入月数!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;
	}
	if($number>1 && empty($quota)){
		$quota = 2;
		for($i=0;$i<$number;$i++){
			$cardkey = get_randstr(16);
			$db->query("insert into {$prefix}cardkey (cardkey,month,quota) values ('{$cardkey}','{$month}','{$quota}')");
		}
				showmsg('成功添加'.$i.'张卡密!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;
	}elseif($number>1){
		
		for($i=0;$i<$number;$i++){
			$cardkey = get_randstr(16);
			$db->query("insert into {$prefix}cardkey (cardkey,month,quota) values ('{$cardkey}','{$month}','{$quota}')");
		}
				showmsg('成功添加'.$i.'张卡密!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;
	}elseif($number==1){
		
		$db->query("insert into {$prefix}cardkey (cardkey,month,quota) values ('{$cardkey}','{$month}','{$quota}')");
					showmsg('成功添加1张卡密!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
		exit;
	}
	
	
}
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
                        <h4>卡密管理</h4>
                    </div>
                    <div class="card-toolbar clearfix">
                        <form action="?" role="form" method="post">
                            <input type="hidden" name="uset" value="ok">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <label>月数</label>
                                        <input class="form-control" type="text" name="month" placeholder="生成月数">
                                    </div>
                                    <div class="col-xs-3">
                                        <label>张数</label>
                                        <input class="form-control" type="text" name="number" placeholder="生成张数">
                                    </div>
                                    <div class="col-xs-3">
                                        <label>配额</label>
                                        <input class="form-control" type="text" name="quota" placeholder="几个配额可以使用的卡密">
                                    </div>
                                    <div class="col-xs-3">
                                        <label>&nbsp;</label><br>
                                        <button class="btn btn-primary" type="submit">点击生成</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>卡密</th>
                                        <th>月数</th>
                                        <th>状态</th>
                                        <th>uid</th>
                                        <th>使用人</th>
                                        <th>时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($rows=$db->get_results("select * from {$prefix}cardkey limit $start,$pagesize")){ foreach($rows as $row){?>
                                    <tr>
                                        <td><?=$row->id?></td>
                                        <td><?=$row->cardkey?></td>
                                        <td><?=$row->month?></td>
                                        <td>
                                            <? if($row->isuse==0){?><font class="text-success">未使用</font>
                                            <? }else {?>
                                            <font class="text-danger">已使用</font>
                                        <? }?>
                                        </td>
                                        <td><?=$row->uid?></td>
                                        <td><?=$row->user?></td>
                                        <td><?=$row->username?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="#!" title=""
                                                    data-toggle="tooltip" data-original-title="编辑"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default" href="#!" title=""
                                                    data-toggle="tooltip" data-original-title="查看"><i
                                                        class="mdi mdi-eye"></i></a>
                                                <a class="btn btn-xs btn-default" href="?del=ok&id=<?=$row->id?>" title=""
                                                    data-toggle="tooltip" data-original-title="删除"><i
                                                        class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr><?php }}?>
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
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>

</body>

</html>