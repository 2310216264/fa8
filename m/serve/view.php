<?
include("../../config/conn.php");
include("../../config/function.php");
include("../../config/xy.php");
$id=intval($_GET[id]);
checkdjl("c4",$id,"yjcode_server");
while0("*","yjcode_server where zt<>99 and id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}

$sqlsell="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);
if(!$rowsell=mysqli_fetch_array($ressell)){php_toheader("../");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta name="keywords" content="<?=$seokey?>">
<meta name="description" content="<?=$seodes?>">
<title><?=$row[tit]?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="view.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? 
$wxfxtit=$row[tit];
$wxfxurl=weburl."m/serve/view".$id.".html";
$wxfxtp=returntp("bh='".$row[bh]."' order by xh asc","-1");
$wxfxdes=$row[wdes];
include("../../tem/wxfx.php");
?>

<!--头部B-->
<? $nowpagetit="服务详情";include("../tem/moban/".$rowcontrol[wapmb]."/tem/top.php");?>
<!--头部E-->

<!--图片B-->
<div class="qh">
<div class="addWrap">
 <div class="swipe" id="mySwipe">
   <div class="swipe-wrap">
   <?
   $i=0;
   while1("*","yjcode_tp where bh='".$row[bh]."' order by xh asc limit 5");while($row1=mysqli_fetch_array($res1)){
   ?>
   <div><a href="#"><img class="img-responsive" src="<?=returnnotp($row1[tp],"-1")?>" onerror="this.src='../../img/none300x300.gif'" /></a></div>
   <? $i++;}?>
   <? if($i==0){?><div><a href="#"><img class="img-responsive" src="../../img/none300x300.gif" /></a></div><? $i=1;}?>
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
</div>
<!--图片E-->

<div class="tit box"><div class="d1"><?=$row[tit]?></div></div>
<? if(!empty($row[wdes])){?>
<div class="wdes box"><div class="d1"><?=$row[wdes]?></div></div>
<? }?>

<div class="money box">
 <div class="d1">￥<span id="nowmoney"><?=$row[money1]?></span></div>
 <div class="d2">关注<?=$row[djl]?>人次</div>
</div>

<? if(!empty($row[txt])){?>
<div class="titcap box">
 <div class="d1 flex"><div><span></span></div></div>
 <div class="d2"><span class="s1">服务详情</span><span class="s2">SERVICE DETAILS</span></div>
 <div class="d3 flex"><div><span></span></div></div>
</div>
<div class="protxt box">
 <div class="protxtM"><?=$row[txt]?></div>
</div>
<? }?>

<? 
while1("*","yjcode_onecontrol where tyid=10");if($row1=mysqli_fetch_array($res1)){$lc=$row1[txt];}
if(!empty($lc)){
?>
<div class="titcap box">
 <div class="d1 flex"><div><span></span></div></div>
 <div class="d2"><span class="s1">交易流程</span><span class="s2">PROCESS</span></div>
 <div class="d3 flex"><div><span></span></div></div>
</div>
<div class="protxt box">
 <div class="protxtM"><?=$lc?></div>
</div>
<? }?>


<!--购买B-->
<div class="buym"></div>
<div class="buy box">
 <div class="d1"><a href="../shop/view<?=$row[userid]?>.html"><img src="img/shopv.png" height="23" /><br>店铺</a></div>
 <? if(!empty($rowsell[uqq])){?>
 <div class="d1"><a href="javascript:void(0);" onClick="qqtang('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)"><img src="../img/kefu.png" height="23" /><br>客服</a></div>
 <? }?>
 <div class="d4" onClick="buyserve('<?=$row[bh]?>')">立即购买</div>
</div>
<!--购买E-->

<div style="display:none;"><?=$rowcontrol[webtj]?></div>

<script language="javascript">
var taocanid=0;
function buyserve(x){
 if(document.getElementById("tcnum")){if(taocanid==0){alert("请先选择套餐");return false;}}
 if(document.getElementById("tc2div"+taocanid)){if(taocanid2==0){alert("请先选择套餐");return false;}taocanid=taocanid2;}
 $.get("../../tem/serveBuy.php",{bh:x,buynum:1,tcid:taocanid},function(result){
  response=result.replace(/[\r\n]/g,'');
  response=response.split("|");
  if(response[0]=="err1"){location.href="../reg/index.php?reurl=<?=weburl?>m/serve/view<?=$row[id]?>.html";return false;}
  else if(response[0]=="err2"){alert("亲~不能购买自己的服务哦");return false;}
  else if(response[0]=="ok"){location.href="../user/servebuy.php?orderbh="+response[1];}else{alert("未知错误，请刷新重试");return false;}
 });
}
</script>
</body>
</html>