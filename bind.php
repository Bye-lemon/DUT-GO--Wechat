<?php

$openid = $_GET["openid"];
$key = $_GET["bkey"];
$state = "";

$db = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS,SAE_MYSQL_DB);
if($db)
{
  $sql = mysqli_query($db,"select * from tmp_bind where bkey='$key'"); 
  $info = mysqli_fetch_array($sql);
  
  if(!empty($info))
  { 
    mysqli_query($db,"update tmp_bind set openid='$openid' where bkey='".$info['bkey']."'");
    $state="success";
  }
  else
  {
    $state="fail";
  }
  
  mysqli_free_result($sql);
  mysqli_close($db);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>绑定结果</title>
  <link rel="stylesheet" href="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
  <script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
  <div data-role="page">
    <div data-role="main" class="ui-content">
      <div style="text-align:center;">
        <?php 
          if($state=="success")
          {
          	//echo "<img src="" width="150px" />";
            echo "<br/>";
            echo "<h3>绑定成功，请在屏幕上点击完成按钮。。</h3>";
          }
          else
          {
            //echo "<img src="" width="150px" />";
            echo "<br/>";
            echo "<h3>绑定失败，请返回重新扫描绑定。。</h3>";
          }
        ?>
      </div>
    </div>  
  </div> 
</body>
</html>