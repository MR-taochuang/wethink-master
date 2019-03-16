<?php

namespace WeApi;

use Driver\core\Wechat;

/**
 * Class Custom
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 16:46
 * 小程序客服发送消息
 */

class Custom extends Wechat{

    /**
     * 下发客服当前输入状态给用户
     * @param $touser
     * @param $command /用户的 OpenID
     * @return array /命令
     */
    public function WeApiCustomTyping($touser,$command){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['touser'=>$touser,'command'=>$command])->toArray();
    }

    /**
     * 发送客服消息给用户
     * @param array $options
     * @return array
     */
    public function WeApiCustomSend(array $options){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($options)->toArray();
    }
}