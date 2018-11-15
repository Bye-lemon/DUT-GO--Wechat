<?php

$orderid = $_GET["orderid"];

$db = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
    
if($db)
{
    $sql = mysqli_query($db,"select * from wxpay where orderid='$orderid'"); 
  	$info = mysqli_fetch_array($sql);
  
    if(empty($info))  
    {
      echo "0";
    }
    else
    {
      echo "1";
    }
    
    mysqli_free_result($sql);
    mysqli_close($db);
}

?>