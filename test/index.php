<?php

$start = microtime(true);
echo '开始运行时间' . '【' . $start . '】<br>';
$start_usage = memory_get_usage() / 1024;
echo '运行内存【' . ($start_usage) . 'KB】<br>';
include "../autoload.php";

$config=[
    'token'          => 'test',
    'appid'          => 'wxbe0725b8a99ed3d2',
    'appsecret'      => '939f94d55f4bd3d94183226773b66d57',
    'encodingaeskey' => 'BJIUzE0gqlWy0GxfPp4J1oPTBmOrNDIGPNav1YFH5Z5',
    // 配置商户支付参数
    'mch_id'         => "1332187001",
    'mch_key'        => 'A82DC5BD1F3359081049C568D8502BC5',
    // 配置商户支付双向证书目录 （p12 | key,cert 二选一，两者都配置时p12优先）
    // 'ssl_p12'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . 'apiclient_cert.p12',
    'ssl_key'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . 'apiclient_key.pem',
    'ssl_cer'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . 'apiclient_cert.pem',
    // 配置缓存目录，需要拥有写权限
];

$data=\Driver\Register::wechat()->Menu($config)->GetMenu();
echo '<pre>';
print_r($data);exit;

$end = microtime(true);
echo '<br>结束运行时间' . '【' . $end . '】<br>';
echo '运行时间' . '【' . ($end - $start) . '】<br>';
$end_usage = memory_get_usage() / 1024;
echo '运行内存【' . ($end_usage) . 'KB】<br>';
echo '系统运行内存【' . ($end_usage - $start_usage) . 'KB】';





