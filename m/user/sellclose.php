<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellorder.php");}


if(sqlzhuru($_POST[yjcode])=="close"){
 zwzr();
 $pwd=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,pwd","yjcode_user where pwd='".$pwd."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("登录密码有误！","sellclose.php?zuorderbh=".$zuorderbh);}
 if($row[ddzt]!="wait"){Audit_alert("未知错误！","sellorderview.php?orderbh=".$orderbh);}
 PointUpdateM($row[userid],$row[allmoney3]);
 PointIntoM($row[userid],"卖家取消订单",$row[allmoney3]);
 updatetable("yjcode_order","ddzt='close' where selluserid=".$userid." and zuorderbh='".$zuorderbh."'");
 $txt="商家取消了订单";
 intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$zuorderbh."',".$row[userid].",".$row[selluserid].",2,'".$txt."','".$sj."'");
 php_toheader("sellorderview.php?zuorderbh=".$zuorderbh); 

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
 <div class="d1" onClick="gourl('sellorder.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">取消订单</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]=="wait"){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){layerts("请输入登录密码");return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="sellclose.php?zuorderbh=<?=$zuorderbh?>";
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
 * 您未发货，取消订单后，费用将直接退回至买家帐号
 </div>
 </div>
 <? }?>

 <? include("sellorderv.php");?>
 
</body>
</html>