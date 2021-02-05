<?
include("../config/conn.php");
include("../config/function.php");
$getstr=$_GET[str];
$id=intval(returnsx("i"));
while0("*","yjcode_server where id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$row[wkey]?>">
<meta name="description" content="<?=$row[wdes]?>">
<title><?=$row[tit]?>成交记录 - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>
<div class="yjcode">

 <div class="morecj">
   <ul class="morecju1">
   <li class="l1">商品名称</li>
   <li class="l2">总价</li>
   <li class="l3">数量</li>
   <li class="l4">用户名</li>
   <li class="l5">购买时间</li>
   </ul>
   <? 
   if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}
   pagef(" where (ddzt=2 or ddzt=4 or ddzt=5 or ddzt=6 or ddzt=11) and serverbh='".$row[bh]."'",30,"yjcode_serverorder","order by sj desc");while($row=mysqli_fetch_array($res)){
   ?>
   <ul class="morecju2">
   <li class="l1"><?=$row[tit]." ".$row[taocan]?></li>
   <li class="l2"><?=sprintf("%.2f",$row[money3])?></li>
   <li class="l3"><?=$row[num]?></li>
   <li class="l4"><?=returnjiami(returnnc($row[userid]))?></li>
   <li class="l5"><?=dateYMD($row[sj])?></li>
   </ul>
   <? }?>
 
   <div class="npa">
   <?
   $nowurl="cjlist";
   $nowwd="";
   require("../tem/page.html");
   ?>
   </div>

 </div>

</div>
<? include("../tem/bottom.html");?>
</body>
</html>