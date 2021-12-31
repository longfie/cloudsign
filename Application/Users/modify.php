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
$set = NULL;
    if($user=htmlspecialchars(safestr($_POST['user']))){
        $set.="user='{$user}'";
    }
    if($qq=strip_tags(safestr($_POST['qq']))){
        is_null($set)?$set.="qq='{$qq}'":$set.=",qq='{$qq}'";
        
    }
    if($mail=strip_tags(safestr($_POST['mail']))){
       
        is_null($set)?$set.="mail='{$mail}'":$set.=",mail='{$mail}'";
    }
   
    if($_POST['pwd']){
        $pwd=md5(md5($_POST['pwd']).md5(TF_JW));
         is_null($set)?$set.="pwd='{$pwd}'":$set.=",pwd='{$pwd}'";
        
    }
    if(is_null($set)){

        showmsg('你并没有修改噢~<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
        exit();
    }else{
        $db->query("update {$prefix}user set {$set} where uid='{$userrow->uid}'");
        showmsg('保存成功~<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
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
</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-header">
                        <h4>修改资料</h4>
                    </div>
                    <div class="card-body">
                        <form action="?" method="post">
                            <input type="hidden" name="uset" value="ok">
                            <div class="form-group">
                                <label for="example-nf-email">用户名</label>
                                <input class="form-control" type="text" id="example-nf-name" name="user"
                                    placeholder="请输入用户名..不改请留空">
                            </div>
                            <div class="form-group">
                                <label for="example-nf-email">QQ</label>
                                <input class="form-control" type="text" id="example-nf-qq" name="qq"
                                    placeholder="请输入新的QQ..不改请留空">
                            </div>
                            <div class="form-group">
                                <label for="example-nf-email">QQ邮箱</label>
                                <input class="form-control" type="email" id="example-nf-email" name="mail"
                                    placeholder="请输入新的邮箱..不改请留空">
                            </div>
                            <div class="form-group">
                                <label for="example-nf-password">新密码</label>
                                <input class="form-control" type="password" id="example-nf-password"
                                    name="pwd" placeholder="请输入密码..不改请留空">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">保存</button>
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