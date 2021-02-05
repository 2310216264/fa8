<?php
header("Content-type:text/html; charset=UTF-8"); 
include("../../config/conn.php");
include("../../config/function.php");



$arr = explode("|",$rowcontrol[ipsshh]);

 //公司名称：迅付信息科技有限公司
 //系统:新系统接口S2S返回
 //功能:新系统返回报文处理
 //创建者:IPS
 //日期：2015-01-29

$paymentResult = $_POST["paymentResult"];//获取信息
$xml=simplexml_load_string($paymentResult,'SimpleXMLElement', LIBXML_NOCDATA); 

  //读取相关xml中信息
   $ReferenceIDs = $xml->xpath("GateWayRsp/head/ReferenceID");//关联号
   //var_dump($ReferenceIDs); 
   $ReferenceID = $ReferenceIDs[0];//关联号
   $RspCodes = $xml->xpath("GateWayRsp/head/RspCode");//响应编码
   $RspCode=$RspCodes[0];
   $RspMsgs = $xml->xpath("GateWayRsp/head/RspMsg"); //响应说明
   $RspMsg=$RspMsgs[0];
   $ReqDates = $xml->xpath("GateWayRsp/head/ReqDate"); // 接受时间
    $ReqDate=$ReqDates[0];
   $RspDates = $xml->xpath("GateWayRsp/head/RspDate");// 响应时间
    $RspDate=$RspDates[0];
   $Signatures = $xml->xpath("GateWayRsp/head/Signature"); //数字签名
    $Signature=$Signatures[0];
   $MerBillNos = $xml->xpath("GateWayRsp/body/MerBillNo"); // 商户订单号
    $MerBillNo=$MerBillNos[0];
   $CurrencyTypes = $xml->xpath("GateWayRsp/body/CurrencyType");//币种
    $CurrencyType=$CurrencyTypes[0];
   $Amounts = $xml->xpath("GateWayRsp/body/Amount"); //订单金额
    $Amount=$Amounts[0];
   $Dates = $xml->xpath("GateWayRsp/body/Date");    //订单日期
    $Date=$Dates[0];
   $Statuss = $xml->xpath("GateWayRsp/body/Status");  //交易状态
    $Status=$Statuss[0];
   $Msgs = $xml->xpath("GateWayRsp/body/Msg");    //发卡行返回信息
    $Msg=$Msgs[0];
   $Attachs = $xml->xpath("GateWayRsp/body/Attach");    //数据包
    $Attach=$Attachs[0];
   $IpsBillNos = $xml->xpath("GateWayRsp/body/IpsBillNo"); //IPS订单号
    $IpsBillNo=$IpsBillNos[0];
   $IpsTradeNos = $xml->xpath("GateWayRsp/body/IpsTradeNo"); //IPS交易流水号
    $IpsTradeNo=$IpsTradeNos[0];
   $RetEncodeTypes = $xml->xpath("GateWayRsp/body/RetEncodeType");    //交易返回方式
    $RetEncodeType=$RetEncodeTypes[0];
   $BankBillNos = $xml->xpath("GateWayRsp/body/BankBillNo"); //银行订单号
    $BankBillNo=$BankBillNos[0];
   $ResultTypes = $xml->xpath("GateWayRsp/body/ResultType"); //支付返回方式
    $ResultType=$ResultTypes[0];
   $IpsBillTimes = $xml->xpath("GateWayRsp/body/IpsBillTime"); //IPS处理时间
    $IpsBillTime=$IpsBillTimes[0];
	
$resParam="关联号:"
          .$ReferenceID
          ."响应编码:"
          .$RspCode
          ."响应说明:"
          .$RspMsg
          ."接受时间:"
          .$ReqDate
          ."响应时间:"
          .$RspDate
          ."数字签名:"
          .$Signature
          ."商户订单号:"
          .$MerBillNo
          ."币种:"
          .$CurrencyType
          ."订单金额:"
          .$Amount
          ."订单日期:"
          .$Date
          ."交易状态:"
          .$Status
          ."发卡行返回信息:"
          .$Msg
          ."数据包:"
          .$Attach
		   ."IPS订单号:"
		     .$IpsBillNo
		   ."交易返回方式:"
          .$RetEncodeType
		   ."银行订单号:"
		     .$BankBillNo
			  ."支付返回方式:"
		     .$ResultType
			   ."IPS处理时间:"
		     .$IpsBillTime;
//file_put_contents(PATH_LOG_FILE,date('y-m-d h:i:s').'S2S新系统获取参数信息:'.$resParam."\r\n",FILE_APPEND);

//验签明文
//billno+【订单编号】+currencytype+【币种】+amount+【订单金额】+date+【订单日期】+succ+【成功标志】+ipsbillno+【IPS订单编号】+retencodetype +【交易返回签名方式】+【商户内部证书】

 $sbReq = "<body>"
                          . "<MerBillNo>" . $MerBillNo . "</MerBillNo>"
                          . "<CurrencyType>" . $CurrencyType . "</CurrencyType>"
                          . "<Amount>" . $Amount . "</Amount>"
                          . "<Date>" . $Date . "</Date>"
                          . "<Status>" . $Status . "</Status>"
                          . "<Msg><![CDATA[" . $Msg . "]]></Msg>"
                          //. "<Attach><![CDATA[" . $Attach . "]]></Attach>"
                          . "<IpsBillNo>" . $IpsBillNo . "</IpsBillNo>"
                          . "<IpsTradeNo>" . $IpsTradeNo . "</IpsTradeNo>"
                          . "<RetEncodeType>" . $RetEncodeType . "</RetEncodeType>"
                          . "<BankBillNo>" . $BankBillNo . "</BankBillNo>"
                          . "<ResultType>" . $ResultType . "</ResultType>"
                          . "<IpsBillTime>" . $IpsBillTime . "</IpsBillTime>"
                       . "</body>";
$sign=$sbReq.$arr[0].$rowcontrol[ipszs];




$md5sign=  md5($sign);


//判断签名
if($Signature==$md5sign)
{

      if($RspCode=='000000')
    {
	
		
		$billno=$MerBillNo;
		$amount=$Amount;
		
       $sj=date("Y-m-d H:i:s");
       $uip=$_SERVER["REMOTE_ADDR"];

		
		//while1("*","yjcode_dingdang where ddbh='".$billno."' and ddzt='等待买家付款'");


		$sqltype="select * from yjcode_dingdang where ddbh='".$billno."'";



		$restype=mysql_query($sqltype);
		$rowtype=mysql_fetch_array($restype);
		//print_r($rowtype);
		
		if($rowtype['alipayzt']!="TRADE_SUCCESS"){

			$url="http://".$_SERVER['SERVER_NAME']."/user/ips/ok1.php?billno=".$billno."&amount=".$amount;
		//echo $url;
        file_get_contents($url);

       }
		

        

      


	  
		//php_toheader("../paylog.php");		
				
		
		echo "支付成功";
	
    }
    
 }
else
{

    echo "订单签名错误";
}


?>
