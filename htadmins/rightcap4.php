<?
$sqlpro="select * from yjcode_pro where bh='".$bh."'";mysqli_set_charset($conn,"utf8");$respro=mysqli_query($conn,$sqlpro);
if(!$rowpro=mysqli_fetch_array($respro)){php_toheader("productlist.php");}
$promoney=returnjgdian(returnyhmoney($rowpro[yhxs],$rowpro[money2],$rowpro[money3],$sj,$rowpro[yhsj1],$rowpro[yhsj2],$rowpro[id]));
?>
 <div class="rproglo">
 <ul class="u1">
 <li class="l1"><a href="../product/view<?=$rowpro[id]?>.html" target="_blank"><img border="0" class="tp" src="<?=returntp("bh='".$rowpro[bh]."' order by xh asc","-2")?>" onerror="this.src='../img/none60x60.gif'" width="80" height="80" /></a></li>
 <li class="l2"><strong><?=$rowpro[tit]?></strong></li>
 <li class="l3">售价：<strong class="feng"><?=$promoney?></strong></li>
 <li class="l4">已被关注<?=$rowpro[djl]?>次，销量<?=$rowpro[xsnum]?>，审核状态：<strong><?=returnztv($rowpro[zt])?></strong></li>
 </ul>
 </div>
 
 <div class="bqu1">
 <a href="product.php?bh=<?=$bh?>" id="rtit1">基本资料</a>
 <a href="javascript:void(0);" onclick="videoonc()" id="rtit2">视频管理</a>
 <a href="javascript:void(0);" onclick="taocanonc()" id="rtit3">套餐管理</a>
 <a href="productlist.php">返回列表</a>
 </div> 
