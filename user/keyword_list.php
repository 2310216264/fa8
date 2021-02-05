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
.prou1 .l1{width:200px;}
.prou1 .l3{width:130px;}
.prou1 .l6{width:210px;}
.prou3{float: left; margin: 0px 10px 0 10px; width: 938px; height: 33px; border-bottom: #e4e4e6 solid 1px; border-left: #e4e4e6 solid 1px; border-right: #e4e4e6 solid 1px;}
.prou3 li{float: left; padding-top: 8px; text-align: center;}
.prou3 .l1{width: 200px;background-color:#fff;}
.prou3 .l2{width: 150px;background-color:#fff;}
.prou3 .l3{width: 130px;background-color:#fff;}

/*审核中-橙色*/
.zt1{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #ff6600;}
/*审核成功-淡蓝色*/
.zt2{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #3bb4f2;}
/*进行中-蓝色*/
.zt3{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #5a98de;}
/*成功-绿色*/
.zt4{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #5eb95e;}
/*失败-红色*/
.zt5{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #dd514c;}

.prou3 .l6{width: 210px;background-color:#fff;}

.btn_edit{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #5a98de;}
.btn_info{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #5eb95e;}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
<!--<div class="tishi">尊敬的卖家，禁止推荐违规商品，否则不退款。</div>-->
<ul class="wz">
<li class="l1"><a href="keyword_add.php">提交优化</a></li>
<li class="l1 l2"><a href="keyword_list.php">我的优化</a></li>
</ul> 

<!--白B-->
<div class="rkuang">

<ul class="prou1">
<li class="l1">编号</li>
<li class="l3">状态</li>
<li class="l3">发布时间</li>
<li class="l6">操作</li>
</ul>

<? while1("*","yjcode_keyorder where sj_uid='".$_SESSION[SHOPUSER]."' order by id desc limit 10");while($row2=mysqli_fetch_array($res1)){?>
<!--列表-->
<ul class="prou3">
<li class="l1"><?=$row2[bh]?></li>
<li class="l3">
	<?php	
	if($row2[zt]==1){echo "<span class='zt1'>审核中</span>";}
	elseif($row2[zt]==2){echo "<span class='zt3'>审核成功</span>";}
	elseif($row2[zt]==3){echo "<span class='zt3'>进行中</span>";}
	elseif($row2[zt]==4){echo "<span class='zt1'>等待验收</span>";}
	elseif($row2[zt]==5){echo "<span class='zt4'>成功</span>";}
	elseif($row2[zt]==6){echo "<span class='zt5'>不满意</span>";}
	elseif($row2[zt]==7){echo "<span class='zt5'>审核不通过</span>";}
	?>
</li>

<li class="l3"><?=$row2[add_time]?></li>
<li class="l6">
	<?php if($row2[zt] == 4){?>
	<a href="keyword_yanshou.php?id=<?=$row2[id]?>"><span class="zt1">进行验收</span></a>
	<?php }else if($row2[zt] == 2){?>
	<a href="keyword_pay.php?id=<?=$row2[id]?>" ><span class="btn_edit">支付</span></a>
	<?php }else{?>
	<a href="keyword_info.php?id=<?=$row2[id]?>" ><span class="btn_info">详情</span></a>
	<?php }?>
</li>

</ul>
<?}?>
<!--列表-->

<div class="clear clear15"></div>
</div>
</div> 


</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>