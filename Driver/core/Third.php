<?php

namespace Driver\core;

/**
 * Class Third
 * @package Driver\core
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/3/20 19:42
 * 第三方插件加载
 * @method \Driver\third\Mycurlfile mycurlfile($config = []) static 注册初始类库
 * @method \Driver\third\Tool tool() static 注册curl
 * @method \Driver\third\Ipregion ipregion() static ip转地区
 */
class Third {

    public static function __callStatic($name, $arguments)
    {
        $class = '\\Driver\\third\\' . ucwords(strtolower($name));
        return (new \ReflectionClass($class))->newInstanceArgs($arguments);
    }

    public function __call($name, $arguments)
    {
        $class = '\\Driver\\third\\' . ucwords(strtolower($name));
        return (new \ReflectionClass($class))->newInstanceArgs($arguments);
    }

}