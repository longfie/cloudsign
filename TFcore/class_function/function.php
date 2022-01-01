<?php
/**
 * 核心功能库
 */
 
function TF_Data($name = null, $value = null, $default = null){
	static $_config = array();
	// 无参数时获取所有
	if (empty($name)) {
		return $_config;
	}
	// 优先执行设置获取或赋值
	if (is_string($name)) {
		if (!strpos($name, '.')) {
			$name = strtoupper($name);
			if (is_null($value)) return isset($_config[$name]) ? $_config[$name] : $default;
			$_config[$name] = $value;
			return null;
		}
		// 二维数组设置和获取支持
		$name = explode('.', $name);
		$name[0] = strtoupper($name[0]);
		if (is_null($value)) return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
		$_config[$name[0]][$name[1]] = $value;
		return null;
	}
	// 批量设置
	if (is_array($name)) {
		$_config = array_merge($_config, array_change_key_case($name, CASE_UPPER));
		return null;
	}
	return null; // 避免非法参数
}

//生成随机字符串
function get_randstr($len = 12) {
	$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$strlen = strlen($str);
	$randstr = '';
	for ($i = 0;$i < $len;$i++) {
		$randstr.= $str[mt_rand(0, $strlen - 1) ];
	}
	return $randstr;
	//获取12位随机数据
}

//过滤危险字符
function safestr($str) {
	if (!get_magic_quotes_gpc()) {
		return addslashes($str);
	} else {
		return $str;
	}
}
//$url = (isHTTPS() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']; //获取域名
//判断是否是HTTPS
/*function isHTTPS()
{

    if (defined('HTTPS') && HTTPS) return true;
    if (!isset($_SERVER)) return FALSE;
    if (!isset($_SERVER['HTTPS'])) return FALSE;
    if ($_SERVER['HTTPS'] === 1) {  //Apache
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
        return TRUE;
    }
    return FALSE;
}
*/
function Domain()
{
    if (defined('HTTPS') && HTTPS) return 'https://'. $_SERVER['HTTP_HOST'].'/';
    if (!isset($_SERVER)) return 'http://'. $_SERVER['HTTP_HOST'].'/';
    if (!isset($_SERVER['HTTPS'])) return 'http://'. $_SERVER['HTTP_HOST'].'/';
    if ($_SERVER['HTTPS'] === 1) {  //Apache
        return 'https://'. $_SERVER['HTTP_HOST'].'/';
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
        return 'https://'. $_SERVER['HTTP_HOST'].'/';
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //其他
        return 'https://'. $_SERVER['HTTP_HOST'].'/';
    }
    return 'http://'. $_SERVER['HTTP_HOST'].'/';
}


function curl($url,$cookie=null){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    $re = curl_exec($ch);
    curl_close($ch);
    return $re;
}


function J($array=null)
{
if(is_array($array))
{
    return json_encode($array);
}
}

function showmsg($msg = '如果你看到此页面,说明系统正常运行中~by龙辉-QQ1790716272')
{
    echo <<<HTML
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>天方站点提示信息</title>
        <style type="text/css">
            html {
                background: #eee
            }

            body {
                background: #fff;
                color: #333;
                font-family: "微软雅黑", "Microsoft YaHei", sans-serif;
                margin: 2em auto;
                padding: 1em 2em;
                max-width: 700px;
                -webkit-box-shadow: 10px 10px 10px rgba(0, 0, 0, .13);
                box-shadow: 10px 10px 10px rgba(0, 0, 0, .13);
                opacity: .8
            }

            h1 {
                border-bottom: 1px solid #dadada;
                clear: both;
                color: #666;
                font: 24px "微软雅黑", "Microsoft YaHei", , sans-serif;
                margin: 30px 0 0 0;
                padding: 0;
                padding-bottom: 7px
            }

            #error-page {
                margin-top: 50px
            }

            h3 {
                text-align: center
            }

            #error-page p {
                font-size: 9px;
                line-height: 1.5;
                margin: 25px 0 20px
            }

            #error-page code {
                font-family: Consolas, Monaco, monospace
            }

            ul li {
                margin-bottom: 10px;
                font-size: 9px
            }

            a {
                color: #21759B;
                text-decoration: none;
                margin-top: -10px
            }

            a:hover {
                color: #D54E21
            }

            .button {
                background: #f7f7f7;
                border: 1px solid #ccc;
                color: #555;
                display: inline-block;
                text-decoration: none;
                font-size: 9px;
                line-height: 26px;
                height: 28px;
                margin: 0;
                padding: 0 10px 1px;
                cursor: pointer;
                -webkit-border-radius: 3px;
                -webkit-appearance: none;
                border-radius: 3px;
                white-space: nowrap;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                -webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0, 0, 0, .08);
                box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0, 0, 0, .08);
                vertical-align: top
            }

            .button.button-large {
                height: 29px;
                line-height: 28px;
                padding: 0 12px
            }

            .button:focus,
            .button:hover {
                background: #fafafa;
                border-color: #999;
                color: #222
            }

            .button:focus {
                -webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
                box-shadow: 1px 1px 1px rgba(0, 0, 0, .2)
            }

            .button:active {
                background: #eee;
                border-color: #999;
                color: #333;
                -webkit-box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5);
                box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5)
            }

            table {
                table-layout: auto;
                border: 1px solid #333;
                empty-cells: show;
                border-collapse: collapse
            }

            th {
                padding: 4px;
                border: 1px solid #333;
                overflow: hidden;
                color: #333;
                background: #eee
            }

            td {
                padding: 4px;
                border: 1px solid #333;
                overflow: hidden;
                color: #333
            }
        </style>
    </head>

    <body id="error-page">
    <h3>站点提示信息</h3>
    {$msg}
    </body>

    </html>
HTML;
}


function GET($key = null)
{
    if(isset($_GET[$key])){
        $str = $_GET[$key];
        //特殊字符的过滤方法
        return safestr($str);
    }else{
        return null;
    }
}
function A($array){
    if(is_object($array)){
        $array = (array)$array;
    }
    if(is_array($array)){
        foreach($array as $key=>$value){
            $array[$key] = A($value);
        }
    }
    return $array;
}
//计算该字段数量数量
function get_count($table, $where = '1=1', $key = '*') {
	global $db;
    global $prefix;
	$row = A($db->get_row("select count({$key}) as count from {$prefix}{$table} where {$where}"));
	$count = $row['count'];
	return $count;
	//计数
}




//获取百度头像
function get_user_avatar($cookie)  //author : 一千零一夜 百度2020年更新 已经失效
	{
		$tbs_url = 'http://tieba.baidu.com/';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept','text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9','Accept-Encoding','Accept-Encoding','Accept-Language','zh-CN,zh;q=0.9','Cache-Control','max-age=0','Connection','keep-alive','Host','tieba.baidu.com','User-Agent','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4651.0 Safari/537.36','Upgrade-Insecure-Requests','1','Sec-Fetch-User','?1','Sec-Fetch-Site','none','Sec-Fetch-Mode','navigate','Sec-Fetch-Dest','document','sec-ch-ua-platform','"Windows"'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE,'BDUSS= BDUSS=URjOWtHdURtY2pvZ1FxZkNwenlORWNSTFdPYTVNSlNpbXZhNHhyUU0tTUROOE5oRVFBQUFBJCQAAAAAAAAAAAEAAAB5yumpx-PM~V-2ZcmiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOqm2EDqpthe;STOKEN=d753931a67edf41d7077931a25f425d3a9097becbe90c2aa061c01199c77e129;  ');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$passport_html = curl_exec($ch);
		curl_close($ch);
		$regex = '/\<img class\=\"head_img\" src\=\"(.*?)\"\>/';
		preg_match($regex,$passport_html,$baidu_avatar);
		return $baidu_avatar;
	}

//获取吧数
function get_user_tbnum($cookie)  //author : 一千零一夜 百度2020年更新 已经失效
	{
		$tbs_url = 'http://tieba.baidu.com/f/like/mylike?red_tag=d0481906941';
		$ch = curl_init($tbs_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept','text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9','Accept-Encoding','Accept-Encoding','Accept-Language','zh-CN,zh;q=0.9','Cache-Control','max-age=0','Connection','keep-alive','Host','tieba.baidu.com','User-Agent','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4651.0 Safari/537.36','Upgrade-Insecure-Requests','1','Sec-Fetch-User','?1','Sec-Fetch-Site','none','Sec-Fetch-Mode','navigate','Sec-Fetch-Dest','document','sec-ch-ua-platform','"Windows"'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE,'BDUSS=');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$html = curl_exec($ch);
		curl_close($ch);
		$regex = '/<a href="\/f\/like\/mylike\?&pn=(\d+)">.*<\/a>/i';//匹配所有A标签';
		preg_match_all($regex,$html,$tbnum);
		return $html;
	}
function send_url($url,$cookie){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
		$html = curl_exec($ch);
		curl_close($ch);
		return $html;
}
		
function duo_curl($urls) {

	$ua='Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36';

	$queue = curl_multi_init(); 

	$map = array();

	foreach ($urls as $url) { 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_TIMEOUT,1); 
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL, true); 
		curl_multi_add_handle($queue, $ch); 
		$map[(string) $ch] = $url; 
	}
	$responses = array(); 
	do { 
		while (($code = curl_multi_exec($queue, $active)) == CURLM_CALL_MULTI_PERFORM) ; 
		if ($code != CURLM_OK) { break; } 
		while ($done = curl_multi_info_read($queue)) { 
			$info = curl_getinfo($done['handle']); 
			$error = curl_error($done['handle']); 
			$results = curl_multi_getcontent($done['handle']);
			$responses[$map[(string) $done['handle']]] = compact('info', 'error', 'results'); 
			curl_multi_remove_handle($queue, $done['handle']); 
			curl_close($done['handle']); 
		}
		if ($active > 0) { 
			curl_multi_select($queue, 0.5); 
		} 
	} while ($active);
	curl_multi_close($queue); 
	return $responses; 
}


function duo_curls($urls) {

	$ua='Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36';

	$queue = curl_multi_init(); 

	$map = array();

	foreach ($urls as $url) { 
	    

		$ch = curl_init(); 
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
	curl_setopt($ch,CURLOPT_TIMEOUT,1);
	curl_setopt($ch,CURLOPT_NOBODY,1);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_AUTOREFERER,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		curl_multi_add_handle($queue, $ch); 
		$map[(string) $ch] = $url; 
	}
	$responses = array(); 
	do { 
		while (($code = curl_multi_exec($queue, $active)) == CURLM_CALL_MULTI_PERFORM) ; 
		if ($code != CURLM_OK) { break; } 
		while ($done = curl_multi_info_read($queue)) { 
			$info = curl_getinfo($done['handle']); 
			$error = curl_error($done['handle']); 
			$results = curl_multi_getcontent($done['handle']);
			$responses[$map[(string) $done['handle']]] = compact('info', 'error', 'results'); 
			curl_multi_remove_handle($queue, $done['handle']); 
			curl_close($done['handle']); 
		}
		if ($active > 0) { 
			curl_multi_select($queue, 0.5); 
		} 
	} while ($active);
	curl_multi_close($queue); 
	return $responses; 
}







function get_url($url_array, $wait_usec = 0)
{

    if (!is_array($url_array))
        return false;
    $wait_usec = intval($wait_usec);
    $data    = array();
    $handle  = array();
    $running = 0;
    $mh = curl_multi_init(); // multi curl handler
    $i = 0;
    foreach($url_array as $url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return don't print
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
	    curl_setopt($ch, CURLOPT_NOSIGNAL, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
        curl_setopt($ch, CURLOPT_MAXREDIRS, 7);
        curl_multi_add_handle($mh, $ch); // 把 curl resource 放进 multi curl handler 里
        $handle[$i++] = $ch;
    }
    /* 执行 */
    do {
        curl_multi_exec($mh, $running);
        if ($wait_usec > 0) /* 每个 connect 要间隔多久 */
            usleep($wait_usec); // 250000 = 0.25 sec
    } while ($running > 0);
    /* 读取资料 */
    foreach($handle as $i => $ch) {
        $content  = curl_multi_getcontent($ch);
        $data[$i] = (curl_errno($ch) == 0) ? $content : false;
    }
    /* 移除 handle*/
    foreach($handle as $ch) {
        curl_multi_remove_handle($mh, $ch);
    }
    curl_multi_close($mh);
    return $data;
}


//判断是否是管理员
function isadmin($admin){
	if($admin==1){
		return true;
	}else{
		return false;
	}
}

	function fetch($url,$cookie=null,$postdata=null,$header=array()){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	if (!is_null($postdata)) curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
	if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
	if (!empty($header)) curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	//curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$re = curl_exec($ch);
	curl_close($ch);
	return $re;
}
	
//获取站点运行天数
function site_time($time){
	$Date_1 = date("Y-m-d");  //天数计算公式  1小时3600秒 一天24小时  一天86400  当前时间戳-数据库时间戳/86400 = day  or /3600/24
	$Date_2 = $time;
	$d1 = strtotime($Date_1);
	$d2 = strtotime($Date_2);
	$Days = round(($d1-$d2)/3600/24);
	return $Days;
	
}
