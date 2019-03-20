<?php

namespace WeChat;

use Driver\core\WeChat;

/**
 * Class Wifi
 * @package WeChat
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/7 14:04
 * 微信wifi接口
 */
class Wifi extends Wechat{
    /***
     * @param $callback_url
     * @return array
     * 第三方平台获取开插件wifi_token
     */
    public function OpenPlugin($callback_url){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['callback_url'=>$callback_url])->toArray();
    }

    /***
     * @param $options
     * @return array
     * 连Wi-Fi完成页跳转小程序
     */
    public function FinishPageSet($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 设置顶部banner跳转小程序接口
     */
    public function HomePageSet($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $shop_id
     * @return array
     * 查询门店WiFi信息接口
     */
    public function ShopGet($shop_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['shop_id'=>$shop_id])->toArray();
    }

    /***
     * @param null $pageindex
     * @param null $pagesize
     * @return array
     * 获取WiFi门店列表
     */
    public function ShopList($pageindex=null,$pagesize=null){
        $data = array();
        if(!empty($pageindex)) $data['pageindex']=$pageindex;
        if(!empty($pagesize)) $data['pagesize']=$pagesize;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $shop_id
     * @param $old_ssid
     * @param $ssid
     * @param null $password
     * @return array
     * 修改门店网络信息
     */
    public function ShopUpdate($shop_id,$old_ssid,$ssid,$password=null){
        $data=['shop_id'=>$shop_id,'old_ssid'=>$old_ssid,'ssid'=>$ssid];
        if(!empty($password)) $data['password']=$password;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /**
     * @param $shop_id
     * @param null $ssid
     * @return array
     * 清空门店网络及设备
     */
    public function ShopClean($shop_id,$ssid=null){
        $data=['shop_id'=>$shop_id,'ssid'=>$ssid];
        if(!empty($ssid)) $data['ssid']=$ssid;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $shop_id
     * @param $ssid
     * @param $password
     * @return array
     * 添加密码型设备
     */
    public function DeviceAdd($shop_id,$ssid,$password){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['shop_id'=>$shop_id,'ssid'=>$ssid,'password'=>$password])->toArray();
    }

    /***
     * @param $shop_id
     * @param $ssid
     * @param null $reset
     * @return array
     * 添加portal型设备
     */
    public function ApportalRegister($shop_id,$ssid,$reset=null){
        $data=['shop_id'=>$shop_id,'ssid'=>$ssid];
        if(!empty($reest)) $data['reset']=$reset;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param null $pageindex
     * @param null $pagesize
     * @param null $shop_id
     * @return array
     * 查询设备
     */
    public function BizwwifiDeviceList($pageindex=null,$pagesize=null,$shop_id=null){
        $data=array();
        if(!empty($pageindex)) $data['pageindex']=$pageindex;
        if(!empty($pagesize)) $data['pagesize']=$pagesize;
        if(!empty($shop_id)) $data['shop_id']=$shop_id;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $bssid
     * @return array
     * 删除设备
     */
    public function DeviceDelete($bssid){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($bssid)->toArray();
    }

    /***
     * @param $shop_id
     * @param $ssid
     * @param $img_id
     * @return array
     * 获取物料二维码
     */
    public function QrcodeGet($shop_id,$ssid,$img_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['shop_id'=>$shop_id,'ssid'=>$ssid,'img_id'=>$img_id])->toArray();
    }

    /***
     * @param $shop_id
     * @return array
     * 查询商家主页
     */
    public function HomepageGet($shop_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['shop_id'=>$shop_id])->toArray();
    }

    /***
     * @param $shop_id
     * @param $bar_type
     * @return array
     * 设置微信首页欢迎语
     */
    public function BarSet($shop_id,$bar_type){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['shop_id'=>$shop_id,'bar_type'=>$bar_type])->toArray();
    }

    /***
     * @param $begin_date
     * @param $end_date
     * @param $shop_id
     * @return array
     * Wi-Fi数据统计
     */
    public function StatisticsList($begin_date,$end_date,$shop_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['begin_date'=>$begin_date,'end_date'=>$end_date,'shop_id'=>$shop_id])->toArray();
    }

    /***
     * @param $shop_id
     * @param $card_id
     * @param $card_describe
     * @param $start_time
     * @param $end_time
     * @return array
     * 设置门店卡券投放信息
     */
    public function CouponputSet($shop_id,$card_id,$card_describe,$start_time,$end_time){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['shop_id'=>$shop_id,'card_id'=>$card_id,'card_describe'=>$card_describe,'start_time'=>$start_time,'end_time'=>$end_time])->toArray();
    }

    /***
     * @param $shop_id
     * @return array
     *查询门店卡券投放信息
     */
    public function CouponputGet($shop_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['shop_id'=>$shop_id])->toArray();
    }

}