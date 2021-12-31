<?php
/* Name: 百度登录操作类
 * Author: 一千零一夜
 * Website: blog.eirds.cn
 * QQ: 1790716272
*/
//error_reporting(0);
require_once('../common.php');
require 'login.class.php';
$time = date("Y-m-d H:i:s");
$login=new baiduLogin();

$num = $db->get_row("select count(*) as count from {$prefix}info where uid={$userrow->uid}");
if($num->count>=$userrow->quota){
    $array =array('code'=>-1,'msg'=>iconv('gb2312','utf-8','当前挂机已超出配额,如需添加多挂机,请联系站长'));
    echo J($array);
    exit();
}

if($_GET['do']=='time'){
    $array=$login->servertime();
}
if($_GET['do']=='checkvc'){
    $array=$login->checkvc($_POST['user']);
}
if($_GET['do']=='sendcode'){
    $array=$login->sendcode($_POST['type'],$_POST['token'],$_POST['lurl'],$_POST['BAIDUID']);
}
if($_GET['do']=='login'){
    $array=$login->login($_POST['time'],$_POST['user'],$_POST['pwd'],$_POST['p'],$_POST['vcode'],$_POST['vcodestr']);
}
if($_GET['do']=='login2'){
    $array=$login->login2($_POST['type'],$_POST['token'],$_POST['lurl'],$_POST['BAIDUID'],$_POST['vcode']);
}
if($_GET['do']=='getvcpic'){
    header('content-type:image/jpeg');
    echo $login->getvcpic($_GET['vcodestr']);
    exit;
}
if($_GET['do']=='getphone'){
    $array=$login->getphone($_POST['phone']);
}
if($_GET['do']=='sendsms'){
    $array=$login->sendsms($_POST['phone'],$_POST['vcode'],$_POST['vcodestr'],$_POST['vcodesign']);
}
if($_GET['do']=='login3'){
    $array=$login->login3($_POST['phone'],$_POST['smsvc']);
}
if($_GET['do']=='getqrcode'){
    $array=$login->getqrcode();
}
if($_GET['do']=='qrlogin'){
    $array=$login->qrlogin($_POST['sign']);
}


if (!is_null($array['bduss']) && !is_null($array['stoken']) && !is_null($array['ptoken'])){
    if($db->get_row("select user from {$prefix}info where user='{$array['user']}' limit 1")){
        $db->query("update {$prefix}info set bduss = '{$array['bduss']}',zt=0,uid={$userrow->uid} where user = '{$array['user']}'");
        echo j($array);
    }elseif($db->query("insert into {$prefix}info (uid,userid,user,bduss,ptoken,stoken,addtime) values ('{$userrow->uid}','{$array['uid']}','{$array['user']}','{$array['bduss']}','{$array['ptoken']}','{$array['stoken']}','{$time}')")){
        echo j($array);
    }
}else{
    echo j($array);
}
