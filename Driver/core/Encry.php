<?php

namespace Driver\core;


/**
 * Class EncryService
 * @package service
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/3/16 8:44
 * 自定义加密库
 */

class Encry{

    public $data;

    /**
     * @param int $num
     * @return $this
     * 数字加密
     */
    function encode_num($num=0)
    {
        if(empty($num)) $num=$this->data;
        if(strlen($num)>9) throw new \Exception("加密数字过大");
        $start_rand = rand(100, 999);
        $end_rand = rand(100, 999);
        $time=time();
        $len=strlen($time);
        $start_len=rand(4,$len-4);
        $end_len=$len-$start_len;
        $start=ceil(substr($time,0,$start_len));
        $end=ceil(substr($time,$start_len,$end_len));
        $start_time=ceil($start+$start_rand);
        $end_time=ceil($end+$end_rand);
        $num=ceil($num+$start+$end+$start_len+$end_len);
        $this->data = $start_rand.$start_len.strlen($start_time).$start_time.$num.$end_time.strlen($end_time).$end_len. $end_rand;
        return $this;
    }
    function decode_num($num=0){
        if(empty($num)) $num=$this->data;
        $start_rand=substr($num,0,3);
        $start_len=substr($num,3,1);
        $start_time_len=ceil(substr($num,4,1));
        $start_time=ceil(substr($num,5,$start_time_len));
        $end_rand=substr($num,-3);
        $end_len=substr($num,-4,1);
        $end_time_len=ceil(substr($num,-5,1));
        $end_time=ceil(substr($num,-5-$end_time_len,$end_time_len));
        $start=5+$start_time_len;
        $len=10+$start_time_len+$end_time_len;
        $total_len=strlen($num);
        $len=$total_len-$len;
        $num=substr($num,$start,$len);
        if(empty($num)){
            $this->data=null;
        }else{
            $this->data=ceil($num-($start_time-$start_rand)-($end_time-$end_rand)-$start_len-$end_len);
        }

        return  $this;
    }
    function encode($string='')
    {
        if(empty($string)) $string=$this->data;
        list($chars, $length) = ['', strlen($string = iconv('utf-8', 'gbk', $string))];
        for ($i = 0; $i < $length; $i++) {
            $chars .= str_pad(base_convert(ord($string[$i]), 10, 36), 2, 0, 0);
        }
        $this->data=$chars;
        return $this;
    }
    function decode($string='')
    {
        if(empty($string)) $string=$this->data;
        $chars = '';
        foreach (str_split($string, 2) as $char) {
            $chars .= chr(intval(base_convert($char, 36, 10)));
        }
        $this->data=iconv('gbk', 'utf-8', $chars);
        return $this;
    }
    function toEcho(){
        return $this->data;
    }
    function toArray(){
        return json_decode(json_encode($this),true);
    }
}