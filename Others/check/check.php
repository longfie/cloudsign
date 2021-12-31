<?php
require_once dirname(__FILE__).'/TnCode.class.php';
$tn  = new TnCode();
if($tn->check()){
	$_SESSION['TFcode'] = 'ok';
    $_SESSION['TFcodetime']=time()+120;//验证码有效时间
    echo "ok";
}else{
	$_SESSION['TFcode'] = 'error';
    echo "error";
}

?>
