<?php

namespace WeChat;

use Driver\third\Tool;
use Driver\core\Wechat;

/**
 * Class We
 * @package WeChat
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2018/12/21 16:07
 *微信基础类
 */
class We extends Wechat
{
    /**
     * @return array
     * @throws \Exception
     * 获取微信服务器所有IP
     */
    public function GetWechatIp()
    {
        return self::instance(__FUNCTION__)->run(self::GetAccessToken(),function (){return 1;})->get()->toArray();
    }

    /**
     * @return string
     * 获取微信token
     */
    public function AccessToken()
    {
        return self::GetAccessToken();
    }

    /**
     * @param array $options
     * @return array
     * @throws \Exception
     * 检测服务器
     */
    public function WebCheck(array $options)
    {
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /**
     * @param $template_id
     * @param $scene
     * @param $redirect_url
     * @param $reserved
     * 一次性订阅
     */
    public function Subscribemsg($template_id, $scene, $redirect_url, $reserved)
    {
        $url = self::instance(__FUNCTION__)->run(self::$config->set('template_id', $template_id), self::$config->set('scene', $scene), self::$config->set('redirect_url', $redirect_url), self::$config->set('reserved', $reserved))->toUrl();
        header('location:' . $url);
        exit;
    }

    /**
     * @param string $appid
     * @return array
     * @throws \Exception
     * 公众号调用或第三方平台帮公众号调用对公众号的所有api调用（包括第三方帮其调用）次数进行清零
     */
    public function ClearQuota($appid = '')
    {
        $appid = empty($appid) ? self::$config->get('appid') : $appid;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['appid' => $appid])->toArray();
    }

    /**
     * @return array
     * @throws \Exception
     * 获取公众号的自动回复规则
     */
    public function GetCurrent()
    {
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->get()->toArray();
    }

    /**
     * @param $access_token
     * @return mixed
     * @throws \Exception
     * 设置外部token
     */
    public function setAccessToken($access_token)
    {
        \Driver\Register::cache()->set('AccessToken', $access_token, 7000);
        return $access_token;
    }
    public function requestAccessToken(){
        $access_token =  \Driver\Register::cache()->get('AccessToken');
        if (isset($access_token)) {
            self::$config->set('access_token',$access_token);
            \Driver\Register::cache()->set('access_token', $access_token);
            return $access_token;
        } else {
            $res = self::instance("AccessToken")->run()->get()->toArray();
            if (!empty($res['access_token'])) {
                \Driver\Register::cache()->set('WeApiAccessToken', $res['access_token'], 7000);
                \Driver\Register::cache()->set('access_token', $res['access_token']);
                self::$config->set('access_token',$res['access_token']);
                return $res['access_token'];
            } else{
                throw new \Exception($res['access_token']);
            }
        }
    }
}