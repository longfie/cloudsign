<?php

	require_once("../TFcore/common.php");
	include_once ROOT.'TFcore/class_expand/PHPMailer/class.phpmailer.php';
	include_once ROOT.'TFcore/class_expand/PHPMailer/class.smtp.php';
	if(GET('key')!==TF_Data('corn'))exit;
	$websiteuser=$_GET['websiteuser'];
	$usermail=$_GET['usermail'];
	$Body = $_GET['body'];
	$money = $_GET['money'];
	$Name = TF_Data('name');
	$Domain = Domain();

  switch ($Body) {
    case 1:
        $Bodys = '<p align="center">尊敬的云签到用户('.$websiteuser.'),您好。<br>您在'.$Name.'('.$Domain.')的签到状态失效了~<br>请您及时更新,确保签到状态能够正常运行!<br>感谢您的使用~<br>此邮件为网站自动发送,如有打扰请屏蔽.<br>如有疑问请联系作者:龙辉<br>QQ1790716272</p>';
        break;
    case 2:
        $Bodys = '尊敬的云用户您好,你在本网站:'.Domain().'/  vip体验已经到期,请及时充值继续享受服务噢~~ </br>不及时续费会导致断签哦~';

        break;
   case 3:
       $Bodys = "<div id=\"cTMail-Wrap\" style=\"box-sizing:border-box;text-align:center;min-width:320px; max-width:660px; border:1px solid #f6f6f6; background-color:#f7f8fa; margin:auto; padding:20px 0 30px; font-family:&#39;helvetica neue&#39;,PingFangSC-Light,arial,&#39;hiragino sans gb&#39;,&#39;microsoft yahei ui&#39;,&#39;microsoft yahei&#39;,simsun,sans-serif\">
    <div class=\"main-content\" style=\"\">
        <table style=\"width:100%;font-weight:300;margin-bottom:10px;border-collapse:collapse\">
            <tbody>
            <tr style=\"font-weight:300\">
                <td style=\"width:3%;max-width:30px;\"></td>
                <td style=\"max-width:600px;\">
                    <p style=\"height:2px;background-color: #00a4ff;border: 0;font-size:0;padding:0;width:100%;margin-top:20px;\"></p>
                    <div id=\"cTMail-inner\" style=\"background-color:#fff; padding:23px 0 20px;box-shadow: 0px 1px 1px 0px rgba(122, 55, 55, 0.2);text-align:left;\">
                        <table style=\"width:100%;font-weight:300;margin-bottom:10px;border-collapse:collapse;text-align:left;\">
                            <tbody>
                            <tr style=\"font-weight:300\">
                                <td style=\"width:3.2%;max-width:30px;\"></td>
                                <td style=\"max-width:480px;text-align:left;\">
                                    <h1 id=\"cTMail-title\" style=\"font-weight:bold;font-size:20px; line-height:36px; margin:0 0 16px;\">云签-邮件提醒</h1>
                                    <p id=\"cTMail-userName\" style=\"font-size:14px;color:#333; line-height:24px; margin:0;\">尊敬的云签用户，您好！</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">这封信是由云签到系统:（" . Domain() . "）发送的。</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">您在我们网站挂机挂机状态已失效，请及时更新</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">失效时间：" . date('Y-m-d H:i:s') . ",</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\"><a href='" .  Domain() . "'>点我前往更新状态</a></p>
                                   <br/>
                                    </p>
                                    <dl style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 18px;\">
                                        <dd style=\"margin: 0px 0px 6px; padding: 0px; font-size: 12px; line-height: 22px;\"><p id=\"cTMail-sender\" style=\"font-size: 14px; line-height: 26px; word-wrap: break-word; word-break: break-all; margin-top: 32px;\">此致 <br  />
                                            <strong>站长龙辉QQ1790716272</strong></p>
                                        </dd>
                                    </dl>
                                </td>
                                <td style=\"width:3.2%;max-width:30px;\"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>"  ;


          break;
      case 4:
          $Bodys = "<div id=\"cTMail-Wrap\" style=\"box-sizing:border-box;text-align:center;min-width:320px; max-width:660px; border:1px solid #f6f6f6; background-color:#f7f8fa; margin:auto; padding:20px 0 30px; font-family:&#39;helvetica neue&#39;,PingFangSC-Light,arial,&#39;hiragino sans gb&#39;,&#39;microsoft yahei ui&#39;,&#39;microsoft yahei&#39;,simsun,sans-serif\">
    <div class=\"main-content\" style=\"\">
        <table style=\"width:100%;font-weight:300;margin-bottom:10px;border-collapse:collapse\">
            <tbody>
            <tr style=\"font-weight:300\">
                <td style=\"width:3%;max-width:30px;\"></td>
                <td style=\"max-width:600px;\">
                    <p style=\"height:2px;background-color: #00a4ff;border: 0;font-size:0;padding:0;width:100%;margin-top:20px;\"></p>
                    <div id=\"cTMail-inner\" style=\"background-color:#fff; padding:23px 0 20px;box-shadow: 0px 1px 1px 0px rgba(122, 55, 55, 0.2);text-align:left;\">
                        <table style=\"width:100%;font-weight:300;margin-bottom:10px;border-collapse:collapse;text-align:left;\">
                            <tbody>
                            <tr style=\"font-weight:300\">
                                <td style=\"width:3.2%;max-width:30px;\"></td>
                                <td style=\"max-width:480px;text-align:left;\">
                                    <h1 id=\"cTMail-title\" style=\"font-weight:bold;font-size:20px; line-height:36px; margin:0 0 16px;\">云签-邮件提醒</h1>
                                    <p id=\"cTMail-userName\" style=\"font-size:14px;color:#333; line-height:24px; margin:0;\">尊敬的云签用户，您好！</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">这封信是由云签到系统:（" . Domain(). "）发送的。</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">您在我们网站充值的会员已经到账</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">充值时间：" . date('Y-m-d H:i:s') . ",</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\"><a href='" . Domain() . "'>点我前往</a></p>
                                   <br/>
                                    </p>
                                    <dl style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 18px;\">
                                        <dd style=\"margin: 0px 0px 6px; padding: 0px; font-size: 12px; line-height: 22px;\"><p id=\"cTMail-sender\" style=\"font-size: 14px; line-height: 26px; word-wrap: break-word; word-break: break-all; margin-top: 32px;\">此致 <br  />
                                            <strong>站长龙辉QQ1790716272</strong></p>
                                        </dd>
                                    </dl>
                                </td>
                                <td style=\"width:3.2%;max-width:30px;\"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>"  ;
          break;
          case 5:
           $Bodys = "<div id=\"cTMail-Wrap\" style=\"box-sizing:border-box;text-align:center;min-width:320px; max-width:660px; border:1px solid #f6f6f6; background-color:#f7f8fa; margin:auto; padding:20px 0 30px; font-family:&#39;helvetica neue&#39;,PingFangSC-Light,arial,&#39;hiragino sans gb&#39;,&#39;microsoft yahei ui&#39;,&#39;microsoft yahei&#39;,simsun,sans-serif\">
    <div class=\"main-content\" style=\"\">
        <table style=\"width:100%;font-weight:300;margin-bottom:10px;border-collapse:collapse\">
            <tbody>
            <tr style=\"font-weight:300\">
                <td style=\"width:3%;max-width:30px;\"></td>
                <td style=\"max-width:600px;\">
                    <p style=\"height:2px;background-color: #00a4ff;border: 0;font-size:0;padding:0;width:100%;margin-top:20px;\"></p>
                    <div id=\"cTMail-inner\" style=\"background-color:#fff; padding:23px 0 20px;box-shadow: 0px 1px 1px 0px rgba(122, 55, 55, 0.2);text-align:left;\">
                        <table style=\"width:100%;font-weight:300;margin-bottom:10px;border-collapse:collapse;text-align:left;\">
                            <tbody>
                            <tr style=\"font-weight:300\">
                                <td style=\"width:3.2%;max-width:30px;\"></td>
                                <td style=\"max-width:480px;text-align:left;\">
                                    <h1 id=\"cTMail-title\" style=\"font-weight:bold;font-size:20px; line-height:36px; margin:0 0 16px;\">云签-邮件提醒</h1>
                                    <p id=\"cTMail-userName\" style=\"font-size:14px;color:#333; line-height:24px; margin:0;\">尊敬的云签用户，您好！</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">这封信是由云签到系统:（" . Domain(). "）发送的。</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">请加群936838495,群内有云签机器人</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\">你正在使用本站的免费云签</p>
                                    <p class=\"cTMail-content\" style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 24px; margin: 6px 0px 0px; word-wrap: break-word; word-break: break-all;\"><a href='" . Domain() . "'>点我前往</a></p>
                                   <br/>
                                    </p>
                                    <dl style=\"font-size: 14px; color: rgb(51, 51, 51); line-height: 18px;\">
                                        <dd style=\"margin: 0px 0px 6px; padding: 0px; font-size: 12px; line-height: 22px;\"><p id=\"cTMail-sender\" style=\"font-size: 14px; line-height: 26px; word-wrap: break-word; word-break: break-all; margin-top: 32px;\">此致 <br  />
                                            <strong>站长龙辉QQ1790716272</strong></p>
                                        </dd>
                                    </dl>
                                </td>
                                <td style=\"width:3.2%;max-width:30px;\"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>"  ;
    default:
        showmsg();
        break;

}

	if(Host=='' || Port=='' || Username=='' || Password==''){
		echo 'state:0';	//所有所填项不能为空！
	}else{
		$mail = new PHPMailer(true);
		try{
			// 开启SMTP调试模式
			$mail->SMTPDebug = 2;
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = Host;
			$mail->Username = Username;
			$mail->Password = Password;
			$mail->SMTPSecure = 'ssl';
			$mail->Port = Port;
			$mail->CharSet = 'UTF-8';
			// 邮件正文是否为html编码 注意此处是一个方法
			$mail->isHTML(true);
			// 发件人邮箱必须和$mail->Username一致
			$mail->setFrom(Username, $Name);
			$mail->addAddress($usermail);	//收信人
			$mail->Subject = '温馨提示~来自'.$Name.'('.$Domain.')的邮箱，请注意查收！';	//标题
			$mail->Body = $Bodys;	//内容
			$state = $mail->send();
			echo 'state:1';
		}catch(Exception $e){
			echo 'state:2';
		}
	}