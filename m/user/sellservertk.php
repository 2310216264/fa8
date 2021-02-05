<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellserverorder.php");}


if(sqlzhuru($_POST[yjcode])=="tk"){
 zwzr();
 $pwd=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,pwd","yjcode_user where pwd='".$pwd."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("登录密码有误！","sellservertk.php?orderbh=".$orderbh);}
 if($row[ddzt]!=7 && $row[ddzt]!=9){Audit_alert("未知错误！","sellserverorderview.php?orderbh=".$orderbh);}
 $r1=sqlzhuru($_POST["R1"]);
 if($r1=="yes"){ //同意退款
  PointUpdateM($row[userid],$row[money3]);
  PointIntoM($row[userid],"商家同意退款，服务订单编号".$row[orderbh],$row[money3]);
  updatetable("yjcode_serverorder","ddzt=8 where selluserid=".$userid." and id=".$row[id]);
  $str="商家同意退款。说明：".sqlzhuru($_POST[t2]);
  intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",2,'".$str."','".getsj()."'");
 }elseif($r1=="no"){
  updatetable("yjcode_serverorder","ddzt=9 where selluserid=".$userid." and id=".$row[id]);
  $str="商家拒绝了退款申请。说明：".sqlzhuru($_POST[t2]);
  intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",2,'".$str."','".getsj()."'");
 }
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

 <? if($row[ddzt]==7 || $row[ddzt]==9){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){layerts("请输入登录密码");return false;}
 if(!confirm("确定提交吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="sellservertk.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <div class="listcap box"><div class="d2">附加说明（可留空）：</div></div>
 <div class="sellordertk box"><div class="d1"><textarea name="t2"></textarea></div></div>
 <div class="uk box">
  <div class="d1">是否同意<span class="s1"></span></div>
  <div class="d2">
  <select name="R1" style="font-size:14px;">
  <option value="yes">同意</option>
  <option value="no">不同意</option>
  </select>
  </div>
  <div class="d3"><img src="../img/rightjian.png" height="13" /></div>
 </div>
 <div class="uk box">
  <div class="d1">登录密码<span class="s1"></span></div>
  <div class="d2"><input type="password" name="t1" class="inp" placeholder="请输入登录密码" /></div>
 </div>
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("提交")?></div>
 </div>
 <div class="tishi box">
 <div class="d1">
 <strong>站长提示：</strong><br>
 在处理退款前，建议先与买方沟通协商好
 </div>
 </div>
 <input type="hidden" value="tk" name="yjcode" />
 </form>
 <? }?>

 <? include("sellserverorderv.php");?>
 
</body>
</html>