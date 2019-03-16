<?php
namespace WeChat;

use Driver\WeChat;

/**
 * Class Invoice
 * @package WeChat
 * @author Mr.taochuang <mr_taochuang@163.com>
 * @date 2019/1/7 14:05
 * 微信发票
 */
class Invoice extends WeChat{
    /***
     * @return array
     * 获取授权页ticket
     */
    public function GetTicket(){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->get()->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 获取授权页链接
     */
    public function GetAuthurl(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $order_id
     * @param $s_pappid
     * @return array
     * 查询授权完成状态
     */
    public function GetAuthData($order_id,$s_pappid){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['order_id'=>$order_id,'s_pappid'=>$s_pappid])->toArray();
    }

    /***
     * @param $s_pappid
     * @param $order_id
     * @param $reason
     * @param null $url
     * @return array
     *拒绝开票
     */
    public function RejectInsert($s_pappid,$order_id,$reason,$url=null){
        $data=['s_pappid'=>$s_pappid,'order_id'=>$order_id,'reason'=>$reason];
        if(!empty($url)) $data['url']=$url;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 设置授权页字段信息
     */
    public function SetAuthField(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @return array
     * 查询授权页字段信息
     */
    public function GetAuthField(){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(array())->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 关联商户号与开票平台
     */
    public function SetPayMch(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @return array
     *  查询商户号与开票平台关联情况
     */
    public function GetPayMch(){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(array())->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 统一开票接口-开具蓝票
     */
    public function MakeOutInvoice(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 统一发票接口发票冲红
     */
    public function ClearOutInvoice(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $fpqqlsh
     * @param $nsrsbh
     * @return array
     * 统一开票接口查询已开发票
     */
    public function QueryInvoceInfo($fpqqlsh,$nsrsbh){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['fpqqlsh'=>$fpqqlsh,'nsrsbh'=>$nsrsbh])->toArray();
    }

    /***
     * @param $phone
     * @param $time_out
     * @return array
     * 设置商户联系方式
     */
    public function SetContact($phone,$time_out){
        $data=['contact'=>['phone'=>$phone,'time_out'=>$time_out]];
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @return array
     * 查询商户联系方式
     */
    public function GetContact(){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(array())->toArray();
    }

    /***
     * @return array
     * 获取自身的开票平台识别码
     */
    public function SetUrl(){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(array())->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 创建发票卡券模板
     */
    public function CreateCard(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $file
     * @return array
     * 上传PDF
     */
    public function SetPdf($file){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->file($file)->toArray();
    }

    /***
     * @param $action
     * @param $s_media_id
     * @return array
     * 查询已上传的PDF文件
     */
    public function GetPdf($action,$s_media_id){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['action'=>$action,'s_media_id'=>$s_media_id])->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 将电子发票卡券插入用户卡包
     */
    public function InvoiceInsert(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $card_id
     * @param $code
     * @param $reimburse_status
     * @return array
     * 更新发票卡券状态
     */
    public function InvoiceUpdateStatus($card_id,$code,$reimburse_status){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['card_id'=>$card_id,'code'=>$code,'reimburse_status'=>$reimburse_status])->toArray();
    }

    /***
     * @param $card_id
     * @param $encrypt_code
     * @return array
     * 查询报销发票信息
     */
    public function GetInvoiceInfo($card_id,$encrypt_code){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['card_id'=>$card_id,'encrypt_code'=>$encrypt_code])->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 批量查询报销发票信息
     */
    public function GetInvoiceBatch(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param $card_id
     * @param $encrypt_code
     * @param $reimburse_status
     * @return array
     * 报销方更新发票状态
     */
    public function UpdateInvoiceStatus($card_id,$encrypt_code,$reimburse_status){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['card_id'=>$card_id,'encrypt_code'=>$encrypt_code,'reimburse'=>$reimburse_status])->toArray();
    }

    /***
     * @param array $options
     * @return array
     *  报销方批量更新发票状态
     */
    public function UpdateStatusBatch(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 将发票抬头信息录入到用户微信中
     */
    public function GetUserTitleUrl(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param null $attach
     * @param null $biz_name
     * @return array
     * 获取用户抬头（方式一）:获取商户专属二维码，立在收银台
     */
    public function GetSelectTitleUrl($attach=null,$biz_name=null){
        $data=[];
        if(!empty($attcch)) $data['attach']=$attach;
        if(!empty($biz_name)) $data['biz_name']=$biz_name;
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($data)->toArray();
    }

    /***
     * @param $scan_text
     * @return array
     * 获取用户抬头（方式二）:商户扫描用户的发票抬头二维码
     */
    public function ScanTitle($scan_text){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post(['scan_text'=>$scan_text])->toArray();
    }

    /***
     * @param array $options
     * @return array
     *  获取授权页链接
     */
    public function GetBillAuthUrl(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 创建财政电子票据接口
     */
    public function CreateBillCard(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

    /***
     * @param array $options
     * @return array
     * 将财政电子票据添加到用户微信卡包
     */
    public function InsertBill(array $options){
        return self::instance(__FUNCTION__)->run(self::GetAccessToken())->post($options)->toArray();
    }

}
