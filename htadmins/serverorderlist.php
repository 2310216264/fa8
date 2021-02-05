<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$ses=" where ddzt<>99 and id>0";
if($_GET[ddzt]!=""){$ses=$ses." and ddzt=".intval($_GET[ddzt])."";}
if($_GET[st1]!=""){$ses=$ses." and orderbh ='".$_GET[st1]."'";}
if($_GET[st2]!=""){$ses=$ses." and tit like '%".$_GET[st2]."%'";}
if($_GET[page]!=""){$page=$_GET[page];}else{$page=1;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/order.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script language="javascript">
function ser(){
location.href="serverorderlist.php?st1="+document.getElementById("st1").value+"&st2="+document.getElementById("st2").value+"&ddzt=<?=$_GET[ddzt]?>";	
}
</script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu6").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0402,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
 <? $leftid=2;include("menu_order.php");?>

<div class="right">
 <div class="bqu1">
 <a class="a1" href="serverorderlist.php?ddzt=<?=$_GET[ddzt]?>"><?=returnjgdw(returnserverorderzt($_GET[ddzt]),"","所有服务订单")?></a>
 </div>

 <div class="rights">
 <strong>提示：</strong><br>
 <span class="red">程序给予管理员最高权限，可删除任意服务订单信息，但删除正在交易中的服务订单，可能会引起会员资金数据的不同步，且不可恢复，请慎重。</span>
 </div>
 <!--B-->
 <ul class="psel">
 <li class="l1">订单编码：</li><li class="l2"><input value="<?=$_GET[st1]?>" type="text" id="st1" size="15" /></li>
 <li class="l1">商品信息：</li><li class="l2"><input value="<?=$_GET[st2]?>" type="text" id="st2" size="15" /></li>
 <li class="l3"><a href="javascript:ser()" class="a2">搜索</a></li>
 </ul>
 <ul class="ksedi">
 <li class="l2">
 <a href="javascript:checkDEL(49,'yjcode_serverorder')" class="a2">删除</a>
 </li>
 </ul>
 <ul class="serordercap">
 <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l2">订单信息</li>
 <li class="l3">订单状态</li>
 <li class="l4">价格</li>
 <li class="l5">买家</li>
 <li class="l6">卖家</li>
 <li class="l7">下单时间/IP</li>
 </ul>
 <?
 pagef($ses,10,"yjcode_serverorder","order by sj desc");while($row=mysqli_fetch_array($res)){
 $tp=returntp("bh='".$row[serverbh]."' order by xh asc","-1");
 $au="serverorderview.php?orderbh=".$row[orderbh];
 ?>
 <ul class="serorderlist">
 <li class="l1"><input name="C1" type="checkbox" value="<?=$row[orderbh]?>" /></li>
 <li class="l2">
 <a href="<?=$au?>"><img border="0" class="imgtp" src="<?=$tp?>" onerror="this.src='../img/none60x60.gif'" width="52" height="52" align="left" /></a>
 <a title="<?=$row["tit"]?>" href="<?=$au?>" class="a1"><?=returntitdian($row["tit"],100)?></a><br>
 订单编号：<?=$row[orderbh]?>
 </li>
 <li class="l3"><?=returnserverorderzt($row[ddzt])?></li>
 <li class="l4"><strong class="feng">￥<?=$row[money3]?></strong><br>单价:<?=$row[money1]?><br>附加费:<?=$row[money2]?><br>数量:<?=$row[num]?></li>
 <li class="l5"><a href="user.php?id=<?=$row[userid]?>"><?=returnnc($row[userid])?></a><br><a href="http://wpa.qq.com/msgrd?v=3&uin=<?=returnqq($row[userid])?>&site=<?=weburl?>&menu=yes" target="_blank"><img border="0" src="img/qq.png" /></a></li>
 <li class="l6"><a href="user.php?id=<?=$row[selluserid]?>"><?=returnnc($row[selluserid])?></a><br><a href="http://wpa.qq.com/msgrd?v=3&uin=<?=returnqq($row[selluserid])?>&site=<?=weburl?>&menu=yes" target="_blank"><img border="0" src="img/qq.png" /></a></li>
 <li class="l7"><?=$row[sj]?><br><?=$row[uip]?></li>
 </ul>
 <? }?>
 <?
 $nowurl="serverorderlist.php";
 $nowwd="ddzt=".$_GET[ddzt]."&st1=".$_GET[st1]."&st2=".$_GET[st2];
 include("page.php");
 ?>
 <!--E-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>