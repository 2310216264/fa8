<?php
header("Content-type:text/html; charset=gb2312"); 
include("../../config/conn.php");
include("../../config/function.php");



		$billno=$_GET['billno'];
		$amount=$_GET['amount'];
		
        $sj=date("Y-m-d H:i:s");
        $uip=$_SERVER["REMOTE_ADDR"];

		
		//while1("*","yjcode_dingdang where ddbh='".$billno."' and ddzt='等待买家付款'");






		$sj=date("Y-m-d H:i:s");
       $uip=$_SERVER["REMOTE_ADDR"];
       while1("*","yjcode_dingdang where ddbh='".$billno."' and ddzt='等待买家付款'");if($row1=mysql_fetch_array($res1)){
       updatetable("yjcode_dingdang","sj='".$sj."',uip='".$uip."',ifok=1,alipayzt='TRADE_SUCCESS',ddzt='交易成功' where ddbh='".$billno."'");
       $money1=$row1["money1"];
       PointIntoM($row1[userid],"环讯支付充值".$money1."元",$money1);
       PointUpdateM($row1[userid],$money1);
       $caridarr=$row1[carid];
       include("../buy.php"); 

?>