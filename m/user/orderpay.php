<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$userid=$rowuser[id];
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("serverorder.php");}


if(sqlzhuru($_POST[yjcode])=="pay"){
 zwzr();
 if($row[money3]>$rowuser[money1]){Audit_alert("余额不足，请充值后，再进行订单支付。","orderpay.php?orderbh=".$orderbh);}
 updatetable("yjcode_serverorder","ddzt=4 where ddzt=2 and id=".$row[id]);
 $m=$row[money3]*(-1);
 PointIntoM($userid,"支付服务订单费用".$row[money3]."元,订单编号".$orderbh,$m);
 PointUpdateM($userid,$m);
 updatetable("yjcode_server","xsnum=xsnum+1 where bh='".$row[serverbh]."'");
 php_toheader("serverorderview.php?orderbh=".$orderbh); 

}

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

<div class="bfbtop1 box">
 <div class="d1" onClick="gourl('sellserverorder.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">确认接单</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]==2){?>
 <script language="javascript">
 function tj(){
 if(!confirm("确定要支付订单费用吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="orderpay.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <? $m=$row[money3]-$rowuser[money1];if($m<=0){$m="";}?>
 <div class="uk box">
  <div class="d1">可用余额</div>
  <div class="d21"><strong class="red"><?=sprintf("%.2f",$rowuser[money1])?></strong>元 【<a href="pay.php?m=<?=$m?>" onclick="gopay()">充值</a>】</div>
 </div>
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("支付费用")?></div>
 </div>
 <input type="hidden" value="pay" name="yjcode" />
 </form>
 <? }?>

 <? include("sellserverorderv.php");?>
 
</body>
</html>