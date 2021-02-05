<?
include("../../config/conn.php");
include("../../config/function.php");
$id=intval($_GET[id]);
while0("*","yjcode_provideo where id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}

while1("*","yjcode_pro where bh='".$row[probh]."'");if(!$row1=mysqli_fetch_array($res1)){php_toheader("../");}
$proid=$row1[id];
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title><?=$row[tit]?> <?=webname?></title>
<? $cssjsty="a";include("../tem/cssjs.html");?>
<link href="view.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="view.js"></script>
</head>
<body>
<div class="yjcode">

<? $nowpagetit="商品视频";include("../tem/moban/".$rowcontrol[wapmb]."/tem/top.php");?>

<div class="videoview box">
<div class="video1">
 <div class="d1"><?=$row[tit]?></div>
 <div class="d2"><iframe name="fvideo" id="fvideo" marginwidth="0" marginheight="0" width="100%" height="400px" border="0" frameborder=0 src="../../video/index.php?id=<?=$id?>&w=100%&h=400"></iframe></div>
</div>
</div>

</div>
<? include("../tem/moban/".$rowcontrol[wapmb]."/tem/bottom.php");?>
</body>
</html>