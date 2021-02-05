<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$userid=$rowuser[id];

$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and (ddzt=6 or ddzt=11) and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("serverorder.php");}
if(panduan("bh","yjcode_server where bh='".$row[serverbh]."'")==0){Audit_alert("该服务信息已被删除，无法进行评价！","serverorder.php");}
$sqlpj="select * from yjcode_serverpj where orderbh='".$orderbh."' and userid=".$userid;mysqli_set_charset($conn,"utf8");$respj=mysqli_query($conn,$sqlpj);
if($rowpj=mysqli_fetch_array($respj)){$ifpj=1;}else{$ifpj=0;}

if(sqlzhuru($_POST[jvs])=="pj"){
 zwzr();
 if(1==$ifpj){Audit_alert("您已评价过，不能重复点评！","serverorderpj.php?orderbh=".$orderbh);}
 $sj=getsj();
 $uip=getuip();
 if(panduan("*","yjcode_tp where bh='".$orderbh."'")==1){$iftp=1;}else{$iftp=0;}
 intotable("yjcode_serverpj","serverbh,selluserid,userid,sj,uip,pf1,pf2,pf3,txt,orderbh,pjlx,iftp","'".$row[serverbh]."',".$row[selluserid].",".$row[userid].",'".$sj."','".$uip."',".sqlzhuru($_POST[hpjjf1]).",".sqlzhuru($_POST[hpjjf2]).",".sqlzhuru($_POST[hpjjf3]).",'".sqlzhuru($_POST[s1])."','".$row[orderbh]."',".$_POST[Rpj].",".$iftp."");$id=mysqli_insert_id($conn);
 if(empty($id)){Audit_alert("您已评价过，不能重复点评！","serverorderpj.php?orderbh=".$orderbh);}
 $sql1="select avg(pf1) as pf1v,avg(pf2) as pf2v,avg(pf3) as pf3v from yjcode_serverpj where serverbh='".$row[serverbh]."' and selluserid=".$row[selluserid];mysqli_set_charset($conn,"utf8");$res1=mysqli_query($conn,$sql1);
 $row1=mysqli_fetch_array($res1);
 updatetable("yjcode_server","pf1=".round($row1[pf1v],2).",pf2=".round($row1[pf2v],2).",pf3=".round($row1[pf3v],2)." where bh='".$row[serverbh]."'");
 PointInto($userid,"交易成功，点评服务获得积分",$rowcontrol[pjjf]);
 PointUpdate($userid,$rowcontrol[pjjf]); 
 updatetable("yjcode_serverorder","ifpj=1 where orderbh='".$orderbh."'");

 $ur="../upload/".$row[userid]."/".$orderbh."/";createDir($ur);$u=inp_tp_upload(1,$ur,"video");if(!empty($u)){updatetable("yjcode_serverpj","ifvideo=1 where id=".$id);}
 
 php_toheader("serverorderpj.php?orderbh=".$orderbh);

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function pjover(x,y){
document.getElementById("pjbg"+x).style.backgroundImage="url(img/pj"+y+"v.gif)";
if(y==0){sv="未打分";}
else if(y==1){sv="失望";}
else if(y==2){sv="不满";}
else if(y==3){sv="一般";}
else if(y==4){sv="满意";}
else if(y==5){sv="惊喜";}
document.getElementById("pjf"+x).innerHTML=y+"分&nbsp;"+sv;
}

function pjonc(x,y){
document.getElementById("hpjjf"+x).value=y;
}

function pjout(x,y){
 pjjf=parseInt(document.getElementById("hpjjf"+x).value);
 if(pjjf!=0){pjover(x,pjjf);}
 else{pjover(x,0);}
}

function tj(){
 if(parseInt(document.getElementById("hpjjf1").value)==0){alert("请先对服务态度打分");return false;}
 if(parseInt(document.getElementById("hpjjf2").value)==0){alert("请先对工作效率打分");return false;}
 if(parseInt(document.getElementById("hpjjf3").value)==0){alert("请先对完成质量打分");return false;}
 if((document.f1.s1.value).replace(/\s/,"")==""){alert("请输入简要的点评内容");document.f1.s1.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 tjwait();
 f1.action="serverorderpj.php?orderbh=<?=$orderbh?>";
}
</script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <ul class="wz">
 <li class="l1 l2"><a href="javascript:void(0);">服务订单详情</a></li>
 <li class="l1"><a href="serverorder.php">我的服务订单</a></li>
 </ul>

 <!--白B-->
 <div class="rkuang">
 
 <? if(0==$ifpj){?>
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <input type="hidden" value="pj" name="jvs" />
 <input type="hidden" id="hpjjf1" name="hpjjf1" value="0" />
 <input type="hidden" id="hpjjf2" name="hpjjf2" value="0" />
 <input type="hidden" id="hpjjf3" name="hpjjf3" value="0" />
 <div class="orderpj">
 <ul class="u1">
 <li class="l1">填写真实评价信息，可获得网站赠送的<?=$rowcontrol[pjjf]?>积分</li>
 <li class="l2">评价<br>服务</li>
 <li class="l3"><textarea name="s1"></textarea></li>
 <li class="l61">视频</li>
 <li class="l6">
 <input type="file" name="inp1" id="inp1" size="15" accept=".mp4">
 </li>
 <li class="l41">图片</li>
 <li class="l4">
 <iframe style="float:left;" src="tpupload.php?admin=8&bh=<?=$orderbh?>" width="150" scrolling="no" height="33" frameborder="0"></iframe>
 </li>
 <li class="l5">(最多上传七张)</li>
 </ul>
 <ul class="u2">
 <li class="l1">服务态度：</li>
 <li class="l2" id="pjbg1"><? for($i=1;$i<=5;$i++){?><span class="s1" onclick="pjonc(1,<?=$i?>)" onmouseout="pjout(1,<?=$i?>)" onmouseover="pjover(1,<?=$i?>)"></span><? }?><span id="pjf1" class="pjf"></span></li>
 <li class="l1">工作效率：</li>
 <li class="l2" id="pjbg2"><? for($i=1;$i<=5;$i++){?><span class="s1" onclick="pjonc(2,<?=$i?>)" onmouseout="pjout(2,<?=$i?>)" onmouseover="pjover(2,<?=$i?>)"></span><? }?><span id="pjf2" class="pjf"></span></li>
 <li class="l1">完成质量：</li>
 <li class="l2" id="pjbg3"><? for($i=1;$i<=5;$i++){?><span class="s1" onclick="pjonc(3,<?=$i?>)" onmouseout="pjout(3,<?=$i?>)" onmouseover="pjover(3,<?=$i?>)"></span><? }?><span id="pjf3" class="pjf"></span></li>
 <li class="l3">综合评价：</li>
 <li class="l4">
 <label><input name="Rpj" type="radio" value="1" checked="checked" /> 好评</label> 
 <label><input name="Rpj" type="radio" value="2" /> 中评</label> 
 <label><input name="Rpj" type="radio" value="3" /> 差评</label>
 </li>
 </ul>
 <div class="xgtp">
  <div id="xgtp1" style="display:none;">正在处理</div>
  <div id="xgtp2"></div>
 </div>
 <div class="pjbtn"><? tjbtnr("发表评价")?></div>
 </div>
 </form>
 
 <? }else{?>
 <div class="orderv1 orderv0">
  <table class="table1" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td class="td1">评价内容</td>
  <td class="td2">
  您于 <?=$rowpj[sj]?> 对本次交易进行了评价：<br>
  <strong class="feng">服务态度<?=$rowpj[pf1]?>分，工作效率<?=$rowpj[pf2]?>分，完成质量<?=$rowpj[pf3]?>分</strong><br>
  评价：<?=$rowpj[txt]?><br>
  <? $u="../upload/".$rowuser[id]."/".$orderbh."/video.mp4";if(is_file($u)){?>
  <a href="<?=$u?>" target="_blank"><img src="../img/video.jpg" width="50" height="50" /></a>&nbsp;&nbsp;
  <? }?>
  <? while1("*","yjcode_tp where bh='".$orderbh."' order by xh asc");while($row1=mysqli_fetch_array($res1)){$tp="../".str_replace(".","-1.",$row1[tp]);?>
  <a href="../<?=$row1[tp]?>" target="_blank"><img src="<?=$tp?>" width="50" height="50" /></a>&nbsp;&nbsp;
  <? }?>
  </td>
  </tr>
  </table>
 </div>
 <? }?>
 
 <? include("serverorderv.php");?>
 
 <div class="clear clear15"></div>

 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<script language="javascript">
function xgtread(x){
 $.get("protp.php",{bh:x},function(result){
  $("#xgtp2").html(result);
 });
}
function deltp(x){
 document.getElementById("xgtp1").style.display="";
 $.get("protpdel.php",{id:x},function(result){
  xgtread("<?=$orderbh?>");
  document.getElementById("xgtp1").style.display="none";
 });
}
xgtread("<?=$orderbh?>");
</script>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>