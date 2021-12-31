<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/16 16:53
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

session_start();
//加载核心文件
require_once('../core.php');
if($_SESSION['TFcodetime']<time()){
    unset($_SESSION['TFcode']);
    unset($_SESSION['TFcodetime']);
}
    header('Content-Type:application/json');
//用户登录
if($_POST['login']=='ok'){
	header('Content-Type:application/json');
	$user = safestr($_POST['user']);

	$pwd = safestr($_POST['pwd']);

	$sid = md5(get_randstr(4).uniqid().rand(1,1000));

	$time = date("Y-m-d H:i:s");

	if(empty($user)){

		$output = array('status' => 1,'msg' => '账号不能为空！');

    }else if(empty($pwd)){

		$output = array('status' => 1,'msg' => '密码不能为空！');

    }else if($db->get_var("select active from {$prefix}user where user='{$user}' limit 1")==1){

		$output = array('status' => 1,'msg' => '您的账号已被停用！请联系管理员');

    }else{

        if($_SESSION['TFcode']=='ok'){
            $pwd = md5(md5($pwd).md5(TF_JW));

            if($row=$db->get_row("select uid,user from {$prefix}user where user='{$user}' and pwd='{$pwd}' limit 1")){

                $db->query("update {$prefix}user set sid='{$sid}',lasttime='{$time}' where uid='{$row->uid}'");

                setcookie("TF_token",$sid,time()+3600*24*14,'/');

                $output = array('status' => 0,'msg' => '登录成功，尊敬的'.$row->user.'欢迎您回来！');

            }else{

                $output = array('status' => 1,'msg' => '登录失败，账号或密码错误！');


            }


        }else{
            $output = array('status' => 1,'msg' => '表哥别慌.请先完成滑块验证噢~！');
        }

	}
	echo J($output);
}
