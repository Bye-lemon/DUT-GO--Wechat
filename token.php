<?php

$mmc = memcache_init();
$token = memcache_get($mmc,"token");
if(empty($token))
{
$appid = "wx33046e932f306f23";
$secret = "9cad4307e246087f4e00572709dae490";
    
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$output=curl_exec($ch);
curl_close($ch);
$jsoninfo = json_decode($output,true);
$access_token = $jsoninfo['access_token'];

memcache_set($mmc,"token",$access_token,0,7200);
$token=memcache_get($mmc,"token");
}

?>