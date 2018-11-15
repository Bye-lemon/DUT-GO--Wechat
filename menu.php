 <?php
include("token.php");

$post = '{
  "button":[
  {
    "name":"物联网工坊",
    "type":"view",
    "url":"http://www.dlut.edu.cn"
  },
  {
    "name":"会员绑定",
    "type":"view",
    "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx33046e932f306f23&redirect_uri=http://wurenbox.feingst.com/oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
  }]
}';

$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$token";

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
curl_exec($ch);
curl_close($ch);

?>