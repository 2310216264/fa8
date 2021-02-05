 <? 
 $sj=date("Y-m-d H:i:s");
 $sqlb1="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$resb1=mysqli_query($conn,$sqlb1);$rowb1=mysqli_fetch_array($resb1);
 $au="../serve/view".returnserverid($row[serverbh]).".html";
 ?>
 
 <div class="serverorderv2">
  <ul class="u1">
  <li class="l1"><a href="<?=$au?>" target="_blank"><?=$row[tit]?></a></li>
  <li class="l2"><span>编号:<?=$orderbh?></span></li>
  <li class="l3"><span class="s1">订单总额</span><span class="s2"><?=$row[money3]?></span></li>
  <li class="l7"><span class="s1">附加费用</span><span class="s2"><?=$row[money2]?></span>
  <? if($row[ddzt]==1){?><span class="s3" onclick="servermoney2tang(<?=$row[id]?>)">[调整]</span><? }?>
  </li>
  <li class="l8"><span class="s1">商品单价</span><span class="s2"><?=$row[money1]?></span></li>
  <li class="l4"><span class="s1">商品数量</span><span class="s2"><?=$row[num]?></span></li>
  <li class="l5"><span class="s1">订单状态</span><span class="s2"><?=returnserverorderzt($row[ddzt])?></span></li>
  <li class="l6">
  <span class="s1">买家 [<strong><?=$rowb1[nc]?></strong>]</span>
  <? if(!empty($rowb1[uqq])){?><a href="javascript:void(0);" onclick="opentangqq('<?=$rowb1[uqq]?>')" class="s2"><?=$rowb1[uqq]?></a><? }?>
  <? if(!empty($rowb1[mot])){?><span class="s3"><?=$rowb1[mot]?></span><? }?>
  </li>
  </ul>
  
  <? if(!empty($ifztcontrol)){?>
  <!--状态说明B-->
  <div class="ztcontrol">
   <div class="d1"></div>
   <div class="d2">
   
    <? if($row[ddzt]==1){?>
    <div class="ds1">买家已经下单，请尽快确认交易</div>
    <div class="ds3">
    <a href="queren.php?orderbh=<?=$orderbh?>" class="a1">确认接单</a>
    <a href="sellserverclose.php?orderbh=<?=$orderbh?>" class="a0">取消订单</a>
    </div>
    <? }?>
    
    <? if($row[ddzt]==2){?>
    <div class="ds1">商家已经接单，等待买方支付款项。</div>
    <div class="ds3">
    <? if(!empty($rowb1[uqq])){?>
    <a href="javascript:void(0);" onclick="opentangqq('<?=$rowb1[uqq]?>')" class="a1">提醒买家</a>   
	<? }?>
    <a href="sellserverclose.php?orderbh=<?=$orderbh?>" class="a0">取消订单</a>
    </div>
    <? }?>
    
    <? if($row[ddzt]==3){?>
    <div class="ds1">您不同意本次交易，已经关闭订单</div>
    <? }?>
    
    <? if($row[ddzt]==4){?>
    <div class="ds1">买家已经付款，资金正在本站担保，请尽快完成服务。</div>
    <div class="ds3">
    <a href="yanshou.php?orderbh=<?=$orderbh?>" class="a1">已经完成，提交验收</a>
    </div>
    <? }?>
    
    <? if($row[ddzt]==5){?>
    <div class="ds1">正在等待买家验收。</div>
    <div class="ds3">
    <? if(!empty($rowb1[uqq])){?><div class="ds3"><a href="javascript:void(0);" onclick="opentangqq('<?=$rowb1[uqq]?>')" class="a1">提醒买家</a></div><? }?>
    </div>
    <? }?>
    
    <? if($row[ddzt]==6){?>
    <div class="ds1">交易成功。</div>
    <? }?>
    
    <? if($row[ddzt]==7){?>
    <div class="ds1">买家申请退款中</div>
    <div class="ds3">
    <a href="sellserverordertk.php?orderbh=<?=$orderbh?>" class="a1">前往处理退款</a>
    </div>
    <? }?>
    
    <? if($row[ddzt]==8){?>
    <div class="ds1">您同意了买家的退款申请，款项已经退回到买家账户中。</div>
    <? }?>
    
    <? if($row[ddzt]==9){?>
    <div class="ds1">您拒绝了退款申请。</div>
    <? }?>

    <? if($row[ddzt]==10){?>
    <div class="ds1">买家申请了平台介入处理本次退款纠纷，处理过程中资金将被冻结，直至处理完毕。您可以提交更有利于您的证据。</div>
    <div class="ds3"><a href="serverorderjf2.php?orderbh=<?=$orderbh?>" class="a1">查看记录</a></div>
    <? }?>

    <? if($row[ddzt]==11){?>
    <div class="ds1">平台已经判定本次交易纠纷为您胜诉，款项已经自动结算至您的账户。</div>
    <div class="ds3"><a href="serverorderjf2.php?orderbh=<?=$orderbh?>" class="a0">查看沟通记录</a></div>
    <? }?>

    <? if($row[ddzt]==12){?>
    <div class="ds1">平台已经判定本次交易纠纷为买家胜诉，款项已经退回到买家的账户。</div>
    <div class="ds3"><a href="serverorderjf2.php?orderbh=<?=$orderbh?>" class="a0">查看沟通记录</a></div>
    <? }?>
    
    <? if($row[ddzt]==13){?>
    <div class="ds1">买家关闭了订单。</div>
    <? }?>
    
   </div>
  </div>
  <!--状态说明E-->
  <? }?>
  
  <ul class="u2">
  <li class="l1">下单时间</li><li class="l2"><?=$row[sj]?></li>
  <li class="l1">选购套餐</li><li class="l2"><?=returnjgdw($row[taocan],"","无")?></li>
  </ul>
 
  
 </div>
 
  
 <? if(returncount("yjcode_serverorderlog where orderbh='".$orderbh."'")>0){?>
 <div class="serverjfgtlist">
  <div class="cap">沟通记录</div>
  <? 
  $i=1;
  while1("*","yjcode_serverorderlog where orderbh='".$orderbh."' and selluserid=".$userid." order by sj asc");while($row1=mysqli_fetch_array($res1)){
  $txt=$row1[txt];
  if($row1[admin]==1){$tp=returntppd("../upload/".$row1[userid]."/user.jpg","img/nonetx.gif");$sf="<strong class='blue'>买方</strong>";}
  elseif($row1[admin]==2){$tp=returntppd("../upload/".$row1[selluserid]."/user.jpg","img/nonetx.gif");$sf="<strong class='green'>卖方</strong>";}
  elseif($row1[admin]==3){$tp="img/nonetx.jpg";$sf="平台";}
  ?>
  <ul class="u1<? if($i==1){?> u0<? }?>">
  <li class="l1"><img src="<?=$tp?>" width="40" /></li>
  <li class="l2">[<?=$sf?>] <?=$txt?><br><?=$row1[sj]?></li>
  </ul>
  <? $i++;}?>
 </div>
 <? }?>
