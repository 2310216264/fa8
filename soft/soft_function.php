<?php
include("../config/conn.php");
//父类软件数目
function softcount($id){
	global $conn;
	$sqlty1="select count(*) as id from yjcode_soft where soft_type_id=".$id;
	mysqli_set_charset($conn,"utf8");$rescount=mysqli_query($conn,$sqlty1);$rowcount=mysqli_fetch_array($rescount);
	return intval($rowcount[id]);
	return intval($rowcount);
}

//子类软件数目
function softcounts($id){
	global $conn;
	$sqlty1="select count(*) as id from yjcode_soft where soft_type_id=".$id;
	mysqli_set_charset($conn,"utf8");$rescount=mysqli_query($conn,$sqlty1);$rowcount=mysqli_fetch_array($rescount);
	return intval($rowcount[id]);
	return intval($rowcount);
}

//查询大类的所有子类ID加上大类ID
function soft_sid($id){
	global $conn;
	global $str;
	$sq="select id from yjcode_soft_type where fid=".$id;
	mysqli_set_charset($conn,"utf8");
	$resty1=mysqli_query($conn,$sq);
	$rowty1=mysqli_fetch_all($resty1,MYSQLI_ASSOC);
	if($rowty1){
		foreach ($rowty1 as $k=>$v){
			$str .= $v[id].',';
		}
		return $str.$id;
	}else{
		return 0;
	}
	
}


function softcountf($id){
	global $conn;
	global $str;
	global $pid;
	$pid = soft_sid($id);
	return $pid;
	// if($pid!=0){
	// 	$sqlty1="select count(*) as id from yjcode_soft where soft_type_id in($pid)";
	// 	mysqli_set_charset($conn,"utf8");$rescount=mysqli_query($conn,$sqlty1);$rowcount=mysqli_fetch_all($rescount,MYSQLI_ASSOC);
	
	// 	// if($rowcount[0][id]=='0'){
	// 	//  $str = 0;
	// 	// 	return $str;
	// 	// }else{
			
	// 		return $rowcount[0][id];
	// 	// }
	// 	// return $rowcount;
	// }else{
	// 	return 0;
	// }

}




// 授权类型

function soft_shouquan($x){
if($x==1){return "免费软件";}
elseif($x==2){return "共享软件";}
elseif($x==3){return "收费软件";}
}

// 支持的系统
function soft_xitong($f){
	if(strstr($f,49)){$str = 'Win7/';}
	if(strstr($f,50)){$str .= 'Win8/';}  
	if(strstr($f,51)){$str .= 'Win10/';}  
	if(strstr($f,52)){$str .= 'WinVista/';} 
	if(strstr($f,53)){$str .= 'WinXP/';}
	if(strstr($f,54)){$str .= 'MacOS/';}
	return $str;
}

// 获取系统位数
function soft_weishu($z){
	if(strstr($z,49)){$str = '32位/';}
	if(strstr($z,50)){$str .= '64位';}  
	return $str;
}



function rentsers($x,$xv,$y,$yv,$nq="view",$z='',$zv='',$w='',$wv=''){
if(empty($nq)){$nq="view";}
$nstr=$_GET[id];
if(!check_in("_".$x.$xv."v",$nstr)){
if(check_in("_".$x,$nstr)){
 $a=preg_split("/_".$x."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$x.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$x.$xv."v".$d[1];
}else{
 $nstr=$nstr."_".$x.$xv."v";
}
}
if($y!=""){
if(!check_in("_".$y.$yv."v",$nstr)){
if(check_in("_".$y,$nstr)){
 $a=preg_split("/_".$y."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$y.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$y.$yv."v".$d[1];
}else{
 $nstr=$nstr."_".$y.$yv."v";
}
}
}
if($z!=""){
if(!check_in("_".$z.$zv."v",$nstr)){
if(check_in("_".$z,$nstr)){
 $a=preg_split("/_".$z."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$z.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$z.$zv."v".$d[1];
}else{
 $nstr=$nstr."_".$z.$zv."v";
}
}
}
if($w!=""){
if(!check_in("_".$w.$wv."v",$nstr)){
if(check_in("_".$w,$nstr)){
 $a=preg_split("/_".$w."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$w.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$w.$wv."v".$d[1];
}else{
 $nstr=$nstr."_".$w.$wv."v";
}
}
}
if($xv==""){$nstr=str_replace("_".$x."v","",$nstr);}
if($yv==""){$nstr=str_replace("_".$y."v","",$nstr);}
if($zv==""){$nstr=str_replace("_".$z."v","",$nstr);}
if($wv==""){$nstr=str_replace("_".$w."v","",$nstr);}
return ($nq.$nstr).".html";}


