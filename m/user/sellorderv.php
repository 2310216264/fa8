<?
$sqlbuy="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$resbuy=mysqli_query($conn,$sqlbuy);
$rowbuy=mysqli_fetch_array($resbuy);
?>
<div class="ordervtop1 box">
 <div class="d1">
  <strong><?=strip_tags(returnorderzt($row[ddzt]))?></strong><br>
  <? 
  if($row[ddzt]=="wait"){
   $second=strtotime($sj)-strtotime($row[sj]);
   $day = floor($second/(3600*24));
   $second = $second%(3600*24);//除去整天之后剩余的时间
   $hour = floor($second/3600);
   $second = $second%3600;//除去整小时之后剩余的时间 
   $minute = floor($second/60);
   $second = $second%60;//除去整分钟之后剩余的时间 
   $sjcv=$day."天".$hour."时".$minute."分".$second."秒";
   echo "已过去".$sjcv;
  
  }elseif($row[ddzt]=="db"){
   $second=$row[dbautosj]-strtotime($sj);
   $day = floor($second/(3600*24));
   $second = $second%(3600*24);//除去整天之后剩余的时间
   $hour = floor($second/3600);
   $second = $second%3600;//除去整小时之后剩余的时间 
   $minute = floor($second/60);
   $second = $second%60;//除去整分钟之后剩余的时间 
   $sjcv=$day."天".$hour."时".$minute."分".$second."秒";
   echo "还剩".$sjcv."自动确认";
  
  }elseif($row[ddzt]=="close"){
   echo $row[closesj];
    
  }elseif($row[ddzt]=="back"){
   $second=$row[tkautosj]-strtotime($sj);
   $day = floor($second/(3600*24));
   $second = $second%(3600*24);//除去整天之后剩余的时间
   $hour = floor($second/3600);
   $second = $second%3600;//除去整小时之后剩余的时间 
   $minute = floor($second/60);
   $second = $second%60;//除去整分钟之后剩余的时间 
   $sjcv=$day."天".$hour."时".$minute."分".$second."秒";
   echo "请在".$sjcv."内处理";

  }elseif($row[ddzt]=="backerr"){
   $second=$row[tkautosj]-strtotime($sj);
   $day = floor($second/(3600*24));
   $second = $second%(3600*24);//除去整天之后剩余的时间
   $hour = floor($second/3600);
   $second = $second%3600;//除去整小时之后剩余的时间 
   $minute = floor($second/60);
   $second = $second%60;//除去整分钟之后剩余的时间 
   $sjcv=$day."天".$hour."时".$minute."分".$second."秒";
   echo $sjcv."后自动打款给您";
 
  }elseif($row[ddzt]=="suc"){
   echo "再接再励，祝您天天开单";
  
  }
  ?>
 </div>
 <div class="d2"><img src="img/ddzt_<?=$row[ddzt]?>.png" /></div>
</div>

<!--物流B-->
<script language="javascript">
function wuliu1onc(){
if(document.getElementById("wuliu1d2").className=="d2"){
 document.getElementById("wuliu1d2").className="d2 d21";
 document.getElementById("wuliu1img").src="img/jiantop.png";
 }else{
 document.getElementById("wuliu1d2").className="d2";
 document.getElementById("wuliu1img").src="img/jiandown.png";
 }
}
</script>
<? if(5==$row[fhxs]){?>
<div class="wuliu1 box" onClick="wuliu1onc()">
 <div class="d1"><img src="img/add1.png" /></div>
 <div class="d2" id="wuliu1d2">
 <? if(!empty($row[kdid])){while1("*","yjcode_kuaidi where id=".$row[kdid]);if($row1=mysqli_fetch_array($res1)){$kdbh=$row1[kdbh];$kddh=$row[kddh];?>
 <a href="<?=$row1[kdweb]?>" target="_blank"><?=$row1[tit]?></a> (<span><?=$row[kddh]?></span>)<br>
 <? while2("*","yjcode_chajian where cjbh='cj001' and zt=0");if($row2=mysqli_fetch_array($res2)){include("../../config/chajian/cj001/index.php");}else{echo "<br>您可以复制快递单号，然后点击快递公司名称进入网站查询及时的物流信息";}?>
 <? }}else{echo "暂无快递/物流信息<br>可及时关注订单进度<br>如有疑问，请及时联系店家";}?>
 </div>
 <div class="d3"><img id="wuliu1img" src="img/jiandown.png" /></div>
</div>
<div class="wuliu2 box">
 <div class="d1"><img src="img/add2.png" /></div>
 <div class="d2"><?=$row[shdz]?></div>
</div>
<? }?>
<!--物流E-->

<!--循环B-->
<div class="ordermain1 box"><div class="d1"></div><div class="d2">订单信息</div></div>
<div class="ordermain2 box"><div class="d1">订单总额:</div><div class="d2"><?=$row[allmoney3]?>元</div></div>
<? if(!empty($row[yunfei])){?>
<div class="ordermain2 box"><div class="d1">包含运费:</div><div class="d2"><?=$row[yunfei]?>元</div></div>
<? }?>
<? if($row[ddzt]=="back" || $row[ddzt]=="backsuc" || $row[ddzt]=="backerr" || $row[ddzt]=="jfbuy" || $row[ddzt]=="jfsell" || $row[ddzt]=="jf"){?>
<div class="ordermain2 box"><div class="d1">申请退款:</div><div class="d2"><?=$row[tkmoney]?>元</div></div>
<? }?>
<!--买家B-->
<div class="orderbuy1 box"><div class="d1">联系QQ:</div><div class="d2"><span onclick="qqtang('<?=$rowbuy[uqq]?>')"><?=$rowbuy[uqq]?></span></div></div>
<div class="orderbuy1 box"><div class="d1">微信号码:</div><div class="d2"><?=$rowbuy[weixin]?></div></div>
<div class="orderbuy2 box"></div>
<!--买家E-->
<div class="ordermain3 box"></div>

<?
$lii=1;
$sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";
mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
$sqlpro="select * from yjcode_pro where bh='".$rowli[probh]."'";mysqli_set_charset($conn,"utf8");$respro=mysqli_query($conn,$sqlpro);
$rowpro=mysqli_fetch_array($respro);
$tp=returntp("bh='".$rowli[probh]."' order by iffm desc","-2");
$fhxs=$rowli[fhxs];
$tcfhxs=0;
if(!empty($rowli[tcid])){
 $sqltc="select * from yjcode_taocan where id=".$rowli[tcid];mysqli_set_charset($conn,"utf8");$restc=mysqli_query($conn,$sqltc);$rowtc=mysqli_fetch_array($restc);
 $tcfhxs=$rowtc[fhxs];
}
?>

<div class="ordermain1 box"><div class="d1"></div><div class="d2"><strong>第<?=$lii?>件商品</strong></div></div>
<!--商品B-->
<div class="orderpro1 box">
 <div class="d1"><img src="<?=$tp?>" onerror="this.src='../../img/none150x150.gif'" width="70" height="70" /></div>
 <div class="d2">
 <strong><?=$rowli["tit"]?></strong><br>
 <? if(!empty($rowli[tcv])){echo "<span class='hui'>套餐：".$rowli[tcv]."</span><br>";}?>
 </div>
 <div class="d3">￥<?=$rowli[money1]?><br><span class="hui">x<?=$rowli[num]?></span></div>
</div>
<!--商品E-->

<? if(!empty($rowli[buyform])){?>
<div class="ordermain2 box">
 <div class="d1">购买备注:</div>
 <div class="d2"><?=$rowli[buyform]?></div>
</div>
<? }?>
<? if(!empty($rowli[liuyan])){?>
<div class="ordermain2 box">
 <div class="d1">买家留言:</div>
 <div class="d2"><?=$rowli[liuyan]?></div>
</div>
<? }?>
<? if(!empty($rowli[fhtxt])){?>
<div class="ordermain2 box">
 <div class="d1">发货备注:</div>
 <div class="d2"><?=$rowli[fhtxt]?></div>
</div>
<? }?>

<!--订单信息B-->

<div class="ordermain2 box">
 <div class="d1">取货方式:</div>
 <div class="d2">
 <? if(!empty($rowpro[downurl])){?><strong class="green">下载地址：<a href="<?=$rowpro[downurl]?>" target="_blank"><?=$rowpro[downurl]?></a></strong><br><? }?>
 <span class="feng">
 <? if(1==$fhxs){?>需要你手动发货<? }?>
 
 <? if(2==$fhxs && $tcfhxs==0){?>网盘地址：<?=$rowpro[wpurl]?><br>网盘密码：<?=$rowpro[wppwd]?><br>解压密码：<?=$rowpro[wppwd1]?><? }?>
 <? if(2==$tcfhxs){?>网盘地址：<?=$rowtc[wpurl]?><br>网盘密码：<?=$rowtc[wppwd]?><br>解压密码：<?=$rowtc[wppwd1]?><? }?>
 
 <? if(3==$fhxs && $tcfhxs==0){if(empty($rowpro[upty])){$u=weburl."upload/u/".dateYMDN($rowsell[sj])."/".$rowpro[userid]."/".$rowpro[bh]."/".$rowpro[upf];}else{$u=$rowpro[upf];}?>
  <strong>该订单的商品已经传至服务器，请点击以下图标进行下载</strong><br>
  <a href="<?=$u?>" target="_blank"><img border="0" style="margin-top:5px;" src="img/down.png" /></a>
  <? }?>
  <? if(3==$tcfhxs){if(empty($rowpro[upty])){$u=weburl."upload/u/".dateYMDN($rowsell[sj])."/".$rowpro[userid]."/".$rowpro[bh]."/".$rowtc[upf];}else{$u=$rowtc[upf];}?>
  <strong>该订单的商品已经传至服务器，请点击以下图标进行下载</strong><br>
  <a href="<?=$u?>" target="_blank"><img border="0" style="margin-top:5px;" src="img/down.png" /></a>
  <? }?>
  
  <? if(4==$fhxs || 4==$tcfhxs){?>
  以下是您购买的卡密信息<br>
  <?=$rowli[txt]?>
  <? }?>
  
  <? if(5==$fhxs || 5==$tcfhxs){?>
  快递物流
  <? }?>
 
 </span>
 </div>
</div>
<div class="ordermain3 box"></div>

<!--订单信息E-->

<? $lii++;}?>
<!--循环E-->

<div class="ordermain1 box"><div class="d1"></div><div class="d2">沟通记录</div></div>
<div class="jflist box">
 <div class="jfgtlist">
  <? 
  $i=1;
  while1("*","yjcode_orderlog where zuorderbh='".$zuorderbh."' and selluserid=".$userid." order by sj desc");while($row1=mysqli_fetch_array($res1)){
  $txt=$row1[txt];
  if($row1[admin]==1){$tp=returntppd("../../upload/".$row1[userid]."/user.jpg","../../user/img/nonetx.gif");$sf="买方";}
  elseif($row1[admin]==2){$tp=returntppd("../../upload/".$row1[selluserid]."/user.jpg","../../user/img/nonetx.gif");$sf="卖方";}
  elseif($row1[admin]==3){$tp="../../user/img/nonetx.jpg";$sf="平台";}
  ?>
  <ul class="u1<? if($i==1){?> u0<? }?>">
  <li class="l1"><img src="<?=$tp?>" width="40" /></li>
  <li class="l2">[<?=$sf?>] <?=$txt?><br><?=$row1[sj]?></li>
  </ul>
  <? $i++;}?>
 </div>
</div>

<? if($ifztcontrol==1){?>
<!--状态B-->
<? 
 $cz="";
 if($row[ddzt]=="suc"){ //交易成功
 
 }elseif($row[ddzt]=="wait"){ //等待发货
 $cz="<a href='fahuo.php?zuorderbh=".$row[zuorderbh]."' class='a1'>发货</a>";
 $cz=$cz."<a href='sellclose.php?zuorderbh=".$row[zuorderbh]."'>取消订单</a>";
 
 }elseif($row[ddzt]=="back"){ //退款处理中
 $cz="<a href='selltk.php?zuorderbh=".$row[zuorderbh]."'>处理退款</a>";
 
 }elseif($row[ddzt]=="backsuc"){ //退款成功
 $cz="";

 }elseif($row[ddzt]=="db"){ //担保中

 }elseif($row1[ddzt]=="wpay"){ //等待买家付款

 }elseif($row[ddzt]=="jf"){ //纠纷处理中 
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";

 }elseif($row[ddzt]=="jfbuy"){ //买家胜诉 
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";

 }elseif($row[ddzt]=="jfsell"){ //卖家胜诉 
 $cz="<a href='orderjf2.php?zuorderbh=".$row[zuorderbh]."'>沟通</a>";
  
 }
?>
<? if(!empty($cz)){?>
<div class="ordermain4fd">
<div class="ordermain4 box">
 <div class="d1"><?=$cz?></div>
</div>
</div>
<div class="ordermain4fdv"></div>
<? }?>
<!--状态E-->
<? }?>
