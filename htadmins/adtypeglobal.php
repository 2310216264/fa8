<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/ad.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu5").className="a1";
</script>

<div class="yjcode">
 <? $leftid=1;include("menu_ad.php");?>

<div class="right">
 <? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0602,")){echo "<div class='noneqx'>无权限</div>";exit;}?>
 
 <? include("rightcap2.php");?>
 <script language="javascript">document.getElementById("rtit0").className="a1";</script>

 <!--begin-->
 <ul class="adtypecap">
 <li class="l1">广告定位编号</li>
 <li class="l2">说明</li>
 <li class="l3">管理</li>
 </ul>
 <?
 $adbh=array("ADDL","ADLP","ADI00","ADI01","ADI02","ADI13","ADI14","ADTOP","ADKF","ADTANG");
 $adtit=array("对联广告","首页拉屏广告","首页顶部广告","底部广告","导航菜单","首页底部合作伙伴","首页底部友情链接","全站顶部广告","右侧自定义客服","一天出现一次的弹窗");
 $adsize=array("100*?","1150*400","1150*?","1150*?","","100*35","","1150*?","","900*465");
 $admust=array("pic","pic","","","font","pic","font","pic","code","pic");
 for($i=0;$i<count($adbh);$i++){
 $adurl="adlist.php?bh=".$adbh[$i]."&sm=".urlencode($adtit[$i]."-".$adsize[$i])."&must=".$admust[$i];
 ?>
 <ul class="adtypelist">
 <li class="l1"><?=$adbh[$i]?></li>
 <li class="l2"><?=$adtit[$i]." ".$adsize[$i]?></li>
 <li class="l3">
 <a href="<?=$adurl?>">列表</a><span></span>
 <a href="ad_lx.php?bh=<?=$adbh[$i]?>&sm=<?=urlencode($adtit[$i]."-".$adsize[$i])?>&must=<?=$admust[$i]?>">新增</a>
 </li>
 </ul>
 <?
 }
 ?>
 <!--end-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>