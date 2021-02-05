<?
include("../../config/conn.php");
include("../../config/function.php");
$sj=date("Y-m-d H:i:s");
$id=intval($_GET[id]);
checkdjl("c3",$id,"yjcode_pro");
while0("*","yjcode_pro where zt<>99 and id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
$nowmoney=sprintf("%.1f",returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]));
$nuid=returnuserid($_SESSION["SHOPUSER"]);

$sqlsell="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);
if(!$rowsell=mysqli_fetch_array($ressell)){php_toheader("../");}

$nch="";
if(isset($_COOKIE['prohistoy'])){
$nch=$_COOKIE['prohistoy'];
if(check_in($row[id]."xcf",$nch)){$nch=str_replace($row[id]."xcf","",$nch);}
$a=preg_split("/xcf/",$nch);
if(count($a)>20){$ni=20;}else{$ni=count($a);}
$nch="";
for($i=0;$i<=$ni;$i++){
$nch=$nch.$a[$i]."xcf";
}
}
$Month = 864000 + time();
setcookie(prohistoy,$row[id]."xcf".$nch, $Month,'/');
$nch=$_COOKIE['prohistoy'];
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title><?=$row[tit]?> <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="view.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="view.js"></script>
<script language="javascript">
onShareAppMessage: function () {
}
</script>
</head>
<body>
<? 
$wxfxtit=$row[tit];
$wxfxurl=weburl."m/product/view".$id.".html";
$wxfxtp=returntp("bh='".$row[bh]."' order by xh asc","-2");
$wxfxdes=$row[wdes];
include("../../tem/wxfx.php");
?>

<div class="czcap box">
<div class="d1 flex"><a href="javascript:void(0);" onClick="backhis()"><img src="../img/leftjian.png" /></a></div>
<div class="d2" onClick="gourl('../')"><span></span><span></span><span></span></div>
</div>

<? while3("*","yjcode_provideo where probh='".$row[bh]."' and gs='mp4' and zt=0 and iftj=1");if($row3=mysqli_fetch_array($res3)){$provideo=1;}else{$provideo=0;}?>
<? if(empty($provideo)){?>
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
<ul id="position" style="display:none;"><? for($j=0;$j<$i;$j++){?><li class="<? if(0==$j){?>cur<? }?>"></li><? }?></ul>
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
<? }else{?>
<!--视频B-->
<div class="qhvideo box">
<div class="d1 flex"><iframe name="fvideo" id="fvideo" marginwidth="0" marginheight="0" width="100%" height="350px" border="0" frameborder=0 src="../../video/index.php?id=<?=$row3[id]?>&w=100%&h=350"></iframe></div>
</div>
<!--视频E-->
<? }?>

<div class="jiagem box">
<div class="dleft">
<div class="d1">￥<span id="nowmoney"><?=returnwan($nowmoney)?></span></div>
<div class="d2"><span id="zhekou"><? if(!empty($row[money1])){echo sprintf("%.1f",$nowmoney/$row[money1]*10)."折";}else{echo "无折扣";}?></span></div>
<div class="d3">原价<s id="yuanjia">￥<?=returnwan(sprintf("%.1f",$row[money1]))?></s><span id="nowkcnum" style="display:none;"><?=$row[kcnum]?></span></div>
</div>
<div class="dcenter flex">
<? 
if(2==$row[yhxs] && $sj<=$row[yhsj2]){
if($sj<$row[yhsj1]){$a=1;}else{$a=2;}
?>
<span id="nyhsj1" style="display:none;"><?=str_replace("-","/",$row[yhsj1])?></span>
<span id="nyhsj2" style="display:none;"><?=str_replace("-","/",$row[yhsj2])?></span>
<span id="nmoney2" style="display:none;"><?=returnjgdian($row[money2])?></span>
<span id="nmoney3" style="display:none;"><?=returnjgdian($row[money3])?></span>
<span id="nowsj" style="display:none;"><?=str_replace("-","/",$sj)?></span>
<div id="xsyh">
<div class="d1"><span id="yhsjv"></span></div>
<div class="d2"><?=$row[yhsm]?></div>
</div>
<script language="javascript" src="yhsj.js"></script>
<script language="javascript">yhsj(<?=$a?>);</script>
<? }?>
</div>

<div class="dright">
<? 
$a1="none";$a2="none";
if(empty($nuid)){$a1="";}else{
if(panduan("probh,userid","yjcode_profav where probh='".$row[bh]."' and userid=".$nuid)==1){$a2="";}else{$a1="";}
}
?>
<a id="favpno" style="display:<?=$a1?>;" href="javascript:void(0);" onClick="profavInto('<?=$row[bh]?>','')"><img src="img/favb.png" /><br>收藏</a>
<a id="favpyes" style="display:<?=$a2?>;" href="../user/favpro.php"><img src="img/favb.png" /><br>已收藏</a>
</div>

</div>

<div class="tit box"><div class="d1 flex"><? if($row[admintj]>0){?><span>精选</span><? }?><?=$row[tit]?></div></div>
<div class="tese box">
<div class="dmain flex">
<div class="d1">
<a href="javascript:void(0);" onClick="tscapover(1)" id="tscap1" class="a1">担保交易</a>
<? if($row[fhxs]==2 || $row[fhxs]==3 || $row[fhxs]==4){?><a href="javascript:void(0);" onClick="tscapover(2)" id="tscap2">自动发货</a><? }?>
<? if(1==$row[ifuserdj]){?><a href="javascript:void(0);" onClick="tscapover(3)" id="tscap3">VIP折扣</a><? }?>
</div>
<div class="tsmain" id="tsmain1">担保交易，安全保证，有问题不解决可申请退款。</div>
<div class="tsmain" id="tsmain2" style="display:none;">自动发货商品，随时可以购买，零等待。</div>
<div class="tsmain" id="tsmain3" style="display:none;">不同会员等级尊享不同购买折扣。</div>
</div>
</div>

<!--有套餐B-->
<? $alli=returncount("yjcode_taocan where admin is null and zt=0 and probh='".$row[bh]."'");if($alli>0){?>
<div id="tcnum" style="display:none;"><?=$alli?></div>
<div class="taocan box">
<div class="d1 flex">
<div class="tcsm">套餐</div>
<div class="tcmain"> 
<? 
$i=1;
$ja=0;
while1("*","yjcode_taocan where admin is null and zt=0 and probh='".$row[bh]."' order by xh asc");while($row1=mysqli_fetch_array($res1)){
if(empty($row1[fhxs])){$k=$row[kcnum];}else{$k=$row1[kcnum];}
$tp1="../../upload/".$row1[userid]."/".$row1[probh]."/tc".$row1[id]."-1.png";
if(!is_file($tp1)){$tp1="../../img/none180x180.gif";}
$oncj="taocanonc(".$i.",".$alli.",".$row1[money1].",".$row1[money2].",".$row1[id].",".sprintf("%.1f",$row1[money1]/$row1[money2]*10).",".$k.",'".$row1[tit]."','".$tp1."')";
if($i==1){$ja=$row1[id];}
?>
<a href="javascript:void(0);" id="taocana<?=$i?>" onClick="<?=$oncj?>"><?=$row1[tit]?><i></i></a>
<? $i++;}?>
</div>
</div>
</div>

<?
while1("*","yjcode_taocan where admin is null and zt=0 and probh='".$row[bh]."' order by xh asc");while($row1=mysqli_fetch_array($res1)){
$alli2=returncount("yjcode_taocan where admin=2 and zt=0 and tit='".$row1[tit]."' and probh='".$row[bh]."'");if($alli2>0){
$i=1;
?>
<span id="tc2num<?=$row1[id]?>" style="display:none;"><?=$alli2?></span>
<div class="taocan taocan1 box" id="tc2div<?=$row1[id]?>" style="display:none;">
<div class="d1 flex">
<div class="tcsm">选择</div>
<div class="tcmain"> 
<? 
while2("*","yjcode_taocan where admin=2 and zt=0 and tit='".$row1[tit]."' and probh='".$row[bh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){
if(empty($row2[fhxs])){$k=$row[kcnum];}else{$k=$row2[kcnum];}
$tp2="../../upload/".$row2[userid]."/".$row2[probh]."/tc".$row2[id]."-1.png";
if(!is_file($tp2)){$tp2="../../img/none180x180.gif";}
?>
<a href="javascript:void(0);" id="taocan2a<?=$row1[id]?>_<?=$i?>" onClick="taocan2onc(<?=$i?>,<?=$alli2?>,<?=$row2[money1]?>,<?=$row2[money2]?>,<?=$row2[id]?>,<?=sprintf("%.1f",$row2[money1]/$row2[money2]*10)?>,<?=$k?>,'<?=$row2[tit2]?>','<?=$tp2?>')"><?=$row2[tit2]?><i></i></a>
<? $i++;}?>
</div>
</div>
</div>
<? }}?>

<script language="javascript">
pretc1id=<?=$ja?>;
</script>
<? }?>
<!--有套餐E-->

<div class="txtcap box"><div class="d1 flex">商品属性</div></div>
<div class="prosx box">
<div class="dmain">
<? if(!empty($row[ysweb])){?>
<div class="d1"><span class="s1">演示网站：</span><span class="s2"><a href="<?=$row[ysweb]?>" target="_blank">查看</a></span></div>
<? }?>
<? 
$a=preg_split("/xcf/",$row[tysx]);
$sx1arr=array();
$sxall="xcf";
$m=0;
for($i=0;$i<=count($a);$i++){
$ai=$a[$i];
if($ai!=""){
if(!is_numeric($ai)){$z1=preg_split("/:/",$ai);$ai=$z1[0];}
while1("*","yjcode_typesx where id=".$ai);if($row1=mysqli_fetch_array($res1)){
while2("*","yjcode_typesx where name1='".$row1[name1]."' and admin=1 and ifjd=1");if($row2=mysqli_fetch_array($res2)){
if(!in_array($row1[name1],$sx1arr)){$sx1arr[$m]=$row1[name1];$m++;}
if(!is_numeric($a[$i])){$z1=preg_split("/:/",$a[$i]);$v=$z1[1];}else{$v=$row1[name2];}
$sxall=$sxall.$row1[name1].":".$v."xcf";
}
}
}
}
for($i=0;$i<count($sx1arr);$i++){
?>
<div class="d1"><span class="s1"><?=$sx1arr[$i]?>：</span><span class="s2"><? $b=preg_split("/xcf/",$sxall);for($j=0;$j<=count($b);$j++){if(check_in($sx1arr[$i],$b[$j])){echo str_replace($sx1arr[$i].":","",$b[$j])." ";}}?></span></div>
<? }?>
</div>
</div>

<div class="clear box" id="txttitP"></div>
<div class="txttit box" id="txttit">
<div class="d1 flex d11" id="bqcap1" onClick="bqonc(1)">商品详情</div>
<div class="d1 flex" id="bqcap2" onClick="bqonc(2)">用户评价 <? $allpj=returncount("yjcode_order where probh='".$row[bh]."' and admin=2 and ifpj=1");echo $allpj;?></div>
<div class="d1 flex" id="bqcap3" onClick="bqonc(3)">交易规则</div>
</div>

<div class="txtmain box" id="bqdiv1">
<div class="dmain flex">
<?=$row[txt]?>
</div>
</div>

<div id="bqdiv2" style="display:none;">
<? 
while1("*","yjcode_order where probh='".$row[bh]."' and admin=2 and ifpj=1 order by sj desc limit 15");while($row1=mysqli_fetch_array($res1)){
$usertx="../../upload/".$row1[userid]."/user.jpg";
if(!is_file($usertx)){$usertx="../../user/img/nonetx.gif";}else{$usertx=$usertx."?id=".rnd_num(1000);} 
?>
<div class="pjlist box">
<div class="d1"><img src="<?=$usertx?>" width="50" height="50" /><br><?=returnjiami(returnnc($row1[userid]))?></div>
<div class="d2">
<span class="s0"><img src="../img/pj<?=$row1[pjlx]?>.png" /></span>
<span class="s1">
<img src="../../img/x1.png" class="img1" width="76" height="15" />
<? $pf=round(($row1[pf1]+$row1[pf2]+$row1[pf3])/3,2);?>
<div class="pf" style="width:<?=$pf/5*76?>px;"><img src="../../img/x2.png" width="76" height="15" /></div>
</span>
<span class="s2"><?=dateYMDHM($row1[pjsj])?></span>
<span class="s3"><?=$row1[pjtxt]?></span>
<? if(1==$row1[ifpjtp]){?>
<span class="s5">
<? 
while2("*","yjcode_tp where bh='".$row1[zuorderbh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){$tp="../../".str_replace(".","-1.",$row2[tp]);
?>
<a href="../../<?=$row2[tp]?>" target="_blank"><img src="<?=$tp?>" width="50" height="50" /></a>&nbsp;&nbsp;
<? }?>
</span>
<? }?>
<? if(!empty($row1[hftxt])){?><span class="s4">卖家回复：<?=$row1[hftxt]?></span><? }?>
</div>
</div>
<? }?>
<div class="morepj box"><div class="d1 flex" onClick="gourl('pjlist_i<?=$row[id]?>v.html')">查看更多评价</div></div>
</div>

<div class="txtmain box" id="bqdiv3" style="display:none;">
<div class="dmain flex">
<? 
while1("*","yjcode_type where id=".intval($row[ty1id]));if($row1=mysqli_fetch_array($res1)){$gz=$row1[jygz];}
if(empty($gz)){
while1("*","yjcode_onecontrol where tyid=9");if($row1=mysqli_fetch_array($res1)){$gz=$row1[txt];}
}
echo $gz;
?>
</div>
</div>








<? 
$cara1="none";$cara2="none";
if(empty($nuid)){$cara1="";}else{
$carnum=returncount("yjcode_car where userid=".$nuid);
if(panduan("probh,userid","yjcode_car where probh='".$row[bh]."' and userid=".$nuid)==1){$cara2="";}else{$cara1="";}
}
?>
<!--购买B-->
<div class="buym"></div>
<div class="buy box">
<div class="d1"><a href="../shop/view<?=$row[userid]?>.html"><img src="img/shopv.png" height="23" /><br>店铺</a></div>
<? if(!empty($rowsell[uqq])){?>
<div class="d1"><a href="javascript:void(0);" onClick="qqtang('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)"><img src="../img/kefu.png" height="23" /><br>客服</a></div>
<? }?>
<div class="d1" onClick="gourl('../user/car.php')"><span id="gwcnum" <? if(empty($carnum)){?> style="display:none;"<? }?>><?=intval($carnum)?></span><img src="../img/car.png" height="23" /><br>购物车</div>
<div class="d3 flex" style="display:<?=$cara1?>;" id="cara1" onClick="carInto('<?=$row[bh]?>')">加购物车</div>
<div class="d3 flex" style="display:<?=$cara2?>;" id="cara2" onClick="gourl('../user/car.php');">已在购物车</div>
<div class="d4 flex" onClick="buyInto('<?=$row[bh]?>')">立即购买</div>
</div>
<!--购买E-->

<script language="javascript">
//商品收藏
function profavInto(x){
$.get("../../tem/favproInto.php",{bh:x},function(result){
if(result=="err1"){location.href="../reg/index.php?reurl=<?=weburl?>m/product/view<?=$row[id]?>.html";return false;}
else if(result=="err2"){alert("亲~不能收藏自己的商品哦");return false;}
else if(result=="ok"){
document.getElementById("favpyes").style.display="";
document.getElementById("favpno").style.display="none";
}else{alert("未知错误，请刷新重试");return false;}
});
}

//加入购物车
function carInto(x){
if(document.getElementById("tcnum")){if(taocanid==0){layerts("请先选择套餐");gotoTop();return false;}}
if(document.getElementById("tc2div"+taocanid)){if(taocanid2==0){layerts("请先选择套餐");gotoTop();return false;}taocanid=taocanid2;}
$.get("../../tem/carInto.php",{bh:x,kcnum:1,tcid:taocanid},function(result){
if(result=="err1"){location.href="../reg/index.php?reurl=<?=weburl?>m/product/view<?=$row[id]?>.html";return false;}
else if(result=="err2"){alert("亲~不能将自己的商品放入购物车哦");return false;}
else if(result=="ok"){
a=parseInt(document.getElementById("gwcnum").innerHTML);
document.getElementById("gwcnum").innerHTML=a+1;
document.getElementById("gwcnum").style.display="";
document.getElementById("cara2").style.display="";
document.getElementById("cara1").style.display="none";
layerts("已加入购物车中");
}else{alert("未知错误，请刷新重试");return false;}
});

}

//立即购买
function buyInto(x){
if(document.getElementById("tcnum")){if(taocanid==0){layerts("请先选择套餐");gotoTop();return false;}}
if(document.getElementById("tc2div"+taocanid)){if(taocanid2==0){layerts("请先选择套餐");gotoTop();return false;}taocanid=taocanid2;}
$.get("../../tem/buyInto.php",{bh:x,kcnum:1,tcid:taocanid},function(result){
if(result=="err1"){location.href="../reg/index.php?reurl=<?=weburl?>m/product/view<?=$row[id]?>.html";return false;}
else if(result=="err2"){alert("亲~不能购买自己的商品哦");return false;}
else if(result=="ok"){location.href="../user/car.php";}else{alert("未知错误，请刷新重试");return false;}
});
}

var sc=$(document);
var nav=$("#txttit"); //得到导航对象
$(window).scroll(function () {
if(sc.scrollTop()>=$("#txttitP").offset().top){
$("#txttit").addClass("txttit1");
}else{
$("#txttit").removeClass("txttit1")
}
});

</script>

<div style="display:none;"><?=$rowcontrol[webtj]?></div>
</body>
</html>