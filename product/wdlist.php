<?
include("../config/conn.php");
include("../config/function.php");
$getstr=$_GET[str];
$id=intval(returnsx("i")); 
while0("*","yjcode_pro where zt<>99 and id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$row[tit]?>相关问题 - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<style type="text/css">
body{background-color:#E8E6F0;}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>

<div class="yjcode">
 <div class="dqwz">
 <ul class="u1">
 <li class="l1">
 当前位置：<a href="<?=weburl?>">首页</a> > <a href="search_j<?=$row[ty1id]?>v.html"><?=returntype(1,$row[ty1id])?></a>
 <? if(0!=$row[ty2id]){?> > <a href="search_j<?=$row[ty1id]?>v_k<?=$row[ty2id]?>v.html"><?=returntype(2,$row[ty2id])?></a><? }?>
 <? if(0!=$row[ty3id]){?> > <a href="search_j<?=$row[ty1id]?>v_k<?=$row[ty2id]?>v_m<?=$row[ty3id]?>v.html"><?=returntype(3,$row[ty3id])?></a><? }?>
 > <?=$row[tit]?> 评价
 </li>
 </ul>
 </div>

 <div class="clear clear10"></div>
 <? 
 if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}
 pagef(" where probh='".$row[bh]."' and (hftxt<>'')",20,"yjcode_wenda","order by sj desc");while($row=mysqli_fetch_array($res)){
 $usertx="../upload/".$row[userid]."/user.jpg";
 if(!is_file($usertx)){$usertx="../user/img/nonetx.gif";}else{$usertx=$usertx."?id=".rnd_num(1000);} 
 ?>
 <div class="allwdlist">
  <ul class="u1">
  <li class="l1"><span>问</span></li>
  <li class="l2"><?=$row[txt]?></li>
  <li class="l3"><?=returnjiami(returnnc($row[userid]))?> <?=$row[sj]?></li>
  </ul>
  <? if(!empty($row[hftxt])){?>
  <ul class="u2">
  <li class="l1"><span>答</span></li>
  <li class="l2"><?=$row[hftxt]?></li>
  <li class="l3">商家 <?=$row[hfsj]?></li>
  </ul>
  <? }?>
 </div>
 <? }?>
 <div class="npa">
 <?
 $nowurl="wdlist";
 $nowwd="";
 require("../tem/page.html");
 ?>
 </div>


</div>

<? include("../tem/bottom.html");?>
</body>
</html>