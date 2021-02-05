<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$id=intval($_GET[id]);
checkdjl("c4",$id,"yjcode_server");
while0("*","yjcode_server where zt<>99 and id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}

$sqlsell="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);
if(!$rowsell=mysqli_fetch_array($ressell)){php_toheader("../");}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$row[wkey]?>">
<meta name="description" content="<?=$row[wdes]?>">
<title><?=$row[tit]?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<script language="javascript">
function dcaponc(x){
 for(i=1;i<=4;i++){
  if(document.getElementById("dcap"+i)){
  document.getElementById("dcap"+i).className="";
  document.getElementById("dmain"+i).style.display="none";
  }
 }
 document.getElementById("dcap"+x).className="a1 g_bc0_h";
 document.getElementById("dmain"+x).style.display="";
}
</script></head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>
<div class="yjcode">
 
 <div class="dqwz">
 <ul class="u1">
 <li class="l1">
 当前位置：<a href="<?=weburl?>">首页</a> > <a href="search_j<?=$row[ty1id]?>v.html"><?=returnservertype(1,$row[ty1id])?></a>
 <? if(0!=$row[ty2id]){?> > <a href="search_j<?=$row[ty1id]?>v_k<?=$row[ty2id]?>v.html"><?=returnservertype(2,$row[ty2id])?></a><? }?>
 </li>
 </ul>
 </div>
 
<!--基本资料B-->
<div class="sermain">

 <!--左B-->
 <div class="dleft">
 <? $tp=returntp("bh='".$row[bh]."' order by xh asc","-1");?>
 <div class="tp"><img src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'"/></div>
  <ul class="u1">
  <li class="l1"></li>
  <li class="l2">交易动态</li>
  <li class="l3"></li>
  <li class="l4">网站真实交易数据</li>
  </ul>
 <!--滚动开始-->
 <div class="gdmain" id="Marquee1">
 <? 
 $i=1;while1("*","yjcode_serverorder where (ddzt=2 or ddzt=4 or ddzt=5 or ddzt=6 or ddzt=11) order by sj desc limit 50");while($row1=mysqli_fetch_array($res1)){
 while2("id,bh,tit","yjcode_server where bh='".$row1[serverbh]."'");$row2=mysqli_fetch_array($res2);
 ?>
 <div class="gd">
 <ul class="u2">
 <li class="l1"><?=dateMD($row1[sj])?></li>
 <li class="l2"><?=returnjiami(returnnc($row1[userid]))?> ￥<?=$row1[money3]?></li>
 <li class="l3"><span><a href="view<?=$row2[id]?>.html" target="_blank"><?=$row2[tit]?></a></span></li>
 </ul>
 </div>
 <? $i++;}?>
 <script>
 var Mar1 = document.getElementById("Marquee1");
 var child_div1=Mar1.getElementsByTagName("div")
 var picH1 = 70;//移动高度
 var scrollstep1=3;//移动步幅,越大越快
 var scrolltime1=40;//移动频度(毫秒)越大越慢
 var stoptime1=2500;//间断时间(毫秒)
 var tmpH1 = 0;
 Mar1.innerHTML += Mar1.innerHTML;
 function start1(){
	if(tmpH1 < picH1){
		tmpH1 += scrollstep1;
		if(tmpH1 > picH1 )tmpH1 = picH1 ;
		Mar1.scrollTop = tmpH1;
		setTimeout(start1,scrolltime1);
	}else{
		tmpH1 = 0;
		Mar1.appendChild(child_div1[0]);
		Mar1.scrollTop = 0;
		setTimeout(start1,stoptime1);
	}
 }
 start1();
 </script>
 </div>
 <!--滚动结束-->
 </div>
 <!--左E-->
 
 <!--中B-->
 <div class="dcenter">
  <h1><?=$row[tit]?></h1>
  
  <div class="jgm">
   <ul class="jgu1">
   <li class="l1">本站优惠价</li>
   <li class="l2">￥<span id="nowmoney"><?=sprintf("%.2f",$row[money1])?></span><span id="nowmoneyY" style="display:none;"><?=$row[money1]?></span></li>
   </ul>
   <ul class="jgu2">
   <li class="l0">综合评分：</li>
   <li class="l1">
   <img src="../img/x1.png" class="img1" width="92" height="15" />
   <? $pf=round(($row[pf1]+$row[pf2]+$row[pf3])/3,2);?>
   <div class="pf" style="width:<?=$pf/5*92?>px;"><img src="../img/x2.png" title="<?=$pf?>分" width="92" height="15" /></div>
   </li>
   <li class="l2">有效成交：<?=returncount("yjcode_serverorder where serverbh='".$row[bh]."' and (ddzt=2 or ddzt=4 or ddzt=5 or ddzt=6 or ddzt=11)")?>笔</li>
   </ul>
  </div>

  <!--套餐B-->
  <? $alli=returncount("yjcode_servertaocan where admin=1 and zt=0 and serverbh='".$row[bh]."'");if($alli>0){?>
  <div id="tcnum" style="display:none;"><?=$alli?></div>
  <ul class="utc" id="utc1">
  <li class="l1">套餐：</li>
  <li class="l2">
  <? 
  $i=1;
  $ja=0;
  while1("*","yjcode_servertaocan where admin=1 and zt=0 and serverbh='".$row[bh]."' order by xh asc");while($row1=mysqli_fetch_array($res1)){
  if($i==1){$ja=$row1[id];}
  $tp="../upload/".$row1[userid]."/".$row1[serverbh]."/tc".$row1[id]."-1.png";
  if(is_file($tp)){$tit="";}
  else{$tp="";$tit=$row1[tit1];}
  $oncj="taocanonc(".$i.",".$alli.",".$row1[money1].",".$row1[id].",'".$tp."')";
  ?>
  <a href="javascript:void(0);" id="taocana<?=$i?>" style="background:url(<?=$tp?>) center center no-repeat;" title="<?=$row1[tit1]?>" onClick="<?=$oncj?>"><?=$tit?></a>
  <? $i++;}?>
  </li>
  </ul>
   
  <?
  while1("*","yjcode_servertaocan where admin=1 and zt=0 and serverbh='".$row[bh]."' order by xh asc");while($row1=mysqli_fetch_array($res1)){
  $alli2=returncount("yjcode_servertaocan where admin=2 and zt=0 and tit1='".$row1[tit1]."' and serverbh='".$row[bh]."'");if($alli2>0){
  $i=1;
  ?>
  <span id="tc2num<?=$row1[id]?>" style="display:none;"><?=$alli2?></span>
  <ul class="utc" id="tc2div<?=$row1[id]?>" style="display:none;">
  <li class="l1">选择：</li>
  <li class="l2">
  <? 
  while2("*","yjcode_servertaocan where admin=2 and zt=0 and tit1='".$row1[tit1]."' and serverbh='".$row[bh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){
  $tp="../upload/".$row2[userid]."/".$row2[serverbh]."/tc".$row2[id]."-1.png";
  if(is_file($tp)){$tit="";}
  else{$tp="";$tit=$row2[tit2];}
  ?>
  <a href="javascript:void(0);" id="taocan2a<?=$row1[id]?>_<?=$i?>" title="<?=$row2[tit2]?>" style="background:url(<?=$tp?>) center center no-repeat;" onClick="taocan2onc(<?=$i?>,<?=$alli2?>,<?=$row2[money1]?>,<?=$row2[id]?>,'<?=$tp?>')"><?=$tit?></a>
  <? $i++;}?>
  </li>
  </ul>
  <? }}?>
   
  <script language="javascript">pretc1id=<?=$ja?>;</script>
  <? }?>
  <!--套餐E-->

  <ul class="u6">
  <li class="l1"><input type="text" onChange="moneycha()" id="tbuynum" value="1" /></li>
  <li class="l2"><a href="javascript:void(0);" onClick="shujia()" class="a1">+</a><a href="javascript:void(0);" onClick="shujian()" class="a2">-</a></li>
  </ul>
  
  <div class="buydiv">
   <a href="javascript:void(0);" onClick="buyserve('<?=$row[bh]?>')" class="buy">立即购买</a>
  </div>
 
  <ul class="u3">
  <li class="l1">保障：</li>
  <li class="l2">
   <a href="javascript:void(0);" onMouseOver="tscapover(1)" id="tscap1" class="a1">担保交易</a>
   <? if($rowsell[baomoney]>0){?><a href="javascript:void(0);" onMouseOver="tscapover(2)" id="tscap2">保证金</a><? }?>
  </li>
  </ul>
  <div class="tsmain" id="tsmain1">购买服务后，资金进入网站担保，安全保证，交易结束前，有问题不解决可申请退款。</div>
  <div class="tsmain" id="tsmain2" style="display:none;">该商家已在本站缴纳了 <?=$rowsell[baomoney]?>元 保证金，可用于消保赔付。</div>

  <? if(empty($rowcontrol[fenxiang])){?>
  <ul class="fx">
  <li class="l1">分享：</li>
  <li class="l2">
  <? 
  $fxurl=weburl."serve/view".$row[id].".html";
  $fxtit=$row[tit];
  $fxtp=returntp("bh='".$row[bh]."' order by xh asc","-1");
  include("../tem/fenxiang.php");
  ?>
  </li>
  </ul>
  <? }?>

 
 </div>
 <!--中E-->
 
 <!--右B-->
 <? $xy=returnjgdw($rowsell[xinyong],"",returnxy($row[userid],1));?>
 <div class="dright">
  <ul class="u1">
  <li class="l1">联系掌柜</li>
  <li class="l2"><img src="../upload/<?=$rowsell[id]?>/shop.jpg" onerror="this.src='../img/none180x180.gif'" /></li>
  <li class="l3"><?=$rowsell[shopname]?></li>
  <li class="l4"><a href="<?=returnmyweb($rowsell[id],$rowsell[myweb])?>" class="g_bg0" target="_blank">我的店铺</a></li>
  <li class="l31">商家信誉：</li>
  <li class="l41"><img title="信用值<?=$xy?>" src="../img/dj/<?=returnxytp($xy)?>" /></li>
  <li class="l51">商家认证：</li>
  <li class="l61">
  <? if(1==$rowsell["ifemail"]){?><img src="../user/img/rz1.gif" title="邮箱已绑定" /><? }?>
  <? if(1==$rowsell["ifmot"]){?><img title="手机号码已绑定" src="../user/img/rz2.gif" /><? }?>
  <? if(2==$rowsell["sfzrz"]){?><img title="身份证已认证" src="../user/img/rz3.gif" /><? }?>
  </li>
  <? if(!empty($rowsell[uqq])){?>
  <li class="l71">QQ 号码：</li>
  <li class="l81"><a href="javascript:void(0);" onClick="opentangqq('<?=$rowsell[uqq]?>')"><?=$rowsell[uqq]?></a></li>
  <? }?>
  </ul>
 </div>
 <!--右E-->
 
</div>
<!--基本资料E-->

<!--详情B-->
<div class="sermain1">

 <!--左B-->
 <div class="serleft">
 
  <div class="dcap">
   <a href="javascript:void(0);" class="g_bc0_h a1" onClick="dcaponc(1)" id="dcap1">服务详情</a>
   <a href="javascript:void(0);" onClick="dcaponc(2)" id="dcap2">购买记录</a>
   <a href="javascript:void(0);" onClick="dcaponc(3)" id="dcap3">服务评价</a>
   <a href="javascript:void(0);" onClick="dcaponc(4)" id="dcap4">交易流程</a>
  </div>

  
  <div class="ymtxt" id="dmain1"><?=$row[txt]?></div>
  
  <div id="dmain2" style="display:none;">
   <ul class="cju1">
   <li class="l1">商品名称</li>
   <li class="l2">总价</li>
   <li class="l3">数量</li>
   <li class="l4">用户名</li>
   <li class="l5">购买时间</li>
   </ul>
   <? 
   while1("*","yjcode_serverorder where (ddzt=2 or ddzt=4 or ddzt=5 or ddzt=6 or ddzt=11) and serverbh='".$row[bh]."' order by sj desc limit 20");while($row1=mysqli_fetch_array($res1)){
   ?>
   <ul class="cju2">
   <li class="l1"><?=$row1[tit]." ".$row1[taocan]?></li>
   <li class="l2"><?=sprintf("%.2f",$row1[money3])?></li>
   <li class="l3"><?=$row1[num]?></li>
   <li class="l4"><?=returnjiami(returnnc($row1[userid]))?></li>
   <li class="l5"><?=dateYMD($row1[sj])?></li>
   </ul>
   <? }?>
   <div class="cjmore"><a href="cjlist_i<?=$row[id]?>v.html" target="_blank">查看更多成交记录</a></div>
  </div>
  
  <div id="dmain3" style="display:none;">
   <ul class="pjcap">
   <li class="l1">商品评价</li>
   <li class="l2">服务态度<br><strong class="feng"><?=sprintf("%.2f",$row[pf1])?></strong></li>
   <li class="l2">工作效率<br><strong class="feng"><?=sprintf("%.2f",$row[pf2])?></strong></li>
   <li class="l2">完成质量<br><strong class="feng"><?=sprintf("%.2f",$row[pf3])?></strong></li>
   <li class="l2">综合评分<br><strong class="feng"><?=sprintf("%.2f",($row[pf1]+$row[pf2]+$row[pf3])/3)?></strong></li>
   <li class="l3"><a href="../user/serverorder.php?ddzt=suc">写评价赚积分</a></li>
   </ul>
   <? 
   while1("*","yjcode_serverpj where serverbh='".$row[bh]."' order by sj desc limit 20");while($row1=mysqli_fetch_array($res1)){
   $usertx="../upload/".$row1[userid]."/user.jpg";
   if(!is_file($usertx)){$usertx="../user/img/nonetx.gif";}else{$usertx=$usertx."?id=".rnd_num(1000);} 
   ?>
   <div class="pj pj<?=$row1[pjlx]?>">
    <ul class="u1"><li class="l1"><img src="<?=$usertx?>"  width="50" height="50" /></li><li class="l2"><?=returnjiami(returnnc($row1[userid]))?></li></ul>
    <ul class="u2">
    <li class="l1">
    <?=$row1[txt]?><br>
    <? if(1==$row1[ifvideo]){?>
    <a href="<?="../upload/".$row1[userid]."/".$row1[orderbh]."/video.mp4"?>" target="_blank"><img src="../img/video.jpg" width="50" height="50" /></a>&nbsp;&nbsp;
    <? }?>
    <? 
    if(1==$row1[iftp]){
    while2("*","yjcode_tp where bh='".$row1[orderbh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){$tp="../".str_replace(".","-1.",$row2[tp]);
    ?>
    <a href="../<?=$row2[tp]?>" target="_blank"><img src="<?=$tp?>" width="50" height="50" /></a>&nbsp;&nbsp;
    <? }}?>
    </li>
    <? if(!empty($row1[hf])){?><li class="l2">卖家回复：<?=$row1[hf]?></li><? }?>
    <li class="l3"><?=$row1[sj]?></li>
    </ul>
    <div class="d2">
    <? if(1==$row1[pjlx]){?><span class="s1">好评</span><? }?>
    <? if(2==$row1[pjlx]){?><span class="s2">中评</span><? }?>
    <? if(3==$row1[pjlx]){?><span class="s3">差评</span><? }?>
    </div>
    <div class="d3">
    <img src="../img/x1.png" class="img1" width="76" height="15" />
    <? $pf=round(($row1[pf1]+$row1[pf2]+$row1[pf3])/3,2);?>
    <div class="pf" style="width:<?=$pf/5*76?>px;"><img src="../img/x2.png" title="<?=$pf?>分" width="76" height="15" /></div>
    </div>
   </div>
   <? }?>
   <div class="cjmore"><a href="pjlist_i<?=$row[id]?>v.html" target="_blank">查看全部评价</a></div>
  </div>
  
  <div class="ymtxt" id="dmain4" style="display:none;"><? while1("*","yjcode_onecontrol where tyid=10");if($row1=mysqli_fetch_array($res1)){$lc=$row1[txt];}echo returnjgdw($lc,"","交易流程资料正在整理中……");?></div>
  
 </div>
 <!--左E-->
 
 <!--右B-->
 <div class="serright">
  <ul class="u1">
  <li class="l1">猜你喜欢</li>
  <li class="l2"><a href="./">更多</a></li>
  </ul>
  <? while1("*","yjcode_server where zt=0 and ifxj=0 and ty1id=".$row[ty1id]." and id<>".$row[id]." order by lastsj desc limit 10");while($row1=mysqli_fetch_array($res1)){?>
  <ul class="u2">
  <li class="l1"><a href="view<?=$row1[id]?>.html"><img src="<?=returntp("bh='".$row1[bh]."' order by xh asc","-1");?>" /></a></li>
  <li class="l2"><a href="view<?=$row1[id]?>.html"><?=$row1[tit]?></a></li>
  </ul>
  <? }?>
 </div>
 <!--右E-->
 
</div>
<!--详情E-->
 
 
</div>
<? include("../tem/bottom.html");?>
</body>
</html>