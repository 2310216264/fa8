<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$ses=" where admin=1 and userid=".$userid;
if($_GET[ddzt]!=""){$ses=$ses." and ddzt='".$_GET[ddzt]."'";}
if($_GET[t1v]!=""){$ses=$ses." and tit like '%".$_GET[t1v]."%'";}
if($_GET[t2v]!=""){$ses=$ses." and sj>='".$_GET[t2v]."'";}
if($_GET[t3v]!=""){$ses=$ses." and sj<='".$_GET[t3v]."'";}
if($_GET[t4v]!=""){$ses=$ses." and zuorderbh='".$_GET[t4v]."'";}
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
 location.href="order.php?"+str;
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
 <option value="wait"<? if($_GET[ddzt]=="wait"){?> selected="selected"<? }?>>等待发货</option>
 <option value="db"<? if($_GET[ddzt]=="db"){?> selected="selected"<? }?>>等待买家确认</option>
 <option value="suc"<? if($_GET[ddzt]=="suc"){?> selected="selected"<? }?>>交易成功</option>
 <option value="back"<? if($_GET[ddzt]=="back"){?> selected="selected"<? }?>>退款申请中</option>
 <option value="backerr"<? if($_GET[ddzt]=="backerr"){?> selected="selected"<? }?>>不同意的退款</option>
 <option value="backsuc"<? if($_GET[ddzt]=="backsuc"){?> selected="selected"<? }?>>退款成功</option>
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
 
 <ul class="ordercap">
 <li class="l0"><input name="C2" onclick="xuan()" type="checkbox" /></li>
 <li class="l1">商品名称</li>
 <li class="l2">订单总额</li>
 <li class="l3">数量</li>
 <li class="l4">订单状态</li>
 <li class="l5">操作</li>
 </ul>
 <!--列表开始-->
 <?
 pagef($ses,10,"yjcode_order","order by sj desc");while($row=mysqli_fetch_array($res)){
 $au="orderview.php?zuorderbh=".$row[zuorderbh];
 $cz="";
 if($row[ddzt]=="suc"){ //交易成功
  if(empty($row[ifpj])){
  $cz="<a href='orderpj.php?zuorderbh=".$row[zuorderbh]."' class='btn feng'>评价</a>";
  }else{
  $cz="<a href='orderpj.php?zuorderbh=".$row[zuorderbh]."' class='blue'>已评价</a><br>";
  }
 
 }elseif($row[ddzt]=="wait"){ //等待发货
  $cz="<a href='javascript:void(0);' onclick='opentangqq(\"".returnqq($row[selluserid])."\",\"".returnweixin($row[selluserid])."\",".$row[selluserid].")' class='blue'>提醒卖家发货</a>";
  $cz=$cz."<br><a href='ordertk.php?zuorderbh=".$row[zuorderbh]."' class='hui'>退款</a>";
 
 }elseif($row[ddzt]=="back"){ //退款处理中
  $cz="<a href='orderjf1.php?zuorderbh=".$row[zuorderbh]."' class='btn'>沟通</a>";
 
 }elseif($row[ddzt]=="backsuc"){ //退款成功
  $cz=$cz."<a href='orderjf1.php?zuorderbh=".$row[zuorderbh]."' class='btn'>沟通</a>";
 
 }elseif($row[ddzt]=="backerr"){ //退款失败，不同意退款
  $cz="<a href='shouhuo.php?zuorderbh=".$row[zuorderbh]."' class='btn'>收货</a>";
  $cz=$cz."<br><a href='ordertk.php?zuorderbh=".$row[zuorderbh]."' class='blue'>再次申请退款</a>";
  $cz=$cz."<br><a href='orderjf.php?zuorderbh=".$row[zuorderbh]."' class='hui'>申请客服介入</a>";

 }elseif($row[ddzt]=="db"){ //担保中
  $cz="<a href='shouhuo.php?zuorderbh=".$row[zuorderbh]."' class='btn'>收货</a>";
  $cz=$cz."<br><a href='ordertk.php?zuorderbh=".$row[zuorderbh]."' class='hui'>退款</a>";

 }elseif($row[ddzt]=="close"){ //订单取消

 }elseif($row[ddzt]=="jf"){ //纠纷处理中
  $cz="<a href='orderjf1.php?zuorderbh=".$row[zuorderbh]."' class='btn'>沟通</a>";

 }elseif($row[ddzt]=="jfbuy"){ //买家胜诉
  $cz="<a href='orderjf1.php?zuorderbh=".$row[zuorderbh]."' class='btn'>沟通</a>";

 }elseif($row[ddzt]=="jfsell"){ //卖家胜诉
  $cz="<a href='orderjf1.php?zuorderbh=".$row[zuorderbh]."' class='btn'>沟通</a>";
  
 }
 ?>
 <ul class="order1">
 <li class="l1"><? if($row[ddzt]=="wpay"){?><input name="C1" id="ck<?=$row[id]?>" type="checkbox" value="<?=$row[id]?>" /><? }?></li>
 <li class="l2"><?=$row[sj]?></li>
 <li class="l3">订单编号：<?=$row[zuorderbh]?></li>
 <li class="l4">商家：<?=returnshopname($row[selluserid])?></li>
 <li class="l5"><a href="javascript:void(0);" onclick="opentangqq('<?=returnqq($row[selluserid])?>','<?=returnweixin($row[selluserid])?>','<?=$row[selluserid]?>')"><img src="../img/qq.png" border="0" /></a></li>
 </ul>
 <div class="orderlist">
 <?
 $lii=1;
 $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' and userid=".$userid." order by id asc";
 mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
 $tp=returntp("bh='".$rowli[probh]."' order by iffm desc","-2");
 ?>
 <ul class="order2<? if($lii>1){?> order21<? }?>">
 <li class="l1"><a href="<?=$au?>"><img class="tp" src="<?=$tp?>" onerror="this.src='../img/none60x60.gif'" /></a></li>
 <li class="l2">
 <a title="<?=$rowli["tit"]?>" href="<?=$au?>" class="a1"><?=returntitdian($rowli["tit"],50)?></a><br>
 发货形式：<?=returnfhxs($rowli[fhxs])?><br>
 <? if(!empty($rowli[tcv])){?>套餐：<?=$rowli[tcv]?><? }?>
 </li>
 <li class="l3">￥<?=returnjgdian($rowli[money1]*$rowli[num])?></li>
 <li class="l4"><?=$rowli[num]?></li>
 <li class="l5"><? if($lii==1){echo returnorderzt($row[ddzt]);?><br><a href="<?=$au?>">订单详情</a><? }?></li>
 <li class="l6"><? if($lii==1){echo $cz;}?></li>
 </ul>
 <? $lii++;}?>
 </div>
 <? }?>
 <!--列表结束-->
 <div class="npa">
 <?
 $nowurl="order.php";
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