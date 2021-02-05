<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and (ddzt='db' or ddzt='backerr') and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("order.php");}


if(sqlzhuru($_POST[yjcode])=="sh"){
 zwzr();
 $allmoney=$row[allmoney3];
 $jyts="买家确认收货，交易完成，订单：".$row[zuorderbh];
 PointUpdateM($row[selluserid],$allmoney);
 PointIntoM($row[selluserid],$jyts,$allmoney);
 updatetable("yjcode_order","ddzt='suc',oksj='".$sj."' where zuorderbh='".$row[zuorderbh]."'");
 intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$row[zuorderbh]."',".$row[userid].",".$row[selluserid].",1,'".$jyts."','".$sj."'");
 //推荐/平台佣金B
 $v=returntjuserid($row[userid]);
 while2("*","yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc");while($row2=mysqli_fetch_array($res2)){
  $ptyj=$row2[allmoney3]-returnsellbl($row2[selluserid],$row2[probh])*$row2[allmoney3];
  if($ptyj>0){
   PointUpdateM($row2[selluserid],$ptyj*(-1));PointIntoM($row2[selluserid],"扣除平台佣金".$ptyj."元，订单：".$row[zuorderbh],$ptyj*(-1));
  }
  $tjmoney=returntjmoney($row2[probh]);
  if(!empty($v) && !empty($tjmoney)){
  $tjm=$row2[allmoney3]*$tjmoney;
  $nc1=returnnc($row2[userid]);
  PointUpdateM($v,$tjm);
  PointIntoM($v,"您推荐的买家(".$nc1.")成功交易了".$row2[allmoney3]."元，您获得相应佣金",$tjm);
  }
 }
 //推荐/平台佣金E
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
 <div class="d2">收货</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]=="db" || $row[ddzt]=="backerr"){?>
 <script language="javascript">
 function tj(){
 if(!confirm("确定收货吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="shouhuo.php?zuorderbh=<?=$zuorderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("确认收货")?></div>
 </div>
 <input type="hidden" value="sh" name="yjcode" />
 </form>
 <div class="tishi box">
 <div class="d1">
 <strong>* 站长提示：</strong><br>
 * 请先试用好您购买的这个商品，再确认收货<br>
 * 如果商品有问题，与售后方无法达成共识，您可以<a href="ordertk.php?zuorderbh=<?=$zuorderbh?>">申请退款</a>
 </div>
 </div>
 <? }?>

 <? include("orderv.php");?>
</body>
</html>