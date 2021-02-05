<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();

$sj=date("Y-m-d H:i:s");
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}


$userdj=returnuserdj($rowuser[id]);

$nowdj=0;
if(empty($userdj)){Audit_alert("本站未启用会员等级系统，请联系客服！","./");}

if($_GET[control]=="xf"){ //续费
while1("*","yjcode_userdj where name1='".$userdj."'");if($row1=mysqli_fetch_array($res1)){
if($rowuser[money1]<$row1[money1]){Audit_alert("余额不足，请先充值！","userdj.php");}
$money1=$row1["money1"]*(-1);
PointUpdateM($rowuser[id],$money1); 
PointIntoM($rowuser[id],$row1[name1]."会员等级费用支出(续费)",$money1);

if($row1[jgdw]!=9){
if(empty($rowuser[userdjdq])){$dq=$sj;}else{
$sjv=$rowuser[userdjdq];
if($rowuser[userdjdq]<$sj){$sjv=$sj;}
if(empty($row1[jgdw])){$ds="month";}else{$ds="year";}
$dq=date('Y-m-d H:i:s',strtotime ("+1 ".$ds,strtotime($sjv)));
}
}else{
$dq="2099-12-30 00:00:00";
}

updatetable("yjcode_user","userdjdq='".$dq."' where id=".$rowuser[id]);
}
php_toheader("userdj.php?t=suc");

}elseif($_GET[control]=="ts"){ //提升等级
while2("*","yjcode_userdj where name1='".$userdj."'");$row2=mysqli_fetch_array($res2);
while1("*","yjcode_userdj where id=".intval($_GET[id]));if($row1=mysqli_fetch_array($res1)){
if($row1[jgdw]!=9){
if(empty($row2[jgdw])){$nt=$row2[money1]/30;}else{$nt=$row2[money1]/365;}
if(empty($row1[jgdw])){$st=$row1[money1]/30;$ds="month";}else{$st=$row1[money1]/365;$ds="year";}
if(empty($rowuser[userdjdq]) || $rowuser[userdjdq]<$sj){$dq=date('Y-m-d H:i:s',strtotime ("+1 ".$ds,strtotime($sj)));}else{$dq=$rowuser[userdjdq];}
$sjc=DateDiff($dq,$sj,"d");
$djcj=$st-$nt;
$cj=$djcj*$sjc;
if(empty($row1[jgdw])){$ts="month";}else{$ts="year";}
}elseif($row1[jgdw]==9){
$cj=$row1[money1]-$row2[money1];
$dq="2099-12-30 00:00:00";
}

$cj=sprintf("%.2f",$cj);
if($rowuser[money1]<$cj){Audit_alert("余额不足，请先充值！","userdj.php");}
$money1=$cj*(-1);
PointUpdateM($rowuser[id],$money1); 
PointIntoM($rowuser[id],"会员等级提升",$money1);
updatetable("yjcode_user","userdj='".$row1[name1]."',userdjdq='".$dq."' where id=".$rowuser[id]);
}
php_toheader("userdj.php?t=suc");

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/inf.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function tj(x,y){
if(confirm("确定提交吗？")){}else{return false;}
layer.msg('正在处理数据，请稍候', {icon: 16  ,time: 0,shade :0.25});
location.href="userdj.php?id="+y+"&control="+x;
}
</script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">

<ul class="wz">
<li class="l1 l2"><a href="userdj.php">会员等级</a></li>
</ul>

<!--白B-->
<div class="rkuang">

<? systs("恭喜您，操作成功!","userdj.php")?>
<ul class="uk">
<li class="l1">您的等级：</li>
<li class="l21"><strong class="green"><?=$userdj?></strong> (到期：<?=returndqsj($rowuser[userdjdq])?>)</li>
<li class="l1">您的余额：</li>
<li class="l21"><?=sprintf("%.2f",$rowuser[money1])?>元  [<a href="pay.php" class="red"><strong>充值</strong></a>]</li>
</ul>

<ul class="djcap">
<li class="l1">会员等级</li>
<li class="l2">尊享服务</li>
<li class="l3">续费费用 </li>
<li class="l4">操作</li>
</ul>


<? 
while2("*","yjcode_userdj where name1='".$userdj."'");if($row2=mysqli_fetch_array($res2)){$nowdj=$row2[xh];}
$dq=$rowuser[userdjdq];
while1("*","yjcode_userdj where zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){
?>
<ul class="djlist">
<li class="l1"><?=$row1[name1]?></li>
<li class="l2">购买会员商品享<strong><?=$row1[zhekou]?></strong>折</li>
<li class="l3"><?=$row1[money1]?>元/<? if(empty($row1[jgdw])){echo "月";}elseif(1==$row1[jgdw]){echo "年";}elseif(9==$row1[jgdw]){echo "终身";}?> </li>
<li class="l4">
<? if($nowdj<$row1[xh]){?>
<a href="javascript:void(0);" onclick="tj('ts',<?=$row1[id]?>)" class="a0">提升等级</a>

<? }elseif($nowdj==$row1[id] && $row1[jgdw]!=9){?>
<? if($row2[id]!=1){?>
<a href="javascript:void(0);" onclick="tj('xf',<?=$row1[id]?>)" class="a1">续费</a>
<? }?>
<? }?>
</li>
</ul>
<? }?>

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