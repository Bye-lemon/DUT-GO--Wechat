<?php

$id = $_GET["fid"];
$key = $_GET["bkey"];

$db = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
if($db)
{
  //采集完成指静脉信息，写入云端临时库，等待用户绑定
  mysqli_query($db,"insert into tmp_bind(openid,fid,bkey) values('',$id,'$key')"); 
    
  mysqli_close($db);
}

?>