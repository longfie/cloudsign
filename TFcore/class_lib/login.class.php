<?php
/* Name: 百度登录操作类
 * Author: 一千零一夜
 * Website: blog.eirds.cn
 * QQ: 1790716272
*/

class baiduLogin{
    private $referrer = 'https://wappass.baidu.com/passport/login?clientfrom=native&tpl=tb&login_share_strategy=choice&client=android&adapter=3&t=1485501702555&act=bind_mobile&loginLink=0&smsLoginLink=0&lPFastRegLink=0&fastRegLink=1&lPlayout=0&loginInitType=0';
    //获取ServerTime
    public function servertime(){
        $url='https://wappass.baidu.com/wp/api/security/antireplaytoken?tpl=tb&v='.time().'0000';
        $data=$this->get_curl($url,$post,$this->referrer);
        $arr=json_decode($data,true);
        if($arr['errno']==110000){
            return array('code'=>0,'time'=>$arr['time']);
        }else{
            return array('code'=>-1,'msg'=>$arr['errmsg']);
        }
    }
    //获取验证码图片
    public function getvcpic($vcodestr){
        $url='https://wappass.baidu.com/cgi-bin/genimage?'.$vcodestr.'&v='.time().'0000';
        return $this->get_curl($url,0,$this->referrer);
    }
    //普通登录操作
    public function login($time,$user,$pwd,$p,$vcode=null,$vcodestr=null){
        if(empty($user))return array('code'=>-1,'msg'=>'用户名不能为空');
        if(empty($pwd))return array('code'=>-1,'msg'=>'pwd不能为空');
        if(empty($p))return array('code'=>-1,'msg'=>'密码不能为空');
        if($vcode=='null')$vcode='';
        if($vcodestr=='null')$vcodestr='';
        //$url='https://wappass.baidu.com/wp/api/login';
        $url='https://wappass.baidu.com/wp/api/login?v='.time().'0000';
        $post='username='.$user.'&code=&password='.$p.'&verifycode='.$vcode.'&clientfrom=native&tpl=tb&login_share_strategy=choice&client=android&adapter=3&t='.time().'0000&act=bind_mobile&loginLink=0&smsLoginLink=1&lPFastRegLink=0&fastRegLink=1&lPlayout=0&loginInitType=0&lang=zh-cn&regLink=1&action=login&loginmerge=1&isphone=0&dialogVerifyCode=&dialogVcodestr=&dialogVcodesign=&gid=660BDF6-30E5-4A83-8EAC-F0B4752E1C4B&vcodestr='.$vcodestr.'&countrycode=&servertime='.$time.'&logLoginType=sdk_login&passAppHash=&passAppVersion=';
        $data = $this->get_curl($url,$post,$this->referrer);
        $arr=json_decode($data,true);
        if(array_key_exists('errInfo',$arr) && $arr['errInfo']['no']=='0'){
            if(!empty($arr['data']['loginProxy'])){
                $data = $this->get_curl($arr['data']['loginProxy'],0,$referrer);
                $arr=json_decode($data,true);
            }
            $data=$arr['data']['xml'];
            preg_match('!<uname>(.*?)</uname>!i',$data,$user);
            preg_match('!<uid>(.*?)</uid>!i',$data,$uid);
            preg_match('!<portrait>(.*?)</portrait>!i',$data,$face);
            preg_match('!<displayname>(.*?)</displayname>!i',$data,$displayname);
            preg_match('!<bduss>(.*?)</bduss>!i',$data,$bduss);
            preg_match('!<ptoken>(.*?)</ptoken>!i',$data,$ptoken);
            preg_match('!<stoken>(.*?)</stoken>!i',$data,$stoken);
            return array('code'=>0,'uid'=>$uid[1],'user'=>$user[1],'displayname'=>$displayname[1],'face'=>$face[1],'bduss'=>$bduss[1],'ptoken'=>$ptoken[1],'stoken'=>$stoken[1]);
        }elseif($arr['errInfo']['no']=='310006'||$arr['errInfo']['no']=='500001'||$arr['errInfo']['no']=='500002'){
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg'],'vcodestr'=>$arr['data']['codeString']);
        }elseif($arr['errInfo']['no']=='400023'){
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg'],'type'=>$arr['data']['showType'],'phone'=>$arr['data']['phone'],'email'=>$arr['data']['email'],'lstr'=>$arr['data']['lstr'],'ltoken'=>$arr['data']['ltoken']);
        }elseif(array_key_exists('errInfo',$arr)){
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
        }else{
            return array('code'=>-1,'msg'=>'登录失败，原因未知');
        }
    }
    //登录异常时发送手机/邮件验证码
    public function sendcode($type,$lstr,$ltoken){
        $url='https://wappass.baidu.com/wp/login/sec?ajax=1&v='.time().'0000&vcode=&clientfrom=native&tpl=tb&login_share_strategy=choice&client=android&adapter=3&t='.time().'0000&act=bind_mobile&loginLink=0&smsLoginLink=1&lPFastRegLink=0&fastRegLink=1&lPlayout=0&loginInitType=0&lang=zh-cn&regLink=1&action=login&loginmerge=1&isphone=0&dialogVerifyCode=&dialogVcodestr=&dialogVcodesign=&gid=660BDF6-30E5-4A83-8EAC-F0B4752E1C4B&showtype='.$type.'&lstr='.rawurlencode($lstr).'&ltoken='.$ltoken;
        $data=$this->get_curl($url,0,$this->referrer);
        $arr=json_decode($data,true);
        if(array_key_exists('errInfo',$arr) && $arr['errInfo']['no']=='0'){
            return array('code'=>0);
        }elseif(array_key_exists('errInfo',$arr)){
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
        }else{
            return array('code'=>-1,'msg'=>'发生验证码失败，原因未知');
        }
    }
    //登录异常时登录操作
    public function login2($type,$lstr,$ltoken,$vcode){
        if(empty($type))return array('code'=>-1,'msg'=>'type不能为空');
        if(empty($lstr))return array('code'=>-1,'msg'=>'lstr不能为空');
        if(empty($ltoken))return array('code'=>-1,'msg'=>'ltoken不能为空');
        if(empty($vcode))return array('code'=>-1,'msg'=>'vcode不能为空');

        $url='https://wappass.baidu.com/wp/login/sec?type=2&v='.time().'0000';
        $post='vcode='.$vcode.'&clientfrom=native&tpl=tb&login_share_strategy=choice&client=android&adapter=3&t='.time().'0000&act=bind_mobile&loginLink=0&smsLoginLink=1&lPFastRegLink=0&fastRegLink=1&lPlayout=0&loginInitType=0&lang=zh-cn&regLink=1&action=login&loginmerge=1&isphone=0&dialogVerifyCode=&dialogVcodestr=&dialogVcodesign=&gid=660BDF6-30E5-4A83-8EAC-F0B4752E1C4B&showtype='.$type.'&lstr='.rawurlencode($lstr).'&ltoken='.$ltoken;
        $data = $this->get_curl($url,$post,$this->referrer);
        $arr=json_decode($data,true);
        if(array_key_exists('errInfo',$arr) && $arr['errInfo']['no']=='0'){
            if(!empty($arr['data']['loginProxy'])){
                $data = $this->get_curl($arr['data']['loginProxy'],0,$referrer);
                $arr=json_decode($data,true);
            }
            $data=$arr['data']['xml'];
            preg_match('!<uname>(.*?)</uname>!i',$data,$user);
            preg_match('!<uid>(.*?)</uid>!i',$data,$uid);
            preg_match('!<portrait>(.*?)</portrait>!i',$data,$face);
            preg_match('!<displayname>(.*?)</displayname>!i',$data,$displayname);
            preg_match('!<bduss>(.*?)</bduss>!i',$data,$bduss);
            preg_match('!<ptoken>(.*?)</ptoken>!i',$data,$ptoken);
            preg_match('!<stoken>(.*?)</stoken>!i',$data,$stoken);

            return array('code'=>0,'uid'=>$uid[1],'user'=>$user[1],'displayname'=>$displayname[1],'face'=>$face[1],'bduss'=>$bduss[1],'ptoken'=>$ptoken[1],'stoken'=>$stoken[1]);

        }elseif(array_key_exists('errInfo',$arr)){
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
        }else{
            return array('code'=>-1,'msg'=>'登录失败，原因未知');
        }
    }
    //检测是否需要验证码
    public function checkvc($user){
        if(empty($user))return array('saveOK'=>-1,'msg'=>'请先输入用户名');
        $url='https://wappass.baidu.com/wp/api/login/check?tt='.time().'9117&username='.$user.'&countrycode=&clientfrom=wap&sub_source=leadsetpwd&tpl=tb';
        $data=$this->get_curl($url,0,$this->referrer);
        $arr=json_decode($data,true);
        if($arr['errInfo'] && $arr['errInfo']['no']=='0' && empty($arr['data']['codeString'])){
            return array('code'=>0);
        }elseif($arr['errInfo'] && $arr['errInfo']['no']=='0'){
            return array('code'=>1,'vcodestr'=>$arr['data']['codeString']);
        }else{
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
        }
    }
    //手机验证码登录，获取手机号是否存在
    public function getphone($phone){
        if(empty($phone))return array('saveOK'=>-1,'msg'=>'请先输入手机号');
        if(strlen($phone)!=11)return array('saveOK'=>-1,'msg'=>'请输入正确的手机号');
        $phone2='';
        for($i=0;$i<11;$i++){
            $phone2.=$phone[$i];
            if($i==2||$i==6)$phone2.='+';
        }
        $url='https://wappass.baidu.com/wp/api/security/getphonestatus?v='.time().'0000';
        $post='mobilenum='.$phone2.'&clientfrom=native&tpl=tb&login_share_strategy=choice&client=android&adapter=3&t='.time().'0000&act=bind_mobile&loginLink=0&smsLoginLink=1&lPFastRegLink=0&fastRegLink=1&lPlayout=0&lang=zh-cn&regLink=1&action=login&loginmerge=1&isphone=0&dialogVerifyCode=&dialogVcodestr=&dialogVcodesign=&gid=E528690-4ADF-47A5-BA87-1FD76D2583EA&agreement=1&vcodesign=&vcodestr=&sms=1&username='.$phone.'&countrycode=';
        $data=$this->get_curl($url,$post,$this->referrer);
        $arr=json_decode($data,true);
        if($arr['errInfo'] && $arr['errInfo']['no']=='0'){
            return array('code'=>0,'msg'=>$arr['errInfo']['msg']);
        }else{
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
        }
    }
    //手机验证码登录，发送验证码
    public function sendsms($phone,$vcode=null,$vcodestr=null,$vcodesign=null){
        if(empty($phone))return array('saveOK'=>-1,'msg'=>'请先输入手机号');
        if(strlen($phone)!=11)return array('saveOK'=>-1,'msg'=>'请输入正确的手机号');
        if($vcode=='null')$vcode='';
        if($vcodestr=='null')$vcodestr='';
        if($vcodesign=='null')$vcodesign='';
        $url='https://wappass.baidu.com/wp/api/login/sms?v='.time().'0000';
        $post='username='.$phone.'&tpl=tb&clientfrom=native&countrycode=&gid=E528690-4ADF-47A5-BA87-1FD76D2583EA&dialogVerifyCode='.$vcode.'&vcodesign='.$vcodesign.'&vcodestr='.$vcodestr;
        $data=$this->get_curl($url,$post,$this->referrer);
        $arr=json_decode($data,true);
        if($arr['errInfo'] && $arr['errInfo']['no']=='0'){
            return array('code'=>0,'msg'=>$arr['errInfo']['msg']);
        }elseif($arr['errInfo']['no']=='50020'){
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg'],'vcodestr'=>$arr['data']['vcodestr'],'vcodesign'=>$arr['data']['vcodesign']);
        }else{
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
        }
    }
    //手机验证码登录操作
    public function login3($phone,$smsvc){
        if(empty($phone))return array('code'=>-1,'msg'=>'手机号不能为空');
        if(empty($smsvc))return array('code'=>-1,'msg'=>'验证码不能为空');

        $url='https://wappass.baidu.com/wp/api/login?v='.time().'0000';
        $post='smsvc='.$smsvc.'&clientfrom=native&tpl=tb&login_share_strategy=choice&client=android&adapter=3&t='.time().'0000&act=bind_mobile&loginLink=0&smsLoginLink=1&lPFastRegLink=0&fastRegLink=1&lPlayout=0&lang=zh-cn&regLink=1&action=login&loginmerge=&isphone=0&dialogVerifyCode=&dialogVcodestr=&dialogVcodesign=&gid=E528690-4ADF-47A5-BA87-1FD76D2583EA&agreement=1&vcodesign=&vcodestr=&smsverify=1&sms=1&mobilenum='.$phone.'&username='.$phone.'&countrycode=&passAppHash=&passAppVersion=';
        $data = $this->get_curl($url,$post,$this->referrer);
        $arr=json_decode($data,true);
        if(array_key_exists('errInfo',$arr) && $arr['errInfo']['no']=='0'){
            if(!empty($arr['data']['loginProxy'])){
                $data = $this->get_curl($arr['data']['loginProxy'],0,$referrer);
                $arr=json_decode($data,true);
            }
            $data=$arr['data']['xml'];
            preg_match('!<uname>(.*?)</uname>!i',$data,$user);
            preg_match('!<uid>(.*?)</uid>!i',$data,$uid);
            preg_match('!<portrait>(.*?)</portrait>!i',$data,$face);
            preg_match('!<displayname>(.*?)</displayname>!i',$data,$displayname);
            preg_match('!<bduss>(.*?)</bduss>!i',$data,$bduss);
            preg_match('!<ptoken>(.*?)</ptoken>!i',$data,$ptoken);
            preg_match('!<stoken>(.*?)</stoken>!i',$data,$stoken);
            return array('code'=>0,'uid'=>$uid[1],'user'=>$user[1],'displayname'=>$displayname[1],'face'=>$face[1],'bduss'=>$bduss[1],'ptoken'=>$ptoken[1],'stoken'=>$stoken[1]);
        }elseif(array_key_exists('errInfo',$arr)){
            return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
        }else{
            return array('code'=>-1,'msg'=>'登录失败，原因未知');
        }
    }
    //获取扫码登录二维码
    public function getqrcode(){
        $url='https://passport.baidu.com/v2/api/getqrcode?lp=pc&gid=07D9D20-91EB-43D8-8553-16A98A0B24AA&apiver=v3&tt='.time().'0000&callback=callback';
        $data=$this->get_curl($url,0,'https://passport.baidu.com/v2/?login');
        preg_match('/callback\((.*?)\)/',$data,$match);
        $arr=json_decode($match[1],true);
        if(array_key_exists('errno',$arr) && $arr['errno']==0){
            return array('code'=>0,'imgurl'=>$arr['imgurl'],'sign'=>$arr['sign'],'link'=>'https://wappass.baidu.com/wp/?qrlogin&t='.time().'&error=0&sign='.$arr['sign'].'&cmd=login&lp=pc&tpl=&uaonly=');
        }else{
            return array('code'=>$arr['errno'],'msg'=>'获取二维码失败');
        }
    }
    //扫码登录操作
    public function qrlogin($sign){
        if(empty($sign))return array('code'=>-1,'msg'=>'sign不能为空');
        $url='https://passport.baidu.com/channel/unicast?channel_id='.$sign.'&tpl=pp&gid=07D9D20-91EB-43D8-8553-16A98A0B24AA&apiver=v3&tt='.time().'0000&callback=callback';
        $data=$this->get_curl($url,0,'https://passport.baidu.com/v2/?login');
        preg_match('/callback\((.*?)\)/',$data,$match);
        $arr=json_decode($match[1],true);
        if(array_key_exists('errno',$arr) && $arr['errno']==0){
            $arr=json_decode($arr['channel_v'],true);
            $data=$this->get_curl('https://passport.baidu.com/v2/api/bdusslogin?bduss='.$arr['v'].'&u=https%3A%2F%2Fpassport.baidu.com%2F&qrcode=1&tpl=pp&apiver=v3&tt='.time().'0000&callback=callback',0,'https://passport.baidu.com/v2/?login',0,1);
            preg_match('/callback\((.*?)\)/',$data,$match);
            $arr=json_decode($match[1],true);
            if(array_key_exists('errInfo',$arr) && $arr['errInfo']['no']=='0'){
                $data=str_replace('=deleted','',$data);
                preg_match('!BDUSS=(.*?);!i',$data,$bduss);
                preg_match('!PTOKEN=(.*?);!i',$data,$ptoken);
                preg_match('!STOKEN=(.*?);!i',$data,$stoken);
                $userid=$this->getUserid($arr['data']['userName']);
                return array('code'=>0,'uid'=>$userid,'user'=>$arr['data']['userName'],'displayname'=>$arr['data']['displayname'],'mail'=>$arr['data']['mail'],'phone'=>$arr['data']['phoneNumber'],'bduss'=>$bduss[1],'ptoken'=>$ptoken[1],'stoken'=>$stoken[1]);
            }elseif(array_key_exists('errInfo',$arr)){
                return array('code'=>$arr['errInfo']['no'],'msg'=>$arr['errInfo']['msg']);
            }else{
                return array('code'=>'-1','msg'=>'登录失败，原因未知');
            }
        }elseif(array_key_exists('errno',$arr)){
            return array('code'=>$arr['errno']);
        }else{
            return array('code'=>'-1','msg'=>'登录失败，原因未知');
        }
    }
    private function getUserid($uname){
        $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36';
        $data = $this->get_curl('http://tieba.baidu.com/home/get/panel?ie=utf-8&un='.urlencode($uname),0,0,0,0,$ua);
        $arr = json_decode($data,true);
        $userid = $arr['data']['id'];
        return $userid;
    }
    private function get_curl($url,$post=0,$referer=1,$cookie=0,$header=0,$ua=0,$nobaody=0){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $httpheader[] = "Accept:application/json";
        $httpheader[] = "Accept-Encoding:gzip,deflate,sdch";
        $httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";
        $httpheader[] = "Connection:close";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        if($post){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($header){
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
        }
        if($cookie){
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        if($referer){
            curl_setopt($ch, CURLOPT_REFERER, "https://wappass.baidu.com/");
        }
        if($ua){
            curl_setopt($ch, CURLOPT_USERAGENT,$ua);
        }else{
            curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; Android 4.4.2; H650 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36');
        }
        if($nobaody){
            curl_setopt($ch, CURLOPT_NOBODY,1);

        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    }
}