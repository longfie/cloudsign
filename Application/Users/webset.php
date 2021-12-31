<?php
use TF\TFcore;
require_once('../core.php');
if(!TF_Data('login_state')){
    
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
if(!isadmin($userrow->uid)){showmsg('这不是你该来的地方~我想你可能是走错地方了<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');exit();}
if(TFcore::CSRF()){showmsg("CSRF防御,如有疑问请联系站长");exit;}
if($_POST['webset']=='ok'){
	foreach($_POST as $k=> $value){
		$db->query("insert into {$prefix}website set vkey='".safestr($k)."',value='".safestr($value)."' on duplicate key update value='".safestr($value)."'");
	}
    showmsg('修改成功<a href="#" onclick="javascript:history.back(-1);">点击返回</a>');
    exit;
}


?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>首页 - <?=TF_Data('name');?></title>
    <link rel="icon" href="<?=$Userstatic.'images/';?>favicon.ico" type="image/ico">
    <meta name="keywords" content="<?=TF_Data('keywords');?>">
    <meta name="description" content="<?=TF_Data('description');?>">
    <meta name="author" content="<?=AUTHOR;?>">
    <link href="<?=$Userstatic;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?=$Userstatic;?>css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid p-t-15">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <ul class="nav nav-tabs page-tabs">
                        <li class="active"> <a href="#!">网站设置</a> </li>
                        <li> <a href="noticeset.php">公告设置</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <form action="?" method="post" class="edit-form">
                                <input type="hidden" name="webset" value="ok">
                                <div class="form-group">
                                    <label for="web_site_title">网站标题</label>
                                    <input class="form-control" type="text" id="web_site_title" name="name"
                                        value="<?=TF_Data('name')?>" placeholder="请输入站点标题">
                                </div>
                                <div class="form-group">
                                    <label for="web_site_description">站点描述</label>
                                    <input class="form-control" id="web_site_description" rows="5"
                                        name="web_site_description" name="describe"
                                        value="<?=TF_Data('describe')?>"
                                        placeholder="请输入站点描述"></textarea>
                                    <small class="help-block">网站描述，有利于搜索引擎抓取相关信息</small>
                                </div>
                                <div class="form-group">
                                    <label for="web_site_copyright">站点域名</label>
                                    <input class="form-control" type="text" id="web_site_url"
                                        value="<?=Domain();?>">
                                </div>
                                <div class="form-group">
                                    <label for="web_site_copyright">站长QQ</label>
                                    <input class="form-control" type="text" id="web_site_url" 
                                        value="<?=TF_Data('qq')?>" name="qq" placeholder="请输入站长QQ">
                                </div>
                                <div class="form-group">
                                    <label for="web_site_copyright">监控秘钥</label>
                                    <input class="form-control" type="text" id="web_site_url"
                                        value="<?=TF_Data('cron')?>" name="cron" placeholder="请输入监控秘钥">
                                </div>
                                <div class="form-group">
                                    <label for="web_site_copyright">模板选择</label>
                                    <input class="form-control" type="text" id="web_site_url"
                                        value="<?=TF_Data('template')?>" name="template" placeholder="目前只有两套">
                                        <small class="help-block">目前只有两套,请填<code>index或index1</code></small>
                                </div>
                                <div class="form-group">
                                    <label for="web_site_icp">备案信息</label>
                                    <input class="form-control" type="text" id="web_site_icp" name="Icp"
                                        value="<?=TF_Data('Icp')?>" placeholder="请输入备案信息">
                                </div>
                                <div class="form-group">
                                    <label class="btn-block" for="web_site_status">音乐开关</label>
                                    <label class="lyear-switch switch-solid switch-primary" id="getchecked">
                                        <input type="checkbox" name="c"<? if(TF_Data('Music')==1){?> value="0"<?}else{?>value="1"<?}?>>
                                        <span></span>
                                    </label>
                                    <small class="help-block">关闭后首页将不播放音乐</small>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary m-r-5">确 定</button>
                                    <button type="button" class="btn btn-default"
                                        onclick="javascript:history.back(-1);return false;">返 回</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
    <script>
        $('#getchecked').click(function() {
        let name = $('input[name="c"]:checked').val();
         let Music = 1
        if(name === 1){
           return Music = 0
        }else if(name === undefined){
           return Music = 1
        }
        $.ajax({
            type:'post',
            url:'./ajax.php',
            data:{Music},
            success:res=>{
                console.log(res)
            }
        })
    })
    </script>
</body>

</html>