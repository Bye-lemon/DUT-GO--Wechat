<?php

$xmlData=file_get_contents("php://input");

libxml_disable_entity_loader(true);
$data=json_decode(json_encode(simplexml_load_string($xmlData,'SimpleXMLElement',LIBXML_NOCDATA)),true);

ksort($data);
$buff='';
foreach($data as $k=>$v)
{
  if($k!='sign')
  {
    $buff.=$k.'='.$v.'&';
  }
}
$stringSignTemp=$buff.'key=1qaz2wsx3edc4rfv5tgb6yhn7ujm8ik9';//key为证书密钥
$sign=strtoupper(md5($stringSignTemp));

//判断算出的签名和通知信息的签名是否一致
if($sign==$data['sign'])
{
  //
  $db = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
    
  if($db)
  {
    $orderid = $data['out_trade_no'];
    $money = $data['total_fee'];
    $time = date("Y-m-d h:i:sa");  
      
    $sql = mysqli_query($db,"select * from wxpay where orderid='$orderid'"); 
  	$info = mysqli_fetch_array($sql);
  
    if(empty($info))  
    {  
      mysqli_query($db,"insert into wxpay values('$orderid','$money','$time')");
    }
    
    mysqli_free_result($sql);
    mysqli_close($db);
  }  
    
  //处理完成之后，告诉微信成功结果
  echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
  exit();
}

?>