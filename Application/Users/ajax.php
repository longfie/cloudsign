<?php
require_once('../core.php');
header('Content-Type:application/json');
/*if($_POST['reset']=='ok')
{
    
}*/

if(!is_null($_POST['webset'])){

		$db->query("insert into {$prefix}website set vkey='webset',value='".safestr($_POST['webset'])."' on duplicate key update value='".safestr($_POST['webset'])."'");
		echo J(array('code'=>200,'status'=>'ok'));
	}
if(!is_null($_POST['Music'])){

		$db->query("insert into {$prefix}website set vkey='Music',value='".safestr($_POST['Music'])."' on duplicate key update value='".safestr($_POST['Music'])."'");
		echo J(array('code'=>200,'status'=>'ok'));
	}
/*if(!is_null($_GET['webset'])){

		$db->query("insert into {$prefix}website set vkey='webset',value='".safestr($_GET['webset'])."' on duplicate key update value='".safestr($_GET['webset'])."'");
		echo J(array('code'=>200,'status'=>'ok'));
	}
*/