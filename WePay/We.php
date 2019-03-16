<?php

namespace WePay;


use Driver\core\Cache;
use Driver\core\Curl;
use Driver\core\Tools;
use Driver\Register;
use Driver\core\Wechat;
use Driver\third\Tool;

/**
 * Class We
 * @package WePay
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/11 16:55
 * 支付配置接口
 */
class We extends Wechat
{

    /**
     * @param $options
     * @param string $type
     * @param string $sign_type
     * 处理预支付订单参数
     */
    public function doParam(&$options, $type = "wechat",$sign_type='MD5')
    {
        $field = 'appid';
        if ($type == 'weapi') $field = 'weapiappid';
        $options['appid'] = self::$config[$field];
        $options['mch_id']=self::$config['mch_id'];
        $options['nonce_str']=Register::tool()->createNoncestr();
        $options['sign_type']=$sign_type;
        $options['sign']=self::get_pay_sign($options);

    }

    /**
     * @param $prepayId /预付款参数
     * @param string $type
     * @return mixed
     * 转换jsapi支付/h5/小程序支付请求参数
     */
    public function jsapiParam($prepayId,$type='wechat')
    {
        $field = 'appid';
        if ($type == 'weapi') $field = 'weapiappid';
        $options["appId"] = self::$config[$field];
        $options["timeStamp"] = (string)time();
        $options["nonceStr"] = Register::tool()->createNoncestr();
        $options["package"] = "prepay_id={$prepayId}";
        $options["signType"] = "MD5";
        $options["paySign"] = self::get_pay_sign($options);
        $options['timestamp'] = $options['timeStamp'];
        return $options;
    }


    /**
     * @param $product_id /支付订单号
     * @return string
     *扫码支付二维码
     */
    public function qrcodeParam($product_id)
    {
        $options['appid'] = self::$config['appid'];
        $options['mch_id']=self::$config['mch_id'];
        $options['time_stamp']=(string)Register::tools()->system_time();
        $options['nonce_str']=Register::tool()->createNoncestr();
        $options['product_id']=$product_id;
        $options['sign']=self::get_pay_sign($options);
        return "weixin://wxpay/bizpayurl?" . http_build_query($options);
    }

    /**
     * @param $prepayid
     * @return mixed
     * 转换app支付参数
     */
    public function appParam($prepayid)
    {

        $options['appid'] = self::$config['appid'];
        $options['partnerid']=self::$config['mch_id'];
        $options['prepayid']=(string)$prepayid;
        $options['package']='Sign=WXPay';
        $options['timestamp']=(string)Register::tools()->system_time();
        $options['noncestr']=Register::tool()->createNoncestr();
        $options['sign']=self::get_pay_sign($options);
        return $options;
    }

    /**
     * @param $options
     * @param string $type
     * @return string
     * 获取生成签名
     */
    public function get_pay_sign($options, $type = "MD5")
    {
        return self::MakeSign($options, $type);
    }

    /**
     * 生成微信签名
     * @param $options
     * @param string $type
     * @return string
     */
    protected function MakeSign($data, $signType = 'MD5',$buff='')
    {
        ksort($data);
        if (isset($data['sign'])) unset($data['sign']);
        foreach ($data as $k => $v) $buff .= "{$k}={$v}&";
        $buff .= ("key=" . self::$config['mch_key']);

        if (strtoupper($signType) === 'MD5') {
            return strtoupper(md5($buff));
        }
        return strtoupper(hash_hmac('SHA256', $buff, self::$config->get('mch_key')));
    }
    public function ToUrlParams($options)
    {
        $buff = "";
        foreach ($options as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * @param $string
     * @param string $encrypted
     * @return array|string
     * rsa加密
     */
    public function rsaEncode($string, $encrypted = '')
    {
        $search = ['-----BEGIN RSA PUBLIC KEY-----', '-----END RSA PUBLIC KEY-----', "\n", "\r"];
        $pkc1 = str_replace($search, '', $this->getRsaContent());
        $publicKey = '-----BEGIN PUBLIC KEY-----' . PHP_EOL .
            wordwrap('MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8A' . $pkc1, 64, PHP_EOL, true) . PHP_EOL .
            '-----END PUBLIC KEY-----';
        if (!openssl_public_encrypt("{$string}", $encrypted, $publicKey, OPENSSL_PKCS1_OAEP_PADDING)) {
            return ['code'=>400,'message'=>'Rsa Encrypt Error.'];
        }
        return base64_encode($encrypted);
    }

    /**
     * @return array|string
     * 获取文件签名内容
     */
    private function getRsaContent()
    {
        $cacheKey = "pub_ras_key_" .self::$config['mch_id'];
        if (($pub_key = Cache::get($cacheKey))) {
            return $pub_key;
        }
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        $data=\Driver\WeChat::instance(__FUNCTION__)->run()->curl()->ssl($ssl_cer,$ssl_key)->post()->toArray();
        if (!isset($data['return_code']) || $data['return_code'] !== 'SUCCESS' || $data['result_code'] !== 'SUCCESS') {
            $error = 'ResultError:' . $data['return_msg'];
            $error .= isset($data['err_code_des']) ? ' - ' . $data['err_code_des'] : '';
           return ['code'=>400,'error'=>$error,'errorCode'=> 20000, 'data'=>$data];
        }
        Cache::set($cacheKey, $data['pub_key'], 600);
        return $data['pub_key'];
    }

}