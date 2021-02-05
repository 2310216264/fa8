<?php
include("../../../config/conn.php");
include("../../../config/function.php");
sesCheck_m();

$sj=date("Y-m-d H:i:s");
$userid=returnuserid($_SESSION["SHOPUSER"]);
$bh=time()."pay".$userid;
$uip=$_SERVER["REMOTE_ADDR"];
$ddbh=time()."wx".$userid;	
$money1=sqlzhuru($_POST[t1]);
$sxf=0;
if(!empty($rowcontrol[paysxf])){
$sxf=str_replace("0.00",0,sprintf("%.2f",$money1*$rowcontrol[paysxf]));
}
$_SESSION[wxddbh]=time()."wx".$userid."wx".rnd_num(1000);
intotable("yjcode_dingdang","bh,ddbh,userid,sj,uip,money1,ddzt,alipayzt,bz,ifok,wxddbh,sxf","'".$bh."','".$ddbh."',".$userid.",'".$sj."','".$uip."',".$money1.",'wait','','wx',0,'".$_SESSION[wxddbh]."',".$sxf."");

if(intval($_GET[wxly])==0){//公众号或微信本身
php_toheader("jsapi.php");
}

?>

<!--以下是小程序充值来源开始执行-->
<? if(intval($_GET[wxly])==1){?>
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>
var u="../wxpay/wxpay?ddbh=<?=$ddbh?>&userid=<?=$userid?>&wzurl=<?=weburl?>&bk=pay";
wx.miniProgram.navigateTo({
 url:u
});
</script>
<? }?>