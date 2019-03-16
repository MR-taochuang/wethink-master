<?php

namespace WeApi;

use Driver\core\Wechat;

/**
 * Class Plugin
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 17:35
 * 小程序插件管理
 */
class Plugin extends Wechat{

    /**
     * 向插件开发者发起使用插件的申请
     * @param $action /此接口下填写 "apply"
     * @param $plugin_appid /插件 appId
     * @param null $reason /申请使用理由
     * @return array
     */
    public function WeApiApplyPlugin($action,$plugin_appid,$reason=null){
        $data=['action'=>$action,'plugin_appid'=>$plugin_appid];
        if(!empty($reason)) $data['reason']=$reason;
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($data)->toArray();
    }

    /**
     * 获取当前所有插件使用方（供插件开发者调用）
     * @param $action /此接口下填写 "dev_apply_list"
     * @param $page /要拉取第几页的数据
     * @param $num /每页的记录数
     * @return array
     */
    public function WeApiGetPlugin($action,$page,$num){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['action'=>$action,'page'=>$page,'num'=>$num])->toArray();
    }

    /**
     * 查询已添加的插件
     * @param $action /此接口下填写 "list"
     * @return array
     */
    public function WeApiPluginList($action){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['action'=>$action])->toArray();
    }

    /**
     * 修改插件使用申请的状态（供插件开发者调用）
     * @param $action /修改操作
     * @param null $appid /使用者的 appid。同意申请时填写。
     * @param null $reason /拒绝理由。拒绝申请时填写。
     * @return array
     */
    public function PluginApplyStatus($action,$appid=null,$reason=null){
        $data=['action'=>$action];
        if(!empty($appid)) $data['appid']=$appid;
        if(!empty($reason)) $data['reason']=$reason;
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($data)->toArray();
    }

    /**
     * 删除已添加的插件
     * @param $action /此接口下填写 "unbind"
     * @param $plugin_appid /插件 appId
     * @return array
     */
    public function UnbindPlugin($action,$plugin_appid){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['action'=>$action,'plugin_appid'=>$plugin_appid])->toArray();
    }
}