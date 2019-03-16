<?php

namespace WePay;

use Driver\core\Wechat;
use Driver\third\Tool;

/**
 * Class Notify
 * @package WePay
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/3/16 17:20
 * 回调
 */
class Notify extends Wechat
{

    /**
     * @return array
     * 支付回调数据
     */
    public function pay()
    {
        $data = Tool::xml2arr(file_get_contents("php://input"));
        $sign=self::WepayWe()->get_pay_sign($data);
        if(isset($data['sign']) && $data['sign']===$sign){
            return $data;
        }else{
            return ['code'=>400,'message'=>'回调出错'];
        }
    }

    /**
     * @return array
     * 退款回调
     */
    public function refund()
    {
        $data = Tool::xml2arr(file_get_contents("php://input"));
        if (!isset($data['return_code']) || $data['return_code'] !== 'SUCCESS') {
            return ['code'=>400,'message'=>'获取退款通知XML失败！'];
        }
        $pc = new \Prpcrypt(md5(self::$config['mch_key']));
        $array = $pc->decrypt(base64_decode($data['req_info']));
        if (intval($array[0]) > 0) {
            return ['code'=>400,'message'=>[$array[1], $array[0]]];
        }
        $data['decode'] = $array[1];
        return $data;

    }

}