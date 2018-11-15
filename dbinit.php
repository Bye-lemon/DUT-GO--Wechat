<?php

$db = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);

if($db)
{
  //mysqli_query($db,"create table weixin_users(openid int, nickname varchar)"); 
  
  //mysqli_query($db,"create table wxpay(orderid varchar(50),money varchar(20),time varchar(100))");  
    
  mysqli_close($db);
    
  echo "db init ok!";
}


?>