<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>在线支付接口PHP版</title>

<link href="css/index.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="javascript:document.E_FORM.submit()">
<?php
include("../../config/conn.php");
include("../../config/function.php");
//****************************************
$v_mid = $rowcontrol[bankbh];
if($_GET[ifwap]=="yes"){$ifm="m/";}
$v_url = weburl.$ifm.'user/paylog.php';
$key   = $rowcontrol[bankkey];
$remark2 = '[url:='.weburl.'user/bank/AutoReceive.php]';

if(trim($_POST['v_oid'])<>""){
 $v_oid = trim($_POST['v_oid']); 
}else
{
	   $v_oid = date('Ymd',time())."-".$v_mid."-".date('His',time());//订单号，建议构成格式 年月日-商户号-小时分钟秒

}
	 
	$v_amount = trim($_POST[t1]);                   //支付金额                 
    $v_moneytype = "CNY";                                            //币种

	$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key;        //md5加密拼凑串,注意顺序不能变
    $v_md5info = strtoupper(md5($text));                             //md5函数加密并转化成大写字母

	 $remark1 = webname.'网银在线充值';					 //备注字段1
	 



	$v_rcvname   = $_SESSION[SHOPUSER]  ;		// 收货人
	$v_rcvaddr   = ""  ;		// 收货地址
	$v_rcvtel    = ""   ;		// 收货人电话
	$v_rcvpost   = ""  ;		// 收货人邮编
	$v_rcvemail  = "" ;		// 收货人邮件
	$v_rcvmobile = "";		// 收货人手机号

	$v_ordername   = ""  ;	// 订货人姓名
	$v_orderaddr   = ""  ;	// 订货人地址
	$v_ordertel    = ""   ;	// 订货人电话
	$v_orderpost   = ""  ;	// 订货人邮编
	$v_orderemail  = "" ;	// 订货人邮件
	$v_ordermobile = "";	// 订货人手机号 


$userid=returnuserid($_SESSION["SHOPUSER"]);
$sj=date("Y-m-d H:i:s");
$bh=time();
$uip=$_SERVER["REMOTE_ADDR"];
$money1=sqlzhuru($_POST[t1]);
$sxf=0;
if(!empty($rowcontrol[paysxf])){
$sxf=str_replace("0.00",0,sprintf("%.2f",$money1*$rowcontrol[paysxf]));
}
$money1=$money1+$sxf;
intotable("yjcode_dingdang","bh,ddbh,userid,sj,uip,money1,ddzt,alipayzt,bz,ifok,sxf","'".$bh."','".$v_oid."',".$userid.",'".$sj."','".$uip."',".$money1.",'等待买家付款','','网银在线',0,".$sxf."");

?>

<!--以下信息为标准的 HTML 格式 + PHP 语言 拼凑而成的 网银在线 支付接口标准演示页面 无需修改-->

<form method="post" name="E_FORM" action="https://Pay3.chinabank.com.cn/PayGate">
	<input type="hidden" name="v_mid"         value="<?php echo $v_mid;?>">
	<input type="hidden" name="v_oid"         value="<?php echo $v_oid;?>">
	<input type="hidden" name="v_amount"      value="<?php echo $v_amount;?>">
	<input type="hidden" name="v_moneytype"   value="<?php echo $v_moneytype;?>">
	<input type="hidden" name="v_url"         value="<?php echo $v_url;?>">
	<input type="hidden" name="v_md5info"     value="<?php echo $v_md5info;?>">
 
 <!--以下几项项为网上支付完成后，随支付反馈信息一同传给信息接收页 -->	
	
	<input type="hidden" name="remark1"       value="<?php echo $remark1;?>">
	<input type="hidden" name="remark2"       value="<?php echo $remark2;?>">



<!--以下几项只是用来记录客户信息，可以不用，不影响支付 -->
	<input type="hidden" name="v_rcvname"      value="<?php echo $v_rcvname;?>">
	<input type="hidden" name="v_rcvtel"       value="<?php echo $v_rcvtel;?>">
	<input type="hidden" name="v_rcvpost"      value="<?php echo $v_rcvpost;?>">
	<input type="hidden" name="v_rcvaddr"      value="<?php echo $v_rcvaddr;?>">
	<input type="hidden" name="v_rcvemail"     value="<?php echo $v_rcvemail;?>">
	<input type="hidden" name="v_rcvmobile"    value="<?php echo $v_rcvmobile;?>">

	<input type="hidden" name="v_ordername"    value="<?php echo $v_ordername;?>">
	<input type="hidden" name="v_ordertel"     value="<?php echo $v_ordertel;?>">
	<input type="hidden" name="v_orderpost"    value="<?php echo $v_orderpost;?>">
	<input type="hidden" name="v_orderaddr"    value="<?php echo $v_orderaddr;?>">
	<input type="hidden" name="v_ordermobile"  value="<?php echo $v_ordermobile;?>">
	<input type="hidden" name="v_orderemail"   value="<?php echo $v_orderemail;?>">

</form>

</body>
</html>
