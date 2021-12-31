<?php

    /*
    *author : 一千零一夜-龙辉QQ1790716272
    *date:2020/03/28
    *description:贴吧关注类
    *parma: kw=需要关注的吧  bduss=登录贴吧之后的bduss 
    *
    *
    */
    class Tblike{
            protected $kw = '';
            protected $bduss = '';
            protected $head = array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Encoding: gzip, deflate, br',
    'Accept-Language: zh-CN,zh;q=0.9',
    'Cache-Control: max-age=0',
    'Connection: keep-alive',
        'Host: tieba.baidu.com',
    'Sec-Fetch-Dest: document',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-Site: none',
    'Sec-Fetch-User: ?1',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36',
                );
        public function __construct($kw=null,$bduss=null){
            
            $this->kw = urlencode($kw);
            $this->bduss =$bduss;
            
        }
      public function like(){
    $kwurl = 'https://tieba.baidu.com/mo/q/favolike?fid='.$this->fid().'&kw='.$this->kw.'&itb_tbs='.$this->tbs().'&uid='.$this->tbs();
    //$kwurl = 'https://tieba.baidu.com/mo/q/favolike?fid=16386&kw=%E6%81%8B%E7%88%B1&itb_tbs='.$this->tbs().'&uid='.$this->tbs();
      $result = $this->geturl($kwurl,$this->bduss,$this->head);
      $results = json_decode($result,true);
      
      if($results['no']==0){
          return 1;
          
      }elseif($results['no']==20001){
          
           return 0;
           
      }else{
          
          return 0;
      }
     
    
        }
        
       protected function fid(){
        
            $tbinfo = json_decode($this->geturl('http://tieba.baidu.com/f/commit/share/fnameShareApi?ie=utf-8&fname='.$this->kw),true);
            $fid = $tbinfo['data']['fid'];
            return $fid ;
        }
      protected function tbs(){
            $tbs = json_decode($this->geturl('http://tieba.baidu.com/dc/common/tbs',$this->bduss),true);
            
            return $tbs['tbs'];
        }
        
        protected function geturl($url,$bduss=null,$head=null){
                $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);            
            if(!is_null($bduss))curl_setopt($ch, CURLOPT_COOKIE , 'BDUSS='.$bduss);        
            if(!is_null($head))curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);        // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);        // 使用自动跳转
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);           // 自动设置Referer
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);        // 设置等待时间
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);              // 设置cURL允许执行的最长秒数
            $res = curl_exec($ch);
            curl_close($ch);
            return $res;
            }
    }    

    /*代码编写完毕！就是如此简单——.——*/
	
	
	
	
?>