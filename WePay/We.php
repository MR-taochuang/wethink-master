<?php

namespace WePay;


use Driver\Register;
use Driver\WeChat;

/**
 * Class We
 * @package WePay
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/11 16:55
 * 支付配置接口
 */
class We extends WeChat
{

    public function doParam(&$options, $type = "wechat")
    {
        $field = 'appid';
        if ($type == 'weapi') $field = 'weapiappid';
        $options['appid'] = self::$config[$field];
        $options['mch_id']=self::$config['mch_id'];
        $options['nonce_str']=Register::tool()->createNoncestr();
        $options['sign_type']='MD5';
        $options['sign']=self::get_pay_sign($options);
    }

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
        $buff .= ("key=" . self::$config->get('mch_key'));

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

}