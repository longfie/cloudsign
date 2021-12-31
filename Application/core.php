<?php
require_once(dirname(dirname(__FILE__)).'/TFcore/common.php');

define('JSON','true');
$Userstatic = Domain().'Static/Users/';

//判断是否登录
/*if(TF_Data('login_state')){

	showmsg('登录');
    //exit;
    //exit("<script language='javascript'>window.location.href='/Template/Login.html';</script>");
}
*/

/*if($db->get_var("select user from {$prefix}user where uid=1"))
{
    showmsg('登录成功');

}*/
//判断是否被封禁
if($db->get_var("select active from {$prefix}user where uid='{$userrow->uid}'")==1)exit("<script language='javascript'>alert('您的账号已被封禁，请联系管理员。');window.location.href='/';</script>");

