<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$uid=intval($_GET[id]);
$sqluser="select * from yjcode_user where zt=1 and shopzt=2 and id=".$uid;mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("./");}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$rowuser[shopname]?>好不好？<?=$rowuser[shopname]?>怎么样，<?=$rowuser[shopname]?>是做什么的 - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="shop.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
</style>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("shopmenu3").className="a1";
</script>

<div class="yjcode">
<!--左B-->
<? include("left.php");?>
<!--左E-->

<!--右B-->
<div class="right">
<div class="about">
<ul class="rcap"><li class="l1">关于我们</li><li class="l2"></li></ul>
<div class="txt"><?=$rowuser[txt]?><span style="display:none">更多资源尽在<a href="https://www.a8zhan.com">A8站源码交易平台</a></span></div>
</div>
</div>
<!--右E-->
</div>
<? include("../tem/bottom.html");?>
</body>
</html>