<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/29 21:16
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

include_once("../TFcore/common.php");


$key=$_GET['key']??exit('qq'.TF_lH);

if($key!==TF_Data('cron')){
    showmsg('author:'.$key.'---监控密匙错误');
    exit;
}
function send_mail($usermail=null,$body=null):int
{
   
    if(curl(Domain().'Api/sendmail.php?usermail='.$usermail.'&body='.$body.'&key='.TF_Data('cron')) && filter_var($usermail, FILTER_VALIDATE_EMAIL))
    {
        return 1;
    }else {
        return 0;
    }
    
}

spl_autoload_register(function ($classname) {
 
 require_once($classname.'.php');

});

//               代码加载完毕,就是如此简单 ︿(￣︶￣)︿