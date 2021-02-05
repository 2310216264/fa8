<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellserverorder.php");}

$ifztcontrol=1;
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
</head>
<body>

<? include("topuser.php");?>

<div class="glotop box">
 <div class="d1" onClick="gourl('sellserverorder.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">服务订单详情</div>
 <div class="d3"><img onClick="gourl('./')" src="img/user.png" height="21" /></div>
</div>

<? include("sellserverorderv.php");?>

</body>
</html>