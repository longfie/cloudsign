<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/30 15:19
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
include_once('core.php');
ignore_user_abort(true);
set_time_limit(0);

$get_vip_all = $db->get_results("select uid,quota,vipendtime,mail,qq from {$prefix}user where vip='1' and (`signtime`<NOW() or `signtime` IS NULL) order by uid limit 20");
/*$get_vip_all = $db->get_results("select uid,quota,vipendtime,mail,qq from {$prefix}user where vip='1' and (`signtime`<NOW() or `signtime` IS NULL) order by uid limit 50 ");*/
foreach($get_vip_all as $row){
 

    if($row->vipendtime<time()){
        // if(is_null($row->mail))send_mail($row->qq.='@qq.com',2);else send_mail($row->mail,2);
         if(!is_null($row->mail))send_mail($row->mail,2);else send_mail($row->qq.='@qq.com',2);
        $db->query("update {$prefix}user set vip = '0' where uid = '{$row->uid}'");
    }
    $get_bduss[] = $db->get_results("select bduss from {$prefix}info where uid='{$row->uid}' and zt=0 and (`run`<NOW() or `signtime` IS NULL)");

}

foreach($get_bduss as $value){
if(is_array(A($value))) {
    foreach (A($value) as $bduss) {
       // print_r($bduss);
         $urls[]=Domain().'Monitor/tbsign.run.php?key='.$key.'&bduss='.$bduss['bduss'];
    }
}
}
if($urls){
//多线程提交
//showmsg(print_r($urls));
    duo_curls($urls);
   // get_url($urls);
    var_dump(count($urls));
showmsg('本次任务执行完毕。author:龙辉');
}else{
    showmsg();
}


//               代码加载完毕,就是如此简单 ︿(￣︶￣)︿