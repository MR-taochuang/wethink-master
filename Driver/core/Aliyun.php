<?php

namespace Driver\core;

use Driver\Register;
/**
 * Class Aliyun
 * @package Driver
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2018/12/26 13:40
 * 阿里云操作基础
 *
 * -----阿里云集成类----
 *
 * ---------------阿里云操作类-------------------
 * @method  \Aliyun\Sms sms($config = []) static 阿里云短信
 */
class Aliyun
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

        $class = "\\Aliyun\\" . ucfirst(strtolower($name));
        if (class_exists($class)) return new $class($arguments[0]??'');
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

        $class = "\\Aliyun\\" . ucfirst(strtolower($name));
        if (class_exists($class)) return new $class($arguments[0]??'');
        throw new \Exception("Class '{$class}' not found");
    }



}