<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理后台</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/quanju.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu1").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0302,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
 <? $leftid=1;include("menu_quan.php");?>

<div class="right">
 
 <div class="bqu1">
 <a class="a1" href="jubaotypelist.php">举报类型</a>
 </div>

 <!--begin-->
 <ul class="ksedi">
 <li class="l2">
 <a href="jubaotypelx.php" class="a1">新增类型</a>
 <a href="javascript:checkDEL(42,'yjcode_jubaotype')" class="a2">删除</a>
 </li>
 </ul>
 <ul class="qjlistcap">
 <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l2">举报类型</li>
 <li class="l3">适用对象</li>
 <li class="l4">编辑时间</li>
 <li class="l5">操作</li>
 </ul>
 <?
 while1("*","yjcode_jubaotype where zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){
 $nu="jubaotype.php?bh=".$row1[bh];
 if($row1[admin]==1){$ty="商品";}
 elseif($row1[admin]==2){$ty="资讯";}
 elseif($row1[admin]==3){$ty="店铺";}
 ?>
 <ul class="qjlist2">
 <li class="l1"><input name="C1" type="checkbox" value="<?=$row1[id]?>" /></li>
 <li class="l2"><a href="<?=$nu?>"><strong><?=$row1[tit]?></strong></a></li>
 <li class="l3"><?=$ty?></li>
 <li class="l4"><?=$row1[sj]?></li>
 <li class="l5"><a href="<?=$nu?>">编辑</a></li>
 </ul>
 <? }?>
 <!--end-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>