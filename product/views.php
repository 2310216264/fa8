<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$id=85321;
$sj=getsj();
checkdjl("c3",$id,"yjcode_pro");
while0("*","yjcode_pro where zt<>99 and id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
$txtmb=returnjgdw($row[txtmb],"","default");
$_SESSION["tzURL"]=weburl."product/view".$id.".html";
$nowmoney=returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]);
$ty1name=returntype(1,$row[ty1id]);

$sqlsell="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);
if(!$rowsell=mysqli_fetch_array($ressell)){php_toheader("../");}
$nuid=returnuserid($_SESSION["SHOPUSER"]);

$nch="";
if(isset($_COOKIE['prohistoy'])){
$nch=$_COOKIE['prohistoy'];
if(check_in($row[id]."xcf",$nch)){$nch=str_replace($row[id]."xcf","",$nch);}
$a=preg_split("/xcf/",$nch);
if(count($a)>6){$ni=6;}else{$ni=count($a);}
 $nch="";
 for($i=0;$i<=$ni;$i++){
 $nch=$nch.$a[$i]."xcf";
 }
}

$Month = 864000 + time();
setcookie(prohistoy,$row[id]."xcf".$nch, $Month,'/');
$nch=$_COOKIE['prohistoy'];
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=returnjgdw($row[wkey],"",$row[tit])?>">
<meta name="description" content="<?=delhtml(returnjgdw($row[wdes],"",strgb2312(strip_tags($row[txt]),0,250)))?>">
<title><?=$row[tit]?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="<?=$txtmb?>/view.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=$txtmb?>/view.js"></script>
<script type="text/javascript" src="jquery-plugin-slide.js"></script>
<? if(empty($rowcontrol[ifwap])){?>
<script language="javascript">
if(is_mobile()) {document.location.href= '<?=weburl?>m/product/view<?=$row[id]?>.html';}
</script>
<? }?>
</head>
<body>
<?
include("../tem/top.html");
include("../tem/top1.html");
include($txtmb."/views.php");
?>
<div class="clear clear15"></div>
<?
include("../tem/bottom.html");
?>
</body>
</html>