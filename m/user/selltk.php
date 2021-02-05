<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellorder.php");}


if(sqlzhuru($_POST[yjcode])=="tk"){
 zwzr();
 $pwd=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,pwd","yjcode_user where pwd='".$pwd."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("登录密码有误！","selltk.php?zuorderbh=".$zuorderbh);}
 if($row[ddzt]!="back"){Audit_alert("未知错误！","sellorderview.php?zuorderbh=".$zuorderbh);}

 //同意B
 if(sqlzhuru($_POST[R1])=="yes"){
  $v=returntjuserid($row[userid]);
  $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
   $c_tit="商家同意退款，订单：".$row[zuorderbh];
   PointUpdateM($rowli[userid],$rowli[tkmoney]);
   PointIntoM($rowli[userid],$c_tit,$rowli[tkmoney]);
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
 
 php_toheader("sellorderview.php?zuorderbh=".$zuorderbh); 

}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="gourl('sellorder.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">处理退款</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]=="back"){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){layerts("请输入登录密码");return false;}
 if(!confirm("确定提交吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="selltk.php?zuorderbh=<?=$zuorderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <div class="tishi box">
 <div class="d1">
 <strong>站长提示：</strong><br>
 请在 <span class="red"><?=returnsj($row[tkautosj])?></span> 前处理，否则系统默认您接受退款申请，款项会自动退回买家帐户<br>
 如果不同意本次退款，请先与买家沟通，以免引起不必要的纷争<br>
 </div>
 </div>
 <div class="uk box">
  <div class="d1">退款金额<span class="s1"></span></div>
  <div class="d21"><?=$row[tkmoney]?>元</div>
 </div>
 <div class="uk box">
  <div class="d1">是否同意<span class="s1"></span></div>
  <div class="d2">
  <select name="R1" style="font-size:14px;">
  <option value="yes">同意</option>
  <option value="no">不同意</option>
  </select>
  </div>
  <div class="d3"><img src="../img/rightjian.png" height="13" /></div>
 </div>
 <div class="listcap box"><div class="d2">请填写原因：</div></div>
 <div class="sellordertk box"><div class="d1"><textarea name="t2"></textarea></div></div>
 <div class="uk box">
  <div class="d1">登录密码<span class="s1"></span></div>
  <div class="d2"><input type="password" name="t1" class="inp" placeholder="请输入登录密码" /></div>
 </div>
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("提交")?></div>
 </div>
 <input type="hidden" value="tk" name="yjcode" />
 </form>
 <? }?>
 
 <? include("sellorderv.php");?>

</body>
</html>