<?php

namespace WeApi;

use Driver\core\Wechat;

/**
 * Class Media
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 16:42
 * 微信小程序素材管理
 */
class Media extends Wechat{

    /**
     * 把媒体文件上传到微信服务器。目前仅支持图片。用于发送客服消息或被动回复用户消息。
     * @param $file /本地文件
     * @param $type /文件类型
     * @return array
     *
     */
    public function WeApiMediaUpload($file,$type){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken(), self::$config->set('type', $type))->file($file)->toArray();
    }

    /**
     * 获取客服消息内的临时素材。即下载临时的多媒体文件。目前小程序仅支持下载图片文件。
     * @param $media_id /媒体文件 ID
     * @return array
     */
    public function WeApiMediaGet($media_id){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken(), self::$config->set('media_id', $media_id))->get()->toArray();
    }

}