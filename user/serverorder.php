<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$ses=" where ddzt<>99 and userid=".$userid;
if($_GET[ddzt]!=""){$ses=$ses." and ddzt=".intval($_GET[ddzt])."";}
if($_GET[t1v]!=""){$ses=$ses." and tit like '%".$_GET[t1v]."%'";}
if($_GET[t2v]!=""){$ses=$ses." and sj>='".$_GET[t2v]."'";}
if($_GET[t3v]!=""){$ses=$ses." and sj<='".$_GET[t3v]."'";}
if($_GET[t4v]!=""){$ses=$ses." and orderbh='".$_GET[t4v]."'";}
if($_GET[page]!=""){$page=$_GET[page];}else{$page=1;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/adddate.js" ></script> 
<script language="javascript">
function psel(){
 str="t1v="+document.getElementById("t1").value;
 str=str+"&t2v="+document.getElementById("t2").value;
 str=str+"&t3v="+document.getElementById("t3").value;
 str=str+"&t4v="+document.getElementById("t4").value;
 str=str+"&ddzt="+document.getElementById("ddztv").value;
 location.href="serverorder.php?"+str;
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
 <li class="l1 l2"><a href="serverorder.php">我的服务订单</a></li>
 </ul>

 <!--搜索B-->
 <ul class="kssel">
 <li class="l1">订单标题：</li>
 <li class="l2"><input type="text" value="<?=$_GET[t1v]?>" id="t1" style="width:150px;" /></li>
 <li class="l1">订单编号：</li>
 <li class="l2"><input type="text" value="<?=$_GET[t4v]?>" id="t4" style="width:150px;" /></li>
 <li class="l1">交易状态：</li>
 <li class="l2">
 <select id="ddztv">
 <option value="">不限</option>
 <? for($i=1;$i<=13;$i++){?>
 <option value="wait"<? if($_GET[ddzt]==$i){?> selected="selected"<? }?>><?=strip_tags(returnserverorderzt($i))?></option>
 <? }?>
 </select>
 </li>
 <li class="l1">开始时间：</li>
 <li class="l2">
 <input type="text" value="<?=$_GET[t2v]?>" style="width:155px;" id="t2" readonly="readonly" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" />
 </li>
 <li class="l1">结束时间：</li>
 <li class="l2">
 <input type="text" value="<?=$_GET[t3v]?>" style="width:155px;" id="t3"readonly="readonly" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" />
 </li>
 <li class="ltj"><input type="button" onclick="psel()" value="搜索" /> <input type="button" onclick="gourl('order.php')" value="重置" /></li>
 </ul>
 <!--搜索E-->

 <!--白B-->
 <div class="rkuang">

 <ul class="serverordercap">
 <li class="l0"><input name="C2" onclick="xuan()" type="checkbox" /></li>
 <li class="l1">商品名称</li>
 <li class="l2">订单总额</li>
 <li class="l3">数量</li>
 <li class="l4">订单状态</li>
 <li class="l5">操作</li>
 </ul>
 <!--列表开始-->
 <?
 pagef($ses,10,"yjcode_serverorder","order by sj desc");while($row=mysqli_fetch_array($res)){
 $tp=returntp("bh='".$row[serverbh]."' order by xh desc","-1");
 $au="serverorderview.php?orderbh=".$row[orderbh];
 $cz="";
 if($row[ddzt]==1){
 $cz="<a href='serverclose.php?orderbh=".$row[orderbh]."' class='hui'>取消订单</a>";
 
 }elseif($row[ddzt]==2){ //商家已同意，等待买家付款
 $cz="<a href='orderpay.php?orderbh=".$row[orderbh]."' class='btn'>支付费用</a>";
 $cz=$cz."<br><a href='serverclose.php?orderbh=".$row[orderbh]."' class='hui'>取消订单</a>";
 
 }elseif($row[ddzt]==3){ //商家不同意，订单关闭
 
 }elseif($row[ddzt]==4){ //担保制作中
 $cz=$cz."<a href='servertk.php?orderbh=".$row[orderbh]."' class='hui'>申请退款</a>";
 
 }elseif($row[ddzt]==5){ //等待买家验收
 $cz="<a href='serverys.php?orderbh=".$row[orderbh]."' class='btn'>前往验收</a>";
 $cz=$cz."<br><a href='servertk.php?orderbh=".$row[orderbh]."' class='hui'>申请退款</a>";
 
 }elseif($row[ddzt]==6){ //交易成功
 
 }elseif($row[ddzt]==7){ //退款处理中
 $cz="<a href='serverqxtk.php?orderbh=".$row[orderbh]."' class='btn'>取消退款</a>";
 $cz=$cz."<a href='serverorderjf1.php?orderbh=".$row[orderbh]."' class='hui'>沟通记录</a>";

 }elseif($row[ddzt]==8){ //退款成功
 $cz="<a href='serverorderjf1.php?orderbh=".$row[orderbh]."' class='hui'>沟通记录</a>";

 }elseif($row[ddzt]==9){ //退款不同意
 $cz="<a href='serverjf.php?orderbh=".$row[orderbh]."' class='btn'>平台介入</a>";
 $cz=$cz."<a href='serverorderjf1.php?orderbh=".$row[orderbh]."' class='hui'>沟通记录</a>";

 }elseif($row[ddzt]==10){ //平台介入中
 $cz="<a href='serverorderjf1.php?orderbh=".$row[orderbh]."' class='hui'>沟通记录</a>";

 }elseif($row[ddzt]==11){ //卖家胜诉 
  if(panduan("userid,orderbh","yjcode_serverpj where orderbh='".$row[orderbh]."' and userid=".$userid)==0){
  $cz="<a href='serverorderpj.php?orderbh=".$row[orderbh]."' class='btn feng'>评价</a>";
  }else{
  $cz="<a href='serverorderpj.php?orderbh=".$row[orderbh]."' class='blue'>已评价</a><br>";
  }
 $cz=$cz."<a href='serverorderjf1.php?orderbh=".$row[orderbh]."' class='hui'>沟通记录</a>";

 }elseif($row[ddzt]==12){ //买家胜诉 
 $cz="<a href='serverorderjf1.php?orderbh=".$row[orderbh]."' class='hui'>沟通记录</a>";

 }elseif($row[ddzt]==13){ //买家取消订单 
  
 }
 ?>
 <ul class="serverorder1">
 <li class="l1"><? if($row[ddzt]==99){?><input name="C1" id="ck<?=$row[id]?>" type="checkbox" value="<?=$row[id]?>" /><? }?></li>
 <li class="l2"><?=dateYMD($row[sj])?></li>
 <li class="l3">订单编号：<?=$row[orderbh]?></li>
 <li class="l4">商家：<?=returnjiami(returnnc($row[selluserid]))?></li>
 <li class="l5"><a href="javascript:void(0);" onclick="opentangqq('<?=returnqq($row[selluserid])?>')"><img src="../img/qq.png" border="0" /></a></li>
 </ul>
 <ul class="serverorder2">
 <li class="l1"><a href="<?=$au?>"><img class="tp" src="<?=$tp?>" onerror="this.src='img/none60x60.gif'" /></a></li>
 <li class="l2">
 <a title="<?=$row["tit"]?>" href="<?=$au?>" class="a1"><?=returntitdian($row["tit"],102)?></a><br>
 <? if(!empty($row[taocan])){?>套餐：<?=$row[taocan]?><? }?>
 </li>
 <li class="l3"><strong class="feng">￥<?=$row[money3]?></strong><br>单价：<?=$row[money1]?>元<br>附加费：<?=$row[money2]?>元</li>
 <li class="l4"><?=$row[num]?></li>
 <li class="l5"><?=returnserverorderzt($row[ddzt])?><br><a href="<?=$au?>">订单详情</a></li>
 <li class="l6"><?=$cz?></li>
 </ul>
 <? }?>
 <!--列表结束-->
 <div class="npa">
 <?
 $nowurl="serverorder.php";
 $nowwd="ddzt=".$_GET[ddzt]."&t1v=".$_GET[t1v]."&t2v=".$_GET[t2v]."&t3v=".$_GET[t3v]."&t4v=".$_GET[t4];
 require("page.php");
 ?>
 </div>
 
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