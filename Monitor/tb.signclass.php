<?php
/**
 *signcore
 *author : 龙辉QQ1790716272
 *date:2021/10/29
 *description:贴吧签到类
 */
class tbsign{
    protected $bduss = '';
    /*模拟手机客户端签到 每天都+8*/
    protected $tieba_header = array(
        'Content-Type: application/x-www-form-urlencoded',
        'Charset: UTF-8',
        'net: 3',
        'User-Agent: bdtb for Android 8.4.0.1',
        'Connection: Keep-Alive',
        'Accept-Encoding: gzip',
        'Host: c.tieba.baidu.com',
    );
    protected $firefox_header = array(
        'Host: tieba.baidu.com',
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0',
        'Accept: */*',
        'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3',
        'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
        'Referer: http://tieba.baidu.com/',
        'Connection: keep-alive',
    );
    public function __construct($bduss=null){

        $this->bduss =$bduss;

    }


    protected function postdata(){

        $crypt = md5('BDUSS='.$this->bduss.'tbs='.$this->tbs().'tiebaclient!!!');
        $postdata = 'BDUSS='.$this->bduss.'&tbs='.$this->tbs().'&sign='.$crypt;
        return $postdata;
    }

    public function loginstate(){

       return self::TBinfo()['data']['is_login'];
    }

   public function TBinfo(){
       return json_decode($this->xCurl('https://tieba.baidu.com/mg/o/profile?format=json','BDUSS='.$this->bduss,null,$this->firefox_header),true);
    }
    protected function tbs(){
        $tbs = json_decode($this->xCurl('http://tieba.baidu.com/dc/common/tbs','BDUSS='.$this->bduss,null,$this->firefox_header),true);
        return $tbs['tbs'];
    }
    public function allsign($pageno=1){
        if(!$this->loginstate())return 0;
        $POSTDATA=array();
 $tbnum = 0;
        $re = json_decode($this->xCurl('http://c.tieba.baidu.com/c/c/forum/msign','ca=open',$this->postdata(),$this->tieba_header),true);

        /*$re = json_decode($this->xCurl('http://tieba.baidu.com/tbmall/onekeySignin1','BDUSS='.$this->bduss,'ie=utf-8&tbs='.$this->tbs(),$this->firefox_header),true);*/
          // for ($pageno;1; $pageno ++){

        $postdata='BDUSS='.urlencode($this->bduss).'&_client_version=8.1.0.4'.'&page_no=' . $pageno.'&page_size=100'.'&sign='.md5('BDUSS='.$this->bduss.'_client_version=8.1.0.4'.'page_no='.$pageno.'page_size=100tiebaclient!!!');
       
        $re = json_decode($this->xCurl('http://c.tieba.baidu.com/c/f/forum/like','ca=open',$postdata,$this->tieba_header),true);
        if(is_array($re['forum_list']['non-gconforum'])){

            foreach ($re['forum_list']['non-gconforum'] as $list) {

                /* $this->xCurl('http://c.tieba.baidu.com/c/c/forum/sign','ca=open','BDUSS='.urlencode($this->bduss).'&fid='.$list['id'].'&kw='.urlencode($list['name']).'&sign='.md5('BDUSS='.$this->bduss.'fid='.$list['id'].'kw='.$list['name'].'tbs='.$this->tbs().'tiebaclient!!!').'&tbs='.$this->tbs(),$this->tieba_header);*/
                 $this->xCurl('http://c.tieba.baidu.com/c/c/forum/sign','ca=open','BDUSS='.urlencode($this->bduss).'&fid='.$list['id'].'&kw='.urlencode($list['name']).'&sign='.md5('BDUSS='.$this->bduss.'fid='.$list['id'].'kw='.$list['name'].'tbs='.$this->tbs().'tiebaclient!!!').'&tbs='.$this->tbs(),$this->tieba_header);

               /* $POSTDATA[]='BDUSS='.urlencode($this->bduss).'&fid='.$list['id'].'&kw='.urlencode($list['name']).'&sign='.md5('BDUSS='.$this->bduss.'fid='.$list['id'].'kw='.$list['name'].'tbs='.$this->tbs().'tiebaclient!!!').'&tbs='.$this->tbs();*/
                $tbnum++;

            }//}
       // $this->MULTI_send($POSTDATA);
        if ($re['has_more'] == 0)
        return ['end','tbnum'=>$tbnum];
        

        }

        //  $resultss = $this->MULTI_post($POSTDATA,'ca=open',$this->tieba_header);

        /* $res = json_decode($this->xCurl('http://tieba.baidu.com/tbmall/onekeySignin1','BDUSS='.$this->bduss,'ie=utf-8&tbs='.$this->tbs(),$this->firefox_header),true);*/
        return $tbnum;
        /* if($res['data']['signedForumAmount']>0){
             return $res['data']['signedForumAmount'];
         }else{
             return 0;
         }*/

    }


    protected function MULTI_send($postdata) {
        $queue = curl_multi_init();
        $map = array();
        if (!is_null($postdata)){
            foreach ($postdata as $data) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,'http://c.tieba.baidu.com/c/c/forum/sign');
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
                curl_setopt($ch, CURLOPT_COOKIE,'ca=open');
                curl_setopt($ch, CURLOPT_HTTPHEADER,$this->tieba_header);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
                curl_setopt($ch, CURLOPT_ENCODING, "gzip");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_NOBODY, 1);
                curl_setopt($ch, CURLOPT_NOSIGNAL, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 1);
                curl_multi_add_handle($queue, $ch);
                $map[(string) $ch] = $url;
            }}
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

    protected function xCurl($url,$cookie=null,$postdata=null,$header=array()){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        if (!is_null($postdata)) curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
        if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
        if (!empty($header)) curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        $re = curl_exec($ch);
        curl_close($ch);
        return $re;
    }
}