<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/30 17:09
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

//加载核心文件
require_once('../core.php');
//qq登录操作

$qqkey = safestr($_GET['qqkey']);
$qqname = base64_decode(safestr($_GET['nickname']));

if (TF_Data('login_state') && $qqkey !== '') {
    header('location:https://blog.eirds.cn/qqlogin/oauth/?callback='.Domain().'Application/Enter/qqlogin.php');
    if ($row = $db->get_row("select * from {$prefix}user where uid='{$userrow->uid}' limit 1")) {
        if ($row->qqkey == null) {
            $db->query("update {$prefix}user set qqkey='{$qqkey}' where uid='{$userrow->uid}'");
            header('location:'.Domain().'Application/Users/');
        }
    }

}
$sid = md5(get_randstr(4) . uniqid() . rand(1, 1000));
$time = date("Y-m-d H:i:s");
if ($qqkey == "" && $qqname == "") {
    header('location:https://blog.eirds.cn/qqlogin/oauth/?callback='.Domain().'Application/Enter/qqlogin.php');
} else if ($row = $db->get_row("select * from {$prefix}user where qqkey='{$qqkey}' limit 1")) {
    echo '登录成功,等待跳转返回.';
    $db->query("update {$prefix}user set sid='{$sid}',lasttime='{$time}' where uid='{$row->uid}'");
    setcookie("TF_token", $sid, time() + 3600 * 24 * 7, '/');
    header('location:'.Domain().'Application/Users/');
} elseif (!$row = $db->get_row("select * from {$prefix}user where qqkey='{$qqkey}' limit 1")) {
    $pwd = md5(get_randstr(3).rand(1,500));
    $qqname = is_null($qqname)?get_randstr(2).rand(1,100):$qqname;
    $db->query("insert into {$prefix}user (qqkey,user,sid,regtime,lasttime,pwd)values('$qqkey','$qqname','$sid','$time','0000-00-00','$pwd')");
    echo '登录成功,等待跳转返回.';
    $db->query("update {$prefix}user set sid='{$sid}',lasttime='{$time}' where uid='{$row->uid}'");
    setcookie("TF_token", $sid, time() + 3600 * 24 * 7, '/');
    header('location:'.Domain().'Application/Users/');
}



//               代码加载完毕,就是如此简单 ︿(￣︶￣)︿