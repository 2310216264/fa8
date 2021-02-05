<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("order.php");}

if(sqlzhuru($_POST[yjcode])=="tk"){
 zwzr();
 $pwd=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,pwd","yjcode_user where pwd='".$pwd."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("登录密码有误！","ordertk.php?zuorderbh=".$zuorderbh);}
 if($row[ddzt]!="wait" && $row[ddzt]!="db" && $row[ddzt]!="backerr"){Audit_alert("未知错误！","orderview.php?zuorderbh=".$zuorderbh);}
 
 //预判B
 $i=1;
 $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
  $tkm=sqlzhuru($_POST["tk".$i]);
  if($tkm>$rowli[allmoney3]){Audit_alert("退款金额无效，请核实！","ordertk.php?zuorderbh=".$zuorderbh);}
  $i++;
 }
 //预判E
 
 $oksj=date("Y-m-d H:i:s",strtotime("+".$rowcontrol[tksj]." day"));
 $i=1;
 $tkmoney=0;
 $num=0;
 $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
  $tkm=sqlzhuru($_POST["tk".$i]);
  updatetable("yjcode_order","tkmoney=".$tkm.",tkautosj=".strtotime($oksj)." where id=".$rowli[id]);
  $tkmoney=$tkmoney+$tkm;
  $num=$num+$rowli[num];
  $i++;
 }

 updatetable("yjcode_order","ddzt='back',tkautosj=".strtotime($oksj).",tkmoney=".$tkmoney." where admin=1 and zuorderbh='".$zuorderbh."'");
 $txt="买家申请了退款：".sqlzhuru1($_POST[t2])."<br>退款金额：".$tkmoney;
 intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$zuorderbh."',".$row[userid].",".$row[selluserid].",1,'".$txt."','".$sj."'");
 
 //通知B
 $sqluser="select id,mot,ifmot,email,ifemail,ordertx1,ordertx2 from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);if(!$rowuser=mysqli_fetch_array($resuser)){Audit_alert("支付密码有误！","ordertk.php?orderbh=".$orderbh);}
 if(!empty($rowuser[mot]) && $rowuser[ifmot]==1 && $rowcontrol[ifmob]=="on" && empty($rowuser[ordertx1])){
 
 
 while3("*","yjcode_smsmb where mybh='005'");
 if($row3=mysqli_fetch_array($res3)){$txt=$row3[txt];}else{$txt="退款通知：有买家进行了退款，商品单价${money1}元，数量${num}，请尽快登录网站处理";}
 if(empty($rowcontrol[smsmode])){
  include("../../config/mobphp/mysendsms.php");
  $str=str_replace("\${money1}",$tkmoney,$txt);
  $str=str_replace("\${num}",$num,$str);
  yjsendsms($rowuser[mot],$str);
 }else{
  if(1==$rowcontrol[smsmode]){$sms_txt="{money1:'".$tkmoney."',num:'".$num."'}";}else{$sms_txt="{\"money1\":\"".$tkmoney."\",\"num\":\"".$num."\"}";}
  $sms_mot=$rowuser[mot];
  $sms_id=$row3[mbid];
  include("../../config/mobphp/mysendsms.php");
 }
 updatetable("yjcode_control","smskc=smskc-1");
 intotable("yjcode_smsmaillog","admin,fa,userid,txt,sj,uip","2,'".$rowuser[mot]."',".$rowuser[id].",'用户退款',".strtotime(getsj()).",'".getuip()."'");
 
 
 }
 if(!empty($rowuser[email]) && $rowuser[ifemail]==1 && !empty($rowcontrol[mailstr]) && $rowcontrol[mailstr]!=",,," && empty($rowuser[ordertx2])){
 require("../../config/mailphp/sendmail.php");
 $str="退款通知：有买家进行了退款，商品单价".$tkmoney."元，数量".$num."，请尽快登录网站处理<hr>该邮件为系统发出，请勿回复<br>".webname." ".weburl;
yjsendmail("退款通知【".webname."】",$rowuser[email],$str,"../");
 }
 //通知E
 php_toheader("orderview.php?zuorderbh=".$zuorderbh); 

}


?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="gourl('order.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">申请退款</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]=="wait" || $row[ddzt]=="db" || $row[ddzt]=="backerr"){?>
 <script language="javascript">
 function tj(){
 if(document.f1.t2.value==""){layerts("请输入您的退款理由");return false;}
 if((document.f1.t1.value).replace("/\s/","")==""){layerts("请输入登录密码");return false;}
 if(!confirm("确认要申请退款吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="ordertk.php?zuorderbh=<?=$zuorderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <?
 $lii=1;
 $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";
 mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
 $tp=returntp("bh='".$rowli[probh]."' order by iffm desc","-2");
 $proid=returnproid($rowli[probh]);
 ?>
 <div class="listcap box"><div class="d2">第<strong><?=$lii?></strong>件退款商品：最多可退<?=$rowli[allmoney3]?>元</div></div>
 <div class="uk box">
  <div class="d1">退款金额<span class="s1"></span></div>
  <div class="d2"><input  name="tk<?=$lii?>" value="<?=$rowli[allmoney3]?>" class="inp" size="10" type="text" /></div>
 </div>
 <? $lii++;}?>
 <div class="listcap box"><div class="d2">请填写退款理由</div></div>
 <div class="orderpj box"><div class="d1"><textarea name="t2"></textarea></div></div>
 <div class="uk box">
 <div class="d1">登录密码<span class="s1"></span></div>
 <div class="d2"><input type="password" name="t1" class="inp" placeholder="请输入登录密码" /></div>
 </div>
 <div class="fbbtn box">
 <div class="d1"><? tjbtnr_m("申请退款")?></div>
 </div>
 <input type="hidden" value="tk" name="yjcode" />
 <input type="hidden" value="<?=$lii?>" name="tknum" />
 </form>
 <div class="tishi box">
 <div class="d1">
 <strong>* 站长提示：</strong><br>
 * <span class="red">申请退款前，请务必先与卖家沟通好，以免引起不必要的纷争</span><br>
 * 申请退款后，如果卖家在<?=$rowcontrol[tksj]?>天内未做出处理，系统将默认同意退款，款项将自动退回您的帐户<br>
 * 卖家也挺不容易，如果是商品存在问题，而卖家又能积极处理问题，您可以<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=returnqq($row[selluserid])?>&site=<?=weburl?>&menu=yes"  class="blue">与卖家再协商下</a>。
 </div>
 </div>
 <? }?>
</body>
</html>