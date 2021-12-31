<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/11/8 15:01
 *                             _ooOoo_
 *                            o8888888o
 *                            88" . "88
 *                            (| -_- |)
 *                            O\  =  /O
 *                         ____/`---'\____
 *                       .'  \\|     |//  `.
 *                      /  \\|||  :  |||//  \
 *                     /  _||||| -:- |||||-  \
 *                     |   | \\\  -  /// |   |
 *                     | \_|  ''\---/''  |   |
 *                     \  .-\__  `-`  ___/-. /
 *                   ___`. .'  /--.--\  `. . __
 *                ."" '<  `.___\_<|>_/___.'  >'"".
 *               | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *               \  \ `-.   \_ __\ /__ _/   .-` /  /
 *          ======`-.____`-.___\_____/___.-`____.-'======
 *                             `=---='
 *                     佛祖保佑，永不出BUG
 */
require_once('../core.php');
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>基础设置- <?=TF_Data('name');?></title>
    <link rel="icon" href="<?=$Userstatic.'images/';?>favicon.ico" type="image/ico">
    <meta name="keywords" content="<?=TF_Data('keywords');?>">
    <meta name="description" content="<?=TF_Data('description');?>">
    <meta name="author" content="<?=AUTHOR;?>">
    <link href="<?=$Userstatic;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$Userstatic;?>css/pay.css">

</head>

<body>
<div class="container-fluid p-t-15">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-header">
                    <h4>基础设置</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        在这里,你可以对一些基本的设置做出修改
                    </div>
                    <div class="example-box">
                        <div class="form-group row m-b-10">
                            <div class="col-xs-6">关闭账号(没事别乱点)</div>
                            <div class="col-xs-6">
                                <label class="lyear-switch switch-solid switch-cyan">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <div class="col-xs-6">失效邮件提醒</div>
                            <div class="col-xs-6">
                                <label class="lyear-switch switch-solid switch-primary">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <div class="col-xs-6">充值邮件提醒</div>
                            <div class="col-xs-6">
                                <label class="lyear-switch switch-solid switch-success">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <div class="col-xs-6">签到总开关(没事别乱点)</div>
                            <div class="col-xs-6">
                                <label class="lyear-switch switch-solid switch-secondary">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <div class="col-xs-6">回复通知</div>
                            <div class="col-xs-6">
                                <label class="lyear-switch switch-solid switch-info">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <div class="col-xs-6">女朋友来电</div>
                            <div class="col-xs-6">
                                <label class="lyear-switch switch-solid switch-warning">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row m-b-10">
                            <div class="col-xs-6">一键跑路</div>
                            <div class="col-xs-6">
                                <label class="lyear-switch switch-solid switch-danger">
                                    <input type="checkbox" checked="">
                                    <span></span>
                                </label>
                            </div>
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

