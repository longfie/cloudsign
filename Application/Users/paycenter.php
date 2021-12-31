<?php
use TF\TFcore;
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if(!isadmin($userrow->uid)){showmsg('这不是你该来的地方~我想你可能是走错地方了');exit();}
if(TFcore::CSRF()){showmsg('CSRF防御,如有疑问请联系站长');exit;}
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
                    <div class="card-header">
                        <h4>充值中心</h4>
                    </div>
                    <div class="card-body">

                        <form action="#!" method="post" name="edit-form" class="edit-form">
                            <div class="form-group">
                                <label for="web_site_title">绑定的QQ</label>
                                <input class="form-control" type="text" id="qq" name="qq" value=""
                                    placeholder="请输入绑定的QQ">
                                <small class="help-block">绑定的QQ：<code>信息资料所填写的QQ</code></small>
                            </div>
                            <div class="form-group">
                                <label for="web_site_title">月数</label>
                                <input class="form-control" type="number" id="yue" name="yue" value=""
                                    placeholder="请输入要充值的月数">
                            </div>
                            <div class="form-group">
                                <label for="web_site_title">配额充值</label>
                                <input class="form-control" type="text" id="qq" name="qq" value="" placeholder="不填就是不变">
                                <small class="help-block">注意：<code>配额不需要钱,续费时有几个就几块</code></small>
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
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>

</body>

</html>