<?php

namespace WePay;

use Driver\WeChat;

class Pay extends WeChat{

    public function unifiedOrder(array $options){
        return self::instance(__FUNCTION__)->run(self::WepayWe()->doParam($options))->post($options,'xml')->toArray();
    }

}