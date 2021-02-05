<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$getstr=$_GET[str];
$tit="商家风采";
$ses=" where zt=1 and shopzt=2 and shopname<>''";
if(returnsx("s")!=-1){$skey=safeEncoding(returnsx("s"));$ses=$ses." and shopname like '%".$skey."%'";$tit=$tit." ".$skey;}
if(returnsx("q")!=-1){$ses=$ses." and uqq='".returnsx("q")."'";}
if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}
$px="order by yxsj desc";
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$tit?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<style type="text/css">
body{background-color:#F7F9FC;}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>
<script language="javascript">topjconc(2,'店铺');document.getElementById("topt").value="<?=$skey?>";</script>

<div class="yjcode fontyh">

<? adwhile("ADSHOP03");?>

<? if($page==1 && $skey==""){?>
<!--推荐B-->
<div class="tuijian">
 <? 
 $i=1;
 while1("*","yjcode_user where zt=1 and shopzt=2 and pm>0 order by pm asc limit 3");while($row1=mysqli_fetch_array($res1)){
 $au=returnmyweb($row1[id],$row1[myweb]);
 $sucnum=returnjgdw($row1[xinyong],"",returnxy($row1[id],1));
 ?>
 <div class="dlist dlist<?=$i?>">
  <div class="d1"><a href="<?=$au?>" target="_blank"><img border="0" src="<?="../upload/".$row1[id]."/shop.jpg"?>" onerror="this.src='../img/none180x180.gif'" width="120" height="120" /></a></div>
  <ul class="u1">
  <li class="l1"><span class="s0"><?=returnshoptype($row1[shoptype])?></span><a href="<?=$au?>" target="_blank"><?=$row1[shopname]?></a></li>
  <li class="l2"><img src="../img/dj/<?=returnxytp($sucnum)?>" title="信用值<?=$sucnum?>" /></li>
  <li class="l3">宝贝数量：<?=returncount("yjcode_pro where zt=0 and ifxj=0 and userid=".$row1[id])?>件</li>
  <li class="l4"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$row1[uqq]?>&site=<?=weburl?>&menu=yes" target="_blank">快速沟通</a><a href="view<?=$row1[id]?>.html" target="_blank">进入店铺</a></li>
  </ul>
  <div class="d2">
  服务:
  <? while2("*","yjcode_protype where zt=0 and admin=1 and userid=".$row1[id]." order by xh asc limit 4");while($row2=mysqli_fetch_array($res2)){?>
  <a href="prolist_i<?=$row1[id]?>v_j<?=$row2[id]?>v.html" target="_blank"><?=$row2[name1]?></a>&nbsp;
  <? }?> 
  </div>
  <div class="d3">
  <?
  while2("*","yjcode_pro where userid=".$row1[id]." and zt=0 and ifxj=0 order by lastsj desc limit 4");while($row2=mysqli_fetch_array($res2)){
  $au="../product/view".$row2[id].".html";
  $tp=returntp("bh='".$row2[bh]."' order by iffm desc","-2");
  ?>
  <a href="<?=$au?>" target="_blank" title="<?=$row2[tit]?>"><img src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'" width="70" height="70" border="0" /></a>
  <? }?>
  </div>
 </div>
 <? $i++;}?>
 <? if($i<4 && $i>1){$j=4-$i;}elseif($i>4 && $i<7){$j=7-$i;}for($m=1;$m<=$j;$m++){?>
 <div class="xuwei"><a href="../help/aboutview4.html" target="_blank">虚位以待</a></div>
 <? }?>
</div>
<!--推荐E-->
<? }?>

<? adwhile("ADSHOP02");?>

<!--左B-->
<div class="sleft">
 <?
 pagef($ses,10,"yjcode_user",$px);while($row=mysqli_fetch_array($res)){
 $au="view".$row[id].".html";
 $sucnum=returnjgdw($row[xinyong],"",returnxy($row[id],1));
 $mspf=returnjgdw(returnjgdian($row[pf1]),"","5.00");
 $fhpf=returnjgdw(returnjgdian($row[pf2]),"","5.00");
 $shpf=returnjgdw(returnjgdian($row[pf3]),"","5.00");
 ?>
<div class="list">

 <div class="d1">
 描述：<span><?=$mspf?></span>分 | 发货：<span><?=$fhpf?></span>分 | 服务：<span><?=$shpf?></span>分 | 综合：<span><?=$shpf?></span>分
 </div>
 <div class="tx"><span><a href="<?=$au?>" target="_blank"><img src="<?="../upload/".$row[id]."/shop.jpg"?>" onerror="this.src='../img/none180x180.gif'" /></a></span></div>
 <ul class="u1">
 <li class="l1"><a href="<?=$au?>" target="_blank"><?=$row[shopname]?></a></li>
 <li class="l2">宝贝<strong><?=returncount("yjcode_pro where zt=0 and ifxj=0 and userid=".$row[id])?></strong>个</li>
 <li class="l3">
 <? while2("*","yjcode_protype where zt=0 and admin=1 and userid=".$row[id]." order by xh asc limit 4");while($row2=mysqli_fetch_array($res2)){?>
 <a href="prolist_i<?=$row[id]?>v_j<?=$row2[id]?>v.html" target="_blank"><?=$row2[name1]?></a>
 <? }?> 
 </li>
 </ul>
 <div class="d2"><span class="lineone"><?=returnjgdw($row[seodes],"","这家伙很懒，没写说明")?></span></div>
 <div class="d3"><span><?=returnarea($row[areaid1])." ".returnarea($row[areaid2])?></span></div>
 <div class="d4"><span>更新：<? $sjc=DateDiff($sj,$row[yxsj],"i");if($sjc<=60){echo intval($sjc+1)."分钟前";}else{echo dateYMD($row[yxsj]);}?></span></div>
 
</div>
 <? }?>
 <div class="npa">
 <?
 $nowurl="search";
 $nowwd="";
 require("../tem/page.html");
 ?>
 </div>
</div>
<!--左E-->

<!--右B-->
<div class="sright">
 <? adwhile("ADS01",0,280,0)?>
 
 <div class="remeqy">
  <ul class="u1">
  <li class="l1">热门店铺推荐</li>
  <li class="l2"><a href="../help/aboutview4.html" target="_blank">我也要出现在这里</a></li>
  </ul>
  <? 
  $bi=1;
  while1("*","yjcode_user where zt=1 and shopzt=2 and pm>0 order by pm asc limit 5");while($row1=mysqli_fetch_array($res1)){
  $au=returnmyweb($row1[id],$row1[myweb]);
  ?>
  <div class="rmqy rmqy<?=$bi?>">
   <div class="d1"><span class="s<?=$bi?>"></span></div>
   <ul class="nu1">
   <li class="l1"><a href="<?=$au?>" target="_blank" title="<?=$row1[shopname]?>"><img alt="<?=$row1[shopname]?>" src="<?="../upload/".$row1[id]."/shop.jpg"?>" onerror="this.src='../img/none180x180.gif'" /></a></li>
   <li class="l2">
   <a href="<?=$au?>" target="_blank" title="<?=$row1[shopname]?>" class="a1"><?=$row1[shopname]?></a>
   <? while2("*","yjcode_protype where zt=0 and admin=1 and userid=".$row1[id]." order by xh asc limit 2");while($row2=mysqli_fetch_array($res2)){?>
   <a href="prolist_i<?=$row1[id]?>v_j<?=$row2[id]?>v.html" class="a2" title="<?=$row2[name1]?>" target="_blank"><?=$row2[name1]?></a> / 
   <? }?> 
   </li>
   <li class="l3">
   <span>描述<?=returnjgdw(returnjgdian($row1[pf1]),"","5.00")?></span>
   <span>发货<?=returnjgdw(returnjgdian($row1[pf2]),"","5.00")?></span>
   <span>服务<?=returnjgdw(returnjgdian($row1[pf3]),"","5.00")?></span>
   </li>
   </ul>
  </div>
  <? $bi++;}?>
 </div>
 
</div>
<!--右E-->

<div class="clear clear10"></div>

</div>
<? include("../tem/bottom.html");?>
</body>
</html>