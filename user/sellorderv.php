 <? 
 $sqlbuy="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$resbuy=mysqli_query($conn,$sqlbuy);
 $rowbuy=mysqli_fetch_array($resbuy);
 ?>
 
 <div class="orderv1">
 
  <ul class="u1">
  <li class="l1">下单时间：<?=$row[sj]?></li>
  <li class="l2"><span>订单编号：<?=$zuorderbh?></span></li>
  <li class="l3"><span class="s1">订单实付款<? if(!empty($row[yunfei])){echo "(含运费<font class='red'>".$row[yunfei]."</font>元)";}?></span><span class="s2"><?=returnjgdian($row[allmoney3])?></span></li>
  <li class="l4" style="display:none;"><span class="s1">已优惠金额</span><span class="s2"><?=$row[allmoney2]?></span></li>
  <? if($row[ddzt]=="back" || $row[ddzt]=="backsuc" || $row[ddzt]=="backerr" || $row[ddzt]=="jfbuy" || $row[ddzt]=="jfsell" || $row[ddzt]=="jf"){?>
  <li class="l4"><span class="s1">申请退款金额</span><span class="s2"><?=$row[tkmoney]?></span></li>
  <? }?>
  <li class="l5"><span class="s1">订单状态</span><span class="s2"><?=returnorderzt($row[ddzt])?></span></li>
  <li class="l6">
   <span class="s1">买家 [<strong><?=$rowbuy[nc]?></strong>]</span>
   <? if(!empty($rowbuy[uqq])){?><a href="javascript:void(0);" onclick="opentangqq('<?=$rowbuy[uqq]?>','<?=$rowbuy[weixin]?>',<?=$rowbuy[id]?>)" class="s2"><?=$rowbuy[uqq]?></a><? }?>
   <? if(!empty($rowbuy[mot])){?><span class="s3"><?=$rowbuy[mot]?></span><? }?>
  </li>
  </ul>

  <? if(!empty($ifztcontrol)){?>
  <!--状态说明B-->
  <div class="ztcontrol">
   <div class="d1"></div>
   <div class="d2">
   
    <? if($row[ddzt]=="wait"){?>
    <div class="ds1">买家已经付款了，请尽快发货。</div>
    <div class="ds3">
    <a href="fahuo.php?zuorderbh=<?=$zuorderbh?>" class="a1">发货</a>
    <a href="sellclose.php?zuorderbh=<?=$zuorderbh?>" class="a0">取消订单</a>
    </div>
    <? }?>
    
    <? if($row[ddzt]=="close"){?>
    <div class="ds1">您在 <?=$row[closesj]?> 取消了该笔订单。</div>
    <div class="ds2">买家支付的款项已经退回其会员账号。</div>
    <? }?>
    
    <? if($row[ddzt]=="suc"){?>
    <div class="ds1">恭喜您，该笔订单已经交易成功。</div>
    <div class="ds2"><strong>提醒：</strong>如果还需要该商品，请点<a href="<?=$au?>" target="_blank">再次购买</a>。</div>
    <? }?>
    
    <? if($row[ddzt]=="backsuc"){?>
    <div class="ds1">您于 <?=$row[tkoksj]?> 同意了买家的退款申请，款项已经退回到买家账户中。</div>
    <div class="ds2">处理说明：<?=returnjgdw($row[tkjg],"","同意退款")?></div>
    <? }?>
    
    <? 
	if($row[ddzt]=="backerr"){
    $second=$row[tkautosj]-strtotime($sj);
    $day = floor($second/(3600*24));
    $second = $second%(3600*24);//除去整天之后剩余的时间
    $hour = floor($second/3600);
    $second = $second%3600;//除去整小时之后剩余的时间 
    $minute = floor($second/60);
    $second = $second%60;//除去整分钟之后剩余的时间 
    $sjcv=$day."天".$hour."时".$minute."分".$second."秒";
    ?>
    <div class="ds1">您于 <?=$row[tkclsj]?> 拒绝了买家的退款申请。</div>
    <div class="ds2">资金担保剩余：<?=$sjcv?></div>
    <? }?>
    
    <? 
	if($row[ddzt]=="back"){
    $second=$row[tkautosj]-strtotime($sj);
    $day = floor($second/(3600*24));
    $second = $second%(3600*24);//除去整天之后剩余的时间
    $hour = floor($second/3600);
    $second = $second%3600;//除去整小时之后剩余的时间 
    $minute = floor($second/60);
    $second = $second%60;//除去整分钟之后剩余的时间 
    $sjcv=$day."天".$hour."时".$minute."分".$second."秒";
    ?>
    <div class="ds1">退款需要处理，您需要在 <?=$sjcv?> 内处理该订单的退款申请。</div>
    <div class="ds2">如果超时未处理，系统会自动判断为您同意了退款申请。</div>
    <div class="ds3">
    <a href="selltk.php?zuorderbh=<?=$zuorderbh?>" class="a1">处理退款</a>
    </div>
    <? }?>
    
    <? 
	if($row[ddzt]=="db"){
    $second=$row[dbautosj]-strtotime($sj);
    $day = floor($second/(3600*24));
    $second = $second%(3600*24);//除去整天之后剩余的时间
    $hour = floor($second/3600);
    $second = $second%3600;//除去整小时之后剩余的时间 
    $minute = floor($second/60);
    $second = $second%60;//除去整分钟之后剩余的时间 
    $sjcv=$day."天".$hour."时".$minute."分".$second."秒";
	?>
    <div class="ds1">您已发货，等待买家确认收货。</div>
    <div class="ds2">资金担保剩余时间：<?=$sjcv?></div>
    <? }?>

    <? if($row[ddzt]=="jf"){?>
    <div class="ds1">买家申请了平台介入处理本次退款纠纷，处理过程中资金将被冻结，直至处理完毕。您可以提交更有利于您的证据。</div>
    <div class="ds3"><a href="orderjf2.php?zuorderbh=<?=$zuorderbh?>" class="a1">查看记录</a></div>
    <? }?>

    <? if($row[ddzt]=="jfbuy"){?>
    <div class="ds1">平台已经判定本次交易纠纷为买家胜诉，款项已经退回到买家的账户。</div>
    <div class="ds3"><a href="orderjf2.php?zuorderbh=<?=$zuorderbh?>" class="a0">查看沟通记录</a></div>
    <? }?>

    <? if($row[ddzt]=="jfsell"){?>
    <div class="ds1">平台已经判定本次交易纠纷为您胜诉，款项已经自动结算至您的账户。</div>
    <div class="ds3"><a href="orderjf2.php?zuorderbh=<?=$zuorderbh?>" class="a0">查看沟通记录</a></div>
    <? }?>
    
   </div>
  </div>
  <!--状态说明E-->
  <? }?>

  <? if($row[fhxs]==5){?>
  <div class="dtit">物流快递信息：</div>
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">已收运费：</td>
  <td class="td2"><?=$row[yunfei]?>元</td>
  </tr>
  </table>
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">收货信息：</td>
  <td class="td2"><?=$row[shdz]?></td>
  </tr>
  </table>
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">发货信息：</td>
  <td class="td2">
  <? if(!empty($row[kdid])){while1("*","yjcode_kuaidi where id=".$row[kdid]);if($row1=mysqli_fetch_array($res1)){$kdbh=$row1[kdbh];$kddh=$row[kddh];?>
  快递单号：<strong><?=$kddh?></strong><br>
  快递公司：<a href="<?=$row1[kdweb]?>" target="_blank" class="green"><?=$row1[tit]?></a><br>
  <? while2("*","yjcode_chajian where cjbh='cj001' and zt=0");if($row2=mysqli_fetch_array($res2)){include("../config/chajian/cj001/index.php");}?>
  <? }}?>
  </td>
  </tr>
  </table>
  <? }?>

  <!--循环B-->
  <?
  $lii=1;
  $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";
  mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
  $tp=returntp("bh='".$rowli[probh]."' order by iffm desc","-2");
  $proid=returnproid($rowli[probh]);
  ?>
  
  <div class="dtit">第<?=$lii?>件商品：<a href="../product/view<?=$proid?>.html" target="_blank"><?=$rowli[tit]?></a></div>
  <ul class="u2">
  <li class="l1">单价/数量</li><li class="l2"><?=$rowli[money1]?>元 （共<?=$rowli[num]?>件）</li>
  <li class="l1">选购套餐</li><li class="l2"><?=returnjgdw($rowli[tcv],"","无")?></li>
  </ul>
  <? if(!empty($rowli[buyform])){?>
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">购买备注</td>
  <td class="td2"><?=$rowli[buyform]?></td>
  </tr>
  </table>
  <? }?>
  <? if(!empty($rowli[liuyan])){?>
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">买家留言</td>
  <td class="td2"><?=$rowli[liuyan]?></td>
  </tr>
  </table>
  <? }?>
  <? if(!empty($rowli[fhtxt])){?>
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">发货备注</td>
  <td class="td2"><?=$rowli[fhtxt]?></td>
  </tr>
  </table>
  <? }?>
  
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">收货信息</td>
  <td class="td2">
  <? 
  $sqlpro="select * from yjcode_pro where bh='".$rowli[probh]."'";mysqli_set_charset($conn,"utf8");$respro=mysqli_query($conn,$sqlpro);
  if($rowpro=mysqli_fetch_array($respro)){
  $fhxs=$rowli[fhxs];
  $tcfhxs=0;
  if(!empty($rowli[tcid])){
   $sqltc="select * from yjcode_taocan where id=".$rowli[tcid];mysqli_set_charset($conn,"utf8");$restc=mysqli_query($conn,$sqltc);$rowtc=mysqli_fetch_array($restc);
   $tcfhxs=$rowtc[fhxs];
  }
  ?>

  <? if(!empty($rowpro[downurl])){?><strong class="green">下载地址：<a href="<?=$rowpro[downurl]?>" target="_blank"><?=$rowpro[downurl]?></a></strong><br><? }?>
 
  <? if(1==$fhxs){?><strong class="blue">这个商品是需要您手动发货的</strong><? }?>
  
  <? if(2==$fhxs && $tcfhxs==0){?>
  <strong>该订单商品通过网盘下载，请根据以下信息下载：</strong><br>
  <strong class="blue">网盘地址：<a href="<?=$rowpro[wpurl]?>" target="_blank"><?=$rowpro[wpurl]?></a><br>网盘密码：<?=$rowpro[wppwd]?><br>解压密码：<?=$rowpro[wppwd1]?></strong>
  <? }?>
  <? if(2==$tcfhxs){?>
  <strong>该订单商品通过网盘下载，请根据以下信息下载：</strong><br>
  <strong class="blue">网盘地址：<a href="<?=$rowtc[wpurl]?>" target="_blank"><?=$rowtc[wpurl]?></a><br>网盘密码：<?=$rowtc[wppwd]?><br>解压密码：<?=$rowtc[wppwd1]?></strong>
  <? }?>
 
  <? if(3==$fhxs && $tcfhxs==0){if(empty($rowpro[upty])){$u=weburl."upload/".$rowpro[userid]."/".$rowpro[bh]."/".$rowpro[upf];}else{$u=$rowpro[upf];}?>
  <strong>该订单的商品已经传至服务器，请点击以下图标进行下载</strong><br>
  <a href="<?=$u?>" target="_blank"><img border="0" style="margin-top:5px;" src="img/down.jpg" /></a>
  <? }?>
  <? if(3==$tcfhxs){if(empty($rowpro[upty])){$u=weburl."upload/".$rowpro[userid]."/".$rowpro[bh]."/".$rowtc[upf];}else{$u=$rowtc[upf];}?>
  <strong>该订单的商品已经传至服务器，请点击以下图标进行下载</strong><br>
  <a href="<?=$u?>" target="_blank"><img border="0" style="margin-top:5px;" src="img/down.jpg" /></a>
  <? }?>
 
  <? if(4==$fhxs || 4==$tcfhxs){?>
  <strong>以下是您购买的卡密信息</strong><br>
  <span class="fontc">
  <?=$rowli[txt]?>
  </span>
  <? }?>
 
  <? if(5==$fhxs){?>
  通过快递邮寄
  <? }?>
 
  <? }else{?>
  <strong class="red">无法提供该订单的发货信息(有可能是这个商品信息不存在了)</strong>
  <? }?>
  </td>
  </tr>
  </table>
  
  <? $lii++;}?>
  <!--循环E-->
  
 </div>
 
 <div class="jfgtlist">
  <div class="cap">沟通记录</div>
  <? 
  $i=1;
  while1("*","yjcode_orderlog where zuorderbh='".$zuorderbh."' and selluserid=".$userid." order by sj asc");while($row1=mysqli_fetch_array($res1)){
  $txt=$row1[txt];
  if($row1[admin]==1){$tp=returntppd("../upload/".$row1[userid]."/user.jpg","img/nonetx.gif");$sf="买方";}
  elseif($row1[admin]==2){$tp=returntppd("../upload/".$row1[selluserid]."/user.jpg","img/nonetx.gif");$sf="卖方";}
  elseif($row1[admin]==3){$tp="img/nonetx.jpg";$sf="平台";}
  ?>
  <ul class="u1<? if($i==1){?> u0<? }?>">
  <li class="l1"><img src="<?=$tp?>" width="40" /></li>
  <li class="l2">[<?=$sf?>] <?=$txt?><br><?=$row1[sj]?></li>
  </ul>
  <? $i++;}?>
 </div>

