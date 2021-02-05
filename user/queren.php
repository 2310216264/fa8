<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and selluserid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("sellserverorder.php");}

if(sqlzhuru($_POST[yjcode])=="qr"){
 zwzr();
 if($row[ddzt]!=1){Audit_alert("未知错误！","sellserverorderview.php?orderbh=".$orderbh);}
 updatetable("yjcode_serverorder","ddzt=2 where ddzt=1 and id=".$row[id]);
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
 
 <? include("sellserverorderv.php");?>
 <? if($row[ddzt]==1){?>
 <script language="javascript">
 function tj(){
 if(!confirm("确认接单吗？")){return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="queren.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="ordercz">
 <li class="l1">
 <strong>* 温馨提示：</strong><br>
 * 请务必跟买家确认好订单价格及内容后再接单。接单后，请为买家提供优质的售后服务
 </li>
 <li class="l4"><?=tjbtnr("确认接单")?></li>
 </ul>
 <input type="hidden" value="qr" name="yjcode" />
 <input type="hidden" value="<?=$orderbh?>" name="orderbh" />
 </form>
 <? }?>
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