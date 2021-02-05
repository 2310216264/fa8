<?php
//软件操作
include("../config/conn.php");
include("../config/function.php");
$sj=date("Y-m-d H:i:s");

//添加
if($_POST['yjcode_keyorder'] == 'add'){
	$bh = 'k'.time().'_'.$_POST[sj_uid];
	$itable = "yjcode_keyorder";
	$zdarr = "bh,sj_uid,sj_nc,sj_qq,sj_link,sj_keyword,add_time";
	$resarr = "'".$bh."','".$_POST[sj_uid]."','".$_POST[sj_nc]."','".$_POST[sj_qq]."','".$_POST[sj_link]."','".$_POST[sj_keyword]."','".$sj."'";
	$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlinto);
	if(!$res){
		echo json_encode([code=>'0',msg=>'提交失败',data=>'keyword_list.php']);
	}else{
		echo json_encode([code=>'1',msg=>'提交成功',data=>'keyword_list.php']);	
	}
	mysqli_close($conn);
}

//验收
if($_POST['yjcode_keyorder'] == 'yanshou'){
	$data = $_POST['zt'];
	// 确认验收
	$utable = "yjcode_keyorder";
	if($data == 5){
		$ures = "zt=5 where id=".$_POST[id];
	}
	if($data == 6){
		$ures = "zt=6 where id=".$_POST[id];
	}
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'操作失败',data=>'keyword_list.php']);
	}else{
		echo json_encode([code=>'1',msg=>'操作成功',data=>'keyword_list.php']);	
	}	
	
}


//支付
if($_POST['yjcode_keyorder'] == 'pay'){
	
	$uid = $_POST['uid'];//用户信息
	$id = $_POST['id'];//订单
	$zf_money = $_POST['zf_money'];//支付金额
	
	//获取用户信息
	$sqluser="select id,money1,uid,nc from yjcode_user where uid='".$uid."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
	$rowuser=mysqli_fetch_array($resuser);
	$money1 = str_replace("-0.00","0",sprintf("%.2f",$rowuser[money1]));
	
	//余额是否充足
	if($money1>$zf_money){
		//修改位置信息  扣除余额
		$tjtable = "yjcode_keyorder";
		$ures = "zt=3 where id=".$id;
		$sqlupdate="update ".$tjtable." set ".$ures;
		mysqli_set_charset($conn,"utf8");
		$res = mysqli_query($conn,$sqlupdate);
		
		$zf_money=sprintf("%.2f",$zf_money);
		updatetable("yjcode_user","money1=money1-(".$zf_money.") where id=".intval($rowuser[id]));
		
		if($res){
			//消费记录
			$e_prices=$zf_money*(-1);
			PointIntoM($rowuser[id],"购买优化",$e_prices);
			//消费记录
			echo json_encode([code=>'1',msg=>'支付成功',data=>'keyword_list.php']);
		}else{
			echo json_encode([code=>'0',msg=>'支付失败',data=>'']);	
		}
	}else{
		echo json_encode([code=>'2',msg=>'余额不足！',data=>'pay.php']);return false;
	}
}










