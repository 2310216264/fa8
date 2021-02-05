<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <!--白B-->
 <div class="rkuang">
 
 <? include("serverorderv.php");?>
 <? if($row[ddzt]==2){?>
 <script language="javascript">
 function tj(){
 if(!confirm("确定要支付订单费用吗？")){return false;}
 layer.msg('正在处理，请稍候', {icon: 16  ,time: 0,shade :0.25});
 f1.action="orderpay.php?orderbh=<?=$orderbh?>";
 }
 function tangopen(){
 layer.open({
   type:1,
   title: false,
   closeBtn: 0,
   area: '331px',
   skin: 'layui-layer-nobg', //没有背景色
   shadeClose: false,
   content: $('#tang')
 });
 }
 function gopay(){
 tangopen();
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="ordercz">
 <? $m=$row[money3]-$rowuser[money1];if($m<=0){$m="";}?>
 <li class="l1">您的可用余额：<strong class="red"><?=sprintf("%.2f",$rowuser[money1])?></strong>元 【<a href="pay.php?m=<?=$m?>" target="_blank" onclick="gopay()">充值</a>】</li>
 <li class="l4"><?=tjbtnr("支付费用")?></li>
 </ul>
 <input type="hidden" value="pay" name="yjcode" />
 <input type="hidden" value="<?=$orderbh?>" name="orderbh" />
 </form>
 <? }?>
 <div class="clear clear10"></div>

 <div id="tang" style="display:none;">
 <ul class="orderpayt">
 <li class="l1">请在充值页面完成充值!</li>
 <li class="l2">充值后，可刷新页面,继续订单的费用支付。</li>
 <li class="l3">
 <a href="orderpay.php?orderbh=<?=$orderbh?>" class="a1">点击刷新页面</a>
 </li>
 </ul>
 </div>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>