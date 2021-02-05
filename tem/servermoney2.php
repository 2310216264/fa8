<?
header("Content-type:text/html;charset=utf-8");
include("../config/conn.php");
include("../config/function.php");
$id=intval($_GET[id]);
$userid=returnuserid($_SESSION["SHOPUSER"]);
while0("*","yjcode_serverorder where id=".$id." and ddzt=1 and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){Audit_alert("未知错误！","../user/sellserverorder.php","parent.");}

if($_POST["yjcode"]=="money2"){
 zwzr();
 $money2=round((float)$_POST["tmoney2"],2);
 $money3=$row[money1]*$row[num]+$money2;
 $money3=round($money3,2);
 updatetable("yjcode_serverorder","money2=".$money2.",money3=".$money3." where id=".$id);
 php_toheader("servermoney2.php?t=suc&id=".$id); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改附加选项</title>
<link href="../css/global.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/global.js"></script>
<script language="javascript" src="../js/jquery.min.js"></script>
<script language="javascript" src="../js/layer.js"></script>
<style type="text/css">
body{background-color:#F5F8FE;}
.u1{float:left;width:300px;text-align:left;margin:10px 0 0 10px;}
.u1 li{float:left;}
.u1 .l1{width:130px;}
.u1 .l1 input{float:left;width:128px;border:#ddd solid 1px;height:30px;font-size:14px;font-weight:700;text-align:center;color:green;	}
.u1 .l2{width:170px;}
.u1 .l2 input{float:left;margin:0 0 0 10px;width:148px;height:32px;cursor:pointer;border:0;color:#fff;background-color:#ff6600;}
.u1 .l3{width:300px;margin:10px 0 0 0;line-height:20px;}
body,td,th {
	font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
</style>
<script language="javascript">
function tj(){
if(document.f1.tmoney2.vale==""){alert("请输入数值");document.f1.tmoney2.select();return false;}
layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
f1.action="servermoney2.php?id=<?=$id?>";
}
<? if($_GET[t]=="suc"){?>
parent.location.reload();
<? }?>
</script>
</head>
<body>
<form name="f1" method="post" onsubmit="return tj()">
<input type="hidden" value="money2" name="yjcode" />
<ul class="u1">
<li class="l1"><input type="text" placeholder="请输入附加费用" value="<?=$row[money2]?>" name="tmoney2" /></li>
<li class="l2"><input type="submit" value="修改" /></li>
<li class="l3">提示：数值有正负之分，正数表示增加，负数表示减少<br>算法：总额=单价*数量+附加费用</li>
</ul>
</form>
</body>
</html>