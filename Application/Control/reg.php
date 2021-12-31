<?php
/**
 * 天方夜谭
 */
//加载核心文件
session_start();
require_once('../core.php');
if($_SESSION['TFcodetime']<time()){
    unset($_SESSION['TFcode']);
    unset($_SESSION['TFcodetime']);
}
//用户注册
if($_POST['reg']=='ok'){
	//session_start();
	header('Content-Type:application/json');
	$user = safestr($_POST['user']);
	$qq = safestr($_POST['qq']);
	$pwd = safestr($_POST['pwd']);
	// $code = safestr($_POST['code']);
	$sid=md5(get_randstr(4).uniqid().rand(1,1000));
	$time = date("Y-m-d H:i:s");
	$date=time()+3600*24*3;
	if($user=="" || $qq=="" || $pwd==""){
		$output = array('status' => 1,'msg' => '所有项不能为空！');
	}else if(strlen($user) < 5){
		$output = array('status' => 1,'msg' => '用户名太短！');
	}elseif(strlen($user) > 10){
		$output = array('status' => 1,'msg' => '用户名不能太长！');
	}else if(strlen($qq) < 5){
		$output = array('status' => 1,'msg' => '没有小于5位数的QQ！');
	}elseif(strlen($qq) > 11){
		$output = array('status' => 1,'msg' => 'QQ号没有11位以上的！');
	}else if(strlen($pwd) < 5){
		$output = array('status' => 1,'msg' => '密码太短！');
	}else if(strlen($pwd) > 18){
		$output = array('status' => 1,'msg' => '密码不能太长！');
	}
	else if($row_user = $db->get_row("select user from {$prefix}user where user='{$user}' limit 1")){
		$output = array('status' => 1,'msg' => '该用户名已被其他用户注册，换一个吧！');
	}else if($db->get_row("select qq from {$prefix}user where qq='{$qq}' limit 1")){
		$output = array('status' => 1,'msg' => '此QQ号已被注册，换一个吧！');
	}else{
	   if ($_SESSION['TFcode']=='ok')
       {
           $pwd=md5(md5($pwd).md5(TF_JW));
           if($db->query("insert into {$prefix}user (user,pwd,sid,qq,regtime,lasttime)values('$user','$pwd','$sid','$qq','$time','0000-00-00')")){
               $output = array('status' => 0,'msg' => '注册成功！您的账号为：'.$user.'');
               $db->query("update {$prefix}user set vip = '1',vipendtime='{$date}' where user = '$user'");
           }else{
               $output = array('status' => 1,'msg' => '注册失败！出现了未知错误,请联系站长');
           }

       }else{
           $output = array('status' => 1,'msg' => '表哥别慌.请先完成滑块验证噢~！');

       }



	}
	echo J($output);
}