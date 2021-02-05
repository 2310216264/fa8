<?php

include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");

sesCheck();

while0("id,money1,jf,ifmot,ifemail,ifqq,userdj,userdjdq","yjcode_user where uid='".$_SESSION[SHOPUSER]."'");if(!$row=mysqli_fetch_array($res)){php_toheader("un.php");}



$usertx="../upload/".$row[id]."/user.jpg";if(!is_file($usertx)){$usertx="img/nonetx.gif";};
$data['money1'] = str_replace("-0.00","0",sprintf("%.2f",$row[money1]));
$data['jf'] = $row['jf'];
$data['topuimg'] = $usertx;


// 成功
if(1==$row[ifemail]){
	$email = '<span class="icon-box success"><em class="icon icon-envelop"></em><i class="icon icon-gou"></i></span>';
}else{
	$email = '<span class="icon-box warning"><em class="icon icon-envelop"></em><i class="icon icon-p-x"></i><a href="/user/emailbd.php" title="邮箱认证"></a></span>';
}


if(1==$row[ifmot]){
	$ifmot = '<span class="icon-box success"><em class="icon icon-p-phone"></em><i class="icon icon-gou"></i></span>';
}else{
	$ifmot = '<span class="icon-box warning"><em class="icon icon-p-phone"></em><i class="icon icon-p-x"></i><a href="/user/mobbd.php" title="手机认证"></a></span>';
}



if(1==$row[ifqq]){
	$ifqq = '<span class="icon-box success"><em class="icon icon-p-Bind"></em><i class="icon icon-gou"></i></span>';
}else{
	$ifqq = '<span class="icon-box warning"><em class="icon icon-p-Bind"></em><i class="icon icon-p-x"></i><a href="/user/qq.php" title="qq认证"></a></span>';
}




//等级

$fdj="";
$sqld="select * from yjcode_userdj where zt=0 order by xh asc";mysqli_set_charset($conn,"utf8");$resd=mysqli_query($conn,$sqld);
if($rowd=mysqli_fetch_array($resd)){$fdj=$rowd[name1];}else{$fdj="";}

$sqlu="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resu=mysqli_query($conn,$sqlu);$rowu=mysqli_fetch_array($resu);
if(empty($rowu[userdj])){
$ldj=$fdj;
}else{
$ldj=$rowu[userdj];
}

if(!empty($rowu[userdjdq])){
$sj1=date("Y-m-d H:i:s");
if($rowu[userdjdq]<$sj1){
	$ldj=$fdj;
	$dq=date('Y-m-d H:i:s',strtotime ("-10 second",strtotime($sj1)));
	updatetable("yjcode_user","userdj='".$fdj."',userdjdq=NULL where uid='".$_SESSION[SHOPUSER]."'");}
}

switch ($ldj) {
	case '普通会员':
		$dj = 1;
		break;
	
	case '白金会员':
		$dj = 2;
		break;
		
	case '黄金会员':
		$dj = 3;
		break;

	case '钻石会员':
		$dj = 4;
		break;
	default:
		$dj = 1;
		break;
}




$data['topurz'] = $ifmot.$email.$ifqq.$dj;

if($rowu[userdjdq]){ $daoqi = $rowu[userdjdq];}else{ $daoqi = '永不到期';}
$data['topudj'] = mb_substr($ldj,0,2,'utf-8').'(到期:'.$daoqi.')';	

$data['topdj'] = $dj;


echo json_encode($data);

?>




