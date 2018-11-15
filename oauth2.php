<?php

$code = $_GET["code"];
$userinfo = getUserInfo($code);

$openid = $userinfo["openid"];
$nickname = $userinfo["nickname"];
if($userinfo["sex"]==0){$sex="none";}else if($userinfo["sex"]==1){$sex="boy";}else{$sex="girl";}
$headimgurl = $userinfo["headimgurl"];
$fingerid = 0;

$db = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
if($db)
{
  $sql = mysqli_query($db,"select * from weixin_users where openid='".$userinfo['openid']."'"); 
  $info = mysqli_fetch_array($sql);
  
  if(empty($info))
  { 
    mysqli_query($db,"insert into weixin_users values('$openid','$nickname','$sex','$headimgurl',0)");
  }
  else
  {
    $fingerid = $info["fingerid"];
  }
  
  mysqli_free_result($info);
  mysqli_close($db);
}

function getUserInfo($code)
{
  $appid = "wx33046e932f306f23";
  $secret = "9cad4307e246087f4e00572709dae490";

  $access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
  $access_token_json = https_request($access_token_url);
  $access_token_array = json_decode($access_token_json,true);
  $access_token = $access_token_array["access_token"];
  $openid = $access_token_array["openid"];
  
  $userinfo_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid";
  $userinfo_json = https_request($userinfo_url);
  $userinfo_array = json_decode($userinfo_json,true);
  return $userinfo_array;
}

function https_request($url)
{
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
  curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  $output = curl_exec($ch);
  curl_close($ch);
    
  return $output;
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
  <script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
  <div data-role="page">
    <div data-role="header">
      <h1>我的信息</h1>
    </div>
    <div data-role="main" class="ui-content">
      <div style="text-align:center;">
        <img src="<?php echo $headimgurl; ?>" width="150px" />
        <label><?php echo $nickname; ?></label>
        <br/>
        <h3>会员积分：1000</h3>
        <h4>指静脉信息绑定(无人超市)：<?php if($fingerid==0){echo "<font color='red'>未绑定</font>";}else{echo "<font color='green'>已绑定</font>";} ?></h4>
      </div>
      <a href="scan.php?openid=<?php echo $openid; ?>" data-role="button" class="ui-btn">扫码绑定(无人超市注册)</a>
      <a data-role="button" class="ui-btn">购物记录</a>
    </div>  
  </div> 
</body>
</html>