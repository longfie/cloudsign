<?php
namespace TF;
class TFcore
{
public static function ROOT()
{
   // $class = new TFcore;
  return dirname(dirname(dirname(__FILE__) . '/').'/').'/';
}
    
public static function Template($name)
{
   switch ($name)
    {
        case 'index':
        include self::ROOT().'Template/index/index.php';break;
        case 'index1':
        include self::ROOT().'Template/index/index1.php';break;
        case 'login':
        include self::ROOT().'Application/Enter/login.php';break;
        case 'reg':
        include self::ROOT().'Template/index/index2.php';break;
      
       default:include self::ROOT().'Others/404/index.html';
    }
    return 'TFNB';
}
public static function getBDinfo($BDUSS=NULL)
{
    $info = self::Curl('https://tieba.baidu.com/mg/o/profile?format=json','BDUSS='.$BDUSS);
    return json_decode($info,true);
}
public static function getBDinfos($BDUSS=NULL,$STOKEN=NULL)
{
   if($BDUSS!==NULL&&$STOKEN!==NULL) $infos = self::Curl('http://tieba.baidu.com/f/user/json_userinfo?qq-pf-to=pcqq.group','BDUSS='.$BDUSS.';STOKEN='.$STOKEN);
    return json_decode($infos,true);
}
public static function CSRF()
{
     if (empty($_SERVER['HTTP_REFERER'])) {
return true;
 }else {
     return false;
 }
}
public static function Curl($url,$cookie=null,$postdata=null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        if (!is_null($postdata)) curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
        if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
        'Host: tieba.baidu.com',
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0',
        'Accept: */*',
        'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3',
        'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
        'Referer: http://tieba.baidu.com/',
        'Connection: keep-alive',
    ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,3);
        $re = curl_exec($ch);
        curl_close($ch);
        return $re;
    }
public static function Get($url,$cookie=null){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    $re = curl_exec($ch);
    curl_close($ch);
    return $re;
}
/*public static function getUser()
{
    global $db,$userrow;
   return $db->get_var("select qq from tieba_user where uid = {$userrow->uid}");
}*/

}