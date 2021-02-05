<?
include("../config/conn.php");
include("../config/function.php");
$mob=$_GET[mob];
if(empty($mob) || empty($_GET[uid])){echo "True";exit;}
if(panduan("uid,mot","yjcode_user where mot='".$mob."' and uid='".$_GET[uid]."'")==0){echo "True";exit;}
if(strtolower($_SESSION["authnum_session"])!=strtolower($_GET[tyzm])){echo "err1";exit;}

if(!empty($rowcontrol[smsbig])){
 $sj1=strtotime(date("Y-m-d H:i:s",strtotime("-1 day")));
 $sj2=strtotime(getsj());
 if(returncount("yjcode_smsmaillog where uip='".getuip()."' and admin=2 and sj>".$sj1." and sj<".$sj2."")>=$rowcontrol[smsbig]){echo "errbig";exit;}
}
intotable("yjcode_smsmaillog","admin,fa,userid,txt,sj,uip","2,'".$mob."',".returnuserid($_SESSION["SHOPUSER"]).",'找回密码',".strtotime(getsj()).",'".getuip()."'");

while1("*","yjcode_smsmb where mybh='000'");
if($row1=mysqli_fetch_array($res1)){$txt=$row1[txt];}else{$txt="验证码：${yzm},如果不是本人操作，请忽略此信息。";}
$yz=MakePass(6);
if(empty($rowcontrol[smsmode])){
 include("../config/mobphp/mysendsms.php");
 $str=str_replace("\${yzm}",$yz,$txt);
 yjsendsms($mob,$str);
}else{
 if(1==$rowcontrol[smsmode]){$sms_txt="{yzm:'".$yz."'}";}else{$sms_txt="{\"yzm\":\"".$yz."\"}";}
 $sms_mot=$mob;
 $sms_id=$row1[mbid];
 @include("../config/mobphp/mysendsms.php");
}

updatetable("yjcode_control","smskc=smskc-1");
updatetable("yjcode_user","getpwd='".$yz."' where uid='".$_GET[uid]."'");echo "ok";exit;

?>