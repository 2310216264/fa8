<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$id=intval($_GET[id]);
$userid=returnuserid($_SESSION["SHOPUSER"]);
while0("*","yjcode_serverorder where id=".$id." and ddzt=1 and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){Audit_alert("未知错误！","../user/sellserverorder.php","parent.");}

if($_POST["yjcode"]=="money2"){
 zwzr();
 $money2=round((float)$_POST["tmoney2"],2);
 $money3=$row[money1]*$row[num]+$money2;
 $money3=round($money3,2);
 updatetable("yjcode_serverorder","money2=".$money2.",money3=".$money3." where id=".$id);
 php_toheader("sellserverorderview.php?orderbh=".$row[orderbh]); 
}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<script language="javascript">
function tj(){
 if(document.f1.tmoney2.vale==""){alert("请输入数值");document.f1.tmoney2.select();return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="servermoney2.php?id=<?=$id?>";
}
</script>
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="sellserverorderview.php?orderbh=<?=$row[orderbh]?>"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">调整服务订单费用</div>
 <div class="d3"></div>
</div>

<form name="f1" method="post" onSubmit="return tj()">
 <input type="hidden" value="money2" name="yjcode" />

<div class="uk box">
 <div class="d1">服务项目<span class="s1"></span></div>
 <div class="d21"><?=$row[tit]?></div>
</div>

<div class="uk box">
 <div class="d1">附加费用<span class="s1"></span></div>
 <div class="d2"><input class="inp" type="text" placeholder="请输入附加费用" style="font-size:14px;color:#ff6600;" value="<?=$row[money2]?>" name="tmoney2" /></div>
</div>

<div class="uk box">
 <div class="d1">费用提示<span class="s1"></span></div>
 <div class="d21">提示：数值有正负之分，正数表示增加，负数表示减少<br>算法：总额=单价*数量+附加费用</div>
</div>

<div class="fbbtn box">
 <div class="d1"><? tjbtnr_m("保存修改")?></div>
</div>

</form>
</body>
</html>