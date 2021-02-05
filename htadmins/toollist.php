<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

$ses=" where id>0";
if($_GET[st1]!=""){$ses=$ses." and tool_name like '%".$_GET[st1]."%'";}

$page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/tool.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>

<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu3").className="a1";

function ser(){
location.href="toollist.php?st1="+document.getElementById("st1").value;	
}


</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0102,")){echo "<div class='noneqx'>无权限</div>";exit;}?>
<div class="yjcode">
    <? $leftid=4;include("menu_product.php");?>
    <div class="right">
        <div class="bqu1">
            <a class="a1" href="productlist.php">软件列表</a>
        </div>
        <ul class="psel">
            <li class="l1">关键词：</li><li class="l2"><input value="<?=$_GET[st1]?>" type="text" id="st1" size="15" /></li>
            <li class="l3"><a href="javascript:ser()" class="a2">搜索</a></li>
        </ul>
        <!-- 操作 -->
        <ul class="ksedi">
            <li class="l2">
                <a href="javascript:checkDEL(66,'yjcode_tool')" class="a2">删除</a>
                <a href="tooladd.php" class="a1">新增软件</a>
            </li>
        </ul>
        <ul class="tool">
            <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
            <li class="l3">缩略图</li>
            <li class="l2">软件名称</li>
            <li class="l3">时间</li>
            <li class="l3">操作</li>
        </ul>

        <?
           
            pagef($ses,12,"yjcode_tool","order by id desc");while($row=mysqli_fetch_array($res)){
         
        ?>
    
        <ul class="toollist">
            <li class="l11"><input name="C1" type="checkbox" value="<?=$row[id]?>" /></li>
            <li class="l22"><img src="/tool/upload/<?=$row[tool_img]?>" onerror="this.src='../img/none60x60.gif'" width="52" height="52"  alt=""></li>
            <li class="l33"><?=$row[tool_name]?></li>
            <li class="l22"><?=$row[tool_addtime]?></li>
            <li class="l22">
                <a href="tooledit.php?id=<?=$row[id]?>">编辑</a><span></span>
            </li>
        </ul>
        
        <? }?>
        <?  
            $nowurl="toollist.php";
            $nowwd="st1=".$_GET[st1];
            include("page.php");
        ?>
       
        
    </div>
</div>
<?php include("bottom.php");?>
</body>
</html>





