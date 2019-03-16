<?php

echo '<pre>';
$code=$_GET['code'];
include "../autoload.php";
$config = include 'config.php';
echo '<pre>';
$user=\Driver\WeChat::User($config);
$data=$user->UserAccessToken($code);
echo '<Pre>';
print_r($data);exit;
$data=$user->UserInfo($data['access_token'],$data['openid']);
print_r($data);

