<?
include("../config/conn.php");
include("../config/function.php");
$sj=date("Y-m-d H:i:s");
$uid=intval($_GET[id]);
$sqluser="select * from yjcode_user where shopzt=4 and id=".$uid;mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("./");}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>店铺到期提醒 - <?=webname?></title>
<link href="<?=weburl?>css/basic.css" rel="stylesheet" type="text/css" />
<? include("../tem/cssjs.html");?>
<link href="shop.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>

<div class="yjcode">

 <div class="shopdq">
 <ul class="u1">
 <li class="l1">温馨提示：您访问的店铺已经到期。</li>
 <li class="l2">如果您是店铺主人，请及时续期[进入会员中心-左侧-点击续费按钮]</li>
 <li class="l3"><a href="../user/openshop4.php" class="a1">我是店主，马上续期</a><a href="../user/openshop1.php" class="a2">还没有店铺？申请入驻</a></li>
 </ul>
 </div>

</div>

<? include("../tem/bottom.html");?>
</body>
</html>