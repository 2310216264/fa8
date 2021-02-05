<?php
include("../config/conn.php");
include("../config/function.php");
$sj=date("Y-m-d H:i:s");

if($_GET['type'] == 'msg'){
	$c=returncount("yjcode_order where sj>'2020-05-01 16:57:14' and ddzt='wait' and admin=1");
	echo $c;
	die();
}

//位置默认推荐
if($_POST['weizhi_type'] == 'weizhi_default'){
	$utable = "yjcode_tuijian";
	$ures = "pro_default='".$_POST[pro_default]."' where id=".$_POST[id];
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'修改失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'修改成功',data=>'']);	
	}
	mysqli_close($conn);
}

//位置添加
if($_POST['weizhi_type'] == 'weizhi_add'){
	$itable = "yjcode_tuijian";
	$zdarr = "bianhao,sorts,price,state,type,add_time";
	$resarr = "'".$_POST[bianhao]."','".$_POST[sorts]."','".$_POST[price]."','".$_POST[state]."','".$_POST[type]."','".$sj."'";
	$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlinto);
	if(!$res){
		echo json_encode([code=>'0',msg=>'添加失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'添加成功',data=>'']);	
	}
	mysqli_close($conn);
}

//位置修改
if($_POST['weizhi_type'] == 'weizhi_update'){
	$utable = "yjcode_tuijian";
	$ures = "bianhao='".$_POST[bianhao]."',sorts=".$_POST[sorts].",price=".$_POST[price].",state=".$_POST[state]." where id=".$_POST[id];
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'修改失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'修改成功',data=>'']);	
	}
	mysqli_close($conn);
}
//位置删除
if($_POST['weizhi_type'] == 'weizhi_del'){
	$id = $_POST['id'];
	$dsql = "yjcode_tuijian where id='".$id."'";
	$sqldelete="delete from ".$dsql;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqldelete);
	if(!$res){
		echo json_encode([code=>'0',msg=>'删除失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'删除成功',data=>'']);	
	}
	mysqli_close($conn);
}



//商品优惠等级添加
if($_POST['youhui_type'] == 'youhui_add'){
	$itable = "yjcode_youhui";
	$zdarr = "das,d1,zhekou,sorts,type,add_time";
	$resarr = "'".$_POST[das]."','".$_POST[d1]."','".$_POST[zhekou]."','".$_POST[sorts]."','".$_POST[type]."','".$sj."'";
	$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlinto);
	if(!$res){
		echo json_encode([code=>'0',msg=>'添加失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'添加成功',data=>'']);	
	}
	mysqli_close($conn);
}
//商品优惠编辑
if($_POST['youhui_type'] == 'youhui_update'){
	$utable = "yjcode_youhui";
	$ures = "das='".$_POST[das]."',d1=".$_POST[d1].",zhekou=".$_POST[zhekou].",sorts=".$_POST[sorts]." where id=".$_POST[id];
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'修改失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'修改成功',data=>'']);	
	}
	mysqli_close($conn);
	
}
//商品优惠删除
if($_POST['youhui_type'] == 'youhui_del'){
	$id = $_POST['id'];
	$dsql = "yjcode_youhui where id='".$id."'";
	$sqldelete="delete from ".$dsql;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqldelete);
	if(!$res){
		echo json_encode([code=>'0',msg=>'删除失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'删除成功',data=>'']);	
	}
	mysqli_close($conn);
}

