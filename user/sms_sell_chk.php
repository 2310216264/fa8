<?
include("../config/conn.php");
include("../config/function.php");
if($_GET[id]=="" || empty($_SESSION[SHOPUSER])){echo "err1";exit;}
$id=intval($_GET[id]);
$userid=returnuserid($_SESSION["SHOPUSER"]);
while0("*","yjcode_smsmail where userid=".$userid." and id=".$id);if(!$row=mysqli_fetch_array($res)){echo "err1";exit;}
$tit=$row[tit];
$txt=$row[txt];
$fa=$row[fa];

deletetable("yjcode_smsmail where id=".$id." and userid=".$userid);

if($row[admin]==1){ //发送邮件
 if(filter_var($fa,FILTER_VALIDATE_EMAIL)){
  require("../config/mailphp/sendmail.php");
  @yjsendmail($tit,$fa,$txt);
 }

}elseif($row[admin]==2){ //发送手机短信
 if(preg_match("/^1[34578]\d{9}$/",$fa)){
 
 while3("*","yjcode_smsmb where mybh='004'");
 if($row3=mysqli_fetch_array($res3)){$txt=$row3[txt];}
 if(empty($rowcontrol[smsmode])){
  include("../config/mobphp/mysendsms.php");
  $str=str_replace("\${tit}",$tit,$txt);
  @yjsendsms($fa,$str);
  
 }else{
  $sms_txt="{tit:'".$tit."'}";
  if(1==$rowcontrol[smsmode]){$sms_txt="{tit:'".$tit."'}";}else{$sms_txt="{\"tit\":\"".$tit."\"}";}
  $sms_mot=$fa;
  $sms_id=$row3[mbid];
  include("../config/mobphp/mysendsms.php");

 }
 
 updatetable("yjcode_control","smskc=smskc-1");
 intotable("yjcode_smsmaillog","admin,fa,userid,txt,sj,uip","2,'".$fa."',".$userid.",'订单发货提醒',".strtotime(getsj()).",'".getuip()."'");
 
 }

}

echo "ok";
?>