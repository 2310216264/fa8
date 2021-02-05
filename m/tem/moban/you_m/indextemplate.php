<?
include("../../../../config/conn.php");
include("../../../../config/function.php");
$sj=getsj();
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta name="keywords" content="<?=$rowcontrol[webkey]?>">
<meta name="description" content="<?=$rowcontrol[webdes]?>">
<title><?=webname?> - <?=$rowcontrol[webtit]?></title>
<? $cssjsty="b";include("../../../tem/cssjs.html");?>
</head>
<body>

<div class="indextop box">
 <div class="d1"><img src="tem/moban/<?=$rowcontrol[wapmb]?>/homeimg/<?=$rowcontrol[wapmb]?>Img/logo.png" onerror="this.src='img/logo.png'" /></div>
 <div class="d2 flex" onClick="gourl('search/main.php?admin=1')"><span class="s1"><img src="tem/moban/<?=$rowcontrol[wapmb]?>/homeimg/<?=$rowcontrol[wapmb]?>Img/ser.png" /></span><span class="s2">输入搜索内容</span></div>
 <div class="d3" onClick="gourl('user/qiandao.php')"><span>签</span></div>
</div>

<!--图片B-->
<div class="addWrap">
 <div class="swipe" id="mySwipe">
   <div class="swipe-wrap">
   <?
   $i=0;
   while1("*","yjcode_ad where adbh='ADMT01' and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){
   $tp="../".returnjgdw($rowcontrol[addir],"","gg")."/".$row1[bh].".".$row1[jpggif];
   ?>
   <div><a href="<?=$row1[aurl]?>"><img class="img-responsive" src="<?=$tp?>" /></a></div>
   <? $i++;}?>
   </div>
  </div>
  <ul id="position" style="display:none;"><? for($j=0;$j<$i;$j++){?><li class="<? if(0==$j){?>cur<? }?>"></li><? }?></ul>
</div>
<script src="js/swipe.js"></script> 
<script type="text/javascript">
var bullets = document.getElementById('position').getElementsByTagName('li');
var banner = Swipe(document.getElementById('mySwipe'), {
auto: 5000,
continuous: true,
disableScroll:false,
callback: function(pos) {
var i = bullets.length;
while (i--) {
bullets[i].className = ' ';
}
bullets[pos].className = 'cur';
}});
</script>
<!--图片E-->


<!--图标滑屏B-->
<div class="menuhp">

<div class="swiper-container">
 <div class="swiper-wrapper">
  <?
  $anum=returncount("yjcode_ad where adbh='ADMT04' and zt=0");
  if($anum==0){
  ?>
  <div class="swiper-slide">
  <span class="d1"><a href="alltype/"><img src="img/tb5.png" /><br>全部分类</a></span>
  <span class="d1"><a href="user/order.php"><img src="img/tb2.png" /><br>我的订单</a></span>
  <span class="d1"><a href="task/"><img src="img/tb9.png" /><br>任务大厅</a></span>
  <span class="d1"><a href="user/"><img src="img/tb8.png" /><br>个人中心</a></span>
  <span class="d1"><a href="user/favpro.php"><img src="img/tb3.png" /><br>我的收藏</a></span>
  <span class="d1"><a href="news/newslist.html"><img src="img/tb6.png" /><br>行业资讯</a></span>
  <span class="d1"><a href="user/paylog.php"><img src="img/tb4.png" /><br>资金管理</a></span>
  <span class="d1"><a href="user/car.php"><img border="0" src="img/tb1.png" /><br>购物车</a></span>
  <span class="d1"><a href="contact/"><img border="0" src="img/tb7.png" /><br>联系我们</a></span>
  </div>
  <? }else{?>
  <div class="swiper-slide">
  <? $i=1;while1("*","yjcode_ad where adbh='ADMT04' and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
  <span class="d1"><a href="<?=$row1[aurl]?>"><img border="0" src="../<?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh]?>.<?=$row1[jpggif]?>" /><br><?=$row1[tit]?></a></span>
  <? if($i % 10==0 && $anum>10){?></div><div class="swiper-slide"><? }?>
  <? $i++;}?>
  </div>
  <? }?>
 </div>
 <div class="swiper-pagination"<? if($anum<=10){?> style="display:none;"<? }?>></div>
</div>

</div>
<link rel="stylesheet" href="swiper/css/swiper.min.css">
<script src="swiper/js/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper-container', {
pagination: '.swiper-pagination',
paginationClickable: true,
spaceBetween: 30,
});
</script>
<!--图标滑屏E-->

<div class="ggbox box">
<div class="ggnei">
<? adwhile("ADMT07")?>
</div>
</div>

<!--限时B-->
<div class="swiper-container1">
 <div class="swiper-wrapper">
 <? 
 $i=1;
 while1("*","yjcode_pro where zt=0 and ifxj=0 and iftuan=1 and yhxs=2 and yhsj2>'".$sj."' order by yhsj2 asc limit 10");while($row1=mysqli_fetch_array($res1)){
 $money1=returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]);
 $au="product/view".$row1[id].".html";
 $dqsj=str_replace("-","/",$row1[yhsj2]);
 ?>
 <div class="swiper-slide" onClick="gourl('<?=$au?>')">
  <div class="dmain">      
   <span id="dqsj<?=$i?>" style="display:none;"><?=$dqsj?></span>
   <div class="d2"><img src="<?=returntp("bh='".$row1[bh]."' order by xh asc","-1")?>" onerror="this.src='../img/none200x200.gif'" /></div>
   <div class="d3"><span class="djs" id="djs<?=$i?>">正在加载</span></div>
   <div class="d1 linetwo"><span>￥<?=sprintf("%.2f",$money1)?></span> <?=$row1[tit]?></div>
  </div>
 </div>
 <? $i++;}?>
 </div>
 <div class="swiper-pagination1"></div>
</div>
<script>
swiper1 = new Swiper('.swiper-container1', {
slidesPerView: 3,
spaceBetween:5,
freeMode: true,
pagination: {
el: '.swiper-pagination1',
clickable: true,
},
});
userChecksj();
</script>
<!--限时E-->

<div class="ADMYOU01 box">
<div class="dmain flex">
 <? $i=1;while1("*","yjcode_ad where adbh='ADMYOU01' and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
 <div class="d1<? if($i % 2==0){?> d0<? }?><? if($i==1 || $i==2){?> d00<? }?>"><a href="<?=$row1[aurl]?>"><img border="0" src="../<?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh]?>.<?=$row1[jpggif]?>" /></div>
 <? $i++;}?>
</div>
</div>

<div class="cldar" id="ntypeP"></div>
<div class="ntype box" id="ntype">
<div class="dmain">
 <div class="swiper-container" id="swiper1">
  <div class="swiper-wrapper">
   <div class="swiper-slide" style="width:auto;"><a href="javascript:void(0);" onClick="ntypeonc(0)" class="a1" id="ntypecap0">推荐商品</a></div>
   <? $i=1;while1("*","yjcode_type where admin=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
   <div class="swiper-slide" style="width:auto;"><a href="javascript:void(0);" onClick="ntypeonc(<?=$i?>)" id="ntypecap<?=$i?>"><?=$row1[type1]?></a></div>
   <? $i++;}?>
  </div>
 </div>
</div>
</div>
<span id="typeallnum" style="display:none;"><?=$i?></span>

<div class="prolist box" id="prolist0">
<div class="dmain flex">
 <?
 $i=1;
 while1("*","yjcode_pro where zt=0 and ifxj=0 and iftj>0 order by iftj asc limit 10");while($row1=mysqli_fetch_array($res1)){
 $money1=returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]);
 ?>
 <div class="dm" onClick="gourl('product/view<?=$row1[id]?>.html')">
  <div class="d1"><img class="protp" src="<?=returntp("bh='".$row1[bh]."' order by xh asc","-1")?>" onerror="this.src='../img/none200x200.gif'" /></div>
  <div class="d2"><?=returntitdian($row1[tit],50)?></div>
  <div class="d3"><span class="s1">￥<strong><?=sprintf("%.2f",$money1)?></strong></span><span class="s2"><?=$row1[xsnum]?>人付款</span></div>
 </div>
 <? }?>
</div>
</div>

<? $j=1;while0("*","yjcode_type where admin=1 order by xh asc");while($row=mysqli_fetch_array($res)){?>
<div class="prolist box" id="prolist<?=$j?>" style="display:none;">
<div class="dmain flex">
 <?
 $i=1;
 while1("*","yjcode_pro where zt=0 and ifxj=0 and ty1id=".$row[id]." order by lastsj desc limit 10");while($row1=mysqli_fetch_array($res1)){
 $money1=returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]);
 ?>
 <div class="dm" onClick="gourl('product/view<?=$row1[id]?>.html')">
  <div class="d1"><img class="protp" src="<?=returntp("bh='".$row1[bh]."' order by xh asc","-1")?>" onerror="this.src='../img/none200x200.gif'" /></div>
  <div class="d2"><?=returntitdian($row1[tit],50)?></div>
  <div class="d3"><span class="s1">￥<strong><?=sprintf("%.2f",$money1)?></strong></span><span class="s2"><?=$row1[xsnum]?>人付款</span></div>
 </div>
 <? }?>
</div>
</div>
<? $j++;}?>

<script>
var swiper1 = new Swiper('#swiper1',{
        slidesPerView: 'auto',
        paginationClickable: false,
        spaceBetween: 30
});
function ntypeonc(x){
m=document.getElementById("typeallnum").innerHTML;
for(i=0;i<m;i++){
 document.getElementById("ntypecap"+i).className="";
 document.getElementById("prolist"+i).style.display="none";
}
document.getElementById("ntypecap"+x).className="a1";
document.getElementById("prolist"+x).style.display="";
}
var sc=$(document);
var nav=$("#ntype"); //得到导航对象
$(window).scroll(function () {
 if(sc.scrollTop()>=$("#ntypeP").offset().top){
 $("#ntype").addClass("ntype1");
 }else{
 $("#ntype").removeClass("ntype1")
 }
});
</script>

<div class="fwcap box">
 <div class="d1 flex"><div><span></span></div></div>
 <div class="d2"><span class="s1">服务市场</span><span class="s2">Service Market</span></div>
 <div class="d3 flex"><div><span></span></div></div>
</div>
<div class="fwlist box">
 <div class="dmain flex">
 <?
 while1("*","yjcode_server where zt=0 and ifxj=0 order by lastsj desc limit 9");while($row1=mysqli_fetch_array($res1)){
 ?>
 <div class="d1" onClick="gourl('serve/view<?=$row1[id]?>.html')"><img src="<?=returntp("bh='".$row1[bh]."' order by xh asc","-1")?>" onerror="this.src='../img/none200x200.gif'" /><span class="linetwo"><strong>￥<?=$row1[money1]?></strong> <?=$row1[tit]?></span></div>
 <? }?>
 </div>
</div>


<? include("tem/bottom.php");?>

</body>
</html>