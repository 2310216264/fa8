<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellserverorder.php");}


if(sqlzhuru($_POST[yjcode])=="tk"){
 zwzr();
 $zfmm=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,zfmm","yjcode_user where zfmm='".$zfmm."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("支付密码有误！","sellservertk.php?orderbh=".$orderbh);}
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <? include("sellzf.php");?>

 <!--白B-->
 <div class="rkuang">
 
 <? if($row[ddzt]==7 || $row[ddzt]==9){?>
 <script language="javascript">
 function tj(){
 r=document.getElementsByName("R1");rr="";for(i=0;i<r.length;i++){if(r[i].checked==true){rr=r[i].value;}}if(rr==""){alert("请选择处理选项！");return false;}
 if((document.f1.t1.value).replace("/\s/","")==""){alert("请输入支付密码");document.f1.t1.focus();return false;}
 if(!confirm("确定提交吗？")){return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="sellservertk.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="serverordercz">
 <li class="l1"><strong>退款处理</strong></li>
 <li class="l2">在处理退款前，建议先与买方沟通协商好</li>
 <li class="l3">
 <label class="green"><input name="R1" type="radio" value="yes" /> 同意退款</label>
 <label class="red"><input name="R1" type="radio" value="no" /> 不同意退款 </label> 
 </li>
 <li class="l2">附加说明（可留空）：</li>
 <li class="l3"><input  name="t2" class="inp" size="80" type="text"/></li>
 <li class="l2">请输入您的支付密码：(<a href="zfmm.php" class="red">忘了支付密码？</a>)</li>
 <li class="l3"><input  name="t1" class="inp" size="30" type="password"/></li>
 <li class="l4"><?=tjbtnr("提交")?></li>
 </ul>
 <input type="hidden" value="tk" name="yjcode" />
 <input type="hidden" value="<?=$orderbh?>" name="orderbh" />
 </form>
 <? }?>

 <? include("sellserverorderv.php");?>
 
 <div class="clear clear10"></div>
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>