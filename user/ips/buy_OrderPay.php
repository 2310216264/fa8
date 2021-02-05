<?php
header("Content-type:text/html; charset=gb2312");

include("../../config/conn.php");
include("../../config/function.php");
sesCheck();
$sj=date("Y-m-d H:i:s");
$uip=$_SERVER["REMOTE_ADDR"];

$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysql_query("SET NAMES 'GBK'");$resuser=mysql_query($sqluser);
if(!$rowuser=mysql_fetch_array($resuser)){php_toheader("../reg/");}
include("../buycheck.php");

//商户交易日期
$BillDate = date('Ymd');

//商户返回地址
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
$url .= str_ireplace('localhost', '127.0.0.1', $_SERVER['HTTP_HOST']) . $_SERVER['SCRIPT_NAME'];
$url = str_ireplace('orderpay', 'OrderReturn', $url);

if(sqlzhuru($_POST[jvs])=="carpay"){
if($needmoney<=$usermoney){Audit_alert("您的可用余额充足，请用余额直接支付。","../carpay.php?carid=".$carid);}
zwzr();
$bh=time();
$BillNo = date('YmdHis') . mt_rand(100000,999999)."|".$rowuser[id];
$money1=($needmoney*10-$usermoney*10)/10;
intotable("yjcode_dingdang","bh,ddbh,userid,sj,uip,money1,ddzt,alipayzt,bz,ifok,carid","'".$bh."','".$BillNo."',".$rowuser[id].",'".$sj."','".$uip."',".$money1.",'等待买家付款','','环讯支付',0,'".$caridarr."'");
}





$arr = explode("|",$rowcontrol[ipsshh]);

 //获取输入参数
$pVersion = 'v1.0.0';//版本号
$pMerCode = $arr[0];//商户号
$pMerName = webname;//商户名
$pMerCert = $rowcontrol[ipszs];//商户证书
$pAccount  =  $arr[1];//账户号
$pMsgId = "msg".rand(1000,9999);//消息编号
$pReqDate = date("Ymdhis");//商户请求时间

$pMerBillNo = $BillNo;//商户订单号
$pAmount = $money1;//订单金额 
$pDate =date("Ymd");//订单日期
$pCurrencyType = "GB";//币种
$pGatewayType = "01";//支付方式
$pLang = "GB";//语言
$pMerchanturl = $url;//支付结果成功返回的商户URL 
$pFailUrl = "";//支付结果失败返回的商户URL 
$pAttach = "";//商户数据包
$pOrderEncodeTyp = "5";//订单支付接口加密方式 默认为5#md5
$pRetEncodeType ="17";//交易返回接口加密方式
$pRetType = "3";//返回方式 
$pServerUrl = $url;//Server to Server返回页面 
$pBillEXP = 1;//订单有效期(过期时间设置为1小时)
$pGoodsName = "pay";//商品名称
$pIsCredit = "0";//直连选项
$pBankCode = "";//银行号
$pProductType= "1";//产品类型

$reqParam="商户号".$pMerCode
          ."商户名".$pMerName
          ."账户号".$pAccount
          ."消息编号".$pMsgId
          ."商户请求时间".$pReqDate
          ."商户订单号".$pMerBillNo
          ."订单金额".$pAmount
          ."订单日期".$pDate
          ."币种".$pCurrencyType
          ."支付方式".$pGatewayType
          ."语言".$pLang
          ."支付结果成功返回的商户URL".$pMerchanturl
          ."支付结果失败返回的商户URL".$pFailUrl
          ."商户数据包".$pAttach
          ."订单支付接口加密方式".$pOrderEncodeTyp
          ."交易返回接口加密方式".$pRetEncodeType
          ."返回方式".$pRetType
          ."Server to Server返回页面 ".$pServerUrl
          ."订单有效期".$pBillEXP
          ."商品名称".$pGoodsName
          ."直连选项".$pIsCredit
          ."银行号".$pBankCode
          ."产品类型".$pProductType;


 if($pIsCredit==0)
 {
     $pBankCode="";
     $pProductType='';
 }

 //请求报文的消息体
  $strbodyxml= "<body>"
	         ."<MerBillNo>".$pMerBillNo."</MerBillNo>"
	         ."<Amount>".$pAmount."</Amount>"
	         ."<Date>".$pDate."</Date>"
	         ."<CurrencyType>".$pCurrencyType."</CurrencyType>"
	         ."<GatewayType>".$pGatewayType."</GatewayType>"
                 ."<Lang>".$pLang."</Lang>"
	         ."<Merchanturl>".$pMerchanturl."</Merchanturl>"
	         ."<FailUrl>".$pFailUrl."</FailUrl>"
                 ."<Attach>".$pAttach."</Attach>"
                 ."<OrderEncodeType>".$pOrderEncodeTyp."</OrderEncodeType>"
                 ."<RetEncodeType>".$pRetEncodeType."</RetEncodeType>"
                 ."<RetType>".$pRetType."</RetType>"
                 ."<ServerUrl>".$pServerUrl."</ServerUrl>"
                 ."<BillEXP>".$pBillEXP."</BillEXP>"
                 ."<GoodsName>".$pGoodsName."</GoodsName>"
                 ."<IsCredit>".$pIsCredit."</IsCredit>"
                 ."<BankCode>".$pBankCode."</BankCode>"
                 ."<ProductType>".$pProductType."</ProductType>"
	      ."</body>";

  
  $Sign=$strbodyxml.$pMerCode.$pMerCert;//签名明文



 
  $pSignature = md5($strbodyxml.$pMerCode.$pMerCert);//数字签名 
  //请求报文的消息头
  $strheaderxml= "<head>"
                   ."<Version>".$pVersion."</Version>"
                   ."<MerCode>".$pMerCode."</MerCode>"
                   ."<MerName>".$pMerName."</MerName>"
                   ."<Account>".$pAccount."</Account>"
                   ."<MsgId>".$pMsgId."</MsgId>"
                   ."<ReqDate>".$pReqDate."</ReqDate>"
                   ."<Signature>".$pSignature."</Signature>"
              ."</head>";
 
//提交给网关的报文
$strsubmitxml =  "<Ips>"
              ."<GateWayReq>"
              .$strheaderxml
              .$strbodyxml
	      ."</GateWayReq>"
            ."</Ips>";

//提交给网关明文


?>

<!DOCTYPE html>
<html>
<head lang="en">
<meta NAME="robots" CONTENT="noindex,nofollow">
<meta name="robots" content="noarchive"> <!-- 屏蔽-->
<meta http-equiv="content-Type" content="text/html; charset=gb2312">
<form name="form1" id="form1" method="post" action="http://newpay.ips.com.cn/psfp-entry/gateway/payment.html" target="_self">
<input type="hidden" name="pGateWayReq" value="<?php echo $strsubmitxml ?>" />
</form>
<script language="javascript">document.form1.submit();</script>