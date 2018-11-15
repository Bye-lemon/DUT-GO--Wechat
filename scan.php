<?php

$openid = $_GET["openid"];

require_once "jssdk.php";
$jssdk = new JSSDK("wx33046e932f306f23", "9cad4307e246087f4e00572709dae490");
$signPackage = $jssdk->GetSignPackage();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>扫描二维码</title>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  </head>
    
  <body>  
  </body>
    
  <script>
    wx.config({
      debug: false,
      appId: '<?php echo $signPackage["appId"];?>',
      timestamp: <?php echo $signPackage["timestamp"];?>,
      nonceStr: '<?php echo $signPackage["nonceStr"];?>',
      signature: '<?php echo $signPackage["signature"];?>',
      jsApiList: ['scanQRCode']
    });
    wx.ready(function () {        
      wx.scanQRCode({
        needResult:1,
        success:function(res){
          window.location.href="bind.php?openid=<?php echo $openid ?>&bkey="+res.resultStr;
        }
      });
    });
  </script>  
</html>
