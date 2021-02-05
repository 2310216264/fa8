<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$orderbh=$_GET["orderbh"];
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
$rowuser=mysqli_fetch_array($resuser);
while0("*","yjcode_serverorder where ddzt=99 and orderbh='".$orderbh."' and userid=".$rowuser[id]);if(!$row=mysqli_fetch_array($res)){Audit_alert("来源出错，可能这个任务不存在或已经下架","./");}

$sqlsell="select * from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);
if(!$rowsell=mysqli_fetch_array($ressell)){php_toheader("../");}

//入库操作开始
if($_POST[yjcode]=="servebuy"){
 zwzr();
 $num=intval($_POST[tnum]);
 $money3=$row[money1]*$num+$row[money2];
 updatetable("yjcode_serverorder","num=".$num.",money3=".$money3.",ddzt=1 where ddzt=99 and id=".$row[id]);
 php_toheader("serverorderview.php?orderbh=".$orderbh);
}
//入库操作结束

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<style type="text/css">
body,td,th {
	font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
</style>
<? include("cssjs.html");?>
<script language="javascript">
function tj(){
 inpnum=parseInt(document.getElementById("tnum").value);
 if(inpnum<=0){alert("请输入有效的购买数量");document.f1.tnum.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="servebuy.php?control=add&orderbh=<?=$orderbh?>";
}
function numcha(){
 inpnum=parseInt(document.getElementById("tnum").value);
 ddm=accMul(inpnum,<?=$row[money1]?>);
 document.getElementById("tmoney3").innerHTML=ddm;
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

 <!--白B-->
 <div class="rkuang">
 
 <form name="f1" method="post" onsubmit="return tj()">
 <input type="hidden" value="servebuy" name="yjcode" />
 <ul class="uk">
 <li class="l1">服务项目：</li>
 <li class="l21"><?=$row[tit]?></li>
 <? if(!empty($row[taocan])){?>
 <li class="l1">选择套餐：</li>
 <li class="l21"><?=$row[taocan]?></li>
 <? }?>
 <li class="l1">服务单价：</li>
 <li class="l21"><?=$row[money1]?> 元</li>
 <li class="l1">购买数量：</li>
 <li class="l2"><input type="text" class="inp" size="5" onkeyup="value=value.replace(/[^\d]/g,'');numcha();" value="<?=$row[num]?>" id="tnum" name="tnum" /><span class="fd">件</span></li>
 <li class="l1">附加费用：</li>
 <li class="l21"><?=$row[money2]?> 元</li>
 <li class="l1">费用总和：</li>
 <li class="l21"><strong class="feng" id="tmoney3"><?=$row[money3]?></strong> 元</li>
 <li class="l1">卖家QQ号：</li>
 <li class="l21"><a href="javascript:void(0);" onclick="opentangqq('<?=$rowsell[uqq]?>')"><?=$rowsell[uqq]?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;卖家微信号：<?=$rowsell[weixin]?></li>
 <li class="l3"><?=tjbtnr("下一步")?></li>
 </ul>
 </form>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>