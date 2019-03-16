<?php

namespace Driver;

/**
 * Class Loader
 * @package Driver
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/11 13:52
 * 加载核心类库
 * @method \Driver\core\Init init($config=[]) static 注册初始类库
 * @method \Driver\core\Cache cache() static 注册缓存
 * @method \Driver\core\Curl curl() static 注册curl
 * @method \Driver\core\Encry encry() static 自定义加密类
 * @method \Driver\core\Rsa rsa() static rsa加密类
 * @method \Driver\core\Wechat wechat() static 微信开发类
 * @method \Driver\third\Tool tool() static 注册第三方方法
 *
 */
class Register {
      public static function __callStatic($name, $arguments)
      {
          $class='\\Driver\\core\\'.ucwords(strtolower($name));
          return new $class($arguments[0]??'');
      }


}