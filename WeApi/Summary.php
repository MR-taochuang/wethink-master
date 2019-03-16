<?php

namespace WeApi;

use Driver\WeChat;

/**
 * Class Summary
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 17:06
 * 小程序数据分析
 */
class Summary extends WeChat{

    /**
     * 获取用户访问小程序日留存
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询1天数据，允许设置的最大值为昨日。格式为 yyyymmdd
     * @return array
     */
    public function WeApiDatacubeDay($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取用户访问小程序月留存
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询一个月数据。格式为 yyyymmdd
     * @return array
     */
    public function WeApiDatacubeMonth($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取用户访问小程序周留存
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询7天数据。格式为 yyyymmdd
     * @return array
     */
    public function WeApiDatacubeWeek($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取用户访问小程序数据概况
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询1天数据，允许设置的最大值为昨日。格式为 yyyymmdd
     * @return array
     */
    public function WeApiDatacube($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取用户访问小程序数据日趋势
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询1天数据，允许设置的最大值为昨日。格式为 yyyymmdd
     * @return array
     */
    public function WeApiVisitDay($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取用户访问小程序数据月趋势
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询一个月数据。格式为 yyyymmdd
     * @return array
     */
    public function WeApiVisitMonth($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取用户访问小程序数据周趋势
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询7天数据，格式为 yyyymmdd
     * @return array
     */
    public function WeApiVisitWeek($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取小程序新增或活跃用户的画像分布数据。时间范围支持昨天、最近7天、最近30天。其中，新增用户数为时间范围内首次访问小程序的去重用户数，活跃用户数为时间范围内访问过小程序的去重用户数
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，开始日期与结束日期相差的天数限定为0/6/29，分别表示查询最近1/7/30天数据，允许设置的最大值为昨日。格式为 yyyymmdd
     * @return array
     */
    public function WeApiPortrait($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 获取用户小程序访问分布数据
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询1天数据，允许设置的最大值为昨日。格式为 yyyymmdd
     * @return array
     */
    public function WeApiDistribution($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }

    /**
     * 访问页面
     * @param $begin_date /开始日期。格式为 yyyymmdd
     * @param $end_date /结束日期，限定查询1天数据，允许设置的最大值为昨日。格式为 yyyymmdd
     * @return array
     */
    public function WeApiVisitPage($begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['begin_date' => $begin_date, 'end_date' => $end_date])->toArray();
    }
}