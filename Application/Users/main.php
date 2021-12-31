<?php
require_once('../core.php');
/*if(!defined('AUTHOR'))
{
    exit('我想你肯定是走错了地方');

}*/
if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
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
  <link href="<?=$Userstatic?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=$Userstatic?>css/materialdesignicons.min.css" rel="stylesheet">
  <link href="<?=$Userstatic?>css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=$Userstatic?>css/liuyan.css">
</head>

<body>
  <div class="container-fluid p-t-15">

    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card bg-primary">
          <div class="card-body clearfix">
            <div class="pull-right text-right">
              <p class="h6 text-white m-t-0">平台用户</p>
              <p class="h3 text-white m-b-0 fa-1-5x"><?=get_count('user');?></p>
            </div>
            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                  class="mdi mdi-account fa-1-5x"></i></span> </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="card bg-danger">
          <div class="card-body clearfix">
            <div class="pull-right text-right">
              <p class="h6 text-white m-t-0">平台挂机</p>
              <p class="h3 text-white m-b-0 fa-1-5x"><?=get_count('info');?></p>
            </div>
            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                  class="mdi mdi-account fa-1-5x"></i></span> </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="card bg-success">
          <div class="card-body clearfix">
            <div class="pull-right text-right">
              <p class="h6 text-white m-t-0">运行天数</p>
              <p class="h3 text-white m-b-0 fa-1-5x"><?=site_time(TF_Data('SITE_TIME'))?></p>
            </div>
            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                  class="mdi mdi-arrow-down-bold fa-1-5x"></i></span> </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="card bg-purple">
          <div class="card-body clearfix">
            <div class="pull-right text-right">
              <p class="h6 text-white m-t-0">系统时间</p>
              <p class="h3 text-white m-b-0 fa-1-5x"><?=date('Y-m-d')?></p>
            </div>
            <div class="pull-left"> <span class="img-avatar img-avatar-48 bg-translucent"><i
                  class="mdi mdi-comment-outline fa-1-5x"></i></span> </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-lg-6">
        <div class="row">
          <!-- 公告中心 -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>公告中心</h4>
              </div>
              <div class="card-body">
                <p><?=TF_Data('notice')?></p>
              </div>
            </div>
          </div>
          <!-- 我的信息 -->
          <div class="col-md-12">
            <ul class="list-group">
              <li class="list-group-item active">
                <div class="text-center">
                  <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$userrow->qq?>&spec=100" alt=""
                    style="border-radius: 50%;width: 100px;">
                </div>

              </li>
              <li class="list-group-item">
                <span class="mdi mdi-cellphone-android"></span> UID <span
                  class="label label-success pull-right "><?=$userrow->uid?></span>
              </li>
              <li class="list-group-item">
                <span class="mdi mdi-account"></span> 用户名 <span class="label label-dark pull-right "><?=$userrow->user?></span>
              </li>
              <li class="list-group-item">
                <span class="mdi mdi-shield-outline"></span> 用户权限 <span
                  class="label label-purple pull-right "><? if(!$userrow->uid){?>普通用户<?}else{?>超级大牛<?}?></span>
              </li>
              <li class="list-group-item">
                <span class="mdi mdi-timelapse"></span> 会员时长 <span class="label label-danger pull-right "><? if($userrow->vipendtime>time())echo  ceil(($userrow->vipendtime-time())/84600).'天';else echo '然而并没有开通';?></span>
              </li>
              <li class="list-group-item">
                <span class="mdi mdi-shield"></span> 配额 <span class="label label-info pull-right "><?= $userrow->quota?>个</span>
              </li>
            </ul>
          </div>
          <!-- 帮助中心 -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>注意事项</h4>
              </div>
              <div class="card-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                          aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                          <i class="mdi mdi-bullhorn"></i> 怎么添加账号？
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"
                      aria-expanded="false" style="height: 0px;">
                      <div class="panel-body">
                       侧边栏挂机管理，添加挂机,如果添加账号遇到疑问请加群936838495
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-cyan">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                          href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <i class="mdi mdi-bullhorn"></i> 账号会不会被封？
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"
                      aria-expanded="false">
                      <div class="panel-body">
                       本站联系稳定签到多年均没有出现因为签到而封号的,可以放心使用
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-danger">
                    <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                          href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <i class="mdi mdi-bullhorn"></i> 新手必看？
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                      aria-labelledby="headingThree" aria-expanded="false">
                      <div class="panel-body">
                        只要添加成功,vip没有到期,默认自动开启签到.请不要更改密码!!!本站采用国内高速服务器搭建,已连续稳定多年放心食用~
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 留言板 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>留言板</h4>
          </div>
          <div class="card-body">
            <ul class="media-list media-list-message">
              <li>
                <div class="media">
                  <a href="#!"><img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=TF_lH?>>&spec=100"
                      class="img-avatar img-avatar-30" alt="站长-龙辉"></a>
                  <div class="media-body">
                    <p>
                      <a href="#!"><strong>站长-龙辉</strong></a>
                      <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id='5'>回复</a>
                      <time class="pull-right text-fade" datetime="2018-07-14 20:00">3 分钟前</time>
                    </p>
                    <p>尊敬的老哥们,你们好,我是站长,如果你在使用中遇到问题请留言哟~</p>
                  </div>
                </div>
              </li>

              <li>
                <div class="media">
                  <a href="#!"><img src="http://lyear.itshubao.com/iframe/v4/images/users/avatar-1.png"
                      class="img-avatar img-avatar-30" alt="大娃"></a>
                  <div class="media-body">
                    <p>
                      <a href="#!"><strong>大娃</strong></a>
                      <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id='2'>回复</a>
                      <time class="pull-right text-fade" datetime="2018-07-14 20:00">26 分钟前</time>
                    </p>
                    <p>您个瓜娃子，谁让你这么弱的，要力量没力量啊。</p>
                    <ul>
                      <li>
                        <div class="media">
                          <a href="#!"><img src="http://lyear.itshubao.com/iframe/v4/images/users/avatar-2.png"
                              class="img-avatar img-avatar-30" alt="二娃"></a>
                          <div class="media-body">
                            <p>
                              <a href="#!"><strong>二娃</strong></a>
                              <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id='7'>回复</a>
                              <time class="pull-right text-fade" datetime="2018-07-14 20:00">刚刚</time>
                            </p>
                            <p>谢大哥。</p>
                          </div>
                        </div>
                      </li>
                    </ul>

                  </div>
                </div>
              </li>

              <li>
                <div class="media">
                  <a href="#!"><img src="http://lyear.itshubao.com/iframe/v4/images/users/avatar-3.png"
                      class="img-avatar img-avatar-30" alt="三娃"></a>
                  <div class="media-body">
                    <p>
                      <a href="#!"><strong>三娃</strong></a>
                      <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id='2'>回复</a>
                      <time class="pull-right text-fade" datetime="2018-07-14 20:00">2 小时前</time>
                    </p>
                    <p>像我一样，钢筋铁骨，怕过谁。</p>

                    <ul>
                      <li>
                        <div class="media">
                          <a href="#!"><img src="http://lyear.itshubao.com/iframe/v4/images/users/avatar-4.png"
                              class="img-avatar img-avatar-30" alt="四娃"></a>
                          <div class="media-body">
                            <p>
                              <a href="#!"><strong>四娃</strong></a>
                              <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id='3'>回复</a>
                              <time class="pull-right text-fade" datetime="2018-07-14 20:00">5 分钟前</time>
                            </p>
                            <p>三哥，你甭吹牛了，饶痒痒你怕不怕。</p>

                            <ul>
                              <li>
                                <div class="media">
                                  <a href="#!"><img src="http://lyear.itshubao.com/iframe/v4/images/users/avatar-3.png"
                                      class="img-avatar img-avatar-30" alt="三娃"></a>
                                  <div class="media-body">
                                    <p>
                                      <a href="#!"><strong>三娃</strong></a>
                                      <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id='4'>回复</a>
                                      <time class="pull-right text-fade" datetime="2018-07-14 20:00">刚刚</time>
                                    </p>
                                    <p>我看你的皮是痒痒了。</p>
                                  </div>
                                </div>
                              </li>

                              <li>
                                <div class="media">
                                  <a href="#!"><img src="http://lyear.itshubao.com/iframe/v4/images/users/avatar-5.png"
                                      class="img-avatar img-avatar-30" alt="五娃"></a>
                                  <div class="media-body">
                                    <p>
                                      <a href="#!"><strong>五娃</strong></a>
                                      <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id='6'>回复</a>
                                      <time class="pull-right text-fade" datetime="2018-07-14 20:00">刚刚</time>
                                    </p>
                                    <p>哈哈。</p>
                                  </div>
                                </div>
                              </li>
                            </ul>

                          </div>
                        </div>
                      </li>
                    </ul>

                  </div>
                </div>
              </li>

            </ul>
            <form class="message-form" id="respond-form">
              <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$userrow->qq?>&spec=100" alt="<?=$userrow->user?>"
                class="img-avatar img-avatar-30" />
              <input class="form-control" type="text" placeholder="开发中,等待上线">
              <a class="message-btn-close m-r-10" href="#!"><i class="mdi mdi-close"></i></a>
              <a class="message-btn-send" href="#!"><i class="mdi mdi-near-me"></i></a>
              <input type='hidden' name='comment_arc_id' value='1' id='comment_arc_id' />
              <!--当前文章ID-->
              <input type='hidden' name='comment_parent' id='comment_parent_id' value='0' />
              <!--当前回复的评论ID-->
            </form>

          </div>
        </div>
      </div>
    </div>

  </div>

  <script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
  <script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?=$Userstatic;?>js/main.min.js"></script>
  <script>
    $(document).ready(function () {
      // 回复评论
      $(document).on('click', '.reply-btn', function () {

        var parentLi = $(this).parents('.media').first(),
          parentID = $(this).data('id'),
          respond = $('#respond-form'),
          respondHtml = respond.prop("outerHTML");

        $("#respond-form").remove();
        parentLi.after(respondHtml);
        $("#comment_parent_id").val(parentID);
        $('#respond-form').find('.form-control').focus();
        $('.message-btn-close').show();


      });

      $(document).on('click', '.message-btn-close', function () {
        var respond = $('#respond-form'),
          respondHtml = respond.prop("outerHTML");

        respond.remove();
        $('.media-list-message').after(respondHtml);
        $("#comment_parent_id").val('0');
        $('.message-btn-close').hide();
      });
      $(document).on('click', '.message-btn-send', function () {
        let pin = $('.form-control').val()
        let pink = `
      <ul>
        <li>
          <div class="media">
            <a href="#!"><img src="http://lyear.itshubao.com/iframe/v4/images/users/avatar-7.png"
                class="img-avatar img-avatar-30" alt="七娃"></a>
            <div class="media-body">
              <p>
                <a href="#!"><strong>龙辉</strong></a>
                <a href="#!" class="pull-right text-fade m-l-5 reply-btn" data-id=''>回复</a>
                <time class="pull-right text-fade" datetime="2018-07-14 20:00">3 分钟前</time>
              </p>
              <p>${pin}</p>
            </div>
          </div>
        </li>
        <ul>
          `
        $(this).parents('.message-form').siblings('.media').children('.media-body').append(pink)
      })
    });
  </script>
</body>

</html>