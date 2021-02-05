<?
include("../config/conn.php");
include("../config/function.php");
$mot=$_POST[mot];
if(empty($mot)){echo "err1";exit;}

$yzm=$_POST[txyzm];
if(empty($yzm)){echo "err2";exit;}
if(strtolower($_SESSION["authnum_session"])!=strtolower($yzm)){echo "err2";exit;}

if(panduan("mot,ifmot","yjcode_user where mot='".$mot."' and ifmot=1")==1){echo "err1";exit;}

if(!empty($rowcontrol[smsbig])){
 $sj1=strtotime(date("Y-m-d H:i:s",strtotime("-1 day")));
 $sj2=strtotime(getsj());
 if(returncount("yjcode_smsmaillog where uip='".getuip()."' and admin=2 and sj>".$sj1." and sj<".$sj2."")>=$rowcontrol[smsbig]){echo "errbig";exit;}
}
intotable("yjcode_smsmaillog","admin,fa,userid,txt,sj,uip","2,'".$mot."',".returnuserid($_SESSION["SHOPUSER"]).",'注册验证',".strtotime(getsj()).",'".getuip()."'");

while1("*","yjcode_smsmb where mybh='000'");
if($row1=mysqli_fetch_array($res1)){$txt=$row1[txt];}else{$txt="验证码：${yzm},如果不是本人操作，请忽略此信息。";}
$yz=MakePass(6);
if(empty($rowcontrol[smsmode])){
 include("../config/mobphp/mysendsms.php");
 $str=str_replace("\${yzm}",$yz,$txt);
 yjsendsms($mot,$str);
}else{
 $sms_txt="{yzm:'".$yz."'}";
 $sms_mot=$mot;
 $sms_id=$row1[mbid];
 @include("../config/mobphp/mysendsms.php");
}

$_SESSION["REGMOT"]=$mot;
$_SESSION["REGMOTYZ"]=$yz;echo "ok";exit;

?>