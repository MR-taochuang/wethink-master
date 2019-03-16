<?php

namespace WeChat;

use Driver\WeChat;


/**
 * Class Richscan
 * @package WeChat
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/7 14:00
 * 微信扫一扫
 */
class Richscan extends WeChat{
    /***
     * @return array
     * /获取商户信息
     */
    public function MerchantInfoGet(){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->get()->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 创建商品
     */
    public function ProductCreate(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $keystandard
     * @param $keystr
     * @param $status
     * @return array
     * 商品发布
     */
    public function ProductModstatus($keystandard,$keystr,$status){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['keystandard'=>$keystandard,'keystr'=>$keystr,'status'=>$status])->toArray();
    }

    /***
     * @param null $openid
     * @param null $username
     * @return array
     * 设置测试人员白名单
     */
    public function TestWhiteListSet($openid=null,$username=null){
        $data=array();
        if(!empty($openid)) $data['openid']=$openid;
        if(!empty($username)) $data['username']=$username;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $keystandard
     * @param $keystr
     * @param int $qrcode_size
     * @param null $extinfo
     * @return array
     * 获取商品二维码
     */
    public function ProductGetQrCode($keystandard,$keystr,$qrcode_size=100,$extinfo=null){
        $data=['keystandard'=>$keystandard,'keystr'=>$keystr,'qrcode_size'=>$qrcode_size];
        if(!empty($extinfo)) $data['extinfo']=$extinfo;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $keystandard
     * @param $keystr
     * @return array
     * 查询商品信息
     */
    public function ProductGet($keystandard,$keystr){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['keystandard'=>$keystandard,'keystr'=>$keystr])->toArray();
    }

    /***
     * @param $offset
     * @param $limit
     * @param null $status
     * @param null $keystr
     * @return array
     * 批量查询商品信息
     */
    public function ProductGetList($offset,$limit,$status=null,$keystr=null){
        $data=['offset'=>$offset,'limit'=>$limit];
        if(!empty($status)) $data['status']=$status;
        if(!empty($keystr)) $data['keystr']=$keystr;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $keystandard
     * @param $keystr
     * @param null $brand_info
     * @return array
     * 更新商品信息
     */
    public function ProductUpdate($keystandard,$keystr,$brand_info=null){
        $data=['keystandard'=>$keystandard,'keystr'=>$keystr];
        if(!empty($brand_info)) $data['brand_info']=$brand_info;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $keystandard
     * @param $keystr
     * @return array
     * 清除商品信息
     */
    public function ProductClear($keystandard,$keystr){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['keystandard'=>$keystandard,'keystr'=>$keystr])->toArray();
    }

    /***
     * @param $ticket
     * @return array
     * 检查wxticket参数
     */
    public function ScanticketCheck($ticket){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['ticket'=>$ticket])->toArray();
    }

    /***
     * @param $keystandard
     * @param $keystr
     * @param $extinfo
     * @return array
     * 清除扫码记录
     */
    public function ClearScanticketCheck($keystandard,$keystr,$extinfo){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['keystandard'=>$keystandard,'keystr'=>$keystr,'extinfo'=>$extinfo])->toArray();
    }
}