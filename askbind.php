<?php

$id = $_GET["fid"];
$key = $_GET["bkey"];
$state = "";

$db = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
if($db)
{
  //查询临时库中,用户是否已经扫描绑定，增加了openid信息
  $sql = mysqli_query($db,"select * from tmp_bind where bkey='$key'"); 
  $info = mysqli_fetch_array($sql);
  
  if($info["openid"]!="") //是
  { 
    //把fingerid转入
    mysqli_query($db,"update weixin_users set fingerid='$id' where openid='".$info['openid']."'");
    
    //返回绑定的用户信息(openid,nickname,headimgurl)  
    echo $info["openid"];
  }
  else //否
  {
    //返回no
    echo "no";
  }
  
  mysqli_free_result($sql);
  mysqli_close($db);
}

?> 

