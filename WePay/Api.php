<?php

namespace WePay;
use Driver\core\Wechat;
use Driver\Register;


class Api extends Wechat{

    /**
     * @param array $options
     * @return array
     * 微信统一下单接口
     */
    public function unifiedOrder(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @return array
     * 查询订单接口
     */
    public function orderQuery(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param $out_trade_no /订单号
     * @param string $type
     * @return array
     * 关闭订单接口
     */
    public function closeOrder($out_trade_no,$type='wechat'){
        $options=['out_trade_no'=>$out_trade_no];
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param $options /退款参数
     * @param string $type
     * @return array|void
     * 申请退款
     */
    public function refund(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();
    }

    /**
     * @param $options /查询参数
     * @param string $type
     * @return array
     * 查询退款
     */
    public function refundQuery(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param string $type
     * @return array
     * 下载对账单
     */
    public function downloadBill(array $options, $type = 'wechat'){
        $field = 'appid';
        if ($type == 'weapi') $field = 'weapiappid';
        $options['appid'] = self::$config[$field];
        $options['mch_id']=self::$config['mch_id'];
        $options['nonce_str']=Register::third()->tool()->createNoncestr();
        $options['sign']=self::WepayWe()->get_pay_sign($options);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param $type
     * @return array
     * 提交被扫支付API
     * 刷卡支付
     */
    public function micropay(array $options,$type){
        $field = 'appid';
        if ($type == 'weapi') $field = 'weapiappid';
        $options['appid'] = self::$config[$field];
        $options['mch_id']=self::$config['mch_id'];
        $options['nonce_str']=Register::third()->tool()->createNoncestr();
        $options['sign']=self::WepayWe()->get_pay_sign($options);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @return array|void
     * 刷卡支付 撤销订单
     */
    public function reverse(array $options){
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param string $type
     * @return array
     * 测速上报，该方法内部封装在report中，使用时请注意异常流程
     */
    public function report(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param $authCode
     * @param string $type
     * @return array
     * 刷卡支付 授权码查询openid
     */
    public function AuthCode($authCode,$type='wechat'){
        $options['auth_code']=$authCode;
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param string $type
     * @return array
     * 拉取订单评价数据
     */
    public function OrderComment(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param string $type
     * @return array|void
     * 发放优惠券
     */
    public function coupon(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @return array
     * 查询代金券批次
     */
    public function queryStock(array $options,$type="wechat"){
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param string $type
     * @return array
     * 查询代金券
     */
    public function queryInfo(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        return self::instance(__FUNCTION__)->run()->post($options,'xml')->toArray();
    }

    /**
     * @param $options
     * @param string $type
     * @return array|void
     * 发放普通红包
     */
    public function RedPack(array $options,$type='wechat'){
        self::WepayWe()->doSign($options);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param string $type
     * @return array|void
     * 发放裂变红包
     */
    public function GroupRedPack(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();
    }

    /**
     * @param array $options
     * @param string $type
     * @return array|void
     * 企业付款到零钱
     */
    public function Transfers(array $options,$type='wechat'){
        self::WepayWe()->doParam($options,$type);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();

    }

    /**
     * @param $partnerTradeNo
     * @param string $type
     * @return array|void
     * 查询企业付款到零钱
     */
    public function queryTransfers($partnerTradeNo,$type='wechat'){

        $options= ['partner_trade_no' => $partnerTradeNo];
        self::WepayWe()->doParam($options,$type);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();

    }

    /**
     * @param array $options
     * @param string $type
     * @return array|void
     * 企业付款到银行卡
     */
    public function TransfersBank(array $options,$type='wechat'){
        $options['enc_bank_no']=self::WepayWe()->rsaEncode($options['enc_bank_no']);
        $options['enc_true_name']=self::WepayWe()->rsaEncode($options['enc_true_name']);
        $options['desc']=isset($options['desc']) ? $options['desc'] : '';
        self::WepayWe()->doParam($options,$type);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();
    }

    /**
     * @param $partnerTradeNo
     * @param string $type
     * @return array|void
     * 商户企业付款到银行卡操作进行结果查询
     */
    public function queryTransfersBank($partnerTradeNo,$type='wechat'){
        $options=['partner_trade_no' => $partnerTradeNo];
        self::WepayWe()->doParam($options,$type);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();


    }

    /**
     * @param $mchBillno
     * @param $bill_type
     * @return array|void
     * 查询红包记录
     */
    public function queryRedPack($mchBillno,$bill_type){
        $options=['mch_billno' => $mchBillno, 'bill_type' => $bill_type];
        self::WepayWe()->doParam($options);
        $ssl_cer=self::$config['ssl_cer'];
        $ssl_key=self::$config['ssl_key'];
        return self::instance(__FUNCTION__)->run()->ssl($ssl_cer,$ssl_key)->post($options,'xml')->toArray();
    }

}