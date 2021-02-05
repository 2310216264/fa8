<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$userid=$rowuser[id];

$zuorderbh=$_GET[zuorderbh];
$sj=date("Y-m-d H:i:s");
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and (ddzt='suc' or ddzt='jfsell') and admin=1 and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("order.php");}

if(sqlzhuru($_POST[yjcode])=="pj"){
 zwzr();
 if(1==$row[ifpj]){Audit_alert("您已评价过，不能重复点评！","orderpj.php?zuorderbh=".$zuorderbh);}
 if(panduan("*","yjcode_tp where bh='".$zuorderbh."'")==1){$iftp=1;}else{$iftp=0;}
 updatetable("yjcode_order","ifpj=1,pjtxt='".sqlzhuru($_POST[s1])."',pjsj='".$sj."',pf1=".sqlzhuru($_POST[hpjjf1]).",pf2=".sqlzhuru($_POST[hpjjf2]).",pf3=".sqlzhuru($_POST[hpjjf3]).",ifpjtp=".$iftp.",ifpjvideo=0,pjlx=".intval($_POST[Rpj])." where zuorderbh='".$zuorderbh."'");
 $sql1="select avg(pf1) as pf1v,avg(pf2) as pf2v,avg(pf3) as pf3v from yjcode_order where probh='".$row[probh]."' and ifpj=1";
 mysqli_set_charset($conn,"utf8");$res1=mysqli_query($conn,$sql1);$row1=mysqli_fetch_array($res1);
 updatetable("yjcode_pro","pf1=".round($row1[pf1v],2).",pf2=".round($row1[pf2v],2).",pf3=".round($row1[pf3v],2)." where bh='".$row[probh]."'");
 if($row[allmoney3]>0){
 PointInto($userid,"交易成功，点评商品获得积分",$rowcontrol[pjjf]);
 PointUpdate($userid,$rowcontrol[pjjf]); 
 }
 $sqlp="select avg(pf1) pf1v,avg(pf2) pf2v,avg(pf3) pf3v from yjcode_pro where zt=0 and userid=".$row[selluserid];
 mysqli_set_charset($conn,"utf8");$resp=mysqli_query($conn,$sqlp);$rowp=mysqli_fetch_array($resp);
 updatetable("yjcode_user","pf1=".round($rowp[pf1v],2).",pf2=".round($rowp[pf2v],2).",pf3=".round($rowp[pf3v],2)." where id=".$row[selluserid]);
 
 php_toheader("orderpj.php?zuorderbh=".$zuorderbh);

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
<script language="javascript">
function tj(){
 if((document.f1.s1.value).replace(/\s/,"")==""){layerts("请输入简要的点评内容");return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="orderpj.php?zuorderbh=<?=$zuorderbh?>";
}
</script>
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="gourl('order.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">评价</div>
 <div class="d3"></div>
</div>

 <? if(0==$row[ifpj]){?>
 <form name="f1" method="post" onSubmit="return tj()">
 <input type="hidden" value="pj" name="yjcode" />
 <div class="listcap box"><div class="d2">填写评价，可获得<?=$rowcontrol[pjjf]?>积分</div></div>
 <div class="orderpj box"><div class="d1"><textarea name="s1"></textarea></div></div>
 <div class="uk box">
  <div class="d1">评价类型</div>
  <div class="d2">
  <select name="Rpj">
  <option value="1">好评</option>
  <option value="2">中评</option>
  <option value="3">差评</option>
  </select>
  </div>
  <div class="d3"><img src="../img/rightjian.png" height="13" /></div>
 </div>
 <div class="uk box">
  <div class="d1">描述相符</div>
  <div class="d2"><select name="hpjjf1"><? for($i=5;$i>=1;$i--){?><option value="<?=$i?>"><?=$i?>分</option><? }?></select></div>
  <div class="d3"><img src="../img/rightjian.png" height="13" /></div>
 </div>
 <div class="uk box">
  <div class="d1">发货速度</div>
  <div class="d2"><select name="hpjjf2"><? for($i=5;$i>=1;$i--){?><option value="<?=$i?>"><?=$i?>分</option><? }?></select></div>
  <div class="d3"><img src="../img/rightjian.png" height="13" /></div>
 </div>
 <div class="uk box">
  <div class="d1">服务态度</div>
  <div class="d2"><select name="hpjjf3"><? for($i=5;$i>=1;$i--){?><option value="<?=$i?>"><?=$i?>分</option><? }?></select></div>
  <div class="d3"><img src="../img/rightjian.png" height="13" /></div>
 </div>
<!--图片B-->
<div class="uk box">
 <div class="d1">评价图片<span class="s1"></span></div>
 <div class="d2"><iframe style="float:left;margin-top:-1px;" src="tpupload.php?admin=3&bh=<?=$zuorderbh?>" width="103" scrolling="no" height="103" frameborder="0"></iframe></div>
</div>
<div class="xgtp box">
<div class="xgtpm">
 <div id="xgtp1" style="display:none;">正在处理</div>
 <div id="xgtp2"></div>
</div>
</div>
<!--图片E-->
 <div class="fbbtn box">
 <div class="d1"><? tjbtnr_m("发表评论")?></div>
 </div>
 </form>
 
 <? }else{?>
 <div class="orderpj1 box">
  <div class="d1">评价内容</div>
  <div class="d2">
  您于 <?=$row[sj]?> 对本次交易进行了评价：<br>
  描述相符度<strong class="feng"><?=$row[pf1]?>分</strong>，发货速度<strong class="feng"><?=$row[pf2]?>分</strong>，卖家服务态度<strong class="feng"><?=$row[pf3]?>分</strong><br>
  评价：<?=$row[pjtxt]?><br>
  <? while1("*","yjcode_tp where bh='".$zuorderbh."' order by xh asc");while($row1=mysqli_fetch_array($res1)){$tp="../../".str_replace(".","-1.",$row1[tp]);?>
  <a href="../../<?=$row1[tp]?>" target="_blank"><img src="<?=$tp?>" width="50" height="50" /></a>&nbsp;&nbsp;
  <? }?>
  </div>
 </div>
 <? }?>

<? include("orderv.php");?>

<script language="javascript">
function xgtread(x){
 $.get("readtp.php",{bh:x,admin:7},function(result){
  $("#xgtp2").html(result);
 });
}
function deltp(x){
 document.getElementById("xgtp1").style.display="";
 $.get("tpdel.php",{id:x,admin:7},function(result){
  xgtread("<?=$zuorderbh?>");
  document.getElementById("xgtp1").style.display="none";
 });
}
xgtread("<?=$zuorderbh?>");
</script>

</body>
</html>