<?
include("../config/conn.php");
include("../config/function.php");
$id=intval($_GET[id]);
while0("*","yjcode_onecontrol where tyid=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=returnonecon($row[tyid])?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>


<div class="bfb bfbabout">
<div class="yjcode">

 <div class="dqwz">
 <ul class="u1">
 您当前的位置：<a href="../">首页</a> <span>>></span> 
 <?=returnonecon($row[id])?>
 </ul>
 </div>

  <div class="left">
  <div class="aboutmenu">
  <a href="aboutview2.html" rel="nofollow">关于我们<span> ></span></a>
  <a href="aboutview3.html" rel="nofollow">广告合作<span> ></span></a>
  <a href="aboutview4.html" rel="nofollow">联系我们<span> ></span></a>
  <a href="aboutview5.html" rel="nofollow">隐私条款<span> ></span></a>
  <a href="aboutview6.html" rel="nofollow">免责声明<span> ></span></a>
  <a href="map.php" class="a0">网站地图<span> ></span></a>
  </div>
 </div>
 
 <div class="abouttxt"><?=$row[txt]?></div>
 
</div>
</div>
<? include("../tem/bottom.html");?>
</body>
</html>