<?php

namespace Driver\core;

use Driver\third\Tool;

/**
 * Class Curl
 * @package Driver
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/10 20:43
 * curl模拟请求
 *
 * @method Curl instance($config = []) static 注册进入curl
 * @method Curl TIMEOUT($value)  设置请求时间
 * @method Curl VERIFYHOST($value) 设置是否强制验证ssl
 * @method Curl SSLCERTTYPE($value) 指定客户端SSL证书的类型
 * @method Curl SSLKEYTYPE($value)  指定客户端SSL证书的类型
 * @method Curl VERIFYPEER($value) 验证对等方的SSL证书
 */
class Curl
{

    /**
     * config配置
     */
    const CONFIG = 'set_config';
    /**
     * @var null|resource
     * curl实例对象
     */
    private static $curl = null;
    /**
     * @var
     * 请求地址
     */
    private static $url;

    /**
     * @var array
     * curl参数配置
     */
    private static $config = [
        'TIMEOUT' => 60,
        'VERIFYHOST' => 0,
        'SSLCERTTYPE' => 'PEM',
        'SSLKEYTYPE' => 'PEM',
        'VERIFYPEER' => false
    ];

    /**
     * 设置必须curl_setopt
     */
    private function setopt()
    {
        curl_setopt(self::$curl, CURLOPT_URL, self::$url);
        curl_setopt(self::$curl, CURLOPT_TIMEOUT, self::$config['TIMEOUT']);
        curl_setopt(self::$curl, CURLOPT_HEADER, false);
        curl_setopt(self::$curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(self::$curl, CURLOPT_SSL_VERIFYPEER, self::$config['VERIFYPEER']);
        curl_setopt(self::$curl, CURLOPT_SSL_VERIFYHOST, self::$config['VERIFYHOST']);
    }

    /**
     * Curl constructor.
     * 初始连接curl
     */
    public function __construct($config = [])
    {
        self::$curl = curl_init();
        !empty($config) ? self::$config = $config : true;
    }

    /**
     * 设置header
     * @param $header
     * @return $this
     */
    public function header($header)
    {
        curl_setopt(self::$curl, CURLOPT_HTTPHEADER, $header);
        return $this;
    }

    /**
     * 注册请求地址
     * @param $url
     * @return $this
     */
    public function register_url($url)
    {
        self::$url = $url;
        return $this;
    }

    /**
     * get请求
     * @param array $param
     * @return bool
     */
    public function get(array $param = [])
    {
        if (!empty($param)) self::$url .= (stripos(self::$url, '?') !== false ? '&' : '?') . http_build_query($param);
        return self::query();
    }

    /**
     * post 请求
     * @param array $param
     * @return bool
     */
    public function post($param = [])
    {
        curl_setopt(self::$curl, CURLOPT_POST, true);
        curl_setopt(self::$curl, CURLOPT_POSTFIELDS, Tool::_buildHttpData($param));

        return self::query();
    }

    /**
     * 设置代理
     * @param $Host /ip
     * @param $Port /端口
     */
    public function proxy($Host, $Port)
    {
        curl_setopt(self::$curl, CURLOPT_PROXY, $Host);
        curl_setopt(self::$curl, CURLOPT_PROXYPORT, $Port);
        return $this;
    }

    /**
     * 请求ssl配置
     * @param $ssl_cer
     * @param $ssl_key
     */
    public function ssl($ssl_cer, $ssl_key)
    {
        curl_setopt(self::$curl, CURLOPT_SSLCERTTYPE, self::$config['SSLCERTTYPE']);
        curl_setopt(self::$curl, CURLOPT_SSLCERT, $ssl_cer);
        curl_setopt(self::$curl, CURLOPT_SSLKEYTYPE, self::$config['SSLKEYTYPE']);
        curl_setopt(self::$curl, CURLOPT_SSLKEY, $ssl_key);
        return $this;
    }

    /**
     * 设置HTTP用户代理标头
     * @param $agent
     * @return $this
     */
    public function useragent($agent)
    {
        curl_setopt(self::$curl, CURLOPT_USERAGENT, $agent);
        return $this;
    }

    /**
     * 请求执行
     *
     * @return bool
     */
    private function query()
    {
        self::setopt();
        list($content, $status) = [curl_exec(self::$curl), curl_getinfo(self::$curl)];
        $result = (intval($status["http_code"]) === 200) ? $content : curl_errno(self::$curl);
        curl_close(self::$curl);
        return $result;
    }

    /**
     * 注册配置方法
     * @param array $config
     */
    public function register_config(array $config)
    {
        self::$config = $config;
        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * config配置引入
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this, self::CONFIG], [$name, $arguments[0]]);
    }

    /**
     * @param $name
     * @param $arguments
     * @return Curl
     * 初始化curl
     */
    public static function __callStatic($name, $arguments)
    {
        return new Curl($arguments[0]);
    }
    /**
     * @param $field
     * @param $value
     * @return $this
     * 单个设置config
     */
    public function set_config($field, $value)
    {
        self::$config[$field] = $value;
        return $this;
    }

    /**
     * 获取当前配置
     * @return array
     *
     */
    public function config(){
        return self::$config;
    }
}