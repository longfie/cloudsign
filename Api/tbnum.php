<?php

include_once("../TFcore/common.php");
include_once(ROOT.'/TFcore/class_expand/bug/phpQuery.php');
include_once(ROOT.'/TFcore/class_expand/bug/QueryList.php');
use QL\QueryList;

ignore_user_abort(true);
set_time_limit(0);



$url='http://tieba.baidu.com/home/main?un='.'这里填贴吧名称';
$html = curls($url);

function curls($url)   
{   
    $ch = curl_init();   
    curl_setopt($ch, CURLOPT_URL, $url);            //设置访问的url地址   
    //curl_setopt($ch,CURLOPT_HEADER,1);            //是否显示头部信息   
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);           //设置超时   
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);      //跟踪301   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    //https请求不验证证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    //https请求不验证hosts   
    $r = curl_exec($ch);   
    curl_close($ch);   
    return $r;   
}  
    $data = QueryList::Query($html, array(
        'image' => array('.userinfo_left_head>a>img', 'src')
    ))->getData(function ($item) {
        return $item['image'];
    });
  $result =  $data[0];
  var_dump($result);

 

//               代码加载完毕,就是如此简单 ︿(￣︶￣)︿