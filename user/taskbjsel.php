<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$bh=$_GET[bh];
$mid=intval($_GET[mid]);
$sj=date("Y-m-d H:i:s");
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$userid=$rowuser[id];

$sqltask="select * from yjcode_task where bh='".$bh."' and taskty=0 and userid=".$userid."";mysqli_set_charset($conn,"utf8");$restask=mysqli_query($conn,$sqltask);
if(!$rowtask=mysqli_fetch_array($restask)){php_toheader("tasklist.php");}

$sqltaskhf="select * from yjcode_taskhf where bh='".$bh."' and userid=".$userid." and id=".$mid;mysqli_set_charset($conn,"utf8");$restaskhf=mysqli_query($conn,$sqltaskhf);
if(!$rowtaskhf=mysqli_fetch_array($restaskhf)){php_toheader("taskbjlist.php?bh=".$bh);}

if($_GET[control]=="hz"){
 if(0!=$row[zt]){Audit_alert("操作失败，返回重试","taskbjsel.php?bh=".$bh."&mid=".$mid);}
 $money5=0;
 if(empty($rowtask[yjfs])){$money5=$rowtaskhf[money1]*$rowcontrol[taskyj];}
 elseif($rowtask[yjfs]==2){$money5=$rowtaskhf[money1]*$rowcontrol[taskyj]*0.5;}
 $djmoney=$rowtaskhf[money1]-$rowtask[money4]+$money5;
 if($djmoney>$rowuser[money1]){Audit_alert("余额不足，请先充值","taskbjsel.php?bh=".$bh."&mid=".$mid);}
 PointIntoM($rowuser[id],"任务开始，冻结金额(任务编号".$bh.")",$djmoney*(-1));
 PointUpdateM($rowuser[id],$djmoney*(-1));
 $money3=$rowtaskhf[money1]+$money5;
 updatetable("yjcode_task","zt=3,useridhf=".$rowtaskhf[useridhf].",money2=".$rowtaskhf[money1].",money3=".$money3.",money5=".$money5." where id=".$rowtask[id]);
 $rwdq=date("Y-m-d H:i:s",strtotime("+".$rowtask[rwzq]." day"));
 updatetable("yjcode_taskhf","ifxz=1,zbsj='".$sj."',rwdq='".$rwdq."' where id=".$mid);
 $txt="已选标，接手方开始做任务，并且需要在".$rwdq."前完成任务并提交验收";
 intotable("yjcode_tasklog","bh,userid,useridhf,admin,txt,sj,fj","'".$bh."',".$rowtask[userid].",".$rowtaskhf[useridhf].",1,'".$txt."','".$sj."',''");
 if(!empty($rowtask[jsbao])){
  while1("bh,useridhf,ifxz","yjcode_taskhf where bh='".$rowtask[bh]."' and ifxz=0");while($row1=mysqli_fetch_array($res1)){
   PointIntoB($row1[useridhf],"任务未中标，退还保证金",$rowtask[jsbao],2);
   PointUpdateB($row1[useridhf],$rowtask[jsbao]); 
  }
 }
 php_toheader("taskbjlist.php?bh=".$bh);
 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/task.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function tj(){
if(!confirm("确定选择该用户使用吗？")){return false;}
layer.msg('正在处理', {icon: 16  ,time: 0,shade :0.25});
f1.action="taskbjsel.php?bh=<?=$bh?>&mid=<?=$mid?>&control=hz";
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
 
 <? include("rcap17.php");?>
 <script language="javascript">
 document.getElementById("rcap1").className="l1 l2";
 </script>

 <!--白B-->
 <div class="rkuang">
 

 <? include("taskv.php");?>
 
 <?
 while2("*","yjcode_user where id=".$rowtaskhf[useridhf]);$row2=mysqli_fetch_array($res2);
 ?>
 <ul class="taskmain">
 <li class="l1">选择用户：</li>
 <li class="l3"><?=$row2[nc]?></li>
 <li class="l1">联系QQ：</li>
 <li class="l3"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$row2[uqq]?>&site=<?=weburl?>&menu=yes" target="_blank"><?=$row2[uqq]?></a></li>
 <li class="l1">联系电话：</li>
 <li class="l3"><?=$row2[mot]?></li>
 <li class="l1">用户报价：</li>
 <li class="l3"><strong class="red">￥<?=$rowtaskhf[money1]?></strong></li>
 <li class="l1">中介费用：</li>
 <li class="l3">
 <? 
 if(empty($rowtask[yjfs])){echo "雇主承担，费用为<strong class='feng'>￥".$rowtaskhf[money1]*$rowcontrol[taskyj]."</strong>";}
 elseif($rowtask[yjfs]==1){echo "接手方承担";}
 elseif($rowtask[yjfs]==2){echo "双方各承担一半，费用为<strong class='feng'>￥".$rowtaskhf[money1]*$rowcontrol[taskyj]*0.5."</strong>";}
 ?>
 </li>
 <li class="l1">报名时间：</li>
 <li class="l3"><?=$rowtaskhf[sj]?></li>
 <li class="l1">我的余额：</li>
 <li class="l2"><strong class="red">￥<?=$rowuser[money1]?></strong> [<a href="pay.php">充值</a>]</li>
 <li class="l4">接手留言：</li>
 <li class="l5"><?=strip_tags(returnjgdw($rowtaskhf[txt],"","未填写任何说明"))?></li>
 <li class="l1">合作须知：</li>
 <li class="l2">选择合作后，需要冻结报价金额(减去订金)</li>
 </ul>

 <? if(0==$rowtask[zt]){?>
 <form name="f1" method="post" onsubmit="return tj()">
 <div class="ftjbtn">
 <? tjbtnr("选择合作","taskbjlist.php?bh=".$bh)?>
 </div>
 </form>
 <? }?>
 
 <div class="clear clear20"></div>
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>