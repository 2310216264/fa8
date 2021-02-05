<?
include("../../config/conn.php");
include("../../config/function.php");
$admin=intval($_GET[admin]);
if($admin==0){$admin=1;}

if($admin==1){
 $tit="商品搜索";
 $nch=$_COOKIE['proserhis'];
}elseif($admin==2){
 $tit="店铺搜索";
 $nch=$_COOKIE['shopserhis'];
}elseif($admin==3){
 $tit="任务大厅搜索";
 $nch=$_COOKIE['taskserhis'];
}elseif($admin==4){
 $tit="服务市场搜索";
 $nch=$_COOKIE['serveserhis'];
}elseif($admin==5){
 $tit="行业资讯搜索";
 $nch=$_COOKIE['newsserhis'];
}

if($_GET[control]=="del"){
 $Month = 864000 + time();
 if($admin==1){setcookie(proserhis,"", $Month,'/');}
 elseif($admin==2){setcookie(shopserhis,"", $Month,'/');}
 elseif($admin==3){setcookie(taskserhis,"", $Month,'/');}
 elseif($admin==4){setcookie(serveserhis,"", $Month,'/');}
 elseif($admin==5){setcookie(newsserhis,"", $Month,'/');}
 php_toheader("main.php?admin=".$admin);
}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no" />
<title><?=$tit?> - 手机版<?=webname?></title>
<? include("../tem/cssjs.html");?>
<script language="javascript">
function tj(){
seronc(document.f1.topt.value);
}
function selcha(){
location.href="main.php?admin="+document.getElementById("select1").value;
}
function seronc(x){
document.f1.topt.value=x;
form=document.forms[0];
form.method="post";
form.action="../search/index.php?admin=<?=$admin?>";
form.submit();
}
</script>
</head>
<body>
<? $nowpagetit=$tit;$nowpagebk="../";include("../tem/moban/".$rowcontrol[wapmb]."/tem/top.php");?>

<form name="f1" method="post" id="f1">
<div class="searm box">
 <div class="d0">
 <select id="select1" onChange="selcha()">
 <? 
 $arr1=array("商品","店铺","任务","服务","资讯");
 $arr2=array(1,2,3,4,5);
 for($i=0;$i<count($arr1);$i++){
 ?>
 <option value="<?=$arr2[$i]?>" <? if($admin==$arr2[$i]){?> selected<? }?>><?=$arr1[$i]?></option>
 <? }?>
 </select>
 </div>
 <div class="d1 flex"><input type="text" autocomplete="off" placeholder="请输入搜索关键词" disableautocomplete name="topt" /></div>
 <div class="d2"><input type="button" onClick="tj()" class="tjinput" value="搜索" /></div>
</div>
</form>

<div class="serhis box">
 <div class="d1 flex">您可能想搜</div>
 <div class="d2"><a href="main.php?admin=<?=$admin?>&control=del"><img src="img/icon4.gif" /></a></div>
</div>
<div class="serhislist box">
 <div class="d1 flex">
 <?
 $a=preg_split("/xcf/",$nch);
 for($i=0;$i<=count($a);$i++){
 if($a[$i]!=""){
 ?>
 <a href="javascript:void(0);" onClick="seronc('<?=$a[$i]?>')"><?=$a[$i]?></a>
 <? }}?>
 </div>
</div>

</body>
</html>