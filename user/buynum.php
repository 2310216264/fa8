<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$id=intval($_GET[id]);
$userid=returnuserid($_SESSION["SHOPUSER"]);
while0("*","yjcode_car where id=".$id." and userid=".$userid);if(!$row=mysqli_fetch_array($res)){Audit_alert("超时退出",weburl,"parent.");}

if($_GET[control]=="update"){
 $t1=intval($_POST[t1]);
 updatetable("yjcode_car","num=".$t1." where id=".$id." and userid=".$userid);
 php_toheader("buynum.php?t=suc&id=".$id);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改购买数量</title>
<style type="text/css">
body{margin:0;font-size:12px;text-align:center;color:#333;}
*{margin:0 auto;padding:0;}
ul{list-style-type:none;margin:0;padding:0;}
.uk{float:left;width:100%;}
.uk li{float:left;}
.uk .l1{width:100%;}
.uk .l1 input{float:left;width:126px;outline:medium;height:25px;font-size:16px;font-weight:700;margin:13px 0 0 35px;text-align:center;}
.uk .l2{width:130px;margin:13px 0 0 35px;}
.btn1{cursor:pointer;float:left;border:0;color:#fff;width:130px;height:34px;margin-right:10px;background-color:#E83A17;font-size:14px;}
.btn2{background-color:#D43211;}
</style>
<script language="javascript" src="../js/jquery.min.js"></script>
<script language="javascript" src="../js/layer.js"></script>
<script language="javascript">
function tj(){
if(document.f1.t1.value==""){alert("请输入有效的购买数量");document.f1.t1.focus();return false;}	
layer.msg('正在保存', {icon: 16  ,time: 0,shade :0.25});
f1.action="buynum.php?control=update&id=<?=$id?>";
}
<? if($_GET[t]=="suc"){?>
parent.location.reload();
<? }?>
</script>
</head>
<body>
<form name="f1" method="post" onsubmit="return tj()">
<input type="hidden" value="buynum" name="yjcode" />
<ul class="uk">
<li class="l1"><input name="t1" class="inp" autocomplete="off" disableautocomplete onkeyup="value=value.replace(/[^\d]/g,'');" value="<?=$row[num]?>" type="text" /></li>
<li class="l2"><?=tjbtnr("保存修改")?></li>
</ul>
</form>
</body>
</html>