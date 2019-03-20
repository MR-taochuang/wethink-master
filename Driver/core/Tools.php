<?php

namespace Driver\core;


/**
 * Class Perform
 * @package service
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/3/16 13:20
 * 工具类方法
 */

class Tools {
    /**
     * 生成唯一订单号
     * @param int $digits 订单号长度
     * @param string $prefix 订单号前缀
     * @return string 订单号
     */
    public function create_order_number($digits = 24, $prefix = '')
    {
        $date = date('YmdHis');
        $digits = intval($digits);
        if ($digits < 14) return '订单号大于14字符';
        $digits = $digits - strlen($date) - strlen($prefix);
        if ($digits < 0) return '订单号生成失败';
        $rand = '';
        $num = floor($digits / 10);
        for ($i = 0; $i < $num; $i++) {
            $rand .= str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        }
        if ($digits % 10 != 0) {
            $rand .= str_pad(mt_rand(1, substr(9999999999, 0, $digits - ($num * 10))), $digits - ($num * 10), '0', STR_PAD_LEFT);
        }
        $order_number = $prefix . $date . $rand;
        return $order_number;
    }
    /**
     * 下划线转驼峰
     * @param $str下滑线字符串
     * @return mixed 转换之后字符串
     */
    public function convert2Underline($str)
    {
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$str);
        return $str;
    }
    /**
     * 驼峰转下划线
     * @param $str
     * @return mixed
     */
    public function hump2ToLine($str){
        $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
            return '_'.strtolower($matches[0]);
        },$str);
        return $str;
    }
    /**
     * 获取当前对象的所有方法
     * @desc 仅仅获取这个类的方法，不要父类的
     * @param class int Y N 类名
     * @return array array 本类的所有方法构成的一个数组
     */
    public function get_this_class_methods($class) {
        $arr = get_class_methods($class);
        if ($parent_class = get_parent_class($class)) {
            $data = get_class_methods($parent_class);
            $res = array_diff($arr, $data);
        } else {
            $res = $arr;
        }
        return $res;
    }
    /**
     * @return mixed
     * 获取系统时间戳 优于time()
     */
    public function system_time(){
        return $_SERVER['REQUEST_TIME'];
    }

    /**
     * @param $time
     * @return bool|string
     * 时间转换为距离创建多少时间
     */
    function Sec2Time($time)
    {
        if (is_numeric($time)) {
            $res=[];
            $value = array(
                "years" => 0, "days" => 0, "hours" => 0,
                "minutes" => 0, "seconds" => 0,
            );
            if ($time >= 31556926) {
                $value["years"] = floor($time / 31556926);
                $time = ($time % 31556926);
            }
            if ($time >= 86400) {
                $value["days"] = floor($time / 86400);
                $time = ($time % 86400);
            }
            if ($time >= 3600) {
                $value["hours"] = floor($time / 3600);
                $time = ($time % 3600);
            }
            if ($time >= 60) {
                $value["minutes"] = floor($time / 60);
                $time = ($time % 60);
            }
            $value["seconds"] = floor($time);
            if ($value["years"] > 0) {
                $res['year']=$value['years'];
            }
            if ($value["days"] > 0) {
                $res['day']=$value['days'];
            }
            if ($value['hours'] > 0) {
                $res['hour']=$value['hours'];
            }
            if ($value['minutes'] > 0) {
                $res['minute']=$value['minutes'];
            }
            if ($value['seconds'] > 0 ) {
                $res['second']=$value['seconds'];
            }
            Return $res;

        } else {
            return (bool)FALSE;
        }
    }

    /**
     * @param $str
     * @return string
     * 获取汉字/英文首字母
     */
    function Str2First($str)
    {
        $str= iconv("UTF-8","gb2312", $str);//编码转换
        if (preg_match("/^[\x7f-\xff]/", $str))
        {
            $fchar=ord($str{0});
            if($fchar>=ord("A") and $fchar<=ord("z") )return strtoupper($str{0});
            $a = $str;
            $val=ord($a{0})*256+ord($a{1})-65536;
            if($val>=-20319 and $val<=-20284)return "A";
            if($val>=-20283 and $val<=-19776)return "B";
            if($val>=-19775 and $val<=-19219)return "C";
            if($val>=-19218 and $val<=-18711)return "D";
            if($val>=-18710 and $val<=-18527)return "E";
            if($val>=-18526 and $val<=-18240)return "F";
            if($val>=-18239 and $val<=-17923)return "G";
            if($val>=-17922 and $val<=-17418)return "H";
            if($val>=-17417 and $val<=-16475)return "J";
            if($val>=-16474 and $val<=-16213)return "K";
            if($val>=-16212 and $val<=-15641)return "L";
            if($val>=-15640 and $val<=-15166)return "M";
            if($val>=-15165 and $val<=-14923)return "N";
            if($val>=-14922 and $val<=-14915)return "O";
            if($val>=-14914 and $val<=-14631)return "P";
            if($val>=-14630 and $val<=-14150)return "Q";
            if($val>=-14149 and $val<=-14091)return "R";
            if($val>=-14090 and $val<=-13319)return "S";
            if($val>=-13318 and $val<=-12839)return "T";
            if($val>=-12838 and $val<=-12557)return "W";
            if($val>=-12556 and $val<=-11848)return "X";
            if($val>=-11847 and $val<=-11056)return "Y";
            if($val>=-11055 and $val<=-10247)return "Z";
        }
        else
        {
            return '#';
        }
    }


}