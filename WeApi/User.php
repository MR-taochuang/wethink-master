<?php

namespace WeApi;

use Driver\Register;
use Driver\Tool;
use Driver\WeChat;

/**
 * Class User
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 14:01
 * 微信小程序用户信息处理
 */
class User extends WeChat
{

    /**
     * @param $code
     * @return array
     * 小程序通过code获取session
     */
    public function Code2Session($code)
    {
        return self::instance(__FUNCTION__)->run(self::$config->set('code', $code))->get()->toArray();
    }
    /**
     * @param $code
     * @param $iv
     * @param $encryptedData
     * @return array
     * @throws \Exception
     * 获取微信小程序用户信息
     */
    public function GetUserInfo($code, $iv, $encryptedData)
    {
        $result = self::Code2Session($code);
        if (empty($result['session_key'])) throw new \Exception('Code 换取 SessionKey 失败', 403);
        $crypt = new \Encry\WXBizDataCrypt(self::$config->get('weapiappid'), $result['session_key']);
        $err_code = $crypt->decryptData($encryptedData, $iv, $data);
        if ($err_code != 0) throw  new \Exception('解析失败', 403);
        return array_merge($result, Register::tool()->json2arr($data));
    }
}