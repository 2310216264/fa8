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
.prou1 .l1{width:130px;}
.prou1 .l3{width:130px;}
.prou3{float: left; margin: 0px 10px 0 10px; width: 938px; height: 33px; border-bottom: #e4e4e6 solid 1px; border-left: #e4e4e6 solid 1px; border-right: #e4e4e6 solid 1px;}
.prou3 li{float: left; padding-top: 8px; text-align: center;}
.prou3 .l1{width: 130px;background-color:#fff;}
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
<div class="tishi">尊敬的卖家，禁止广告违规商品，否则不退款。</div>
<ul class="wz">
<li class="l1"><a href="product_tuijian.php">购买广告</a></li>
<li class="l1"><a href="product_mytuijian.php">我的广告</a></li>
<li class="l1 l2"><a href="product_tuijianlog.php">购买记录</a></li>
</ul> 

<!--搜索B-->
<!--搜索E-->

<!--白B-->
<div class="rkuang">

<ul class="prou1">
<li class="l1">位置编号</li>
<li class="l3">分类</li>
<li class="l3">商品编号</li>
<li class="l3">购买套餐</li>
<li class="l2">消费</li>
<li class="l3">开通时间</li>
<li class="l3" style="width:135px;">到期时间</li>
</ul>

<? while1("*","yjcode_tuijianlog where user_id='".$_SESSION[SHOPUSER]."' order by id desc");while($row1=mysqli_fetch_array($res1)){?>
<ul class="prou3">
<li class="l1"><?=$row1[tj_bh]?></li>
<li class="l3"><?if($row1[tj_type]==1){?>首页广告<?}else{?>产品页广告<?}?></li>
<li class="l3"><?=$row1[pro_bh]?></li>
<li class="l3"><?=$row1[pro_time]?></li>
<li class="l2"><?=$row1[pro_price]?></li>
<li class="l3"><?=$row1[start_time]?></li>
<li class="l3" style="width:135px;"><?=$row1[end_time]?></li>
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