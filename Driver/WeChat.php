<?php

namespace Driver;


/**
 * Class WeChat
 * @package Driver
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2018/12/26 13:40
 * 微信基础
 *
 * -----微信集成类----
 *
 * ---------------微信公众号操作类-------------------
 * @method  \WeChat\We We($config = []) static 微信基础类
 * @method  \WeChat\Custom Custom($config = []) static 客服消息
 * @method  \WeChat\Kfaccount Kfaccount($config = []) static 客服设置
 * @method  \WeChat\Media Media($config = []) static 素材管理
 * @method  \WeChat\Menu Menu($config = []) static 菜单管理
 * @method  \WeChat\Template Template($config = []) static 模板消息
 * @method  \WeChat\User User($config = []) static 微信用户管理
 * @method  \WeChat\Summary Summary($config = []) static 微信数据分析
 * @method  \WeChat\Qrcode Qrcode($config = []) static 二维码管理
 * @method  \WeChat\Card Card($config = []) static 卡券管理
 * @method  \WeChat\Shake Shake($config = []) static 微信摇一摇
 * @method  \WeChat\Smart Smart($config = []) static 微信智能接口
 * @method  \WeChat\Weshop Weshop($config = []) static 微信小店
 * @method  \WeChat\Richscan Richscan($config = []) static 微信扫一扫
 * @method  \WeChat\Wifi Wifi($config = []) static 微信Wifi
 * @method  \WeChat\Invoice Invoice($config = []) static 微信发票
 * ---------------微信公众号操作类-------------------
 *
 * ---------------微信小程序操作类-------------------
 * @method \WeApi\We WeapiWe($config = []) static 微信小程序基础类
 * @method \WeApi\User WeapiUser($config = []) static 微信小程序用户管理
 * @method \WeApi\Custom WeapiCustom($config = []) static 微信小程序客服发送消息
 * @method \WeApi\Logistics WeapiLogistics($config = []) static WeapiLogistics 微信小程序物流助手
 * @method \WeApi\Media WeapiMedia($config = []) static 微信小程序素材管理
 * @method \WeApi\Plugin WeapiPlugin($config=[]) static 微信小程序插件管理
 * @method \WeApi\Poi WeapiPoi($config=[]) static 微信小程序地址管理
 * @method \WeApi\Qrcode WeapiQrcode($config=[]) static 微信小程序二维码管理
 * @method \WeApi\Summary WeapiSummary($config=[]) static 微信小程序数据分析
 * @method \WeApi\Template WeapiTemplate($config=[]) static 微信小程序模板消息
 * ---------------微信小程序操作类-------------------
 *
 * ---------------微信支付操作类-------------------
 * @method \WePay\We  WepayWe($config = []) static 微信支付基础类
 * @method \WePay\Pay WepayPay($config=[]) static 微信支付
 * ---------------微信支付操作类-------------------
 */
class WeChat
{
    /**
     * @var array
     * 微信公众号基本参数
     */
    public static $config;

    /**
     * WeChat constructor.
     * @param array $param
     * 获取微信公众号配置信息
     */
    public function __construct($param = [])
    {
        if (!empty($param)) self::$config =  Register::init($param);
    }

    /**
     * 初始微信请求
     * @param $url
     * @return \Driver\core\Init;
     */
    public static function instance($url = '')
    {
        return self::$config->registerUrl($url);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     * 静态调取子类
     */
    public static function __callStatic($name, $arguments)
    {
        switch($name){
            case (stripos($name,'Weapi')!==false):
                $class = "\\WeApi\\" . ucfirst(strtolower(str_replace('Weapi','',$name)));
                break;
            case (stripos($name,'Wepay')!==false):
                $class = "\\WePay\\" . ucfirst(strtolower(str_replace('Wepay','',$name)));
                break;
            default :
                $class = "\\WeChat\\" . ucfirst(strtolower($name));
                break;
        }
        if (class_exists($class)) return new $class($arguments[0]);
        throw new \Exception("Class '{$class}' not found");
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     * 非静态调取子类
     */
    public function __call($name, $arguments)
    {

        switch($name){
            case (stripos($name,'Weapi')!==false):
                $class = "\\WeApi\\" . ucfirst(strtolower(str_replace('Weapi','',$name)));
                break;
            case (stripos($name,'Wepay')!==false):
                $class = "\\WePay\\" . ucfirst(strtolower(str_replace('Wepay','',$name)));
                break;
            default :
                $class = "\\WeChat\\" . ucfirst(strtolower($name));
                break;
        }
        if (class_exists($class)) return new $class($arguments[0]);
        throw new \Exception("Class '{$class}' not found");
    }

    /**
     * @return string
     * @throws \Exception
     * 获取公众号access_token
     */
    protected static function GetAccessToken()
    {
        return self::We()->requestAccessToken();
    }

    /**
     * @return string
     * @throws \Exception
     * 获取小程序access_token
     */
    protected static function GetWeApiAccessToken()
    {
        return self::WeapiWe()->requestWeapiAccessToken();
    }

}