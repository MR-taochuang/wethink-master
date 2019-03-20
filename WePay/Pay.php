<?php

namespace WePay;

use Driver\core\Wechat;

class Pay extends Wechat{

    public function unifiedOrder(array $options){
        return self::instance(__FUNCTION__)->run(self::WepayWe()->doParam($options))->post($options,'xml')->toArray();
    }

}