<div class="left">
<ul class="u1">
<li class="l1"><img src="<?=returntppd("../upload/".$rowuser[id]."/shop.jpg","../img/none180x180.gif")?>" width="178" height="178" /></li>
</ul>
<ul class="u2">
<li class="l1">客服中心</li>
<li class="l2">
<?=$rowuser[shopname]?><br>
<? if(!empty($rowuser[uqq])){?>
<a href="javascript:void(0);" onclick="opentangqq('<?=$rowuser[uqq]?>','<?=$rowuser[weixin]?>',<?=$rowuser[id]?>)"><img src="../img/qq5.gif" border="0" /> 点击查看联系方式</a>
<? }?>
</li>
<li class="l3">客服电话：<?=$rowuser[mot]?></li>
<? if(!empty($rowuser[weixin])){?>
<li class="l4">
<? $t="../upload/".$rowuser[id]."/wx.jpg";if(is_file($t)){?>
<img src="<?=$t?>" /><br>
<? }?>
微信：<?=$rowuser[weixin]?>
</li>
<? }?>
</ul>



<ul class="u3">
<li class="l1">商品销量榜</li>
<? 
while0("touchy_time,is_touchy,touchy_b_time","yjcode_control");$rowss=mysqli_fetch_array($res);
$H = date('H');

$touchy_time=explode(',',$rowss[touchy_time]);
$touchy_b_time=explode(',',$rowss[touchy_b_time]);

//判断是否开启敏感过滤
if(1==$rowss[is_touchy]){
	//白天
	if(in_array($H,$touchy_time)){
			//开启	
		if($_SESSION["SHOPUSER"]==""){
			//未登录
			$sess="zt=0 and ifxj=0 and touchy=0";
		}else{
			$sess="zt=0 and ifxj=0";
		}
	//晚上
	}else if(in_array($H,$touchy_b_time)){
		$sess="zt=0 and ifxj=0";
	}else{
		$sess="zt=0 and ifxj=0 and touchy=0";
	}
}else{
	//关闭隐藏
	$sess="zt=0 and ifxj=0 and touchy=0";
}



while1("*","yjcode_pro where userid=".$uid." and ".$sess." order by xsnum desc limit 4");while($row1=mysqli_fetch_array($res1)){
$au="../product/view".$row1[id].".html";
$tp=returntp("bh='".$row1[bh]."' order by iffm desc","-2");
?>
<li class="l2">
<span class="s1"><a href="<?=$au?>" target="_blank"><img border="0" title="<?=$row1[tit]?>"  src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'" width="60" height="60" /></a></span>
<span class="s2"><a href="<?=$au?>" target="_blank" title="<?=$row1[tit]?>"><?=strgb2312s($row1[tit],0,6)?></a><br><span class="feng">￥<?=returnjgdian(returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]))?></span><br>售出<?=$row1[xsnum]?>次</span>
</li>
<? }?>
</ul>



<ul class="u4">
<li class="l1">店铺数据</li>
<li class="l2">
浏览量：<strong><?=$rowuser[djl]?></strong>次<br>
收藏量：<strong><?=returncount("yjcode_shopfav where shopid=".$uid)?></strong>人<br>
</li>
</ul>
</div>