<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellserverorder.php");}


if(sqlzhuru($_POST[yjcode])=="close"){
 zwzr();
 $pwd=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,pwd","yjcode_user where pwd='".$pwd."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("登录密码有误！","sellserverclose.php?orderbh=".$orderbh);}
 if($row[ddzt]!=1 && $row[ddzt]!=2){Audit_alert("未知错误！","sellserverorderview.php?orderbh=".$orderbh);}
 updatetable("yjcode_serverorder","ddzt=3 where selluserid=".$userid." and id=".$row[id]);
 php_toheader("sellserverorderview.php?orderbh=".$orderbh); 

}

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
 <div class="d1" onClick="gourl('sellserverorder.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">取消订单</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]==1 || $row[ddzt]==2){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){layerts("请输入登录密码");return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="sellserverclose.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <div class="uk box">
  <div class="d1">登录密码<span class="s1"></span></div>
  <div class="d2"><input type="password" name="t1" class="inp" placeholder="请输入登录密码" /></div>
 </div>
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("取消订单")?></div>
 </div>
 <input type="hidden" value="close" name="yjcode" />
 </form>
 <div class="tishi box">
 <div class="d1">
 <strong>* 站长提示：</strong><br>
 * 买方未付款，取消订单，双方无责，不过依然建议先与买方沟通协商好<br>
 * 如果对本单无异议，建议接手本单 【<a href="queren.php?orderbh=<?=$orderbh?>">点击接单</a>】
 </div>
 </div>
 <? }?>

 <? include("sellserverorderv.php");?>
 
</body>
</html>