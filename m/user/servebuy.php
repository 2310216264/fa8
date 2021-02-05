<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

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
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<script language="javascript">
function tj(){
 inpnum=parseInt(document.getElementById("tnum").value);
 if(inpnum<=0){alert("请输入有效的购买数量");document.f1.tnum.focus();return false;}
 layer.open({type: 2,content: '正在提交',shadeClose:false});
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
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="javascript:window.history.go(-1);"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">服务下单</div>
 <div class="d3"></div>
</div>

<form name="f1" method="post" onSubmit="return tj()">
 <input type="hidden" value="servebuy" name="yjcode" />

<div class="uk box">
 <div class="d1">服务项目<span class="s1"></span></div>
 <div class="d21"><?=$row[tit]?></div>
</div>

<? if(!empty($row[taocan])){?>
<div class="uk box">
 <div class="d1">选择套餐<span class="s1"></span></div>
 <div class="d21"><?=$row[taocan]?></div>
</div>
<? }?>

<div class="uk box">
 <div class="d1">服务单价<span class="s1"></span></div>
 <div class="d21"><?=$row[money1]?> 元</div>
</div>

<div class="uk box">
 <div class="d1">购买数量<span class="s1"></span></div>
 <div class="d2"><input type="text" class="inp" size="5" onkeyup="value=value.replace(/[^\d]/g,'');numcha();" value="<?=$row[num]?>" id="tnum" name="tnum" /></div>
</div>

<div class="uk box">
 <div class="d1">附加费用<span class="s1"></span></div>
 <div class="d21"><?=$row[money2]?> 元</div>
</div>

<div class="uk box">
 <div class="d1">费用总和<span class="s1"></span></div>
 <div class="d21"><strong class="feng" id="tmoney3"><?=$row[money3]?></strong> 元</div>
</div>

<div class="uk box">
 <div class="d1">卖家QQ<span class="s1"></span></div>
 <div class="d21"><a href="javascript:void(0);" onclick="qqtang('<?=$rowsell[uqq]?>','<?=$rowsell[weixin]?>',<?=$rowsell[id]?>)"><?=$rowsell[uqq]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;卖家微信号：<?=$rowsell[weixin]?></a></div>
</div>

<div class="fbbtn box">
 <div class="d1"><? tjbtnr_m("下一步")?></div>
</div>

</form>
</body>
</html>