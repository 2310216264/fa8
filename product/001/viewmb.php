<script type="text/javascript" src="default/jquery-plugin-slide.js"></script>
<script type="text/javascript" src="../js/lyz.delayLoading.min.js"></script>
<div class="bfb bfbmain fontyh">
<div class="yjcode">

 <? adwhile("ADP04");?>

 <div class="dqwz">
 <ul class="u1">
 <li class="l1">
 当前位置：<a href="<?=weburl?>">首页</a> > <a href="search_j<?=$row[ty1id]?>v.html"><?=returntype(1,$row[ty1id])?></a>
 <? if(0!=$row[ty2id]){?> > <a href="search_j<?=$row[ty1id]?>v_k<?=$row[ty2id]?>v.html"><?=returntype(2,$row[ty2id])?></a><? }?>
 <? if(0!=$row[ty3id]){?> > <a href="search_j<?=$row[ty1id]?>v_k<?=$row[ty2id]?>v_m<?=$row[ty3id]?>v.html"><?=returntype(3,$row[ty3id])?></a><? }?>
 </li>
 </ul>
 </div>

 <div class="protit">
  <span class="s1">本站</span>
  <span class="s2">精选</span>
  <h1><?=$row[tit]?></h1>
  <? if($row[fhxs]==2 || $row[fhxs]==3 || $row[fhxs]==4){?><span class="s3"><img src="img/fh.gif" title="购买后自动发货" /></span><? }?>
 </div>

 <div class="userinf">
  <? if(1==$rowsell[sfzrz]){?><span class="s1">已认证</span><? }?>
  <a href="<?=returnmyweb($rowsell[id],$rowsell[myweb]);?>" target="_blank" class="a1"><?=$rowsell[shopname]?></a>
  <? $sucnum=returnjgdw($rowsell[xinyong],"",returnxy($rowsell[id],1));?>
  <span class="s2"><img src="../img/dj/<?=returnxytp($sucnum)?>" title="信用值<?=$sucnum?>" /></span>
 </div>

 <!--左B-->
 <div class="mainleft">
  <? while3("*","yjcode_provideo where probh='".$row[bh]."' and zt=0 and iftj=1");if($row3=mysqli_fetch_array($res3)){$provideo=1;}else{$provideo=0;}?>
  <? if(empty($provideo)){?>
  <!--切换B-->
  <div class="protp">
   <div class ='Homeslide' >
   <div class ='Homeslide_bigwrap'>
    <div class='Homeslide_hand0'></div>
    <div class='Homeslide_hand1'></div>
    <div class='Homeslide_bigpicdiv'><a href='../tp/showpic.php?bh=<?=$row[bh]?>' target="_blank"><img src=""></a></div>
   </div>
   <div class='Homeslide_thumb' style="display:none;"><ul></ul></div>
   </div>
   <script type="text/javascript">
   var home_slide_data = 
   [
   <? $tpses="yjcode_tp where bh='".$row[bh]."' order by xh asc";$i=1;while1("*",$tpses);while($row1=mysqli_fetch_array($res1)){?>
   <? if($i>1){?>,<? }?>{"title":"","onc":"","image":"<?=returnnotp($row1[tp],"")?>","thumb":"<?=returnnotp($row1[tp],"-1")?>","mark":"<?=$i?>"}
   <? $i++;}?>
   ]; 
   $('.Homeslide').homeslide(home_slide_data,false,3000);
   </script>
  </div>
  <!--切换E-->
  <? }else{?>
  <!--视频B-->
  <div class="provideo"><iframe name="videofr" id="videofr" marginwidth="1" marginheight="1" width="100%" height="600" border="0" frameborder=0 src="../video/index.php?bh=<?=$row[bh]?>&w=778&h=598&id=<?=$row3[id]?>"></iframe></div>
  <!--视频E-->
  <? }?>
  
  <? $protxt=$row[txt];if(!empty($protxt)){?>
  <div class="leftcap">商品详情</div>
  <div class="jubao"><a href="javascript:void();" onClick="jbtang(1,<?=$row[id]?>)">举报</a></div>
  <div class="lefttxt">
  <? if(check_in("video",$row[txt])){?>
  <link href="../config/ueditor/third-party/video-js/video-js.min.css" rel="stylesheet" type="text/css" />
  <script language="javascript" src="../config/ueditor/third-party/video-js/video.dev.js"></script>
  <? }?>
  <?=$protxt?>
  </div>
  <? }?>
  
 </div>
 <!--左E-->
 
 <!--右B-->
 <div class="mainright">
  
  <? if(1==$row[ifuserdj]){?>
  <div id="vipmoney" style="display:none;">
  <ul class="djmcap">
  <li class="l1">等级名称</li>
  <li class="l2">享受折扣</li>
  <li class="l3">折后价</li>
  </ul>
  <? 
  while1("*","yjcode_userdj where zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){
  while2("*","yjcode_prouserdj where probh='".$row[bh]."' and djname='".$row1[name1]."'");if($row2=mysqli_fetch_array($res2)){$zhekou=$row2[zhi];}else{$zhekou=$row1[zhekou];}
  if($zhekou==10){$zhekouv="无";}elseif($zhekou==0){$zhekouv="--";}else{$zhekouv=$zhekou;}
  ?>
  <ul class="djm">
  <li class="l1"><?=$row1[name1]?></li>
  <li class="l2"><?=$zhekouv?></li>
  <li class="l3"><?=sprintf("%.2f",$nowmoney*$zhekou/10)?>元</li>
  </ul>
  <? }?>
  <ul class="djkt">
  <li class="l1"><a href="../user/userdj.php" target="_blank">开通会员等级</a></li>
  <li class="l2">说明：如果您已经开通会员等级，商品结算时会自动计算折后价。</li>
  </ul>
  </div>
  <? }?>

  <!--右1B-->
  <div class="mr0">
   <? if(!empty($rowsell[uqq])){?>
   <a href="javascript:void(0);" onClick="opentangqq('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)" class="a1 qq">QQ咨询</a>
   <? }?>
   <? if(!empty($rowsell[weixin])){?>
   <a href="javascript:void(0);" onClick="opentangqq('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)" class="a1 wx">微信联系</a>
   <? }?>
   <? if(!empty($row[ysweb])){?><a href="../tem/gotourl.php?u=<?=$row[ysweb]?>" target="_blank" rel="nofollow" class="a1 ys">查看演示</a><? }?>
  </div>
  
  <div class="mr1">
  <div class="d1">
  价格：<span id="nowmoney"><?=$nowmoney?></span>元<span id="nowmoneyY" style="display:none;"><?=$nowmoney?></span>
  <span id="zhekou" style="display:none;"><? if(!empty($row[money1])){echo sprintf("%.1f",$nowmoney/$row[money1]*10)."折";}else{echo "无折扣";}?></span>
  <s id="yuanjia" style="display:none;">￥<?=returnjgdian($row[money1])?></s>
  [<a href="../user/pay.php" target="_blank" class="g_ac3">充值</a>]
  </div>
  <? 
  if(2==$row[yhxs] && $sj<=$row[yhsj2]){
  if($sj<$row[yhsj1]){$a=1;}else{$a=2;}
  ?>
  <span id="nyhsj1" style="display:none;"><?=str_replace("-","/",$row[yhsj1])?></span>
  <span id="nyhsj2" style="display:none;"><?=str_replace("-","/",$row[yhsj2])?></span>
  <span id="nmoney2" style="display:none;"><?=returnjgdian($row[money2])?></span>
  <span id="nmoney3" style="display:none;"><?=returnjgdian($row[money3])?></span>
  <span id="nowsj" style="display:none;"><?=str_replace("-","/",$sj)?></span>
  <ul class="u5" id="xsyh">
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
   
   <ul class="u6">
   <li class="l1"><input type="text" onChange="moneycha()" id="tkcnum" value="1" /></li>
   <li class="l2"><a href="javascript:void(0);" onClick="shujia()" class="a1">+</a><a href="javascript:void(0);" onClick="shujian()" class="a2">-</a></li>
   </ul>
   <ul class="u4">
   <li class="l1">
   <? if(empty($row[ifxj])){?>
   
   <a href="javascript:void(0);" onClick="buyInto('<?=$row[bh]?>')" class="buy g_bg0">立即购买</a>
   <? 
   $a1="none";$a2="none";
   if($_SESSION["SHOPUSER"]==""){$a1="";}else{
	if(panduan("probh,userid","yjcode_car where probh='".$row[bh]."' and userid=".$nuid)==1){$a2="";}else{$a1="";}
   }
   ?>
   <a href="javascript:void(0);" onClick="carInto('<?=$row[bh]?>','')" id="carpno" style="display:<?=$a1?>;" class="car g_bc0_h">加入购物车</a>
   <a href="../user/car.php" id="carpyes" style="display:<?=$a2?>;" class="car carok">已在购物车</a>
   
   <? }else{?>
   <a href="javascript:void(0);" class="buy g_bg0">商品已下架</a>
   <? }?>

   </li>
   </ul>
   <? if(1==$row[ifuserdj]){?><div class="dvip" onClick="djmonc()">查看会员价格</div><? }?>
   <ul class="u1">
   <li class="l1">库存：<span id="nowkcnum"><?=$row[kcnum]?></span> 件</li>
   <li class="l2">销量：<span class="feng"><?=$row[xsnum]?></span> 件</li>
   </ul>
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
   <li class="l1"><?=$sx1arr[$i]?>：<? $b=preg_split("/xcf/",$sxall);for($j=0;$j<=count($b);$j++){if(check_in($sx1arr[$i],$b[$j])){echo str_replace($sx1arr[$i].":","",$b[$j])." ";}}?></li>
   <? }?>
   </ul>
   
  </div>
  <!--右1E-->
  
  <? if(empty($rowcontrol[fenxiang])){?>
  <div class="mrfx">
  <? 
  $fxurl=weburl."product/view".$row[id].".html";
  $fxtit=$row[tit];
  $fxtp=returntp("bh='".$row[bh]."' order by xh asc","-1");
  include("../tem/fenxiang.php");
  ?>
  </div>
  <? }?>
  
  <!--右2B-->
  <div class="mr2">
   <ul class="u1"><li class="l1">同分类商品</li><li class="l2"><a href="../shop/prolist_i<?=$row[userid]?>v_j<?=$row[ty1id]?>v.html" target="_blank" class="g_bg0">查看更多</a></li></ul>
   <? 
 $sqltj="select * from yjcode_pro where ty1id=".$row[ty1id]." and userid=".$row[userid]." and ty2id=".$row[ty2id]." and zt=0 and ifxj=0 order by rand() limit 12";
 mysqli_set_charset($conn,"utf8");
   $restj=mysqli_query($conn,$sqltj);
   for($tji=1;$tji<=4;$tji++){
   if($rowtj=mysqli_fetch_array($restj)){
   $tp=returntp("bh='".$rowtj[bh]."' order by xh asc","-1");
   $money1=returnyhmoney($rowtj[yhxs],$rowtj[money2],$rowtj[money3],$sj,$rowtj[yhsj1],$rowtj[yhsj2],$rowtj[id]);
   $au="view".$rowtj[id].".html";
   ?>
   <ul class="u2">
   <li class="l1"><a href="<?=$au?>" target="_blank"><img src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'" /></a></li>
   <li class="l2"><span class="s1">￥<?=$money1?></span> <a href="<?=$au?>" target="_blank"><?=$rowtj[tit]?></a></li>
   </ul>
   <? }}?>
   <div class="allm"><a href="../shop/view<?=$row[userid]?>.html" target="_blank">查看更多</a></div>
  </div>
  <!--右2E-->
  
  <!--右3B-->
  <div class="mr3">
   <div class="d1">推荐分类：</div>
   <? while1("*","yjcode_type where admin=2 and type1='".$ty1name."' order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
   <a href="search_j<?=$row[ty1id]?>v_k<?=$row1[id]?>v.html"><?=$row1[type2]?></a>
   <? }?>
  </div>
  <!--右3E-->
  
 </div>
 <!--右E-->
 
</div>
</div>

<div class="tjbfb bfb">
<div class="yjcode">
 <div class="tjcap">相关推荐</div>
 <? 
 $i=1;
 $sqltj="select * from yjcode_pro where ty1id=".$row[ty1id]." and ty2id=".$row[ty2id]." and zt=0 and ifxj=0 order by rand() limit 8";
 mysqli_set_charset($conn,"utf8");$restj=mysqli_query($conn,$sqltj);
 while($rowtj=mysqli_fetch_array($restj)){
 $tp=returntp("bh='".$rowtj[bh]."' order by xh asc","-1");
 $money1=returnyhmoney($rowtj[yhxs],$rowtj[money2],$rowtj[money3],$sj,$rowtj[yhsj1],$rowtj[yhsj2],$rowtj[id]);
 $au="view".$rowtj[id].".html";
 ?>
 <ul class="u1<? if($i % 4==0){echo " u0";}?>">
 <li class="l1"><a href="<?=$au?>" target="_blank"><img src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'" /></a></li>
 <li class="l2"><a href="<?=$au?>" target="_blank" title="<?=$rowtj[tit]?>"><?=strgb2312($rowtj[tit],0,28);?></a></li>
 <li class="l3"><?=$rowtj[djl]?></li>
 <li class="l4"><?=$rowtj[xsnum]?></li>
 <li class="l5"><?=$money1?>元</li>
 </ul>
 <? $i++;}?>
</div>
</div>

