<?php

namespace WeApi;

use Driver\core\Wechat;

/**
 * Class Qrcode
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/10 16:48
 * 小程序二维码管理
 */
class Qrcode extends Wechat{

    /**
     * 获取小程序二维码，适用于需要的码数量较少的业务场景。通过该接口生成的小程序码，永久有效，有数量限制
     * @param $path /扫码进入的小程序页面路径，最大长度 128 字节，不能为空
     * @param null $width /二维码的宽度，单位 px。最小 280px，最大 1280px
     * @return array
     *
     */
    public function CreateQrcode($path,$width=null){
        $data['path']=$path;
        if(!empty($width)) $data['width']=$width;
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($data)->toArray();
    }

    /**
     * 获取小程序码，适用于需要的码数量较少的业务场景。通过该接口生成的小程序码，永久有效，有数量限制
     * @param array $options
     * @return array
     */
    public function getWXACode(array $options){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($options)->toArray();
    }

    /**
     * 获取小程序码，适用于需要的码数量极多的业务场景。通过该接口生成的小程序码，永久有效，数量暂无限制
     * @param array $options
     * @return array
     */
    public function getWXACodeUnlimit(array $options){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($options)->toArray();
    }

}