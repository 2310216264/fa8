<div class="yjcode">

<? adwhile("ADP04");?>

<!--主体B-->
<div class="zhuti1">
 <ul class="u1">
 <li class="l1"><h1><?=$row[tit]?></h1></li>
 <li class="l2">
 <span class="s0"><?=returntype(1,$row[ty1id])?></span>
 <? if(!empty($row[ty2id])){?>
 <span class="s1"><?=returntype(2,$row[ty2id])?></span>
 <? }?>
 </li>
 <li class="l3">简介：<?=returnjgdw($row[wdes],"",$row[tit])?></li>
 </ul>
 <div class="d1">
 <? 
 $a1="none";$a2="none";
 if(empty($nuid)){$a1="";}else{
  if(panduan("probh,userid","yjcode_profav where probh='".$row[bh]."' and userid=".$nuid)==1){$a2="";}else{$a1="";}
 }
 ?>
 <a id="favpno" style="display:<?=$a1?>;" href="javascript:void(0);" onClick="profavInto('<?=$row[bh]?>','')">收藏</a></li>
 <a id="favpyes" style="display:<?=$a2?>;" href="../user/favpro.php">已收藏</a></li>
 </div>
 <ul class="u2">
 <li class="l1">价格：</li>
 <li class="l2">￥</li>
 <li class="l3">
 <span id="nowmoney"><?=returnwan($nowmoney)?></span><span id="nowmoneyY" style="display:none;"><?=$nowmoney?></span>
 <input type="text" style="display:none;" id="tkcnum" value="1" />
 <span id="nowkcnum" style="display:none;"><?=$row[kcnum]?></span>
 <span class="s1" style="display:none;" id="zhekou"><? if(!empty($row[money1])){echo sprintf("%.1f",$nowmoney/$row[money1]*10)."折";}else{echo "无折扣";}?></span>
 <s id="yuanjia" style="display:none;">￥<?=returnjgdian($row[money1])?></s>
 </li>
 <li class="l4">一键分享：</li>
 <li class="l5">
 <? 
 $fxurl=weburl."product/view".$row[id].".html";
 $fxtit=$row[tit];
 include("../tem/fenxiang.php");
 ?>
 </li>
 </ul>
 
 <? 
 if(2==$row[yhxs] && $sj<=$row[yhsj2]){
 if($sj<$row[yhsj1]){$a=1;}else{$a=2;}
 ?>
 <span id="nyhsj1" style="display:none;"><?=str_replace("-","/",$row[yhsj1])?></span>
 <span id="nyhsj2" style="display:none;"><?=str_replace("-","/",$row[yhsj2])?></span>
 <span id="nmoney2" style="display:none;"><?=returnjgdian($row[money2])?></span>
 <span id="nmoney3" style="display:none;"><?=returnjgdian($row[money3])?></span>
 <span id="nowsj" style="display:none;"><?=str_replace("-","/",$sj)?></span>
 <ul class="uxianshi" id="xsyh">
 <li class="l1">促销：</li>
 <li class="l2"><span class="s1"><?=$row[yhsm]?></span><span class="s2">(促销将于<span id="yhsjv"></span>)</span></li>
 </ul>
 <script language="javascript" src="yhsj.js"></script>
 <script language="javascript">yhsj(<?=$a?>);</script>
 <? }?>

   <!--套餐B-->
   <? $alli=returncount("yjcode_taocan where admin is null and zt=0 and probh='".$row[bh]."'");if($alli>0){?>
   <div id="tcnum" style="display:none;"><?=$alli?></div>
   <ul class="utc" id="utc1">
   <li class="l1">套餐</li>
   <li class="l2">
   <? 
   $i=1;
   $ja=0;
   while1("*","yjcode_taocan where admin is null and zt=0 and probh='".$row[bh]."' order by xh asc");while($row1=mysqli_fetch_array($res1)){
   if(empty($row1[fhxs])){$k=$row[kcnum];}else{$k=$row1[kcnum];}
   if($i==1){$ja=$row1[id];}
   $bgtp="../upload/".$row1[userid]."/".$row1[probh]."/tc".$row1[id].".png";
   $smalltp="../upload/".$row1[userid]."/".$row1[probh]."/tc".$row1[id]."-1.png";
   $tit="";
   if(!is_file($bgtp) || !is_file($smalltp)){$tit=$row1[tit];$bgtp="";$smalltp="";}
   $oncj="taocanonc(".$i.",".$alli.",".$row1[money1].",".$row1[money2].",".$row1[id].",".sprintf("%.1f",$row1[money1]/$row1[money2]*10).",".$k.",'".$bgtp."')";
   ?>
   <a href="javascript:void(0);" id="taocana<?=$i?>" style="background:url(<?=$smalltp?>) center center no-repeat;" title="<?=$row1[tit]?>" onClick="<?=$oncj?>"><?=$tit?></a>
   <? $i++;}?>
   </li>
   </ul>
   
   <?
   while1("*","yjcode_taocan where admin is null and zt=0 and probh='".$row[bh]."' order by xh asc");while($row1=mysqli_fetch_array($res1)){
   $alli2=returncount("yjcode_taocan where admin=2 and zt=0 and tit='".$row1[tit]."' and probh='".$row[bh]."'");if($alli2>0){
   $i=1;
   ?>
   <span id="tc2num<?=$row1[id]?>" style="display:none;"><?=$alli2?></span>
   <ul class="utc" id="tc2div<?=$row1[id]?>" style="display:none;">
   <li class="l1">选择</li>
   <li class="l2">
   <? 
   while2("*","yjcode_taocan where admin=2 and zt=0 and tit='".$row1[tit]."' and probh='".$row[bh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){
   if(empty($row2[fhxs])){$k=$row[kcnum];}else{$k=$row2[kcnum];}
   $bgtp="../upload/".$row2[userid]."/".$row2[probh]."/tc".$row2[id].".png";
   $smalltp="../upload/".$row2[userid]."/".$row2[probh]."/tc".$row2[id]."-1.png";
   $tit="";
   if(!is_file($bgtp) || !is_file($smalltp)){$tit=$row2[tit2];$bgtp="";$smalltp="";}
   ?>
   <a href="javascript:void(0);" id="taocan2a<?=$row1[id]?>_<?=$i?>" title="<?=$row2[tit2]?>" style="background:url(<?=$smalltp?>) center center no-repeat;" onClick="taocan2onc(<?=$i?>,<?=$alli2?>,<?=$row2[money1]?>,<?=$row2[money2]?>,<?=$row2[id]?>,<?=sprintf("%.1f",$row2[money1]/$row2[money2]*10)?>,<?=$k?>,'<?=$bgtp?>')"><?=$tit?></a>
   <? $i++;}?>
   </li>
   </ul>
   <? }}?>
   
   <script language="javascript">pretc1id=<?=$ja?>;</script>
   <? }?>
   <!--套餐E-->

 <ul class="u3">
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
   <li class="l<?=$i?>"><span><?=$sx1arr[$i]?></span><br><? $b=preg_split("/xcf/",$sxall);for($j=0;$j<=count($b);$j++){if(check_in($sx1arr[$i],$b[$j])){echo str_replace($sx1arr[$i].":","",$b[$j])." ";}}?></li>
   <? }?>
 </ul>
 <div class="d2">
   <? if(empty($row[ifxj])){?>
   
   <a href="javascript:void(0);" onClick="buyInto('<?=$row[bh]?>')" class="buy">立即购买</a>
   <? 
   $a1="none";$a2="none";
   if($_SESSION["SHOPUSER"]==""){$a1="";}else{
	if(panduan("probh,userid","yjcode_car where probh='".$row[bh]."' and userid=".$nuid)==1){$a2="";}else{$a1="";}
   }
   ?>
   <a href="javascript:void(0);" onClick="carInto('<?=$row[bh]?>','')" id="carpno" style="display:<?=$a1?>;" class="car">加入购物车</a>
   <a href="../user/car.php" id="carpyes" style="display:<?=$a2?>;" class="car">已在购物车</a>
   <? if(!empty($row[ysweb])){?><a href="../tem/gotourl.php?u=<?=$row[ysweb]?>" target="_blank" rel="nofollow" class="ysweb">查看演示</a><? }?>
   
   <? }else{?>
   <a href="javascript:void(0);" class="buy">商品已下架</a>
   <? }?>
 </div>
</div>
<!--主体E-->

 <!--店主B-->
 <? $xy=returnjgdw($rowsell[xinyong],"",returnxy($row[userid],1));?>
 <div class="proshop">
  <ul class="u1">
  <li class="l1">联系掌柜</li>
  <li class="l2"><img src="<?="../upload/".$rowsell[id]."/shop.jpg";?>" /></li>
  <li class="l3"><?=$rowsell[shopname]?></li>
  <li class="l4"><a href="<?=returnmyweb($rowsell[id],$rowsell[myweb])?>" target="_blank">我的店铺</a></li>
  <li class="l31">商家信誉：</li>
  <li class="l41"><img src="../img/dj/<?=returnxytp($xy)?>" title="信用值<?=$xy?>" /></li>
  <li class="l51">商家认证：</li>
  <li class="l61">
  <? if(1==$rowsell["ifemail"]){?><img src="../img/rz1.gif" title="邮箱已绑定" /><? }?>
  <? if(1==$rowsell["ifmot"]){?><img title="手机号码已绑定" src="../img/rz2.gif" /><? }?>
  <? if(1==$rowsell["sfzrz"]){?><img title="身份证已认证" src="../img/rz3.gif" /><? }?>
  </li>
  <li class="l71">认证类型：</li>
  <li class="l81"><?=returnqylx($rowsell[kdlx],$rowsell[zzrz])?></li>
  <? if(!empty($rowsell[uqq])){?>
  <li class="l71">QQ 号码：</li>
  <li class="l81"><a href="javascript:void(0);" onClick="opentangqq('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)"><?=$rowsell[uqq]?></a></li>
  <? }?>
  <? if(!empty($rowsell[weixin])){?>
  <li class="l71">微信号码：</li>
  <li class="l81"><a href="javascript:void(0);" onClick="opentangqq('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)">点击查看微信</a></li>
  <? }?>
  </ul>
 </div>
 <!--店主E-->

 <!--下方B-->
 <ul class="ucap">
 <li class="l1 g_bc0_h" id="bqcap1" onClick="bqonc(1)">商品详情</li>
 <? $videonum=returncount("yjcode_provideo where probh='".$row[bh]."' and zt=0");if($videonum>0){?>
 <li class="l0" id="bqcap4" onClick="bqonc(4)">视频查看 <strong><?=$videonum?></strong></li>
 <? }?>
 <li class="l0" id="bqcap2" onClick="bqonc(2)">累计评价 <strong><? $allpj=returncount("yjcode_order where probh='".$row[bh]."' and admin=2 and ifpj=1");echo $allpj;?></strong></li>
 <li class="l0" id="bqcap5" onClick="bqonc(5)">商品问答</li>
 <li class="l0" id="bqcap3" onClick="bqonc(3)">交易规则</li>
 </ul>
 <div class="viewtxt" id="bqdiv1">
 
 <!--正文介绍B-->
 <div class="probqm">
 <ul class="probq">
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
 <li class="l1"><?=$sx1arr[$i]?>：</li><li class="l2"><? $b=preg_split("/xcf/",$sxall);for($j=0;$j<=count($b);$j++){if(check_in($sx1arr[$i],$b[$j])){echo str_replace($sx1arr[$i].":","",$b[$j])." ";}}?></li>
 <? }?>
 </ul>
 </div>
 <?=$row[txt]?>
 <!--正文介绍E-->
 </div>
 
 <? if($videonum>0){?>
 <div id="bqdiv4">
  <ul class="bqcap">
  <li class="l1">视频展示</li>
  </ul>
  <div class="videomain">
  
  <div class="videofr"><iframe name="videofr" id="videofr" marginwidth="1" scrolling="no" marginheight="1" width="100%" height="470px" border="0" frameborder=0 src="../video/index.php?bh=<?=$row[bh]?>&w=851"></iframe></div>
  <div class="videolist">
  <? $i=1;while1("*","yjcode_provideo where zt=0 and probh='".$row[bh]."' order by sj desc");while($row1=mysqli_fetch_array($res1)){?>
  <a href="javascript:void(0);" onClick="videodian(<?=$row1[id]?>,<?=$i?>)"<? if($i==1){?> class="a1"<? }?> id="videoa<?=$i?>"><span><?=$i?>、</span><?=$row1[tit]?></a>
  <? $i++;}?>
  <span id="videoall" style="display:none;"><?=$i?></span>
  </div>
  
  </div>
 </div>
 <? }?>
 
 <div id="bqdiv2">
 <a name="pj"></a>
 <ul class="bqcap">
 <li class="l1">商品评价</li>
 </ul>
 <ul class="pjcap">
 <li class="l2">描述相符<br><strong><?=$row[pf1]?></strong></li>
 <li class="l2">发货速度<br><strong><?=$row[pf2]?></strong></li>
 <li class="l2">服务态度<br><strong><?=$row[pf3]?></strong></li>
 <li class="l2">综合评分<br><strong><?=round(($row[pf1]+$row[pf2]+$row[pf3])/3,2)?></strong></li>
 <li class="l3"><a href="../user/order.php?ddzt=suc">写评价赚积分</a></li>
 </ul>
 <div class="pjlist">
 <? 
 while1("*","yjcode_order where probh='".$row[bh]."' and admin=2 and ifpj=1 order by sj desc limit 10");while($row1=mysqli_fetch_array($res1)){
 $usertx="../upload/".$row1[userid]."/user.jpg";
 if(!is_file($usertx)){$usertx="../user/img/nonetx.gif";}else{$usertx=$usertx."?id=".rnd_num(1000);} 
 ?>
 <div class="pj pj<?=$row1[pjlx]?>">
  <ul class="u1"><li class="l1"><img src="<?=$usertx?>" width="50" height="50" /></li><li class="l2"><?=returnjiami(returnnc($row1[userid]))?></li></ul>
  <ul class="u2">
  <li class="l1">
  <?=$row1[pjtxt]?><br>
  <? if(1==$row1[ifpjvideo]){?>
  <a href="<?="../upload/".$row1[userid]."/".$row1[zuorderbh]."/video.mp4"?>" target="_blank"><img src="../img/video.jpg" width="50" height="50" /></a>&nbsp;&nbsp;
  <? }?>
  <? 
  if(1==$row1[ifpjtp]){
  while2("*","yjcode_tp where bh='".$row1[zuorderbh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){$tp="../".str_replace(".","-1.",$row2[tp]);
  ?>
  <a href="../<?=$row2[tp]?>" target="_blank"><img src="<?=$tp?>" width="50" height="50" /></a>&nbsp;&nbsp;
  <? }}?>
  </li>
  <? if(!empty($row1[hftxt])){?><li class="l2">卖家回复：<?=$row1[hftxt]?></li><? }?>
  <li class="l3"><?=$row1[pjsj]?></li>
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
 </div>
 <div class="allpj"><a href="pjlist_i<?=$row[id]?>v.html" target="_blank">查看全部评价</a></div>
 </div>
 
 <!--问答B-->
 <div id="bqdiv5">
  <ul class="bqcap">
  <li class="l1">商品问答</li>
  </ul>
  <? while1("*","yjcode_wenda where probh='".$row[bh]."' and (hftxt<>'') order by sj desc limit 10");while($row1=mysqli_fetch_array($res1)){?>
  <div class="wdlist">
   <ul class="u1">
   <li class="l1"><span>问</span></li>
   <li class="l2"><?=$row1[txt]?></li>
   <li class="l3"><?=returnjiami(returnnc($row1[userid]))?> <?=$row1[sj]?></li>
   </ul>
   <? if(!empty($row1[hftxt])){?>
   <ul class="u2">
   <li class="l1"><span>答</span></li>
   <li class="l2"><?=$row1[hftxt]?></li>
   <li class="l3">商家 <?=$row1[hfsj]?></li>
   </ul>
   <? }?>
  </div>
  <? }?>
  <div class="wenda1">
  <a href="javascript:void(0);" onClick="wendaonc(<?=$row[id]?>)" class="a1">提交咨询问题</a>
  <a href="wdlist_i<?=$row[id]?>v.html" target="_blank">共有<? $a=returncount("yjcode_wenda where probh='".$row[bh]."' and hftxt<>''");echo $a?>条问答 / 点击查看更多>></a>
  </div>
 </div>
 <!--问答E-->
 
 <div id="bqdiv3">
  <ul class="bqcap">
  <li class="l1">交易规则</li>
  </ul>
  <div class="viewtxt fontyh">
  <? 
  while1("*","yjcode_type where id=".intval($row[ty1id]));if($row1=mysqli_fetch_array($res1)){$gz=$row1[jygz];}
  if(empty($gz)){
   while1("*","yjcode_onecontrol where tyid=9");if($row1=mysqli_fetch_array($res1)){$gz=$row1[txt];}
  }
  echo $gz;
  ?>
  </div>
 </div>
 
 <!--下方E-->

</div>
