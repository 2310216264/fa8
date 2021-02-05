<?
include("../config/conn.php");
include("../config/function.php");
$getstr=$_GET[str];
$id=intval(returnsx("i"));
while0("*","yjcode_server where id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
$serverbh=$row[bh];
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$row[wkey]?>">
<meta name="description" content="<?=$row[wdes]?>">
<title><?=$row[tit]?>评价 - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>
<div class="yjcode">

 <div class="morepj">
   <? 
   if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}
   pagef(" where serverbh='".$serverbh."'",30,"yjcode_serverpj","order by sj desc");while($row=mysqli_fetch_array($res)){
   $usertx="../upload/".$row[userid]."/user.jpg";
   if(!is_file($usertx)){$usertx="../user/img/nonetx.gif";}else{$usertx=$usertx."?id=".rnd_num(1000);} 
   ?>
   <div class="pj pj<?=$row[pjlx]?>">
    <ul class="u1"><li class="l1"><img src="<?=$usertx?>" width="50" height="50" /></li><li class="l2"><?=returnjiami(returnnc($row[userid]))?></li></ul>
    <ul class="u2">
    <li class="l1">
    <?=$row[txt]?><br>
    <? if(1==$row[ifvideo]){?>
    <a href="<?="../upload/".$row[userid]."/".$row[orderbh]."/video.mp4"?>" target="_blank"><img src="../img/video.jpg" width="50" height="50" /></a>&nbsp;&nbsp;
    <? }?>
    <? 
    if(1==$row[iftp]){
    while2("*","yjcode_tp where bh='".$row[orderbh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){$tp="../".str_replace(".","-1.",$row2[tp]);
    ?>
    <a href="../<?=$row2[tp]?>" target="_blank"><img src="<?=$tp?>" width="50" height="50" /></a>&nbsp;&nbsp;
    <? }}?>
    </li>
    <? if(!empty($row[hf])){?><li class="l2">卖家回复：<?=$row[hf]?></li><? }?>
    <li class="l3"><?=$row[sj]?></li>
    </ul>
    <div class="d2">
    <? if(1==$row[pjlx]){?><span class="s1">好评</span><? }?>
    <? if(2==$row[pjlx]){?><span class="s2">中评</span><? }?>
    <? if(3==$row[pjlx]){?><span class="s3">差评</span><? }?>
    </div>
    <div class="d3">
    <img src="../img/x1.png" class="img1" width="76" height="15" />
    <? $pf=round(($row[pf1]+$row[pf2]+$row[pf3])/3,2);?>
    <div class="pf" style="width:<?=$pf/5*76?>px;"><img src="../img/x2.png" title="<?=$pf?>分" width="76" height="15" /></div>
    </div>
   </div>
   <? }?>
 
   <div class="npa">
   <?
   $nowurl="pjlist";
   $nowwd="";
   require("../tem/page.html");
   ?>
   </div>

 </div>

</div>
<? include("../tem/bottom.html");?>
</body>
</html>