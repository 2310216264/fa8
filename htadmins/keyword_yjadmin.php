<?php
include("../config/conn.php");
include("../config/function.php");
$sj=date("Y-m-d H:i:s");

//删除
if($_POST['keyword_type'] == 'del'){
	$id = $_POST['id'];
	$dsql = "yjcode_keyorder where id='".$id."'";
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

//审核
if($_POST['keyword_type'] == 'shenhe'){
	$utable = "yjcode_keyorder";
	$ures = "zt='".$_POST[zt]."',sj_keyword='".$_POST[sj_keyword]."',zf_money='".$_POST[zf_money]."' where id=".$_POST[id];
	
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'操作失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'操作成功',data=>'']);	
	}
	mysqli_close($conn);
}

//提交验收
if($_POST['keyword_type'] == 'yanshou'){
	$utable = "yjcode_keyorder";
	$ures = "content='".$_POST[content]."',zt=4 where id=".$_POST[id];
	$sqlupdate="update ".$utable." set ".$ures;
	mysqli_set_charset($conn,"utf8");
	$res = mysqli_query($conn,$sqlupdate);
	if(!$res){
		echo json_encode([code=>'0',msg=>'操作失败',data=>'']);
	}else{
		echo json_encode([code=>'1',msg=>'操作成功',data=>'']);	
	}
	mysqli_close($conn);
}




function ztspan($x){
if($x==1){return "<span class='zt2'>审核中</span>";}
elseif($x==2){return "<span class='zt2'>进行中</span>";}
elseif($x==3){return "<span class='zt2'>成功</span>";}
elseif($x==4){return "<span class='zt2'>审核中</span>";}
elseif($x==5){return "<span class='zt2'>审核中</span>";}
}













