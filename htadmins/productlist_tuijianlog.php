<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$ses=" where id>0";
$page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/ad.css" rel="stylesheet" type="text/css" />
<link href="css/product.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<style>
.cen{text-align:center !important;}
</style>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("leftmenu5").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0102,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
<? $leftid=5;include("menu_product.php");?>

<div class="right">
	<div class="bqu1">
		<a class="a1" href="productlist_tuijianlog.php">推荐记录</a>
	</div>
	<ul class="adtypecap cen" style="width:100%;">
		<li class="l3 cen">位置编号</li>
		<li class="l3 cen">分类</li>
		<li class="l3 cen">会员ID</li>
		<li class="l3 cen">会员昵称</li>
		<li class="l3 cen">商品编号</li>
		<li class="l3 cen">购买套餐</li>
		<li class="l3 cen">消费</li>
		<li class="l3 cen">开通时间</li>
		<li class="l3 cen">到期时间</li>
	</ul>
	<? pagef($ses,20,"yjcode_tuijianlog","order by id desc");while($row1=mysqli_fetch_array($res)){?>
	<ul class="adtypelist" style="width:100%;">
		<li class="l3 cen"><?=$row1[tj_bh]?></li>
		<li class="l3 cen"><?if($row1[tj_type]==1){?>首页推荐<?}else{?>产品页推荐<?}?></li>
		<li class="l3 cen"><?=$row1[user_id]?></li>
		<li class="l3 cen"><?=$row1[user_name]?></li>
		<li class="l3 cen" style=""><?=$row1[pro_bh]?></li>
		<li class="l3 cen"><?=$row1[pro_time]?></li>
		<li class="l3 cen"><?=$row1[pro_price]?></li>
		<li class="l3 cen"><?=$row1[start_time]?></li>
		<li class="l3 cen"><?=$row1[end_time]?></li>
	</ul>
	<?}?>
	<?
	$nowurl="productlist_tuijianlog.php";
	$nowwd="st1=".$_GET[st1]."&st2=".$_GET[st2]."&st3=".$_GET[st3]."&sd1=".$_GET[sd1];
	include("page.php");
	?>
</div>


</div>
<?php include("bottom.php");?>
</body>
</html>