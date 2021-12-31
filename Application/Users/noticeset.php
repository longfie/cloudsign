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
    <link href="<?=$Userstatic;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <ul class="nav nav-tabs page-tabs">
                        <li> <a href="webset.php">网站设置</a> </li>
                        <li class="active"> <a href="#!">公告设置</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <form action="#!" method="post" name="edit-form" class="edit-form">

                                <div class="form-group">
                                    <label for="web_site_description">公告信息</label>
                                    <textarea class="form-control" id="web_site_notice" rows="6"
                                        name="web_site_description" placeholder="请输入公告">如有疑问,请到blog.eirds.cn/338.html留言所有用户请加群:936838495.登录成功即为添加or更新成功！不需要其他操作
                                        ~基于安卓协议，使经验达到最大化！每天经验+8,贴吧会员则更高 </textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary m-r-5">确 定</button>
                                    <button type="button" class="btn btn-default"
                                        onclick="javascript:history.back(-1);return false;">返 回</button>
                                </div>
                            </form>
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