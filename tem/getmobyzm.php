<?
include("../config/conn.php");
include("../config/function.php");
$mob=sqlzhuru($_GET[mob]);
$smsbh=sqlzhuru($_GET[smsbh]);
$yz=sqlzhuru($_GET[yz]);
if(!preg_match("/^1[34578]\d{9}$/",$mob) || empty($smsbh) || empty($yz)){exit;}

if($smsbh=="000"){$txt="验证码：${yzm},您正在进行手机验证，如果不是本人操作，请忽略此信息。";}

if(!empty($rowcontrol[smsbig])){
 $sj1=strtotime(date("Y-m-d H:i:s",strtotime("-1 day")));
 $sj2=strtotime(getsj());
 if(returncount("yjcode_smsmaillog where uip='".getuip()."' and admin=2 and sj>".$sj1." and sj<".$sj2."")>=$rowcontrol[smsbig]){echo "errbig";exit;}
}
intotable("yjcode_smsmaillog","admin,fa,userid,txt,sj,uip","2,'".$mob."',0,'手机端短信验证操作',".strtotime(getsj()).",'".getuip()."'");

while1("*","yjcode_smsmb where mybh='".$smsbh."'");if($row1=mysqli_fetch_array($res1)){$txt=$row1[txt];}
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

?>