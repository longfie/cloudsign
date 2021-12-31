<?php
use TF\TFcore;
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if(!isadmin($userrow->uid)){showmsg('这不是你该来的地方~我想你可能是走错地方了');exit();}
if(TFcore::CSRF()){showmsg("CSRF防御,如有疑问请联系站长");exit;}

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
                        <h4>交易记录</h4>
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
                                    <tr>
                                        <td>1</td>
                                        <td>admin</td>
                                        <td>9075512</td>
                                        <td>9075512@qq.com</td>
                                        <td>2020-03-01 16:55:55</td>
                                        <td>2020-03-01 16:55:55</td>
                                        <td>
                                            <font class="text-success">正常</font>
                                        </td>
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