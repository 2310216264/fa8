<?
include("../../config/conn.php");
include("../../config/function.php");
include("../../config/xy.php");
$getstr=$_GET[str];
$uid=returnsx("i");
$sj=date("Y-m-d H:i:s");
$sqluser="select * from yjcode_user where zt=1 and (shopzt=2 or shopzt=4) and id=".$uid;mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("./");}
if(4==$rowuser[shopzt]){php_toheader("dqview".$rowuser[id].".html");}

$ses=" where zt=0 and ifxj=0 and userid=".$uid;
$ty1id=returnsx("j");
$ty2id=returnsx("k");
if($ty1id!=-1){$ses=$ses." and ty1id=".$ty1id;}
if($ty2id!=-1){$ses=$ses." and ty2id=".$ty2id;}
$px="order by lastsj desc";
if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title><?=$rowuser[shopname]?>的网上店铺 - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("topmenu5").className="a1";
</script>

<? 
pagef($ses,10,"yjcode_server",$px);while($row=mysqli_fetch_array($res)){
$tp=returntp("bh='".$row[bh]."' order by xh asc","-1");
$au="../serve/view".$row[id].".html";
$sqlsell="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);$rowsell=mysqli_fetch_array($ressell);
?>
<div class="serverlist2 box" onclick="gourl('<?=$au?>')">
 <div class="d1"><img border="0" src="<?=$tp?>" onerror="this.src='../img/none70x70.gif'" height="80" /></div>
 <div class="d2">
  <a href="<?=$au?>" class="a1"><?=$row[tit]?></a>
  <div class="dn1">
  <? if($rowsell[baomoney]>0){?>
  <span class="s2">已缴保证金</span>
  <? }?>
  </div>
  <div class="dn2">￥<strong><?=returnjgdian($row[money1])?></strong></div>
 </div>
</div>
<? }?>
<div class="npa">
<?
$nowurl="serverlist";
$nowwd="";
require("../tem/page.html");
?>
</div>

<? include("../tem/moban/".$rowcontrol[wapmb]."/tem/bottom.php");?>
</body>
</html>