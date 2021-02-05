 <? 
 $sqlsell="select * from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);
 $rowsell=mysqli_fetch_array($ressell);
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
   <span class="s1">卖家 [<strong><?=$rowsell[shopname]?></strong>]</span>
   <? if(!empty($rowsell[uqq])){?><a href="javascript:void(0);" onclick="opentangqq('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)" class="s2"><?=$rowsell[uqq]?></a><? }?>
   <span class="s3"><?=$rowsell[mot]?></span>
  </li>
  </ul>

  <? if(!empty($ifztcontrol)){?>
  <!--状态说明B-->
  <div class="ztcontrol">
   <div class="d1"></div>
   <div class="d2">
   
    <? if($row[ddzt]=="wait"){?>
    <div class="ds1">卖家已收到您的订单，正在准备发货，请耐心等待下。</div>
    <div class="ds2"><strong>提醒：</strong>如果卖家长时间未发货，您可以【<a href="ordertk.php?zuorderbh=<?=$zuorderbh?>">申请退款</a>】。卖家也挺不容易，您可以提醒卖家尽快发货】。</div>
    <div class="ds3">
    <a href="javascript:void(0);" onclick="opentangqq('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)" class="a1">提醒卖家尽快发货</a>
    <a href="ordertk.php?orderbh=<?=$orderbh?>" class="a0">申请退款</a>
    </div>
    <? }?>
    
    <? if($row[ddzt]=="close"){?>
    <div class="ds1">您在 <?=$row[closesj]?> 取消了该笔订单。</div>
    <div class="ds2"><strong>提醒：</strong>如果还需要该商品，请点<a href="<?=$au?>" target="_blank">再次购买</a>。</div>
    <? }?>
    
    <? if($row[ddzt]=="suc"){?>
    <div class="ds1">恭喜您，该笔订单已经交易成功。</div>
    <? if(empty($row[ifpj])){?>
    <div class="ds3"><a href="orderpj.php?zuorderbh=<?=$zuorderbh?>" class="a1">写评价赚积分</a></div>
    <? }?>
    <? }?>
    
    <? if($row[ddzt]=="backsuc"){?>
    <div class="ds1">卖家于 <?=$row[tkclsj]?> 同意了您的退款申请，款项已经退回到您的账户中。</div>
    <div class="ds2"><strong>提醒：</strong>如果还需要该商品，请点<a href="<?=$au?>" target="_blank">再次购买</a>。</div>
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
    <div class="ds1">卖家于 <?=$row[tkclsj]?> 拒绝了您的退款申请。</div>
    <div class="ds2"><strong>提醒：</strong>如果商品没有问题，你可以进行【<a href="shouhuo.php?zuorderbh=<?=$zuorderbh?>">确认收货</a>】，如果商品有问题，你可以【<a href="../help/aboutview4.html" target="_blank">申请客服介入</a>】<br>请务必在 <span class="red"><?=$sjcv?></span> 内进行相关操作，否则系统自动完成该笔订单，资金会打入卖家账户</div>
    <div class="ds3">
    <a href="shouhuo.php?zuorderbh=<?=$zuorderbh?>" class="a1">确认收货</a>
    <a href="orderjf.php?zuorderbh=<?=$zuorderbh?>" class="a0">申请客服介入</a>
    </div>
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
    <div class="ds1">退款申请处理中，卖家需要在 <?=$sjcv?> 内处理你的退款申请。</div>
    <div class="ds2"><strong>提醒：</strong>如果商品本身及卖家方面都无问题，你也还需要该商品，那么你可以<a href="orderqxtk.php?zuorderbh=<?=$zuorderbh?>">取消退款申请</a>。</div>
    <div class="ds3">
    <a href="orderqxtk.php?zuorderbh=<?=$zuorderbh?>" class="a1">取消退款申请</a>
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
    <div class="ds1">卖家已发货，等待您确认收货。资金担保剩余时间：<?=$sjcv?></div>
    <div class="ds2"><strong>提醒：</strong>当您收到商品且确认没问题后，可进行【<a href="shouhuo.php?zuorderbh=<?=$zuorderbh?>">确认收货</a>】来完成此次交易;在此期间请尽量注意资金担保剩余时间，若临近该时间点，商品依然存在问题且卖方未予及时解决，可先【<a href="orderyc.php?zuorderbh=<?=$zuorderbh?>">延长担保时间</a>】或【<a href="ordertk.php?zuorderbh=<?=$zuorderbh?>">申请退款</a>】，等待卖方解决问题后，再【<a href="shouhuo.php?zuorderbh=<?=$zuorderbh?>">确认收货</a>】或【<a href="orderqxtk.php?zuorderbh=<?=$zuorderbh?>">取消退款</a>】，不可轻信卖方许诺，以防有意拖延时间至自动完成交易。资金担保时间结束后，款项将自动转入卖家账户。</div>
    <div class="ds3">
    <a href="shouhuo.php?zuorderbh=<?=$zuorderbh?>" class="a1">确认收货</a>
    <a href="orderyc.php?zuorderbh=<?=$zuorderbh?>" class="a0">延长担保时间</a>
    <a href="ordertk.php?zuorderbh=<?=$zuorderbh?>" class="a0">申请退款</a>
    <a href="orderqxtk.php?zuorderbh=<?=$zuorderbh?>" class="a0">取消退款</a>
    </div>
    <? }?>

    <? if($row[ddzt]=="jf"){?>
    <div class="ds1">您已经申请了平台客服介入处理，处理过程中资金将被冻结，直至处理完毕。您可以提交更有利于您的证据。</div>
    <div class="ds3"><a href="orderjf1.php?zuorderbh=<?=$zuorderbh?>" class="a1">提交新证据</a></div>
    <? }?>

    <? if($row[ddzt]=="jfbuy"){?>
    <div class="ds1">平台已经判定本次交易纠纷为买家胜诉，款项已经退回到您的账户。</div>
    <div class="ds3"><a href="orderjf1.php?zuorderbh=<?=$zuorderbh?>" class="a0">查看沟通记录</a></div>
    <? }?>

    <? if($row[ddzt]=="jfsell"){?>
    <div class="ds1">平台已经判定本次交易纠纷为卖家胜诉，款项已经自动结算至卖家账户。</div>
    <div class="ds3"><a href="orderjf1.php?zuorderbh=<?=$zuorderbh?>" class="a0">查看沟通记录</a></div>
    <? }?>
    
   </div>
  </div>
  <!--状态说明E-->
  <? }?>
    
  <? if($row[fhxs]==5){?>
  <div class="dtit">物流快递信息：</div>
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">已付运费：</td>
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
  
  <? if($rowli[ddzt]=="db" || $rowli[ddzt]=="back" || $rowli[ddzt]=="backerr" || $rowli[ddzt]=="suc" || $rowli[ddzt]=="jf" || $rowli[ddzt]=="jfsell"){?>

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
  <strong>快递物流信息：</strong><br>
  快递单号：<strong><?=$rowli[kddh]?></strong><br>
  <? }?>
 
  <? }else{?>
  <strong class="red">亲，很抱歉，无法提供该订单的发货信息（或商品已被卖家删除），请联系卖家</strong>
  <? }?>
  </td>
  </tr>
  </table>
  <? }?>
  
  <? $lii++;}?>
  <!--循环E-->
  
 </div>
 
 <div class="jfgtlist">
  <div class="cap">沟通记录</div>
  <? 
  $i=1;
  while1("*","yjcode_orderlog where zuorderbh='".$zuorderbh."' and userid=".$userid." order by sj asc");while($row1=mysqli_fetch_array($res1)){
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

