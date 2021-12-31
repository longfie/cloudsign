<?php
use TF\TFcore;
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
require_once(ROOT.'Monitor/tb.signclass.php');
if($_POST['uset']=='ok'){
    $bduss = trim($_POST['bduss']);
    if($db->get_var("select bduss from {$prefix}info where bduss='{$bduss}' limit 1")){

        showmsg('老哥,请勿重复添加!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
        exit();
    }
    $re = new tbsign($bduss);


    if($re->loginstate()){
        $num = $db->get_row("select count(*) as count from {$prefix}info where uid={$userrow->uid}");
        if($num->count>=$userrow->quota){
            showmsg('老哥,当前挂机已超出配额,如需添加多个挂机,请联系站长!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
            exit();

        }
        $user = TFcore::getBDinfo($bduss)['data']['user']['name'];
        $time = date("Y-m-d H:i:s");
        $db->query("insert into {$prefix}info (uid,userid,user,bduss,ptoken,stoken,addtime) values ('{$userrow->uid}','1','{$user}','{$bduss}','1','1','{$time}')");

        showmsg('添加成功!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
        exit();
    }else{
        showmsg('输入的BDUSS已失效或格式错误!<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>手动导入bduss - <?=TF_Data('name');?></title>
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
                    <h4>手动导入BDUSS</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        在这里,你可以自己手动导入BDUSS.
                    </div>
                    <form action="?" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-12">下面填写BDUSS,只是BDUSS的值噢!!</label>
                            <div class="col-xs-12">
                                <input name="bduss" class="form-control" type="text" placeholder="请输入BDUSS">
                                <input type="hidden" name="uset" value="ok">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-primary" type="submit">立即使用</button>
                            </div>
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
