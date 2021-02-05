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
<script language="javascript">
function del(x){
document.getElementById("chk"+x).checked=true;
checkDEL(45,'yjcode_servertype')
}
</script>
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
 <a class="a1" href="tasktypelist.php">服务市场分组</a>
 </div>

 <!--begin-->
 <ul class="ksedi">
 <li class="l2">
 <a href="servertype1lx.php" class="a1">新增分组</a>
 <a href="javascript:checkDEL(45,'yjcode_servertype')" class="a2">删除</a>
 </li>
 </ul>
 <ul class="qjlistcap">
 <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l2">分类列表</li>
 <li class="l3">序号</li>
 <li class="l4">编辑时间</li>
 <li class="l5">操作</li>
 </ul>
 <?
 while1("*","yjcode_servertype where admin=1 and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){
 $nu="servertype1.php?bh=".$row1[bh];
 ?>
 <ul class="qjlist1">
 <li class="l1"><input name="C1" id="chk<?=$row1[id]?>" type="checkbox" value="<?=$row1[id]?>xcf0" /></li>
 <li class="l2"><a href="<?=$nu?>"><?=$row1[name1]?></a></li>
 <li class="l3"><?=$row1[xh]?></li>
 <li class="l4"><?=$row1[sj]?></li>
 <li class="l5">
 <a href="javascript:void(0);" onclick="del(<?=$row1[id]?>)">删除</a><span></span>
 <a class="add" href="servertype2lx.php?ty1id=<?=$row1[id]?>">添加子类</a><span></span>
 <a class="edi" href="<?=$nu?>">修改信息</a>
 </li>
 </ul>
 <?
 while2("*","yjcode_servertype where admin=2 and name1='".$row1[name1]."' and zt=0 order by xh asc");while($row2=mysqli_fetch_array($res2)){
 $nu="servertype2.php?bh=".$row2[bh]."&ty1id=".$row1[id]; 
 ?>
 <ul class="qjlist2">
 <li class="l1"><input name="C1" id="chk<?=$row2[id]?>" type="checkbox" value="xcf<?=$row2[id]?>" /></li>
 <li class="l2">- <a href="<?=$nu?>"><?=$row2[name2]?></a></li>
 <li class="l3"><?=$row2[xh]?></li>
 <li class="l4"><?=$row2[sj]?></li>
 <li class="l5">
 <a href="javascript:void(0);" onclick="del(<?=$row2[id]?>)">删除</a><span></span>
 <a href="<?=$nu?>">修改信息</a>
 </li>
 </ul>
 <? }}?>
 <!--end-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>