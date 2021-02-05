<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("order.php");}

if(sqlzhuru($_POST[yjcode])=="tk"){
 zwzr();
 $zfmm=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,zfmm","yjcode_user where zfmm='".$zfmm."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("支付密码有误！","ordertk.php?zuorderbh=".$zuorderbh);}
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
 $txt="买家申请了退款：".sqlzhuru1($_POST[content])."<br>退款金额：".$tkmoney;
 intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$zuorderbh."',".$row[userid].",".$row[selluserid].",1,'".$txt."','".$sj."'");
 
 //通知B
 $sqluser="select id,mot,ifmot,email,ifemail,ordertx1,ordertx2 from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);if(!$rowuser=mysqli_fetch_array($resuser)){Audit_alert("支付密码有误！","ordertk.php?orderbh=".$orderbh);}
 if(!empty($rowuser[mot]) && $rowuser[ifmot]==1 && $rowcontrol[ifmob]=="on" && empty($rowuser[ordertx1])){
 
 
 while3("*","yjcode_smsmb where mybh='005'");
 if($row3=mysqli_fetch_array($res3)){$txt=$row3[txt];}else{$txt="退款通知：有买家进行了退款，商品单价${money1}元，数量${num}，请尽快登录网站处理";}
 if(empty($rowcontrol[smsmode])){
  include("../config/mobphp/mysendsms.php");
  $str=str_replace("\${money1}",$tkmoney,$txt);
  $str=str_replace("\${num}",$num,$str);
  yjsendsms($rowuser[mot],$str);
 }else{
  if(1==$rowcontrol[smsmode]){$sms_txt="{money1:'".$tkmoney."',num:'".$num."'}";}else{$sms_txt="{\"money1\":\"".$tkmoney."\",\"num\":\"".$num."\"}";}
  $sms_mot=$rowuser[mot];
  $sms_id=$row3[mbid];
  include("../config/mobphp/mysendsms.php");
 }
 updatetable("yjcode_control","smskc=smskc-1");
 intotable("yjcode_smsmaillog","admin,fa,userid,txt,sj,uip","2,'".$rowuser[mot]."',".$rowuser[id].",'用户退款',".strtotime(getsj()).",'".getuip()."'");
 
 
 }
 if(!empty($rowuser[email]) && $rowuser[ifemail]==1 && !empty($rowcontrol[mailstr]) && $rowcontrol[mailstr]!=",,," && empty($rowuser[ordertx2])){
 require("../config/mailphp/sendmail.php");
 $str="退款通知：有买家进行了退款，商品单价".$tkmoney."元，数量".$num."，请尽快登录网站处理<hr>该邮件为系统发出，请勿回复<br>".webname." ".weburl;
yjsendmail("退款通知【".webname."】",$rowuser[email],$str);
 }
 //通知E
 php_toheader("orderview.php?zuorderbh=".$zuorderbh); 

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../config/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../config/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" src="../config/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <!--白B-->
 <div class="rkuang">
 
 <? if($row[ddzt]=="wait" || $row[ddzt]=="db" || $row[ddzt]=="backerr"){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){layer.alert('请输入支付密码', {icon:5});return false;}
 if(!confirm("确定要申请退款吗？")){return false;}
 layer.msg('正在处理中，请稍候', {icon: 16  ,time: 0,shade :0.25});
 f1.action="ordertk.php?zuorderbh=<?=$zuorderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="ordercz">
 <li class="l1">
 <strong>* 站长提示：</strong><br>
 * <span class="red">申请退款前，请务必先与卖家沟通好，以免引起不必要的纷争</span><br>
 * 申请退款后，如果卖家在<?=$rowcontrol[tksj]?>天内未做出处理，系统将默认同意退款，款项将自动退回您的帐户<br>
 * 卖家也挺不容易，如果是商品存在问题，而卖家又能积极处理问题，您可以<a href="http://wpa.qq.com/msgrd?v=3&uin=<?=returnqq($row[selluserid])?>&site=<?=weburl?>&menu=yes" target=_blank class="blue">与卖家再协商下</a>。
 </li>
 <?
 $lii=1;
 $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";
 mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
 $tp=returntp("bh='".$rowli[probh]."' order by iffm desc","-2");
 $proid=returnproid($rowli[probh]);
 ?>
 <li class="l2">第<strong><?=$lii?></strong>件商品退款金额：</li>
 <li class="l3"><input  name="tk<?=$lii?>" value="<?=$rowli[allmoney3]?>" class="inp" size="10" type="text" /> 元</li>
 <? $lii++;}?>
 <li class="l2">请输入您的退款理由：</li>
 <li class="l3"><script id="editor" name="content" type="text/plain" style="width:856px;height:150px;"></script></li>
 <li class="l2">请输入您的支付密码：(<a href="zfmm.php" class="red">忘了支付密码？</a>)</li>
 <li class="l3"><input  name="t1" class="inp" size="30" type="password"/></li>
 <li class="l4"><?=tjbtnr("申请退款")?></li>
 </ul>
 <input type="hidden" value="tk" name="yjcode" />
 <input type="hidden" value="<?=$lii?>" name="tknum" />
 </form>
 <? }?>

 <? include("orderv.php");?>
 <div class="clear clear10"></div>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<script language="javascript">
//实例化编辑器
var ue= UE.getEditor('editor'
, {
            toolbars:[
            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'removeformat', 'formatmatch' ,'|', 'forecolor',
                 'fontsize', '|',
                'link', 'unlink',
                'insertimage', 'emotion', 'attachment']
        ]
        });
</script>
<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>