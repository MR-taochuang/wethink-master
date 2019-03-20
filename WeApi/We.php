<?php

namespace WeApi;


use Driver\Register;
use Driver\core\Wechat;

/**
 * Class We
 * @package WeChat
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 16:12
 * 微信小程序基础类
 */
class We extends Wechat
{


    /**
     * @return string
     * 获取微信小程序access_token
     */
    public function AccessToken()
    {
        return self::GetWeApiAccessToken();
    }
    /**
     * @param $access_token
     * @return mixed
     * @throws \Exception
     * 设置外部token
     */
    public function setWeApiAccessToken($access_token)
    {
        Register::cache()->set('WeApiAccessToken', $access_token, 7000);
        return $access_token;
    }

    /**
     * 用户支付完成后，获取该用户的 UnionId
     * @param $openid /支付用户唯一标识
     * @param null $transaction_id 微信支付订单号
     * @param $mch_id /微信支付分配的商户号，和商户订单号配合使用
     * @param $out_trade_no /微信支付商户订单号，和商户号配合使用
     * @return array
     */
    public function WeApiGetUnionid($openid,$transaction_id=null,$mch_id,$out_trade_no){
        $link_url='';
        if(!empty($transaction_id)) $link_url.='&transaction_id='.$transaction_id;
        if(!empty($mch_id)) $link_url.='&mch_id='.$mch_id;
        if(!empty($out_trade_no)) $link_url.='&out_trade_no='.$out_trade_no;
        return self::instance(__FUNCTION__)->run(self::$config->set('link_url',$link_url),self::$config->set('openid',$openid))->get()->toArray();
    }

    /**
     * 创建被分享动态消息的 activity_id
     * @return array
     */
    public function WeApiActivityid(){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->get()->toArray();
    }

    /**
     * 修改被分享的动态消息
     * @param $activity_id /动态消息的 ID，通过 createActivityId 接口获取
     * @param $target_state /动态消息修改后的状态（具体含义见后文）
     * @param $template_info /动态消息对应的模板信息
     * @return array
     */
    public function WeApiUpdatablemsg($activity_id,$target_state,$template_info){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['activity_id'=>$activity_id,'target_state'=>$target_state,'template_info'=>$template_info])->toArray();
    }

    /**
     * 校验一张图片是否含有违法违规内容
     * @param $file /文件地址
     * @return array
     */
    public function imgSecCheck($file){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->file($file)->toArray();
    }

    /**
     * 检查一段文本是否含有违法违规内容。
     * @param $content /文字内容
     * @return array
     */
    public function msgSecCheck($content){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['content'=>$content])->toArray();
    }
    public function requestWeapiAccessToken(){
        $access_token =  \Driver\Register::cache()->get('WeApiAccessToken');
        if (isset($access_token)) {
            self::$config->set('weapi_access_token',$access_token);
            \Driver\Register::cache()->set('weapi_access_token', $access_token);
            return $access_token;
        } else {
            $res = self::instance(__FUNCTION__)->run()->get()->toArray();
            if (!empty($res['access_token'])) {
                \Driver\Register::cache()->set('WeApiAccessToken', $res['access_token'], 7000);
                \Driver\Register::cache()->set('weapi_access_token', $res['access_token']);
                self::$config->set('weapi_access_token',$res['access_token']);
                return $res['access_token'];
            } else{
                throw new \Exception($res['access_token']);
            }
        }
    }

}