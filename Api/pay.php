<?php


//天方云签充值api 国防部级别
//如果你看到这个文件并且会使用,再删除注释
/*
if($_GET['key']=='123456'){}
else exit;
include_once("../TFcore/common.php");
include_once("../TFcore/class_lib/crypt.php");



$uid = $_GET['uid'];

$money = $_GET['money'];

if(!empty($uid)){
	$uid = Mcrypt::decode($uid,'longankang520');
}else{
	exit;
}


$user = $db->get_row("select * from {$prefix}user where uid={$uid}");
$mail = $user->mail;
if(!$mail){
	$mail = trim($user->qq.'@qq.com');
}
if($user->quota<=2){
	$month = $money  / 2 ;
}else if($user->quota>2){

$month = $money / $user->quota ;
$month  = sprintf("%.3f", $month); // 取小数点三位并且四舍五入
//var_dump($month);
}

	if($user->vip==1 && $user->vipendtime>time()){
	$time = $user->vipendtime + 24*60*60*30*$month; //充值后最后的到期时间
$db->query("update {$prefix}user set vipendtime='$time' where uid = '$uid'");

curl(Domain().'/Api/sendmail.php?usermail='.$mail.'&body=4&key=TF_Data('cron')');

}else if($user->vip==1 && $user->vipendtime<=time()){
	$time = time()+ 24*60*60*30*$month;

	$db->query("update {$prefix}user set vipendtime='$time' where uid = '$uid'");

	curl(Domain().'/Api/sendmail.php?usermail='.$mail.'&body=4');

}else{
	$time = time()+ 24*60*60*30*$month;
		
		$db->query("update {$prefix}user set vip = '1',vipendtime='$time' where uid = '$uid'");
		curl(Domain().'/Api/sendmail.php?usermail='.$mail.'&body=4');
		
		exit;
}*/