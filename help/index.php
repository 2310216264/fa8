<?
include("../config/conn.php");
include("../config/function.php");
$getstr=$_GET[str];
$ses=" where id>0 and zt<>99";
if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}
if(returnsx("j")!=-1){$ses=$ses." and ty1id=".returnsx("j");$ty1name=returnhelptype(1,returnsx('j'));$tit=$ty1name;}
if(returnsx("k")!=-1){$ses=$ses." and ty2id=".returnsx("k");$ty2name=returnhelptype(2,returnsx('k'));$tit=$tit." ".$ty2name;}
if(empty($tit)){$tit="帮助中心";}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$tit?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>

<div class="yjcode">

<? include("left.php");?>

<!--列表开始-->
<div class="helpright">
 <div class="wz">
 您当前的位置：<a href="<?=weburl?>">首页</a> <span>>></span> 
 <a href="./" rel="nofollow" >帮助中心</a> <span>>></span> 
 <a href="search_j<?=returnsx("j")?>v.html" rel="nofollow"><?=returnhelptype(1,returnsx("j"))?></a>
 <? if(returnsx("k")!=-1){?><span>>></span> <a rel="nofollow" href="search_j<?=returnsx("j")?>v_h<?=returnsx("k")?>v.html"><?=returnhelptype(2,returnsx("k"))?></a><? }?>
 </div>
 
 <ul class="helplist">
 <?
 pagef($ses,20,"yjcode_help","order by sj desc");
 $i=1;
 while($row=mysqli_fetch_array($res)){
 ?>
 <li class="l1">·<a href="<?=weburl?>help/view<?=$row[id]?>.html" rel="nofollow" class="g_ac0"><?=$row[tit]?></a></li>
 <li class="l2"><?=dateYMD($row[sj])?></li>
 <? if($i % 5==0){?><li class="l3"></li><? }?>
 <? $i++;}?>
 </ul>
 <div class="npa">
 <?
 $nowurl="search";
 $nowwd="";
 require("../tem/page.html");
 ?>
 </div>
</div>
<!--列表结束-->

</div>
<? include("../tem/bottom.html");?>
</body>
</html>