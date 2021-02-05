<?php
include("../../../config/conn.php");
include("../../../config/function.php");

ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once '../lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
global $conn;
$sj=date("Y-m-d H:i:s");
$uip=$_SERVER["REMOTE_ADDR"];
$sql="select * from yjcode_dingdang where wxddbh='".$result[out_trade_no]."' and ifok=0";mysqli_set_charset($conn,"utf8");$res=mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($res)){
 if(round($result["total_fee"]/100,2)!=round($row["money1"],2)){return true;exit;}
 updatetable("yjcode_dingdang","sj='".$sj."',uip='".$uip."',alipayzt='TRADE_SUCCESS',ddzt='交易成功',ifok=1 where wxddbh='".$result[out_trade_no]."'");
 $money1=$row["money1"];
 PointIntoM($row[userid],"微信付款".$money1."元",$money1,4,$result[out_trade_no]);
 PointUpdateM($row[userid],$money1);
 if(!empty($row[sxf])){
 $sxf=$row[sxf]*(-1);
 PointIntoM($row[userid],"支付接口手续费",$sxf,0,$result[out_trade_no]);
 PointUpdateM($row[userid],$sxf);
 }
 $caridarr=$row[carid];
 include("../../buy.php"); 
}
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
