<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$money1=$_GET[money1];
$sj=date("Y-m-d H:i:s");
if(sqlzhuru($_POST[jvs])=="pay"){
 zwzr();
 $t1=sqlzhuru($_POST[t1]);
 $t2=sqlzhuru($_POST[t2]);
 if(empty($t1)){Audit_alert("请输入与扫码支付一致的金额","wxpay_ewm.php");}
 if(empty($t2)){Audit_alert("请输入扫码支付成功后的微信订单号","wxpay_ewm.php");}
 if(panduan("*","yjcode_payreng where ddbh='".$t2."'")){Audit_alert("该微信订单号已经录入，无法重复提交","wxpay_ewm.php");}
 $userid=returnuserid($_SESSION[SHOPUSER]);
 intotable("yjcode_payreng","money1,type1,userid,ddbh,sj,ifok","".$t1.",2,".$userid.",'".$t2."','".$sj."',1");
 php_toheader("../tishi/index.php?admin=7"); 
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function tj(){
 if(document.f1.t1.value==""){layerts("请输入与扫码支付一致的金额");return false;}
 if(document.f1.t2.value==""){layerts("请输入扫码支付成功后的微信订单号");return false;}
 if(!confirm("确认已经扫码支付，并且信息都核实了吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="wxpay_ewm.php";
}
</script>
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="./"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">微信</div>
 <div class="d3"></div>
</div>


<form name="f1" method="post" onSubmit="return tj()">
<input type="hidden" value="pay" name="jvs" />

<div class="uk box">
<div class="d1">二维码</div>
<div class="d21"><img src="../../img/wxpay_ewm.jpg" width="150" height="150" /></div>
</div>

<div class="uk box">
 <div class="d1">操作提示</div>
 <div class="d21">请打开手机微信，扫描以上二维码充值转账</div>
</div>

<div class="uk box">
 <div class="d1">充值金额</div>
 <div class="d2"><input type="text" name="t1" class="inp" style="font-weight:700;color:#ff6600;" value="<?=$money1?>" placeholder="请务必与实际充值金额保持一致" /></div>
</div>

<div class="uk box">
 <div class="d1">订单号</div>
 <div class="d2"><input type="text" name="t2" class="inp" style="font-weight:700;color:#ff6600;" placeholder="请输入扫码支付成功后的微信订单号" /></div>
</div>


<div class="carbtn">
 <input type="submit" class="tjinput" value="立即充值" />
</div>

</form>


<? include("bottom.php");?>
<script language="javascript">
bottomjd(4);
</script>

</body>
</html>