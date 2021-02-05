<?php
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");

?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>软件工具 - <?=webname?></title>
<meta name="keywords" content="软件下载,国外软件,破解软件,电脑软件,站长软件,站长工具,视频软件,编程软件">
<meta name="description" content="a8站下载中心,提供各种最新热门系统软件工具下载">
<? include("../tem/cssjs.html");?>
</head>
<body class="body">
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>

<div class="main">
<?
$i=1;
while1("*","yjcode_soft_type where level=1 order by id asc");while($row1=mysqli_fetch_array($res1)){
?>
<div class="tag t<?=$i?>">
<div class="tag_left"><a href="view_j<?=$row1[id]?>v.html"><em></em><?=$row1[soft_type_name]?></a></div>
<div class="tag_right">
<?
while2("*","yjcode_soft_type where fid=".$row1[id]." and level=2 order by id asc");while($row2=mysqli_fetch_array($res2)){
?>
<a href="view_j<?=$row1[id]?>v_k<?=$row2[id]?>v.html" target="_blank"><?=$row2[soft_type_name]?></a>
<?
}
?>
</div>
</div>

<? $i++;}?>
</div>

<? include("../tem/bottom.html");?>
</body>
</html>