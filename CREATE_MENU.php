<?php

$appid = "wx1b12e8c0b2cb77a1";
$appsecret = "be774e547649c6974c0aa5de19ef4962";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$output = https_request($url);
$jsoninfo = json_decode($output, true);

$access_token = $jsoninfo["access_token"];


$jsonmenu = '{
      "button":[
      {
            "name":"DUTGO!",
            "type":"view",
            "url":"http://www.dlut.edu.cn"
       },
       {
            "name":"会员登陆",
            "type":"view",
            "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b12e8c0b2cb77a1&redirect_uri=http://dutgo.applinzi.com/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
        }]
 }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>