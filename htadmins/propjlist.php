<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$ses=" where admin=2 and ifpj=1";
if($_GET[st1]!=""){$ses=$ses." and pjtxt like '%".$_GET[st1]."%' or probh='".$_GET[st1]."'";}
if(!empty($_GET[pjlx])){$ses=$ses." and pjlx=".intval($_GET[pjlx]);}
$page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/product.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script language="javascript">
function ser(){
location.href="propjlist.php?st1="+document.getElementById("st1").value+"&pjlx="+document.getElementById("tpjlx").value;	
}
</script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu3").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0102,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
 <? $leftid=1;include("menu_product.php");?>

<div class="right">
 
 <div class="bqu1">
 <a class="a1" href="propjlist.php">商品评价</a>
 </div>

 <div class="rights">
 <strong>提示：</strong><br>
 <span class="red">评价与订单同步，如果要删除评价，需要删除订单，但您可以修改评价内容</span>
 </div>

 <!--B-->
 <ul class="psel">
 <li class="l1">关键词：</li><li class="l2"><input value="<?=$_GET[st1]?>" type="text" id="st1" size="15" /></li>
 <li class="l1">评价类型：</li>
 <li class="l2">
 <select id="tpjlx">
 <option value="">==不限==</option>
 <option value="1"<? if("1"==$_GET[pjlx]){?> selected="selected"<? }?>>好评</option>
 <option value="2"<? if("2"==$_GET[pjlx]){?> selected="selected"<? }?>>中评</option>
 <option value="3"<? if("3"==$_GET[pjlx]){?> selected="selected"<? }?>>差评</option>
 </select>
 </li>
 <li class="l3"><a href="javascript:ser()" class="a2">搜索</a></li>
 </ul>
 <ul class="propj">
 <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l2">类型</li>
 <li class="l3">评价内容</li>
 <li class="l4">评价时间</li>
 <li class="l7">商品信息</li>
 <li class="l5">订单编号</li>
 <li class="l6">描述评分</li>
 <li class="l6">发货评分</li>
 <li class="l6">售后评分</li>
 </ul>
 <?
 pagef($ses,20,"yjcode_order","order by sj desc");while($row=mysqli_fetch_array($res)){
 $aurl="propj.php?id=".$row[id];
 ?>
 <ul class="propjlist">
 <li class="l1"><input name="C1" type="checkbox" value="<?=$row[id]?>" /></li>
 <li class="l2">
 <? if(1==$row[pjlx]){?><span class="green">好评</span><? }?>
 <? if(2==$row[pjlx]){?><span class="blue">中评</span><? }?>
 <? if(3==$row[pjlx]){?><span class="red">差评</span><? }?>
 </li>
 <li class="l3"><a href="<?=$aurl?>"><?=strip_tags($row["pjtxt"])?></a></li>
 <li class="l4"><?=$row[sj]?></li>
 <li class="l7"><a href="../product/view<?=returnproid($row[probh])?>.html" title="<?=$row[tit]?>" target="_blank"><?=$row[tit]?></a></li>
 <li class="l5"><a href="orderview.php?zuorderbh=<?=$row[zuorderbh]?>" target="_blank"><?=$row[zuorderbh]?></a></li>
 <li class="l6"><?=$row[pf1]?></li>
 <li class="l6"><?=$row[pf2]?></li>
 <li class="l6"><?=$row[pf3]?></li>
 </ul>
 <? }?>
 <?
 $nowurl="propjlist.php";
 $nowwd="st1=".$_GET[st1]."&zt=".$_GET[zt]."&pjlx=".$_GET[pjlx];
 include("page.php");
 ?>
 <!--E-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>