<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$sj=date("Y-m-d H:i:s");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
<style>
.tishi{float: left; margin: 13px 0 0 0; width: 898px; padding: 10px 0 0 60px; height: 30px; font-size: 14px; border: #FFE8C2 solid 1px; text-align: left; background-color: #FEFEDA; background-position: 8px 8px; color: #E51F1F;}
.prou1 .l1{width:190px;}
.prou1 .l2{width:400px; text-align:left;}
.prou1 .l3{width:130px;}
.prou3{float: left; margin: 0px 10px 0 10px; width: 938px; height: 70px; border-bottom: #e4e4e6 solid 1px; border-left: #e4e4e6 solid 1px; border-right: #e4e4e6 solid 1px;}
.prou3 li{float: left;text-align: center;height:60px;}
.prou3 .l1{width: 190px;background-color:#fff;height:60px;line-height:70px;}
.prou3 .l2{width: 400px;background-color:#fff;height:60px;line-height:18px;text-align:left;padding-top:10px;}
.prou3 .l3{width: 130px;background-color:#fff;height:70px;line-height:70px;}
.prou3 .l6{width: 100px;background-color:#fff;}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
<div class="tishi">尊敬的卖家，禁止推荐违规商品，否则不退款。</div>
<ul class="wz">
<li class="l1"><a href="product_tuijian.php">购买广告</a></li>
<li class="l1 l2"><a href="product_mytuijian.php">我的广告</a></li>
<li class="l1"><a href="product_tuijianlog.php">购买记录</a></li>
</ul> 

<!--搜索B-->
<!--搜索E-->

<!--白B-->
<div class="rkuang">

<ul class="prou1">
<li class="l1">编号/分类</li>
<li class="l2">商品信息</li>
<li class="l3">到期时间</li>
<li class="l3">续费</li>
</ul>

<? while1("*","yjcode_tuijian where user_id='".$_SESSION[SHOPUSER]."' order by id asc limit 10");while($row1=mysqli_fetch_array($res1)){?>
<ul class="prou3">
	<li class="l1"><?=$row1[bianhao]?>/<?if($row1[type]==1){?>首页广告<?}else{?>产品页广告<?}?></li>
	<!--商品信息-->
	<? 
		$sqlss="select * from yjcode_pro where bh='".$row1[pro_bh]."' and zt=0 and ifxj=0";mysqli_set_charset($conn,"utf8");
		$res1s=mysqli_query($conn,$sqlss);
		$row = mysqli_fetch_array($res1s);
		$tp=returntp("bh='".$row[bh]."' order by xh asc","-1");
		if(0==$row[ifxj]){$xjv="<span class='blue'>上架</span>";}else{$xjv="<span class='red'>已下架</span>";}
		$au="/product/view".$row[id].".html";
	?>
	<li class="l2">
		<a href="<?=$au?>" target="_blank">
			<img  style="margin: 0 10px 0 0;" border="0" class="imgtp" onerror="this.src='../img/none180x180.gif'" src="<?=$tp?>" width="52" height="52" align="left">
		</a>
		<a title="<?=$row[tit]?>" href="<?=$au?>" class="a1" target="_blank"><?=strgb2312($row[tit],0,25)?></a><br>
		<?=$xjv." | ".returnztv($row[zt],$row[ztsm])."<br>".returntype(1,$row[ty1id])." - ".returntype(2,$row[ty2id])?>	
	</li>
	
	<!--商品信息-->
	<li class="l3"><?=$row1[end_time]?></li>
	<li class="l3">续费</li>

</ul>
<?}?>


<div class="clear clear15"></div>

</div>
<!--白E-->

</div> 
<!--RE-->

</div>
<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>