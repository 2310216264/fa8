<?php
header("Content-type:text/html; charset=gb2312"); 
include("../../config/conn.php");
include("../../config/function.php");



		$billno=$_GET['billno'];
		$amount=$_GET['amount'];
		
        $sj=date("Y-m-d H:i:s");
        $uip=$_SERVER["REMOTE_ADDR"];

		
		//while1("*","yjcode_dingdang where ddbh='".$billno."' and ddzt='等待买家付款'");


		$sqltype="select * from yjcode_dingdang where ddbh='".$billno."'";
		$restype=mysql_query($sqltype);
		$rowtype=mysql_fetch_array($restype);

		print_r($rowtype);
		
		if($rowtype['ddzt']=="等待买家付款"){

        updatetable("yjcode_dingdang","sj='".$sj."',uip='".$uip."',alipayzt='TRADE_SUCCESS',ddzt='交易成功',ifok=1,bz='环讯支付' where id=".$rowtype[id]);
        $money1=$rowtype["money1"];
        PointIntoM($rowtype[userid],"环讯充值".$money1."元",$money1);
        PointUpdateM($rowtype[userid],$money1);

       }


?>