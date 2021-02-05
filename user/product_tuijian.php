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
.prou1 .l3{width:130px;}
.prou3{float: left; margin: 0px 10px 0 10px; width: 938px; height: 33px; border-bottom: #e4e4e6 solid 1px; border-left: #e4e4e6 solid 1px; border-right: #e4e4e6 solid 1px;}
.prou3 li{float: left; padding-top: 8px; text-align: center;}
.prou3 .l1{width: 190px;background-color:#fff;}
.prou3 .l2{width: 120px;background-color:#fff;}
.prou3 .l3{width: 130px;background-color:#fff;}
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
<li class="l1 l2"><a href="product_tuijian.php">购买广告</a></li>
<li class="l1"><a href="product_mytuijian.php">我的广告</a></li>
<li class="l1"><a href="product_tuijianlog.php">购买记录</a></li>
</ul> 

<!--搜索B-->
<!--搜索E-->

<!--白B-->
<div class="rkuang">

<ul class="prou1">
<li class="l1">编号</li>
<li class="l3">所属分类</li>
<li class="l3">位置</li>
<li class="l3">状态</li>
<li class="l2">售价</li>
<li class="l3">到期时间</li>
<li class="l6">操作</li>
</ul>


<!--首页推荐-->
<? while1("*","yjcode_tuijian where type=1 order by id asc limit 10");while($row1=mysqli_fetch_array($res1)){?>
<ul class="prou3">
<li class="l1"><?=$row1[bianhao]?></li>

<li class="l3"><?if($row1[type]==1){?>首页广告<?}?></li>

<li class="l3"><a href="javascript:;" style="color:green;" onclick="yulan(<?=$row1[type]?>)">预览</a></li>

<li class="l3"><?if($row1[state]==0){?><font color="green">上架</font><?}else{?><font color="red">下架</font><?}?></li>

<li class="l2"><font color="red"><?=$row1[price]?>/月</font></li>

<li class="l3">
	<?if($row1['end_time'] < $sj){?>
	正在出售
	<?}else{?>
	<?=$row1[end_time]?>
	<?}?>
</li>

<li class="l6">
	<?if($row1[zt] == 0){?>
		<a href="product_go.php?id=<?=$row1[id]?>" style="color:green">购买</a>
	<?}else{?>
		<a href="javascript:;" class="">已售出</a>
	<?}?>
</li>
</ul>
<?}?>



<!--产品页推荐-->
<? while1("*","yjcode_tuijian where type=2 order by id asc limit 10");while($row2=mysqli_fetch_array($res1)){?>
<ul class="prou3">
<li class="l1"><?=$row2[bianhao]?></li>

<li class="l3"><?if($row2[type]==2){?>产品页广告<?}?></li>

<li class="l3"><a href="javascript:;" style="color:green;" onclick="yulan(2);">预览</a></li>

<li class="l3"><?if($row2[state]==0){?><font color="green">上架</font><?}else{?><font color="red">下架</font><?}?></li>

<li class="l2"><font color="red"><?=$row2[price]?>/月</font></li>

<li class="l3">
	<?if($row2['end_time'] < $sj){?>
	正在出售
	<?}else{?>
	<?=$row2[end_time]?>
	<?}?>
</li>

<li class="l6">
	<?if($row2[zt] == 0){?>
		<a href="product_go.php?id=<?=$row2[id]?>" style="color:green">购买</a>
	<?}else{?>
		<a href="javascript:;" class="">已售出</a>
	<?}?>
</li>
</ul>
<?}?>

<div class="clear clear15"></div>

</div>
<!--白E-->

</div> 
<!--RE-->

</div>
<script>
	function yulan(type){
		layer.open({
			type: 2,
			shadeClose: false,
			area: ['800px', '500px'],
			offset: ['100px',],
			title:["广告位置预览","text-align:left"],
			skin: 'layui-layer-rim', //加上边框
			content:['product_yulan.php?type='+type, 'no'] 
		});
	}
</script>
<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>