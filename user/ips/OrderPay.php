<?php
header("Content-type:text/html; charset=gb2312");

include("../../config/conn.php");
include("../../config/function.php");

//商户交易日期
$BillDate = date('Ymd');

//商户返回地址
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
$url .= str_ireplace('localhost', '127.0.0.1', $_SERVER['HTTP_HOST']) . $_SERVER['SCRIPT_NAME'];
$url = str_ireplace('orderpay', 'OrderReturn', $url);

$userid=returnuserid($_SESSION["SHOPUSER"]);
$sj=date("Y-m-d H:i:s");
$BillNo = date('YmdHis') . mt_rand(100000,999999)."|".$userid;
$bh=time();
$uip=$_SERVER["REMOTE_ADDR"];
$money1=sqlzhuru($_POST[t1]);
intotable("yjcode_dingdang","bh,ddbh,userid,sj,uip,money1,ddzt,alipayzt,bz,ifok","'".$bh."','".$BillNo."',".$userid.",'".$sj."','".$uip."',".$money1.",'等待买家付款','','环讯支付',0");



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
<!--
<html>
  <head>
    <meta http-equiv="content-Type" content="text/html; charset=gb2312">
    <title>环讯支付接口跳转中……</title>
  </head>
  <body onLoad="javascript:document.frm1.submit()">
    <form action="redirect.php" METHOD="POST" name="frm1">	
    <input type="hidden" value="0" name="test" />
    <input type="hidden" value="<?=$rowcontrol[ipsshh]?>" name="Mer_code" />
    <input type="hidden" value="<?=$rowcontrol[ipszs]?>" name="Mer_key" />
    <input type="hidden" value="<?=$BillNo?>" name="Billno" />
    <input type="hidden" value="<?=$money1?>" name="Amount" />
    <input type="hidden" value="<?=$money1?>" name="DispAmount" />
    <input type="hidden" value="<?=$BillDate?>" name="Date" />
    <input type="hidden" value="RMB" name="Currency_Type" />
    <input type="hidden" value="01" name="Gateway_Type" />
    <input type="hidden" value="GB" name="Lang" />
    <input type="hidden" value="<?=$url?>" name="Merchanturl" />
    <input type="hidden" value="5" name="OrderEncodeType" />
    <input type="hidden" value="17" name="RetEncodeType" />
    <input type="hidden" value="1" name="Rettype" />
    <input type="hidden" value="<?=$url?>" name="ServerUrl" />
    </form> 
  </body> 
</html>-->