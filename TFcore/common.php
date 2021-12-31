<?php
/**
 * 一千零一夜云签系统
 * 作者：龙辉 QQ1790716272
 * 版本：V2.1 于2021在18年写的基础上进行重构
 */
//关闭报错
@error_reporting(E_ALL & ~E_NOTICE);

//设置时区
date_default_timezone_set("PRC");

//设置编码
header("Content-type: text/html; charset=utf-8");

//检测PHP版本
if(version_compare(PHP_VERSION, '7.0', '<')){
	die('require PHP > 7.0 !');
}

define('AUTHOR','LONGHUI'); //核心常量
define('TF_lH','1790716272');
define('TF_JW','17404785');
define('SYSTEM_ROOT', dirname(__FILE__) . '/');
define('ROOT', dirname(SYSTEM_ROOT) . '/');
define('VERSION', '2.1');
define('IN_CRONLITE', true);
require_once SYSTEM_ROOT .'config.php';//加载配置

//安装引导
if(!file_exists(SYSTEM_ROOT.'class_function/database.php') or !file_exists(SYSTEM_ROOT.'install/TFlock.lock')){
	@header("Location:/TFcore/install");
	exit;
}
if(Protect){
    require_once SYSTEM_ROOT .'class_function/ccprotect.php';
}
//加载天方WEB安全防护

require_once SYSTEM_ROOT .'class_function/TFsecure.php';


//加载数据库操作类

include_once SYSTEM_ROOT."class_ezmysql/ez_sql_core.php";
include_once SYSTEM_ROOT."class_ezmysql/ez_sql_mysqli.php";


$mysql = (require SYSTEM_ROOT . "class_function/database.php");

//加载核心功能库
include_once SYSTEM_ROOT."class_function/function.php";
include_once SYSTEM_ROOT."class_lib/TFcore.php";


//实例化数据库操作类
TF_Data($mysql);
$db = new ezSQL_mysqli(TF_Data('DB_USER'),TF_Data('DB_PWD'),TF_Data('DB_NAME'),TF_Data('DB_HOST').':'.TF_Data('DB_PORT'));
$prefix = TF_Data('DB_PREFIX');


//网站初始化
if ($rows = A($db->get_results("select * from {$prefix}website"))){
	foreach ($rows as $value) {
		$website[$value['vkey']] = $value['value'];
	}
	TF_Data($website);
}

//用户状态
$cookiesid = $_COOKIE['TF_token'];

if ($cookiesid && ($userrow = $db->get_row("select * from {$prefix}user where sid ='".$cookiesid."' limit 1"))) {
	TF_Data('login_state', $userrow->uid);
}

//核心文件编写完毕！
?>