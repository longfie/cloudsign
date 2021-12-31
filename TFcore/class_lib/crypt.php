<?php
/**
 *Author 龙辉 QQ1790716272
 *Time  2021/10/16 22:49
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
class Mcrypt{
    private static $default_key = 'a!takA:dlmcldEv,e';

    /**
     * 字符加密，一次一密,可定时解密有效
     *
     * @param string $string 原文
     * @param string $key 密钥
     * @param int $expiry 密文有效期,单位s,0 为永久有效
     * @return string 加密后的内容
     */
    public static function encode($string,$key = '', $expiry = 0){
        $ckeyLength = 4;
        $key = md5($key ? $key : self::$default_key); //解密密匙
        $keya = md5(substr($key, 0, 16));         //做数据完整性验证
        $keyb = md5(substr($key, 16, 16));         //用于变化生成的密文 (初始化向量IV)
        $keyc = substr(md5(microtime()), - $ckeyLength);
        $cryptkey = $keya . md5($keya . $keyc);
        $keyLength = strlen($cryptkey);
        $string = sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string . $keyb), 0, 16) . $string;
        $stringLength = strlen($string);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $keyLength]);
        }

        $box = range(0, 255);
        // 打乱密匙簿，增加随机性
        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        // 加解密，从密匙簿得出密匙进行异或，再转成字符
        $result = '';
        for($a = $j = $i = 0; $i < $stringLength; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        $result = $keyc . str_replace('=', '', base64_encode($result));
        $result = str_replace(array('+', '/', '='),array('-', '_', '.'), $result);
        return $result;
    }

    /**
     * 字符解密，一次一密,可定时解密有效
     *
     * @param string $string 密文
     * @param string $key 解密密钥
     * @return string 解密后的内容
     */
    public static function decode($string,$key = '')
    {
        $string = str_replace(array('-', '_', '.'),array('+', '/', '='), $string);
        $ckeyLength = 4;
        $key = md5($key ? $key : self::$default_key); //解密密匙
        $keya = md5(substr($key, 0, 16));         //做数据完整性验证
        $keyb = md5(substr($key, 16, 16));         //用于变化生成的密文 (初始化向量IV)
        $keyc = substr($string, 0, $ckeyLength);
        $cryptkey = $keya . md5($keya . $keyc);
        $keyLength = strlen($cryptkey);
        $string = base64_decode(substr($string, $ckeyLength));
        $stringLength = strlen($string);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $keyLength]);
        }

        $box = range(0, 255);
        // 打乱密匙簿，增加随机性
        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        // 加解密，从密匙簿得出密匙进行异或，再转成字符
        $result = '';
        for($a = $j = $i = 0; $i < $stringLength; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0)
            && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)
        ) {
            return substr($result, 26);
        } else {
            return '';
        }
    }
}

//               代码加载完毕,就是如此简单 ︿(￣︶￣)︿