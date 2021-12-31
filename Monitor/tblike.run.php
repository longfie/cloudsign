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
$bduss=$_GET['bduss']??exit('Not bduss');
$kw=$_GET['kw']??exit('Not kw');

$uid = $db->get_var("select uid from {$prefix}info where bduss='{$bduss}'");
if(is_null($uid)){
    showmsg('非法提交');exit;
}
$tblike = new Tblike($kw,$bduss);



try {
  
 
   
if($tblike->like()){
    echo json_encode(['code'=>200,'message'=>'关注成功']);
}else{
    echo json_encode(['code'=>500,'message'=>'关注失败']);
}
   
} catch (Exception $e) {

showmsg($e->getMessage());exit;

}




//               代码加载完毕,就是如此简单 ︿(￣︶￣)︿