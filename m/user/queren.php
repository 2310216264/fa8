<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellserverorder.php");}

if(sqlzhuru($_POST[yjcode])=="qr"){
 zwzr();
 if($row[ddzt]!=1){Audit_alert("未知错误！","sellserverorderview.php?orderbh=".$orderbh);}
 updatetable("yjcode_serverorder","ddzt=2 where ddzt=1 and id=".$row[id]);
 php_toheader("sellserverorderview.php?orderbh=".$orderbh); 
 
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

 <? if($row[ddzt]==1){?>
 <script language="javascript">
 function tj(){
 if(!confirm("确认接单吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="queren.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("确认接单")?></div>
 </div>
 <input type="hidden" value="qr" name="yjcode" />
 </form>
 <div class="tishi box">
 <div class="d1">
 <strong>* 站长提示：</strong><br>
 * 请务必跟买家确认好订单价格及内容后再接单。接单后，请为买家提供优质的售后服务
 </div>
 </div>
 <? }?>

 <? include("sellserverorderv.php");?>
 
</body>
</html>