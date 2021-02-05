 <? 
 $sj=date("Y-m-d H:i:s");
 $au="../serve/view".returnserverid($row[serverbh]).".html";
 $sqlb1="select * from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$resb1=mysqli_query($conn,$sqlb1);$rowb1=mysqli_fetch_array($resb1);
 ?>

<div class="ordermain1 box"><div class="d1"></div><div class="d2">订单信息</div></div>
<div class="ordermain2 box"><div class="d1">订单状态:</div><div class="d2"><strong><?=returnserverorderzt($row[ddzt])?></strong></div></div>
<div class="ordermain2 box"><div class="d1">服务信息:</div><div class="d2"><?=$row[tit]?></div></div>
<div class="ordermain2 box"><div class="d1">下单时间:</div><div class="d2"><?=$row[sj]?></div></div>
<div class="ordermain2 box"><div class="d1">选择套餐:</div><div class="d2"><?=returnjgdw($row[taocan],"","无")?></div></div>
<div class="ordermain2 box"><div class="d1">订单编号:</div><div class="d2"><?=$orderbh?></div></div>
<div class="ordermain2 box"><div class="d1">订单总额:</div><div class="d2"><strong class="feng"><?=$row[money3]?>元</strong></div></div>
<div class="ordermain2 box"><div class="d1">附加费用:</div><div class="d2"><strong><?=$row[money2]?>元</strong></div></div>
<div class="ordermain2 box"><div class="d1">商品单价:</div><div class="d2"><?=$row[money1]?>元</div></div>
<div class="ordermain2 box"><div class="d1">商品数量:</div><div class="d2"><?=$row[num]?></div></div>
<div class="ordermain3 box"></div>

<!--买家B-->
<div class="ordermain1 box"><div class="d1"></div><div class="d2">商家信息</div></div>
<div class="ordersell1 box"><div class="d1">买家昵称:</div><div class="d2"><?=$rowb1[nc]?></div></div>
<div class="ordersell1 box"><div class="d1">联系QQ:</div><div class="d2"><span onclick="qqtang('<?=$rowb1[uqq]?>','<?=$rowb1[weixin]?>',<?=$rowb1[id]?>)"><?=$rowb1[uqq]?></span></div></div>
<div class="ordersell1 box"><div class="d1">微信号码:</div><div class="d2"><span onclick="qqtang('<?=$rowb1[weixin]?>','<?=$rowb1[weixin]?>',<?=$rowb1[id]?>)"><?=$rowb1[weixin]?></span></div></div>
<? if(!empty($rowb1[mot])){?>
<div class="ordersell1 box"><div class="d1">手机号码:</div><div class="d2"><?=$rowb1[mot]?></div></div>
<? }?>
<div class="ordersell2 box"></div>
<!--买家E-->

<? if(returncount("yjcode_serverorderlog where orderbh='".$orderbh."'")>0){?>
<div class="ordermain1 box"><div class="d1"></div><div class="d2">沟通记录</div></div>
<div class="jflist box">
 <div class="jfgtlist">
  <? 
  $i=1;
  while1("*","yjcode_serverorderlog where orderbh='".$orderbh."' and userid=".$userid." order by sj desc");while($row1=mysqli_fetch_array($res1)){
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
<? }?>

<? if($ifztcontrol==1){?>
<!--状态B-->
<? 
 $cz="";
 
 if($row[ddzt]==1){ //等待商家同意本次交易
 $cz=$cz."<a href='serverclose.php?orderbh=".$row[orderbh]."'>取消订单</a>";
 
 }elseif($row[ddzt]==2){ //商家已经同意接单，请尽快支付费用
 $cz=$cz."<a href='orderpay.php?orderbh=".$row[orderbh]."' class='a1'>支付费用</a>";
 $cz=$cz."<a href='serverclose.php?orderbh=".$row[orderbh]."'>取消订单</a>";
 
 }elseif($row[ddzt]==4){ //申请退款
 $cz=$cz."<a href='servertk.php?orderbh=".$row[orderbh]."'>申请退款</a>";
 
 }elseif($row[ddzt]==5){ //验收
 $cz=$cz."<a href='serverys.php?orderbh=".$row[orderbh]."'>前往验收</a>";
 $cz=$cz."<a href='servertk.php?orderbh=".$row[orderbh]."'>申请退款</a>";
 
 }elseif($row[ddzt]==7){ //取消退款
 $cz=$cz."<a href='serverqxtk.php?orderbh=".$row[orderbh]."'>取消退款</a>";
 
 }elseif($row[ddzt]==9){ //平台介入
 $cz=$cz."<a href='serverjf.php?orderbh=".$row[orderbh]."'>申请平台介入</a>";
 $cz=$cz."<a href='serverqxtk.php?orderbh=".$row[orderbh]."'>取消退款</a>";
 
 }elseif($row[ddzt]==10 || $row[ddzt]==11 or $row[ddzt]==12){
 $cz=$cz."<a href='serverorderjf1.php?orderbh=".$row[orderbh]."'>沟通</a>";
 
  
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
