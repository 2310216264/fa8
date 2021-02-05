<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellorder.php");}


if(sqlzhuru($_POST[yjcode])=="tk"){
 zwzr();
 $zfmm=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,zfmm","yjcode_user where zfmm='".$zfmm."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("支付密码有误！","selltk.php?zuorderbh=".$zuorderbh);}
 if($row[ddzt]!="back"){Audit_alert("未知错误！","sellorderview.php?zuorderbh=".$zuorderbh);}

 //同意B
 if(sqlzhuru($_POST[R1])=="yes"){
  $v=returntjuserid($row[userid]);
  $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
   $c_tit="商家同意退款，订单：".$row[zuorderbh];
   PointUpdateM($rowli[userid],$rowli[tkmoney]);
   PointIntoM($rowli[userid],$tkjg,$rowli[tkmoney]);
   updatetable("yjcode_order","ddzt='backsuc',tkclsj='".$sj."' where zuorderbh='".$row[zuorderbh]."'");
   //推荐/平台佣金B
   if($rowli[allmoney3]>$rowli[tkmoney]){
	$sjmoney=$rowli[allmoney3]-$rowli[tkmoney];
    PointUpdateM($rowli[selluserid],$sjmoney);
    PointIntoM($rowli[selluserid],"买家进行了部分的退款，剩余的划入您账号内，订单：".$row[zuorderbh],$sjmoney);
    $ptyj=$sjmoney-returnsellbl($rowli[selluserid],$rowli[probh])*$sjmoney;
	if($ptyj>0){PointUpdateM($rowli[selluserid],$ptyj*(-1));PointIntoM($rowli[selluserid],"扣除平台佣金 ".$ptyj."元，订单：".$row[zuorderbh],$ptyj*(-1));}
    $tjmoney=returntjmoney($rowli[probh]);
    if(!empty($v) && !empty($tjmoney)){
    $tjm=$sjmoney*$tjmoney;
    $nc1=returnnc($rowli[userid]);
    PointUpdateM($v,$tjm);
    PointIntoM($v,"您推荐的买家(".$nc1.")成功交易了".$sjmoney."元，您获得相应佣金",$tjm);
    }
   }
   //推荐/平台佣金E
  }
 //同意E
 //不同意B
 }elseif(sqlzhuru($_POST[R1])=="no"){
  $oksj=date("Y-m-d H:i:s",strtotime("+".$rowcontrol[dbsj]." day"));
  $c_tit="卖家不同意退款";
  updatetable("yjcode_order","tkclsj='".$sj."',tkautosj=".strtotime($oksj).",ddzt='backerr' where zuorderbh='".$zuorderbh."'");
 }
 //不同意E

 $tkjg=$c_tit.",理由：".sqlzhuru($_POST[t2]);
 intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$zuorderbh."',".$row[userid].",".$row[selluserid].",2,'".$tkjg."','".$sj."'");
 
 php_toheader("sellorderview.php?orderbh=".$orderbh); 

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <? include("sellzf.php");?>

 <!--白B-->
 <div class="rkuang">
 
 <? if($row[ddzt]=="back"){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){alert("请输入支付密码");document.f1.t1.focus();return false;}
 if(!confirm("确定提交吗？")){return false;}
 layer.msg('正在处理中，请稍候', {icon: 16  ,time: 0,shade :0.25});
 f1.action="selltk.php?zuorderbh=<?=$zuorderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="ordercz">
 <li class="l1">
 <strong>* 站长提示：</strong><br>
 * 请在 <span class="red"><?=returnsj($row[tkautosj])?></span> 前处理，否则系统默认您接受退款申请，款项会自动退回买家帐户<br>
 * 如果不同意本次退款，请先与买家沟通，以免引起不必要的纷争<br>
 </li>
 <li class="l2">是否同意退款：</li>
 <li class="l3">
 <label class="green"><input name="R1" type="radio" value="yes" checked="checked" /> 同意</label>
 <label class="red"><input name="R1" type="radio" value="no" /> 不同意</label> 
 </li>
 <li class="l2">原因：</li>
 <li class="l3"><input  name="t2" class="inp" size="80" type="text"/></li>
 <li class="l2">请输入您的支付密码：(<a href="zfmm.php" class="red">忘了支付密码？</a>)</li>
 <li class="l3"><input  name="t1" class="inp" size="30" type="password"/></li>
 <li class="l4"><?=tjbtnr("提交")?></li>
 </ul>
 <input type="hidden" value="tk" name="yjcode" />
 </form>
 <? }?>

 <? include("sellorderv.php");?>
 
 <div class="clear clear10"></div>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>