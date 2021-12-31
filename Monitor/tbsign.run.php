<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/29 21:25
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


include('core.php');
include('tb.signclass.php');
if (!defined('AUTHOR')){
exit('请不要直接访问该页面!');
}

$bduss=$_GET['bduss']??exit('Not bduss');
$uid = $db->get_row("select uid,tbnum,query,nlock from {$prefix}info where bduss='{$bduss}'");
if(is_null($uid)){
showmsg('非法提交');exit;
}
if(date('H')==00)//假装实现自动刷新贴吧...
{
   $db->query("update {$prefix}info set nlock = '0',tbnum='0' where bduss ='{$bduss}'");
}
$tbsign = new tbsign($bduss);
$inf0 = $db->get_row("select mail,qq from {$prefix}user where uid='{$uid->uid}'");



$signrate=0.5;//对用户所有的号而言,签到频率 单位小时 建议2

if($uid->nlock==1)
{
    $nextsigntime = date("Y-m-d H:i:s",time()+60*60*1.5);
}else
{
    $nextsigntime = date("Y-m-d H:i:s",time()+60*60*$signrate);
}
try {

if ($tbsign->loginstate()===0){
$db->query("update {$prefix}info set zt = '1' where bduss ='{$bduss}'");

if(is_null($inf0->mail))send_mail($inf0->mail,3);else send_mail($inf0->qq.='@qq.com',3);


showmsg('状态已经失效');exit;


}

} catch (Exception $e) {

showmsg($e->getMessage());

}
//数据库轮询

//$tbnum = $tbsign->allsign(1);
// 开始签到
ignore_user_abort(true);
set_time_limit(0);
if(($uid->query)<=ceil(($uid->tbnum)/100))
{
if($uid->query==0)
$tbnum = $tbsign->allsign();
else
$tbnum = $tbsign->allsign($uid->query);
if($uid->tbnum<=99)
$db->query("update {$prefix}info set query=1 where bduss='{$bduss}'");
else
    $db->query("update {$prefix}info set query=query+1 where bduss='{$bduss}'");
}else
{
$db->query("update {$prefix}info set query=0 where bduss='{$bduss}'");
}
if(is_array($tbnum)&&$uid->nlock==0&&$tbnum['tbnum']!=0)
{
$db->query("update {$prefix}info set tbnum=tbnum+{$tbnum['tbnum']},nlock=1 where bduss='{$bduss}'");
}else if(is_numeric($tbnum)&&$uid->nlock==0)
{
$db->query("update {$prefix}info set tbnum=tbnum+{$tbnum} where bduss='{$bduss}'");
}
if($tbnum)
{
$db->query("update {$prefix}user set signtime = '{$nextsigntime}' where uid ='{$uid->uid}'");
$db->query("update {$prefix}info set run = '{$nextsigntime}' where bduss ='{$bduss}'");
var_dump($tbnum);
    
}


//$state = $tbsign->allsign();
/*if ($state>0)
{

$etime=microtime(true);//获取程序执行结束的时间
$total=$etime-$stime;   //计算差值
echo $total.'s';
// $db->query("update {$prefix}info set tbnum = '{$state}' where bduss ='{$bduss}'");
// showmsg('本次任务执行完毕.author:龙辉');
var_dump($state);
}

*/

//               代码加载完毕,就是如此简单 ︿(￣︶￣)︿