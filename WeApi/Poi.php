<?php

namespace WeApi;

use Driver\core\Wechat;

/**
 * Class Poi
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 17:48
 * 微信小程序地点管理
 */
class Poi extends Wechat
{

    /**
     * 添加地点
     * @param array $options
     * @return array
     */
    public function WeApiAddPoi(array $options)
    {
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($options)->toArray();
    }

    /**
     * 删除地点
     * @param $poi_id 	/附近地点 ID
     * @return array
     *
     */
    public function WeApiDelPoi($poi_id){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['poi_id'=>$poi_id])->toArray();
    }

    /**
     * 查看地点列表
     * @return array
     */
    public function WeApiPoiList(){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->get()->toArray();
    }

    /**
     * 展示/取消展示附近小程序
     * @param $poi_id /	附近地点 ID
     * @param $status /是否展示
     * @return array
     */
    public function WeApiPoiShow($poi_id,$status){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['poi_id'=>$poi_id,'status'=>$status])->toArray();
    }
}