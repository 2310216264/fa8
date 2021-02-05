<?php
include("../../../config/conn.php");
include("../../../config/function.php");
sesCheck_m();
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$sj=date("Y-m-d H:i:s");
$userid=$rowuser[id];

if(sqlzhuru($_POST[jvs])=="carpay"){
	include("../../../user/buycheck.php");
	if($needmoney<=$usermoney){Audit_alert("您的可用余额充足，请用余额直接支付。","../carpay.php?carid=".$carid);}
	zwzr();
	$bh=time();
	$_SESSION[wxddbh]=time()."wx".$rowuser[id]."wx".rnd_num(1000);
	$uip=$_SERVER["REMOTE_ADDR"];
	$ddbh=time()."|".$rowuser[id];	
	$money1=sprintf("%.2f",($needmoney-$usermoney));
	intotable("yjcode_dingdang","bh,ddbh,userid,sj,uip,money1,ddzt,alipayzt,bz,ifok,wxddbh,carid,sxf","'".$bh."','".$ddbh."',".$rowuser[id].",'".$sj."','".$uip."',".$money1.",'等待买家付款','','微信手机支付',0,'".$_SESSION[wxddbh]."','".$caridarr."',".$sxf."");
}


if(intval($_GET[wxly])==0){//公众号或微信本身
php_toheader("buy_jsapi.php");
}

?>

<!--以下是小程序充值来源开始执行-->
<? if(intval($_GET[wxly])==1){?>
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
wx.miniProgram.navigateTo({
 url:"../wxpay/wxpay?ddbh=<?=$ddbh?>&userid=<?=$userid?>&wzurl=<?=weburl?>&bk=carpay"
});
</script>
<? }?>