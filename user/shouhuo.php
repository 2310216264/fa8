<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and (ddzt='db' or ddzt='backerr') and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("order.php");}

if(sqlzhuru($_POST[yjcode])=="sh"){
zwzr();
$zfmm=sha1(sqlzhuru($_POST[t1]));
if(panduan("uid,zfmm","yjcode_user where zfmm='".$zfmm."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("支付密码有误！","shouhuo.php?zuorderbh=".$zuorderbh);}
$allmoney=$row[allmoney3];
$jyts="买家确认收货，交易完成，订单：".$row[zuorderbh];
PointUpdateM($row[selluserid],$allmoney);
PointIntoM($row[selluserid],$jyts,$allmoney);

$e_prices=sprintf("%.2f",$allmoney);
updatetable("yjcode_user","sellmyue=sellmyue+(".$e_prices.") where id=".intval($row[selluserid]));

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">

<ul class="wz">
<li class="l1 l2"><a href="javascript:void(0);">订单详情</a></li>
<li class="l1"><a href="order.php">我的订单</a></li>
</ul>

<!--白B-->
<div class="rkuang">

<? if($row[ddzt]=="db" || $row[ddzt]=="backerr"){?>
<script language="javascript">
function tj(){
if((document.f1.t1.value).replace("/\s/","")==""){layer.alert('请输入支付密码', {icon:5});return false;}
layer.msg('正在操作', {icon: 16  ,time: 0,shade :0.25});
f1.action="shouhuo.php?zuorderbh=<?=$zuorderbh?>";
}
</script>
<form name="f1" method="post" onsubmit="return tj()">
<ul class="ordercz">
<li class="l1"><strong>确认收货</strong></li>
<li class="l2">请输入您的支付密码：(<a href="zfmm.php" class="red">忘了支付密码？</a>)</li>
<li class="l3"><input  name="t1" class="inp" size="30" type="password"/></li>
<li class="l4"><?=tjbtnr("确认收货")?></li>
</ul>
<input type="hidden" value="sh" name="yjcode" />
</form>
<? }?>

<? include("orderv.php");?>

<div class="clear clear15"></div>

</div>
<!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>