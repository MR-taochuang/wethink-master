<?php

namespace WeApi;

use Driver\WeChat;

/**
 * Class Template
 * @package WeApi
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/9 16:22
 * 微信小程序模板消息
 */
class Template extends WeChat{

    /**
     * 获取小程序模板库标题列表
     * @param $offset /用于分页，表示从offset开始。从 0 开始计数
     * @param $count /用于分页，表示拉取count条记录。最大为 20
     * @return array
     */
    public function WeApiTemplateList($offset,$count){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['offset'=>$offset,'count'=>$count])->toArray();
    }

    /**
     * 获取模板库某个模板标题下关键词库
     * @param $template_id /模板标题id，可通过接口获取，也可登录小程序后台查看获取
     * @return array
     */
    public function WeApiTemplateGet($template_id){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['id'=>$template_id])->toArray();
    }

    /**
     * 组合模板并添加至帐号下的个人模板库
     * @param $template_id /模板标题id，可通过接口获取，也可登录小程序后台查看获取
     * @param array $keyword_id_list /开发者自行组合好的模板关键词列表，关键词顺序可以自由搭配（例如[3,5,4]或[4,5,3]），最多支持10个关键词组合
     * @return array
     */
    public function WeApiTemplateAdd($template_id,array $keyword_id_list){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['id'=>$template_id,'keyword_id_list'=>$keyword_id_list])->toArray();
    }

    /**
     * 获取帐号下已存在的模板列表
     * @param $offset /用于分页，表示从offset开始。从 0 开始计数
     * @param $count /用于分页，表示拉取count条记录。最大为 20
     * @return array
     */
    public function WeApiTemplateLists($offset,$count){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['offset'=>$offset,'count'=>$count])->toArray();
    }

    /**
     * 删除帐号下的某个模板
     * @param $template_id /要删除的模板id
     * @return array
     */
    public function WeApiTemplateDelete($template_id){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post(['id'=>$template_id])->toArray();
    }

    /**
     * 发送模板消息
     * @param array $options 发送的消息对象数组
     * @return array
     */
    public function WeApiTemplateSend(array $options){
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($options)->toArray();
    }

    /**
     * 下发小程序和公众号统一的服务消息
     * @param $touser /用户openid，可以是小程序的openid，也可以是mp_template_msg.appid对应的公众号的openid
     * @param $mp_template_msg /小程序模板消息相关的信息，可以参考小程序模板消息接口; 有此节点则优先发送小程序模板消息
     * @param null $weapp_template_msg /公众号模板消息相关的信息，可以参考公众号模板消息接口；有此节点并且没有weapp_template_msg节点时，发送公众号模板消息
     * @return array
     */
    public function WeApiTemplateUniform($touser,$mp_template_msg,$weapp_template_msg=null){
        $data=['touser'=>$touser,'mp_template_msg'=>$mp_template_msg];
        if(!empty($weapp_template_msg)) $data['weapp_template_msg']=$weapp_template_msg;
        return self::instance(__FUNCTION__)->run(self::GetWeApiAccessToken())->post($data)->toArray();
    }
}