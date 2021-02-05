<?
include("../config/conn.php");
include("../config/function.php");
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站地图 - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>

<div  class="bfb mapbg">
<div class="yjcode">
 
 <div class="dqwz">
 <ul class="u1">
 您当前的位置：<a href="../">首页</a> <span>>></span> 
 网站地图
 </ul>
 </div>

 <div class="left">
  <div class="aboutmenu">
  <a href="aboutview2.html" rel="nofollow">关于我们<span> ></span></a>
  <a href="aboutview3.html" rel="nofollow">广告合作<span> ></span></a>
  <a href="aboutview4.html" rel="nofollow">联系我们<span> ></span></a>
  <a href="aboutview5.html" rel="nofollow">隐私条款<span> ></span></a>
  <a href="aboutview6.html" rel="nofollow">免责声明<span> ></span></a>
  <a href="map.php" class="a0">网站地图<span> ></span></a>
  </div>
 </div>
 
 <div class="right">
  
  <div class="mapmain">
  
  <div class="dcap">网站导航菜单</div>
  <div class="dtit">
   <a href="<?=weburl?>">网站首页</a>
   <? while1("*","yjcode_ad where adbh='ADI02' and type1='文字' order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
   <a href="<?=$row1[aurl]?>" rel="nofollow" target="_blank"><?=$row1[tit]?></a>
   <? }?>
  </div>
  
  <div class="dcap">网站商品分类</div>
  <? while1("*","yjcode_type where admin=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
  <div class="dlist">
   <div class="d1"><a href="<?=weburl?>product/search_j<?=$row1[id]?>v.html" target="_blank"><?=$row1[type1]?></a>：</div>
   <div class="d2">
   <? while2("*","yjcode_type where type1='".$row1[type1]."' and admin=2 order by xh asc");while($row2=mysqli_fetch_array($res2)){?>
   <a href="<?=weburl?>product/search_j<?=$row1[id]?>v_k<?=$row2[id]?>v.html" target="_blank"><?=$row2[type2]?></a>
   <? }?>
   <a href="<?=weburl?>product/search_j<?=$row1[id]?>v.html" target="_blank">【共 <strong><?=returncount("yjcode_pro where ty1id=".$row1[id]." and zt=0 and ifxj=0")?></strong> 件商品】</a>
   </div>
  </div>
  
  <? 
  $si=0;
  $sbarr=array();
  while2("*","yjcode_typesx where admin=1 and typeid=".$row1[id]." and ifsel=1 order by xh asc");while($row2=mysqli_fetch_array($res2)){
  $ev="e".$row2[id]."_";
  $sbarr[$si]=$ev;
  ?>
  <div class="dlist">
   <div class="d1"><?=$row2[name1]?>：</div>
   <div class="d2">
   <? while3("*","yjcode_typesx where admin=2 and name1='".$row2[name1]."' and typeid=".$row2[typeid]." order by xh asc");while($row3=mysqli_fetch_array($res3)){?>
   <a href="<?=weburl?>product/search_j<?=$row1[id]?>v_<?=$ev.$row3[id]?>v.html" target="_blank"><?=$row3[name2]?></a>
   <? }?>
   </div>
  </div>
  <? $si++;}?>
  
  <div class="xu"></div>
  <? }?>
  
  <div class="dcap">资讯分类栏目</div>
  <div class="dtit">
   <? while1("*","yjcode_newstype where admin=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
   <a href="../news/newslist_j<?=$row1[id]?>v.html" target="_blank"><?=$row1[name1]?></a>
   <? }?>
  </div>
  
  <? if(empty($rowcontrol["iftask"])){?>
  <div class="dcap">任务大厅导航</div>
  <div class="dtit">
   <? while1("*","yjcode_tasktype where admin=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
   <a href="../task/search_j<?=$row1[id]?>v.html" target="_blank"><?=$row1[name1]?></a>
   <? }?>
  </div>
  <? }?>
  

  
  
  </div>
  
 </div>

</div>
</div>

<? include("../tem/bottom.html");?>
</body>
</html>