<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellserverorder.php");}


if(sqlzhuru($_POST[yjcode])=="close"){
 zwzr();
 $zfmm=sha1(sqlzhuru($_POST[t1]));
 if(panduan("uid,zfmm","yjcode_user where zfmm='".$zfmm."' and uid='".$_SESSION[SHOPUSER]."'")==0){Audit_alert("支付密码有误！","yanshou.php?orderbh=".$orderbh);}
 if($row[ddzt]!=4){Audit_alert("未知错误！","sellserverorderview.php?orderbh=".$orderbh);}
 updatetable("yjcode_serverorder","ddzt=5 where id=".$row[id]);
 $str="商家已经完成，提交了验收";
 intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",2,'".$str."','".getsj()."'");
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
 
 <? if($row[ddzt]==4){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace("/\s/","")==""){alert("请输入支付密码");document.f1.t1.focus();return false;}
 if(!confirm("确定要提交验收吗？")){return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="yanshou.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="serverordercz">
 <li class="l1">
 <strong>* 站长提示：</strong><br>
 * 为了确保交易顺利进行，请务必先跟买方进行沟通，再提交验收<br>
 </li>
 <li class="l2">请输入您的支付密码：(<a href="zfmm.php" class="red">忘了支付密码？</a>)</li>
 <li class="l3"><input  name="t1" class="inp" size="30" type="password"/></li>
 <li class="l4"><?=tjbtnr("提交验收")?></li>
 </ul>
 <input type="hidden" value="close" name="yjcode" />
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