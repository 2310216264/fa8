<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and ddzt=5 and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("serverorder.php");}


if(sqlzhuru($_POST[yjcode])=="ys"){
 zwzr();
 $zfmm=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,zfmm","yjcode_user where zfmm='".$zfmm."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("支付密码有误！","serverys.php?orderbh=".$orderbh);}
 $r1=sqlzhuru($_POST["R1"]);
 if($r1=="yes"){ //通过验收
  updatetable("yjcode_serverorder","ddzt=6 where userid=".$userid." and id=".$row[id]);
  $sellblm=$rowcontrol[serversellbl]*$row[money3]; //卖家可得金额
  $ptyj=$row[money3]-$sellblm;
  PointUpdateM($row[selluserid],sprintf("%.2f",$sellblm));
  PointIntoM($row[selluserid],"完成一笔服务订单，已自动扣除平台佣金".$ptyj."元",sprintf("%.2f",$sellblm));
  $str="验收通过。验收说明：".sqlzhuru($_POST[t2]);
  intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",1,'".$str."','".getsj()."'");
 }elseif($r1=="no"){
  updatetable("yjcode_serverorder","ddzt=4 where userid=".$userid." and id=".$row[id]);
  $str="验收不通过，服务订单重新进入担保状态，需要商家再次发起验收。<br>验收说明：".sqlzhuru($_POST[t2]);
  intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",1,'".$str."','".getsj()."'");
 }
 php_toheader("serverorderview.php?orderbh=".$orderbh); 

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

 <? if($row[ddzt]==5){?>
 <script language="javascript">
 function tj(){
 r=document.getElementsByName("R1");rr="";for(i=0;i<r.length;i++){if(r[i].checked==true){rr=r[i].value;}}if(rr==""){alert("请选择验收选项！");return false;}
 if((document.f1.t1.value).replace("/\s/","")==""){layer.alert('请输入支付密码', {icon:5});return false;}
 if(!confirm("是否提供操作？")){return false;}
 layer.msg('正在操作', {icon: 16  ,time: 0,shade :0.25});
 f1.action="serverys.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="serverordercz">
 <li class="l1"><strong>验收</strong></li>
 <li class="l2">请根据商家提供的服务订单，选择以下选项：</li>
 <li class="l3">
 <label class="green"><input name="R1" type="radio" value="yes" /> 通过验收</label>
 <label class="red"><input name="R1" type="radio" value="no" /> 验收不通过 (将重新进入担保状态)</label> 
 </li>
 <li class="l2">验收说明（可留空）：</li>
 <li class="l3"><input  name="t2" class="inp" size="80" type="text"/></li>
 <li class="l2">请输入您的支付密码：(<a href="zfmm.php" class="red">忘了支付密码？</a>)</li>
 <li class="l3"><input  name="t1" class="inp" size="30" type="password"/></li>
 <li class="l4"><?=tjbtnr("确认收货")?></li>
 </ul>
 <input type="hidden" value="ys" name="yjcode" />
 <input type="hidden" value="<?=$orderbh?>" name="orderbh" />
 </form>
 <? }?>
 
 <? include("serverorderv.php");?>

 <div class="clear clear15"></div>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>