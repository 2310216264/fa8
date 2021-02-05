<?
include("../../config/conn.php");
include("../../config/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no" />
<title>资讯 - 手机版<?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<? $nowpagetit="资讯";$nowpagebk="../";include("../tem/moban/".$rowcontrol[wapmb]."/tem/top.php");?>

<!--图片B-->
<div class="addWrap">
 <div class="swipe" id="mySwipe">
   <div class="swipe-wrap">
   <?
   $i=0;
   while1("*","yjcode_ad where adbh='ADMT06' order by xh asc");while($row1=mysqli_fetch_array($res1)){
   $tp="../../".returnjgdw($rowcontrol[addir],"","gg")."/".$row1[bh].".".$row1[jpggif];
   ?>
   <div><a href="<?=$row1[aurl]?>"><img class="img-responsive" src="<?=$tp?>" /></a></div>
   <? $i++;}?>
   </div>
  </div>
  <ul id="position"><? for($j=0;$j<$i;$j++){?><li class="<? if(0==$j){?>cur<? }?>"></li><? }?></ul>
</div>
<script src="../js/swipe.js"></script> 
<script type="text/javascript">
var bullets = document.getElementById('position').getElementsByTagName('li');
var banner = Swipe(document.getElementById('mySwipe'), {
auto: 2000,
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

<? while0("*","yjcode_news where zt=0 and indextop=1 limit 1");if($row=mysqli_fetch_array($res)){?>
<a href="txtlist_i<?=$row[id]?>v.html">
<div class="indextop box">
 <div class="d1">今日<br>头条</div>
 <div class="d2 flex"><span class="s1 lineone"><?=$row[tit]?></span></div>
</div>
</a>
<? }?>

<div class="listtop box">
 <div class="d1" onClick="gourl('../search/main.php?admin=5')"><span class="s1"><img src="../img/ser.png" /></span><span class="s2">请输入搜索关键词！</span></div>
</div>

<? while1("*","yjcode_newstype where admin=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>

<div class="indexcap box">
 <div class="d1 flex"><?=$row1[name1]?></div>
 <div class="d2" onclick="gourl('newslist_j<?=$row1[id]?>v.html')"><img src="../img/rightjian.png" /></div>
</div>

<? while0("*","yjcode_news where type1id=".$row1[id]." and zt=0 order by lastsj desc limit 5");if($row=mysqli_fetch_array($res)){?>
<a href="txtlist_i<?=$row[id]?>v.html">
<div class="indexlist0 box">
 <div class="d1"><img src="../../<?=returntp(" bh='".$row[bh]."'","-1")?>" onerror="this.src='../../img/none100x75.gif'" /></div>
 <div class="d2 flex">
  <span class="s1 linetwo"><?=$row[tit]?></span>
  <span class="s2"><?=returnnewstype(2,$row[type2id])?></span>
  <span class="s3"><?=dateYMD($row[lastsj])?></span>
 </div>
</div>
<div class="indexlist1 box">
 <div class="d1 flex linethree"><strong>摘要：</strong><?=str_replace("&nbsp;","",strip_tags($row[wdes]))?></div>
</div>
</a>
<? }?>


<? while($row=mysqli_fetch_array($res)){?>
<a href="txtlist_i<?=$row[id]?>v.html">
<div class="indexlist box">
 <div class="d1 flex">
   <span class="s1 linetwo"><?=$row[tit]?></span>
   <span class="s2"><?=returnnewstype(2,$row[type2id])?></span>
   <span class="s3"><?=dateYMD($row[lastsj])?></span>
 </div>
 <div class="d2"><img src="../../<?=returntp(" bh='".$row[bh]."'","-1")?>" onerror="this.src='../../img/none100x75.gif'" /></div>
</div>
</a>
<? }?>

<div class="listxx box"></div>

<? }?>

<? include("../tem/moban/".$rowcontrol[wapmb]."/tem/bottom.php");?>
</body>
</html>