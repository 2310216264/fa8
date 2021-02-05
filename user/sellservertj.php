<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/adddate.js" ></script> 
<script language="javascript">
function ser(){
 str="&t2v="+document.getElementById("t2").value;
 str=str+"&t3v="+document.getElementById("t3").value;
 str=str+"&ddzt="+document.getElementById("ddztv").value;
 location.href="sellservertj.php?"+str;
}
</script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>

<?
$ddzt=intval($_GET[ddzt]);
$ses="yjcode_serverorder where ddzt<>99 and selluserid=".$rowuser[id];
if($_GET[t2v]!=""){$ses=$ses." and sj>='".$_GET[t2v]."'";}
if($_GET[t3v]!=""){$ses=$ses." and sj<='".$_GET[t3v]."'";}
?>

<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">

 <? include("sellzf.php");?>
 
 <? include("rcap20.php");?>
 <script language="javascript">
 document.getElementById("rcap2").className="l1 l2";
 </script>


 <!--搜索B-->
 <div class="kssel">
 <ul class="u1">
 <li class="l1">交易状态：</li>
 <li class="l2">
 <select id="ddztv">
 <option value="">不限</option>
 <? for($i=1;$i<=13;$i++){?>
 <option value="<?=$i?>"<? if(intval($ddzt)==$i){?> selected="selected"<? }?>><?=returnserverorderzt($i)?></option>
 <? }?>
 </select>
 </li>
 <li class="l1">开始时间：</li>
 <li class="l2">
 <input type="text" value="<?=$_GET[t2v]?>" style="width:155px;" id="t2" readonly="readonly" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" />
 </li>
 <li class="l1">结束时间：</li>
 <li class="l2">
 <input type="text" value="<?=$_GET[t3v]?>" style="width:155px;" id="t3"readonly="readonly" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" />
 </li>
 <li class="ltj"><input type="button" onclick="ser()" class="bt1" value="搜索" /> <input type="button" onclick="gourl('sellservertj.php')" class="bt2" value="重置" /></li>
 </ul>
 </div>
 <!--搜索E-->

 <!--白B-->
 <div class="rkuang">
 
 <ul class="selltjlist">
 <li class="l1">快速查询：</li>
 <li class="l2">
 <a href="sellservertj.php?t2v=<?=dateYM($sj)."-01 00:00:00"?>">查询这个月</a>&nbsp;&nbsp;&nbsp;&nbsp;
 <? $a=getlastMonthDays($sj);?>
 <a href="sellservertj.php?t2v=<?=$a[0]." 00:00:00"?>&t3v=<?=$a[1]." 00:00:00"?>">查询上个月</a>&nbsp;&nbsp;&nbsp;&nbsp;
 <? $a=date("Y-m-d H:i:s",strtotime("-30 day"));?>
 <a href="sellservertj.php?t2v=<?=$a?>&t3v=<?=$sj?>">查询最近30天</a>
 </li>
 </ul>

 <? for($i=1;$i<=13;$i++){?>
 
 <? if(empty($ddzt) || $ddzt==$i){?>
 <ul class="selltjlist">
 <li class="l1">订单状态：</li>
 <li class="l3"><?=returnserverorderzt($i)?></li>
 <li class="l1">交易总额：</li>
 <li class="l3"><?=sprintf("%.2f",returnsum("money3",$ses." and ddzt=".$i.""))?>元</li>
 <li class="l1">交易笔数：</li>
 <li class="l3"><?=returncount($ses." and ddzt=".$i."")?>笔</li>
 </ul>
 <? }?>
 
 <? }?>
  
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