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
 location.href="selltj.php?"+str;
}
</script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>

<?
$ddzt=$_GET[ddzt];
$ses="yjcode_order where admin=1 and selluserid=".$rowuser[id];
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
 document.getElementById("rcap1").className="l1 l2";
 </script>


 <!--搜索B-->
 <div class="kssel">
 <ul class="u1">
 <li class="l1">交易状态：</li>
 <li class="l2">
 <select id="ddztv">
 <option value="">不限</option>
 <option value="wait"<? if($_GET[ddzt]=="wait"){?> selected="selected"<? }?>>等待发货</option>
 <option value="db"<? if($_GET[ddzt]=="db"){?> selected="selected"<? }?>>等待买家确认</option>
 <option value="suc"<? if($_GET[ddzt]=="suc"){?> selected="selected"<? }?>>交易成功</option>
 <option value="back"<? if($_GET[ddzt]=="back"){?> selected="selected"<? }?>>退款申请中</option>
 <option value="backerr"<? if($_GET[ddzt]=="backerr"){?> selected="selected"<? }?>>不同意的退款</option>
 <option value="backsuc"<? if($_GET[ddzt]=="backsuc"){?> selected="selected"<? }?>>退款成功</option>
 <option value="jf"<? if($_GET[ddzt]=="jf"){?> selected="selected"<? }?>>订单纠纷</option>
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
 <li class="ltj"><input type="button" onclick="ser()" class="bt1" value="搜索" /> <input type="button" onclick="gourl('selltj.php')" class="bt2" value="重置" /></li>
 </ul>
 </div>
 <!--搜索E-->

 <!--白B-->
 <div class="rkuang">
 
 <ul class="selltjlist">
 <li class="l1">快速查询：</li>
 <li class="l2">
 <a href="selltj.php?t2v=<?=dateYM($sj)."-01 00:00:00"?>">查询这个月</a>&nbsp;&nbsp;&nbsp;&nbsp;
 <? $a=getlastMonthDays($sj);?>
 <a href="selltj.php?t2v=<?=$a[0]." 00:00:00"?>&t3v=<?=$a[1]." 00:00:00"?>">查询上个月</a>&nbsp;&nbsp;&nbsp;&nbsp;
 <? $a=date("Y-m-d H:i:s",strtotime("-30 day"));?>
 <a href="selltj.php?t2v=<?=$a?>&t3v=<?=$sj?>">查询最近30天</a>
 </li>
 </ul>

 <? $ddztarr=array("suc","wait","db","back","backerr","backsuc","jf","jfsell","jfbuy");for($i=0;$i<count($ddztarr);$i++){?>
 
 <? $nzt=$ddztarr[$i];if($ddzt=="" || $ddzt==$nzt){?>
 <ul class="selltjlist">
 <li class="l1">订单状态：</li>
 <li class="l3"><?=returnorderzt($nzt)?></li>
 <li class="l1">交易总额：</li>
 <li class="l3"><?=sprintf("%.2f",returnsum("allmoney3",$ses." and ddzt='".$nzt."'"))?>元</li>
 <li class="l1">交易笔数：</li>
 <li class="l3"><?=returncount($ses." and ddzt='".$nzt."'")?>笔</li>
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