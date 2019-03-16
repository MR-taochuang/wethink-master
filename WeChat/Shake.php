<?php

namespace WeChat;


use Driver\WeChat;

/**
 * Class Shake
 * @package WeChat
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/7 13:53
 * 微信摇一摇
 */
class Shake extends WeChat{
    /***
     * @param $options
     * @return array
     * 申请开通摇一摇功能接口
     */
    public function Register($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @return array
     * 查询审核状态接口
     */
    public function AuditStatus(){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->get()->toArray();
    }

    /***
     * @param $quantity
     * @param $apply_reason
     * @param null $comment
     * @param null $poi_id
     * @return array
     * 申请设备ID接口
     */
    public function ApplyId($quantity,$apply_reason,$comment=null,$poi_id=null){
        $data=['quantity'=>$quantity,'apply_reason'=>$apply_reason];
        if(!empty($comment)) $data['comment'] = $comment;
        if(!empty($poi_id)) $data['poi_id'] = $poi_id;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $apply_id
     * @return array
     * 查询设备ID申请状态
     */
    public function ApplyStatus($apply_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['apply_id'=>$apply_id])->toArray();
    }

    /***
     * @param $options
     * @return array
     * 编辑设备信息
     */
    public function DeviceUpdate($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 配备设备与门店的关联关系
     */
    public function BindLocation($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $options
     * @return array
     *
     */
    public function DeviceSearch($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $title
     * @param $description
     * @param $icon_url
     * @param null $comment
     * @return array
     * 页面管理接口
     */
    public function PageAdd($title,$description,$icon_url,$comment=null){
        $data=['title'=>$title,'description'=>$description,'icon_url'=>$icon_url];
        if(!empty($comment)) $data['comment']=$comment;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 编辑页面信息
     */
    public function PageUpdate($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $type
     * @param $page_ids
     * @param $begin
     * @param $count
     * @return array
     * 查询页面列表
     */
    public function PageSearch($type,$page_ids,$begin,$count){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['type'=>$type,'page_ids'=>$page_ids,'begin'=>$begin,'count'=>$count])->toArray();
    }

    /***
     * @param $page_id
     * @return array
     * 删除页面
     */
    public function PageDelete($page_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['page_id'=>$page_id])->toArray();
    }

    /***
     * @param $media
     * @param null $type
     * @return array
     * 上传图片素材
     */
    public function MaterialAdd($media,$type=null){
        $data=['media'=>$media];
        if(!empty($type)) $data['type']=$type;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 配备设备与页面的关联关系
     */
    public function DeviceBindPage($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 查询设备与页面的关联关系
     */
    public function RelationSearch($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 以设备为维度的数据统计接口
     */
    public function StatisticsDevice($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $date
     * @param $page_index
     * @return array
     * 批量查询设备统计数据接口
     */
    public function DeviceList($date,$page_index){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['date'=>$date,'page_index'=>$page_index])->toArray();
    }

    /***
     * @param $page_id
     * @param $begin_date
     * @param $end_date
     * @return array
     * 以页面为维度的数据统计接口
     */
    public function StatisticsPage($page_id,$begin_date,$end_date){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['page_id'=>$page_id,'begin_date'=>$begin_date,'end_date'=>$end_date])->toArray();
    }

    /***
     * @param $date
     * @param $page_index
     * @return array
     * 批量查询页面统计数据接口
     */
    public function PageList($date,$page_index){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['date'=>$date,'page_index'=>$page_index])->toArray();
    }

    /***
     * @param $group_name
     * @return array
     * 新增分组
     */
    public function GroupAdd($group_name){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['group_name'=>$group_name])->toArray();
    }

    /***
     * @param $group_id
     * @param $group_name
     * @return array
     * 编辑分组信息
     */
    public function GroupUpdate($group_id,$group_name){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['group_id'=>$group_id,'group_name'=>$group_name])->toArray();
    }

    /***
     * @param $group_id
     * @return array
     * 删除分组
     */
    public function GroupDelete($group_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['group_id'=>$group_id])->toArray();
    }

    /***
     * @param $begin
     * @param $count
     * @return array
     * 查询分组列表
     */
    public function GroupGetList($begin,$count){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['begin'=>$begin,'count'=>$count])->toArray();
    }

    /***
     * @param $group_id
     * @param $begin
     * @param $count
     * @return array
     * 查询分组详情
     */
    public function GroupGetDetail($group_id,$begin,$count){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['$group_id'=>$group_id,'begin'=>$begin,'count'=>$count])->toArray();
    }

    /***
     * @param $options
     * @return array
     * 添加设备到分组
     */
    public function GroupAddDevice($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 从分组中移除设备
     */
    public function GroupDeleteDevice($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $ticket
     * @param $need_poi
     * @return array
     * 获取设备及用户信息
     */
    public function UserGetShakeInfo($ticket,$need_poi=null){
        $data=['ticket'=>$ticket];
        if($need_poi==1) $data['need_poi']=$need_poi;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 红包预下单接口
     */
    public function HbPreOrder($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options,'xml')->toArray();
    }

    /***
     * @param $use_template
     * @param $logo_url
     * @param $options
     * @return array
     * 创建红包活动
     */
    public function AddLotteryInfo($use_template,$logo_url,$options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken(),self::$config->set('use_template',$use_template),self::$config->set('logo_url',$logo_url))->post($options)->toArray();
    }

    /***
     * @param $options
     * @return array
     * 录入红包信息
     */
    public function SetPrizeBucket($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $lottery_id
     * @param $onoff
     * @return array
     * 设置红包活动抽奖开关
     */
    public function SetLotterySwitch($lottery_id,$onoff){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken(),self::$config->set('lottery_id', $lottery_id),self::$config->set('onoff',$onoff))->get()->toArray();
    }

    /***
     * @param $lottery_id
     * @return array
     * 红包查询接口
     */
    public function QueryLottery($lottery_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken(),self::$config->set('lottery_id', $lottery_id))->get()->toArray();
    }

}