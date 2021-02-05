<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("serverorder.php");}


if(sqlzhuru($_POST[yjcode])=="qxtk"){
 zwzr();
 $pwd=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,pwd","yjcode_user where pwd='".$pwd."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("登录密码有误！","serverqxtk.php?orderbh=".$orderbh);}
 if($row[ddzt]!=7 && $row[ddzt]!=9){Audit_alert("未知错误！","serverorderview.php?orderbh=".$orderbh);}
 $str="买方取消了退款申请";
 intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",1,'".$str."','".getsj()."'");
 updatetable("yjcode_serverorder","ddzt=4 where id=".$row[id]);
 php_toheader("serverorderview.php?orderbh=".$orderbh); 

}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="gourl('serverorder.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">取消退款</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]==7 || $row[ddzt]==9){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){layerts("请输入登录密码");return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="serverqxtk.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <div class="uk box">
  <div class="d1">登录密码<span class="s1"></span></div>
  <div class="d2"><input type="password" name="t1" class="inp" placeholder="请输入登录密码" /></div>
 </div>
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("取消退款")?></div>
 </div>
 <input type="hidden" value="qxtk" name="yjcode" />
 </form>
 <div class="tishi box">
 <div class="d1">
 <strong>* 站长提示：</strong><br>
 * 取消退款申请的话，订单会变更为担保状态，需要商家再次提交验收
 </div>
 </div>
 <? }?>

 <? include("serverorderv.php");?>
 
</body>
</html>