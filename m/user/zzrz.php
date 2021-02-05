<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$zz1="../../upload/".$rowuser[id]."/".strgb2312($rowuser[qyzch],0,15)."-zz.jpg";
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="javascript:window.history.go(-1);"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">执照认证</div>
 <div class="d3"></div>
</div>

<div class="uk box"><div class="d1">认证状态<span class="s1"></span></div><div class="d21"><? 
if(0==$rowuser[zzrz]){echo "<strong class='blue'>已提交资料，正在审核认证，请耐心等待</strong>";}
elseif(1==$rowuser[zzrz]){echo "<strong class='green'>已经通过执照认证</strong>";}
elseif(2==$rowuser[zzrz]){echo "<strong class='red'>认证被拒，原因：".$rowuser[zzrzsm]."</strong>";}
elseif(3==$rowuser[zzrz]){echo "<strong>未提交认证资料</strong>";}
?></div></div>
<div class="uk box"><div class="d1">企业名称<span class="s1"></span></div><div class="d21"><?=$rowuser[qymc]?></div></div>
<div class="uk box"><div class="d1">执照号码<span class="s1"></span></div><div class="d21"><?=$rowuser[qyzch]?></div></div>
<div class="uk box"><div class="d1">法人代表<span class="s1"></span></div><div class="d21"><?=$rowuser[frdb]?></div></div>
<div class="uk box"><div class="d1">企业类型<span class="s1"></span></div><div class="d21"><?=returnqylx1($rowuser[kdlx])?></div></div>

<? if(2==$rowuser[zzrz] || 3==$rowuser[zzrz]){?>
<form name="f1" action="zzrz1.php">
<div class="fbbtn box">
 <div class="d1"><? tjbtnr_m("开始认证")?></div>
</div>
</form>
<? }?>

<? if(is_file($zz1)){?>
<div class="listcap box"><div class="d2">身份证正面：</div></div>
<div class="tishi box">
<div class="d1"><a href="<?=$zz1?>" target="_blank"><img border="0" src="<?=$zz1?>" width="100%" /></a></div>
</div>
<? }?>


<? include("bottom.php");?>
<script language="javascript">
bottomjd(4);
</script>
</body>
</html>