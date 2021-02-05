<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$ses=" where ddzt<>99 and selluserid=".$userid;
if($_GET[ddzt]!=""){$ses=$ses." and ddzt=".intval($_GET[ddzt])."";}
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

<link rel="stylesheet" href="../swiper/css/swiper.min.css">
<script src="../swiper/js/swiper.min.js"></script>

</head>
<body>
<div class="sellordertopfd">
<div class="sellordertop box">
 <div class="d1" onClick="gourl('sell.php')"><img src="../img/leftjian1.png" height="21" /></div>
 <div class="d2">我提供的服务</div>
 <div class="d3"></div>
</div>

<div class="ddztcap box">
<div class="dmain flex">
 <div class="swiper-container" id="swiper1">
  <div class="swiper-wrapper">
   <div class="swiper-slide"><a href="sellserverorder.php" class="<? if($_GET[ddzt]==""){?> a1<? }?>">所有订单</a></div>
   <? for($i=1;$i<=13;$i++){?>
   <div class="swiper-slide"><a href="sellserverorder.php?ddzt=<?=$i?>" class="<? if($_GET[ddzt]==$i){?> a1<? }?>"><?=strip_tags(returnserverorderzt($i))?></a></div>
   <? }?>
  </div>
 </div>
</div>
<script>
var swiper1 = new Swiper('#swiper1',{
slidesPerView: 'auto',
paginationClickable: false,
spaceBetween:10
});
</script>
</div>

</div>
<div class="sellordertopfdv"></div>

<? include("topuser.php");?>

 <!--列表开始-->
 <?
 pagef($ses,10,"yjcode_serverorder","order by sj desc");while($row=mysqli_fetch_array($res)){
 $au="sellserverorderview.php?orderbh=".$row[orderbh];
 $tp=returntp("bh='".$row[serverbh]."' order by xh asc","-1");
 $cz="";
 if($row[ddzt]==1){
 $cz="<a href='queren.php?orderbh=".$row[orderbh]."' class='a1'>确认</a>";
 $cz=$cz."<a href='sellserverclose.php?orderbh=".$row[orderbh]."'>取消订单</a>";
 
 }elseif($row[ddzt]==2){ //商家已同意，等待买家付款
 $cz="<a href='sellserverclose.php?orderbh=".$row[orderbh]."'>取消订单</a>";
 
 }elseif($row[ddzt]==3){ //商家不同意，订单关闭
 
 }elseif($row[ddzt]==4){ //担保制作中
 $cz="<a href='yanshou.php?orderbh=".$row[orderbh]."' class='a1'>提交验收</a>";
 
 }elseif($row[ddzt]==5){ //等待买家验收
 
 }elseif($row[ddzt]==6){ //交易成功
 
 }elseif($row[ddzt]==7){ //退款处理中
 $cz="<a href='sellservertk.php?orderbh=".$row[orderbh]."' class='a1'>处理退款</a>";
 $cz=$cz."<a href='serverorderjf2.php?orderbh=".$row[orderbh]."'>沟通</a>";

 }elseif($row[ddzt]==8){ //退款成功
 $cz="<a href='serverorderjf2.php?orderbh=".$row[orderbh]."'>沟通</a>";

 }elseif($row[ddzt]==9){ //退款不同意
 $cz="<a href='sellservertk.php?orderbh=".$row[orderbh]."' class='a1'>处理退款</a>";
 $cz=$cz."<a href='serverorderjf2.php?orderbh=".$row[orderbh]."'>沟通</a>";

 }elseif($row[ddzt]==10){ //平台介入中
 $cz="<a href='serverorderjf2.php?orderbh=".$row[orderbh]."'>沟通</a>";

 }elseif($row[ddzt]==11){ //卖家胜诉 
 $cz="<a href='serverorderjf2.php?orderbh=".$row[orderbh]."'>沟通</a>";

 }elseif($row[ddzt]==12){ //买家胜诉 
 $cz="<a href='serverorderjf2.php?orderbh=".$row[orderbh]."'>沟通</a>";

 }elseif($row[ddzt]==13){ //买家取消订单 
  
 }

 $sqlu="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$resu=mysqli_query($conn,$sqlu);$rowu=mysqli_fetch_array($resu);
 ?>
 <div class="sellserverorderlist box">
  <div class="d1"><img src="../../upload/<?=$rowu[id]?>/user.jpg" height="15" /></div>
  <div class="d2" onclick="qqtang('<?=$rowu[uqq]?>','<?=$rowu[weixin]?>',<?=$rowu[id]?>)"><?=$rowu[nc]?></div>
  <div class="d3 feng"><?=strip_tags(returnserverorderzt($row[ddzt]))?></div>
 </div>
 
 <div class="sellserverorderlist1 box" onClick="gourl('<?=$au?>')">
  <div class="d1"><img src="<?=$tp?>" onerror="this.src='../../img/none150x150.gif'" height="70" /></div>
  <div class="d2"><strong><?=$row["tit"]?></strong><br><br><? if(!empty($row[taocan])){echo "<span class='hui'>套餐：".$row[taocan]."</span>";}?></div>
  <div class="d3">￥<?=$row[money1]?><br><span class="hui">x<?=$row[num]?></span><br><span class="hui">调价<?=$row[money2]?>元</span></div>
 </div>
 
 <div class="sellserverorderlist2 box">
  <div class="d1">编号 <?=$row[orderbh]?><br>时间 <?=$row[sj]?></div>
  <div class="d2">￥<?=$row[money3]?></div>
 </div>
 <div class="sellserverorderlist4 box">
  <div class="d1">
  <?=$cz?>
  </div>
 </div>
 <? }?>
 <!--列表结束-->
 <div class="npa">
 <?
 $nowurl="sellserverorder.php";
 $nowwd="ddzt=".$_GET[ddzt];
 require("page.html");
 ?>
 </div>

</body>
</html>