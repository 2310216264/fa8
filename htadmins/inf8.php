<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

while0("control_keywords","yjcode_control");$row=mysqli_fetch_array($res);

if(sqlzhuru($_POST[jvs])=="control"){

if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
zwzr();
$data = $_POST['control_keywords'];

function unique($str){  
    //字符串中，需要去重的数据是以数字和“，”号连接的字符串，如$str,explode()是用逗号为分割，变成一个新的数组，见打印  
    $arr = explode(',', $str);  
    $arr = array_unique($arr);//内置数组去重算法  
    $data = implode(',', $arr);  
    $data = trim($data,',');//trim — 去除字符串首尾处的空白字符（或者其他字符）,假如不使用，后面会多个逗号  
    return $data;//返回值，返回到函数外部  
}  
$data = unique($data); 

updatetable("yjcode_control","control_keywords='".$data."'");
php_toheader("inf8.php?t=suc");


}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script language="javascript">
   
</script>
</head>
<style>
	.checkbox-inline{margin-top:10px;}
	.red{color:red;}
</style>

<script language="javascript">

function tj(){
layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
f1.action="inf8.php;
}
</script>

<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu1").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0302,")){echo "<div class='noneqx'>无权限</div>";exit;}?>
<div class="yjcode">
<? $leftid=1;include("menu_quan.php");?>
<div class="right">
	
<? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","inf8.php");}?>


<? include("rightcap1.php");?>
<script language="javascript">document.getElementById("rtit9").className="a1";</script>

<div class="rkuang">
<form name="f1" method="post" onsubmit="return tj()">
<input type="hidden" name="jvs" value="control" />
<div class="rights">
<strong>提示：</strong><br>
1、每个关键词之间用英文逗号隔开，最后面不要加逗号<br>
</div>
<ul class="uk">
<li class="l1" style="color:red;">关键词：</li>


<li class="l5" style="height:470px;">
	<textarea name="control_keywords" style="width:800px;height:470px;background-color: #fff;"><?=$row[control_keywords]?></textarea>
</li>

<li class="l3" style="margin-top:20px;"><input type="submit" value="保存修改" class="btn1" /></li>
</ul>
</form>
</div>
<!--End-->
</div>
</div>
<? include("bottom.php");?>
</body>
</html>