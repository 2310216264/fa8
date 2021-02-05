<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$ses=" where admin=1 and selluserid=".$userid;
$ddzt=$_GET[ddzt];if(!empty($ddzt)){$ses=$ses." and ddzt='".$ddzt."'";}
if($_GET[page]!=""){$page=$_GET[page];}else{$page=1;}
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
<div class="sellordertopfd">
<div class="sellordertop box">
 <div class="d1" onClick="gourl('./')"><img src="../img/leftjian1.png" height="21" /></div>
 <div class="d2">我卖出的商品</div>
 <div class="d3"></div>
</div>
<div class="sellordertop1 box">
 <div class="d1<? if(empty($ddzt)){?> d11<? }?>" onClick="gourl('sellorder.php')">全部</div>
 <div class="d1<? if($ddzt=="wait"){?> d11<? }?>" onClick="gourl('sellorder.php?ddzt=wait')">待发货</div>
 <div class="d1<? if($ddzt=="db"){?> d11<? }?>" onClick="gourl('sellorder.php?ddzt=db')">待收货</div>
 <div class="d1<? if($ddzt=="back"){?> d11<? }?>" onClick="gourl('sellorder.php?ddzt=back')">退款处理</div>
 <div class="d1<? if($ddzt=="jf"){?> d11<? }?>" onClick="gourl('sellorder.php?ddzt=jf')">交易纠纷</div>
</div>
</div>
<div class="sellordertopfdv"></div>

 <!--列表开始-->
 <?
 pagef($ses,10,"yjcode_order","order by sj desc");while($row=mysqli_fetch_array($res)){
 $cz="";
 $au="sellorderview.php?zuorderbh=".$row[zuorderbh];
 $cz="";
 if($row[ddzt]=="suc"){ //交易成功
 
 }elseif($row[ddzt]=="wait"){ //等待发货
 $cz="<a href='fahuo.php?zuorderbh=".$row[zuorderbh]."' class='a1'>发货</a>";
 $cz=$cz."<a href='sellclose.php?zuorderbh=".$row[zuorderbh]."'>取消订单</a>";
 
 }elseif($row[ddzt]=="back"){ //退款处理中
 $cz="<a href='selltk.php?zuorderbh=".$row[zuorderbh]."'>处理退款</a>";
 $cz=$cz."<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";
 
 }elseif($row[ddzt]=="backerr"){ //退款不同意
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";
 
 }elseif($row[ddzt]=="backsuc"){ //退款成功
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";

 }elseif($row[ddzt]=="db"){ //担保中

 }elseif($row1[ddzt]=="wpay"){ //等待买家付款

 }elseif($row[ddzt]=="jf"){ //纠纷处理中 
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";

 }elseif($row[ddzt]=="jfbuy"){ //买家胜诉 
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";

 }elseif($row[ddzt]=="jfsell"){ //卖家胜诉 
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";
  
 }

 $sqlu="select * from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$resu=mysqli_query($conn,$sqlu);$rowu=mysqli_fetch_array($resu);
 ?>
 <div class="sellorderlist box">
  <div class="d1"><img src="img/shop.png" height="15" /></div>
  <div class="d2"><?=$rowu[shopname]?></div>
  <div class="d3 feng"><?=strip_tags(returnorderzt($row[ddzt]))?></div>
 </div>
 
 <?
 $lii=1;
 $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' and selluserid=".$userid." order by id asc";
 mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
 $tp=returntp("bh='".$rowli[probh]."' order by iffm desc","-2");
 ?>
 <div class="sellorderlist1 box" onClick="gourl('<?=$au?>')">
  <div class="d1"><img src="<?=$tp?>" onerror="this.src='../../img/none150x150.gif'" width="70" height="70" /></div>
  <div class="d2"><strong><?=$rowli["tit"]?></strong><br><span class="hui">发货形式：<?=returnfhxs($row[fhxs])?></span><br><? if(!empty($rowli[tcv])){echo "<span class='hui'>套餐：".$rowli[tcv]."</span>";}?></div>
  <div class="d3">￥<?=$rowli[money1]?><br><span class="hui">x<?=$rowli[num]?></span></div>
 </div>
 <? }?>
 
 <div class="sellorderlist2 box">
  <div class="d1">编号 <?=$row[zuorderbh]?><br>时间 <?=$row[sj]?></div>
  <div class="d2">￥<?=$row[allmoney3]?></div>
 </div>
 <div class="sellorderlist4 box">
  <div class="d1">
  <?=$cz?>
  </div>
 </div>
 <? }?>
 <!--列表结束-->
 <div class="npa">
 <?
 $nowurl="sellorder.php";
 $nowwd="ddzt=".$_GET[ddzt];
 require("page.html");
 ?>
 </div>

</body>
</html>