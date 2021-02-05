<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellorder.php");}

if(sqlzhuru($_POST[jvs])=="fh"){
 zwzr();
 if($row[ddzt]!="wait"){Audit_alert("未知错误！","sellorderview.php?orderbh=".$orderbh);}
 $sj=date("Y-m-d H:i:s"); 
 $kdid=intval($_POST[tkd]);
 if(!is_numeric($kdid)){$kdid=0;}
 $oksj=date("Y-m-d H:i:s",strtotime("+".$rowcontrol[dbsj]." day"));
 updatetable("yjcode_order","fhsj='".$sj."',ddzt='db',kdid=".$kdid.",kddh='".sqlzhuru($_POST[tkddh])."',fhtxt='".sqlzhuru1($_POST[content])."',dbautosj=".strtotime($oksj)." where ddzt='wait' and zuorderbh='".$zuorderbh."' and selluserid=".$userid);
 $c_tit="卖家已经发货，款项进入担保阶段，等待买家确认收货";
 intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$zuorderbh."',".$row[userid].",".$row[selluserid].",2,'".$c_tit."','".$sj."'");
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
 <div class="d2">发货</div>
 <div class="d3"></div>
</div>

 <? if($row[ddzt]=="wait"){?>
 <script language="javascript">
 function tj(){
 if(!confirm("确定要发货吗？")){return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="fahuo.php?zuorderbh=<?=$zuorderbh?>";
 }
 </script>
 <form name="f1" method="post" onSubmit="return tj()">
 <? if($row[fhxs]==5){?>
 <div class="uk box" style="margin-top:10px;">
 <div class="d1">快递公司<span class="s1"></span></div>
 <div class="d2">
 <select name="tkd" style="font-size:13px;">
 <option value="0">无须快递</option>
 <? while1("*","yjcode_kuaidi where zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
 <option value="<?=$row1[id]?>"><?=$row1[tit]?></option>
 <? }?>
 </select>
 </div>
 <div class="d3"><img src="../img/rightjian.png" height="13" /></div>
 </div>
 <div class="uk box">
 <div class="d1">快递单号<span class="s1"></span></div>
 <div class="d2"><input  name="tkddh" placeholder="请输入快递单号" class="inp" type="text"/></div>
 </div>
 <? }?>
 <div class="fbbtn box">
  <div class="d1"><? tjbtnr_m("发货")?></div>
 </div>
 <input type="hidden" value="fh" name="jvs" />
 <input type="hidden" value="<?=$orderbh?>" name="orderbh" />
 </form>
 <div class="tishi box">
 <div class="d1">
 <strong>* 站长提示：</strong><br>
 * 尽可能快的发货速度将有助于提高买家对您的评价<br>
 * 发货后，请为买家提供优质的售后服务
 </div>
 </div>
 <? }?>

 <? include("sellorderv.php");?>
 
</body>
</html>