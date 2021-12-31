<?php
require_once('../core.php');
/*if(!defined('AUTHOR'))
{
    exit('我想你肯定是走错了地方');

}*/
require_once ('head.php');
//判断是否登录

if(!TF_Data('login_state')){
    exit("<script language='javascript'>window.location.href='/Application/Enter/';</script>");
}
?>
		<style>
			#avatarUrl {
				border-radius: 50%;
			}
			.c-header {
				box-shadow: 0 0 10px 1px #ccc;
				border-radius: 10px;
				margin-top: 50px;
				position: relative;
				padding: 50px 10px 10px 10px;
				background-color: #fff;
			}
			.c-header #avatarUrl {
				width: 100px;
				position: absolute;
				top: -50px;
				left: 50%;
				transform: translate(-50%);
			}
			.c-header #nickname {
				text-align: center;
				font-size: 16px;
				font-weight: 800;
			}
			.c-header .userInfo {
				text-align: center;
				color: #b1b1b1;
			}
			.c-header .listenSongs {
				float: right;
				font-size: 12px;
				color: #b1b1b1;
			}
			.c-header .lv {
				float: left;
				font-size: 12px;
				color: #33cabb;
			}
		</style>


	<body>
		<div class="container-fluid p-t-15">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="card" style="margin-top: 80px">
						<div class="card-header">
							<h4>网易云打卡</h4>
						</div>
						<div class="card-body">
							<div class="list-group" id="wyyLogin">
								<div
									id="load"
									class="alert alert-info"
									style="display: none"
								></div>
								<div id="login">
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">手机号</div>
											<input
												type="text"
												id="phone"
												value=""
												class="form-control"
											/>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<div class="input-group-addon">密码</div>
											<input
												type="password"
												id="password"
												value=""
												class="form-control"
											/>
										</div>
									</div>
									<button
										type="button"
										id="submit"
										class="btn btn-primary btn-block"
									>
										提交
									</button>
								</div>
								<br />
								<!-- <a class="multitabs" href="add.html">点此重新登录</a> -->
							</div>
							<div id="wyyInfo" style="display: none">
								<div class="c-header">
									<p>
										<img src="" alt="" id="avatarUrl" />
									</p>
									<p id="nickname"></p>
									<p class="userInfo">
										<span></span>
										<span></span>
									</p>
									<div>
										<p class="lv"></p>
										<p class="listenSongs"></p>
									</div>
									<div class="progress" style="clear: both">
										<div
											class="progress-bar progress-bar-striped active"
											role="progressbar"
											id="songs"
										></div>
									</div>
									<button class="btn btn btn-pink btn-sm btn-block" id="sign">
										签到
									</button>
									<button class="btn btn btn-purple btn-sm btn-block" id="daka">
										打卡
									</button>
								</div>

								<p></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?=$Userstatic;?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=$Userstatic;?>js/bootstrap-notify.min.js"></script>
		<script type="text/javascript" src="<?=$Userstatic;?>js/lightyear.js"></script>
		<script type="text/javascript" src="<?=$Userstatic;?>js/jquery.cookie.min.js"></script>
		<script type="text/javascript" src="<?=$Userstatic;?>js/jquery.md5.js"></script>

		<script>
			$('#submit').on('click', () => {
				let phone = $('#phone').val();
				let password = $('#password').val();
				$.ajax({
					method: 'POST',
					url: '/wyyAPI.php?do=login',
					data: {
						uin: phone,
						pwd: $.md5(password),
					},
					success: (res) => {
						res = $.parseJSON(res);
						if (res.code === 400) {
							return lightyear.notify(
								'登录失败：未知错误',
								'danger',
								1000,
								'mdi mdi-emoticon-happy',
								'top',
								'center'
							);
						}
						if (res.code !== 200) {
							return lightyear.notify(
								'登录失败：' + res.msg,
								'danger',
								1000,
								'mdi mdi-emoticon-happy',
								'top',
								'center'
							);
						}
						// $.cookie('MUSIC_U', res.token, { expires: 7 });

						lightyear.notify(
							'登录成功',
							'success',
							1000,
							'mdi mdi-emoticon-happy',
							'top',
							'center'
						);
						$('#wyyLogin').hide().siblings().show();

						let uid = res.account.id;
						if (!uid) {
							lightyear.notify(
								'获取用户信息失败',
								'danger',
								5000,
								'mdi mdi-emoticon-happy',
								'top',
								'center'
							);
						}
						$.ajax({
							method: 'POST',
							url: '/wyyAPI.php?do=detail',
							data: {
								uid,
							},
							success: (res) => {
								res = $.parseJSON(res);
								$('.card-body').css(
									'background',
									'url(' + res.profile.backgroundUrl + ') no-repeat'
								);
								$('#avatarUrl').attr('src', res.profile.avatarUrl);
								$('#nickname').html(res.profile.nickname);
								$('.userInfo span:nth-child(1)').html(
									res.profile.follows + ' 关注 '
								);
								$('.userInfo span:nth-child(2)').html(
									res.profile.followeds + ' 粉丝'
								);
								$('.lv').html('Lv.' + res.level);
								$('.listenSongs').html('听歌量：' + res.listenSongs);
								let total = 20000;
								let listenSongs = res.listenSongs;
								let need = res.listenSongs / total / 0.01 + '%';
								$('#songs').css('width', need);
							},
						});

						$('#sign').on('click', () => {
							$.ajax({
								method: 'POST',
								url: '/wyyAPI.php?do=sign',
								success: (res) => {
									res = $.parseJSON(res);
									console.log(res);
								},
							});
						});
						$('#daka').on('click', () => {
							$.ajax({
								method: 'POST',
								url: '/wyyAPI.php?do=daka',
								success: (res) => {
									res = $.parseJSON(res);
									console.log(res);
								},
							});
						});
					},
				});
			});
		</script>
	</body>
</html>
