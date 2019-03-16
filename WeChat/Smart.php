<?php

namespace WeChat;
use Driver\core\Wechat;

/**
 * Class Smart
 * @package WeChat
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/7 10:27
 * 微信智能接口
 */
class Smart extends Wechat{
    /***
     * @param $options
     * @return array
     * 发送语意理解请求
     */
    public function SemanticSemproxy($options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $format
     * @param $voice_id
     * @param $lang
     * @return array
     * 提交语音接口
     */
    public function AddVoiceToRecoForText($format,$voice_id,$lang){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['format'=>$format,'voice_id'=>$voice_id,'lang'=>$lang])->toArray();
    }

    /***
     * @param $voice_id
     * @param $lang
     * @return array
     * 获取语音识别结果
     */
    public function QueryRecoResultForText($voice_id,$lang){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['voice_id'=>$voice_id,'lang'=>$lang])->toArray();
    }

    /***
     * @param $lfrom
     * @param $lto
     * @return array
     * 微信翻译
     */
    public function TranslateContent($lfrom,$lto){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['lfrom'=>$lfrom,'lto'=>$lto])->toArray();
    }

    /***
     * @param $file
     * @return array
     * 身份证OCR识别接口
     */
    public function IdCard($file){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->file($file)->toArray();
    }

    /***
     * @param $file
     * @return array
     * 银行卡OCR接口
     */
    public function BankCard($file){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->file($file)->toArray();
    }

    /***
     * @param $file
     * @return array
     * 行驶证OCR接口
     */
    public function Driving($file){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->file($file)->toArray();
    }

}