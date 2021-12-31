<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/16 16:55
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
require_once('../core.php');
if(!defined('AUTHOR'))
{
exit('我猜这肯定不是你想走的地方~');
}
require_once ('head.php');
//判断是否登录

if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
//请尽量让用户填写QQ，以便进行通知
if(!$db->get_var("select qq from {$prefix}user where uid ={$userrow->uid}")){
   
    showmsg('为了你能使用更多的功能,如一键关注,失效提醒，机器人查看状态等,请先填写你的QQ和邮箱噢~~<a href="modify.php">点此进入</a>');
   
    exit;
}
?>


<body data-logobg="color_7" data-headerbg="color_7" data-sidebarbg="color_7">
<div class="lyear-layout-web" >
    <div class="lyear-layout-container">
        <!--左侧导航-->
        <aside class="lyear-layout-sidebar">

            <!-- logo -->
            <div id="logo" class="sidebar-header">
                <a href="index.php"><img src="<?=$Userstatic;?>images/logo-sidebar.png" title="LightYear" alt="LightYear" /></a>
            </div>
            <div class="lyear-layout-sidebar-scroll">

                <nav class="sidebar-main">
                    <ul class="nav nav-drawer">
                        <li class="nav-item active"> <a class="multitabs" href="main.php"><i class="mdi mdi-home"></i>
                                <span>后台首页</span></a> </li>
                        <li class="nav-item nav-item-has-subnav">
                            <a href="javascript:void(0)"><i class="mdi mdi-account"></i> <span>用户中心</span></a>
                            <ul class="nav nav-subnav">
                                <li> <a class="multitabs" href="information.php">我的资料</a> </li>
                                <li> <a class="multitabs" href="modify.php">修改资料</a> </li>
                                 <li> <a class="multitabs" href="baseset.php">基础设置</a> </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-has-subnav">
                            <a href="javascript:void(0)"><i class="mdi mdi-robot"></i> <span>挂机管理</span></a>
                            <ul class="nav nav-subnav">
                                <li class="nav-item nav-item-has-subnav">
                                    <a href="#!">添加挂机</a>
                                    <ul class="nav nav-subnav">
                                        <li> <a class="multitabs" href="add.php">短信验证码登录</a> </li>
                                        <li> <a class="multitabs" href="add1.php">扫码登录</a> </li>
                                        <li> <a class="multitabs" href="add2.php">账号密码登录</a> </li>
                                        <li> <a class="multitabs" href="add3.php">QQ扫码登录</a> </li>
                                        <li> <a class="multitabs" href="add4.php">微信扫码登录</a> </li>
                                        <li> <a class="multitabs" href="addbduss.php">手动导入BDUSS</a> </li>
                                    </ul>
                                </li>
                                <li> <a class="multitabs" href="tasklist.php">我的挂机</a> </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-has-subnav">
                            <a href="javascript:void(0)"><i class="mdi mdi-cart"></i> <span>在线商城</span></a>
                            <ul class="nav nav-subnav">
                                <li> <a class="multitabs" href="pay.php">在线充值</a> </li>
                                <li> <a class="multitabs" href="paycard.php">卡密充值</a> </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-has-subnav">
                            <a href="javascript:void(0)"><i class="mdi mdi-view-grid"></i> <span>其他功能</span></a>
                            <ul class="nav nav-subnav">
                                <li> <a class="multitabs" href="wyy.php">网易云打卡</a> </li>
                                <li> <a class="multitabs" href="#">B站挂机</a> </li>
                                <li> <a class="multitabs" href="#">小米论坛签到</a> </li>
                            </ul>
                        </li>
                      <? if(isadmin($userrow->uid)){?>  <li class="nav-item nav-item-has-subnav">
                            <a href="javascript:void(0)"><i class="mdi mdi-settings"></i> <span>系统设置</span></a>
                            <ul class="nav nav-subnav">
                                <li> <a class="multitabs" href="webset.php">网站设置</a> </li>
                                <li> <a class="multitabs" href="webuser.php">用户管理</a> </li>
                                <li> <a class="multitabs" href="usertask.php">挂机管理</a> </li>
                                <li> <a class="multitabs" href="cardset.php">卡密管理</a> </li>
                                <li> <a class="multitabs" href="payrecord.php">交易记录</a> </li>
                                <li> <a class="multitabs" href="paycenter.php">充值中心</a> </li>
                                <li> <a class="multitabs" href="robot.php">机器人中心</a> </li>
                                
                            </ul>
                        </li><?}?>
                    </ul>
                </nav>

                <div class="sidebar-footer">
                    <p class="copyright">Copyright &copy; 2021. <a target="_blank" href="<?=Domain();?>">天方云签到</a>
                    </p>
                </div>
            </div>

        </aside>
        <!--End 左侧导航-->

        <!--头部信息-->
        <header class="lyear-layout-header">

            <nav class="navbar navbar-default">
                <div class="topbar">

                    <div class="topbar-left">
                        <div class="lyear-aside-toggler">
                            <span class="lyear-toggler-bar"></span>
                            <span class="lyear-toggler-bar"></span>
                            <span class="lyear-toggler-bar"></span>
                        </div>
                    </div>

                    <ul class="topbar-right">
                        <li class="dropdown dropdown-profile">
                            <a href="javascript:void(0)" data-toggle="dropdown">
                                <img class="img-avatar img-avatar-48 m-r-10" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$userrow->qq?>>&spec=100" alt="天方云签" />
                                <span><?=$userrow->user?> <span class="caret"></span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li> <a class="multitabs" data-url="information.php" href="javascript:void(0)"><i
                                            class="mdi mdi-account"></i> 个人信息</a> </li>
                                <li> <a class="multitabs" data-url="modify.php" href="javascript:void(0)"><i
                                            class="mdi mdi-lock-outline"></i> 修改密码</a> </li>
                                <li> <a href="javascript:void(0)"><i class="mdi mdi-delete"></i> 清空缓存</a></li>
                                <li class="divider"></li>
                                <li> <a href="loginout.php"><i class="mdi mdi-logout-variant"></i> 退出登录</a> </li>
                            </ul>
                        </li>
                        <!--切换主题配色-->
                        <li class="dropdown dropdown-skin">
                            <span data-toggle="dropdown" class="icon-palette"><i class="mdi mdi-palette"></i></span>
                            <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
                                <li class="drop-title">
                                    <p>LOGO</p>
                                </li>
                                <li class="drop-skin-li clearfix">
                    <span class="inverse">
                      <input type="radio" name="logo_bg" value="default" id="logo_bg_1" checked>
                      <label for="logo_bg_1"></label>
                    </span>
                                    <span>
                      <input type="radio" name="logo_bg" value="color_2" id="logo_bg_2">
                      <label for="logo_bg_2"></label>
                    </span>
                                    <span>
                      <input type="radio" name="logo_bg" value="color_3" id="logo_bg_3">
                      <label for="logo_bg_3"></label>
                    </span>
                                    <span>
                      <input type="radio" name="logo_bg" value="color_4" id="logo_bg_4">
                      <label for="logo_bg_4"></label>
                    </span>
                                    <span>
                      <input type="radio" name="logo_bg" value="color_5" id="logo_bg_5">
                      <label for="logo_bg_5"></label>
                    </span>
                                    <span>
                      <input type="radio" name="logo_bg" value="color_6" id="logo_bg_6">
                      <label for="logo_bg_6"></label>
                    </span>
                                    <span>
                      <input type="radio" name="logo_bg" value="color_7" id="logo_bg_7">
                      <label for="logo_bg_7"></label>
                    </span>
                                    <span>
                      <input type="radio" name="logo_bg" value="color_8" id="logo_bg_8">
                      <label for="logo_bg_8"></label>
                    </span>
                                </li>
                                <li class="drop-title">
                                    <p>头部</p>
                                </li>
                                <li class="drop-skin-li clearfix">
                    <span class="inverse">
                      <input type="radio" name="header_bg" value="default" id="header_bg_1" checked>
                      <label for="header_bg_1"></label>
                    </span>
                                    <span>
                      <input type="radio" name="header_bg" value="color_2" id="header_bg_2">
                      <label for="header_bg_2"></label>
                    </span>
                                    <span>
                      <input type="radio" name="header_bg" value="color_3" id="header_bg_3">
                      <label for="header_bg_3"></label>
                    </span>
                                    <span>
                      <input type="radio" name="header_bg" value="color_4" id="header_bg_4">
                      <label for="header_bg_4"></label>
                    </span>
                                    <span>
                      <input type="radio" name="header_bg" value="color_5" id="header_bg_5">
                      <label for="header_bg_5"></label>
                    </span>
                                    <span>
                      <input type="radio" name="header_bg" value="color_6" id="header_bg_6">
                      <label for="header_bg_6"></label>
                    </span>
                                    <span>
                      <input type="radio" name="header_bg" value="color_7" id="header_bg_7">
                      <label for="header_bg_7"></label>
                    </span>
                                    <span>
                      <input type="radio" name="header_bg" value="color_8" id="header_bg_8">
                      <label for="header_bg_8"></label>
                    </span>
                                </li>
                                <li class="drop-title">
                                    <p>侧边栏</p>
                                </li>
                                <li class="drop-skin-li clearfix">
                    <span class="inverse">
                      <input type="radio" name="sidebar_bg" value="default" id="sidebar_bg_1" checked>
                      <label for="sidebar_bg_1"></label>
                    </span>
                                    <span>
                      <input type="radio" name="sidebar_bg" value="color_2" id="sidebar_bg_2">
                      <label for="sidebar_bg_2"></label>
                    </span>
                                    <span>
                      <input type="radio" name="sidebar_bg" value="color_3" id="sidebar_bg_3">
                      <label for="sidebar_bg_3"></label>
                    </span>
                                    <span>
                      <input type="radio" name="sidebar_bg" value="color_4" id="sidebar_bg_4">
                      <label for="sidebar_bg_4"></label>
                    </span>
                                    <span>
                      <input type="radio" name="sidebar_bg" value="color_5" id="sidebar_bg_5">
                      <label for="sidebar_bg_5"></label>
                    </span>
                                    <span>
                      <input type="radio" name="sidebar_bg" value="color_6" id="sidebar_bg_6">
                      <label for="sidebar_bg_6"></label>
                    </span>
                                    <span>
                      <input type="radio" name="sidebar_bg" value="color_7" id="sidebar_bg_7">
                      <label for="sidebar_bg_7"></label>
                    </span>
                                    <span>
                      <input type="radio" name="sidebar_bg" value="color_8" id="sidebar_bg_8">
                      <label for="sidebar_bg_8"></label>
                    </span>
                                </li>
                            </ul>
                        </li>
                        <!--切换主题配色-->
                    </ul>

                </div>
            </nav>

        </header>
        <!--End 头部信息-->

        <!--页面主要内容-->
        <main class="lyear-layout-content">

            <div id="iframe-content"></div>

        </main>
        <!--End 页面主要内容-->
    </div>
</div>

<script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$Userstatic;?>js/jquery.cookie.min.js"></script>
<script type="text/javascript" src="<?=$Userstatic;?>js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap-multitabs/multitabs.js"></script>
<script type="text/javascript" src="<?=$Userstatic;?>js/index.min.js"></script>
</body>

</html>

