<?php

namespace Start;

use \Driver\Register;

/**
 * Class Run
 * @package Start
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/3/16 10:47
 * 初始化dirve类库
 */
class Run
{

    public static function instance()
    {
        return new Register();
    }

}

