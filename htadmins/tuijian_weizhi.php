<?php
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
AdminSes_audit();

$type=$_GET[type];
//编号ID
$id = $_GET[id];
$caozuo = $_GET[caozuo];

while0("*","yjcode_tuijian where id='".$_GET[id]."' and type='".$type."'");if(!$row=mysqli_fetch_array($res)){}
$caozuos = $_POST[caozuo];

if($caozuos == "add"){
$sj=date("Y-m-d H:i:s");
intotable("yjcode_tuijian","bianhao,sorts,price,state,type,add_time","'".$_POST[bianhao]."','".$_POST[sorts]."','".$_POST[price]."','".$_POST[state]."','".$_POST[type]."','".$sj."'");
php_toheader("tuijian_weizhi.php?t=suc");
}
//函数开始
if($caozuos == "update"){
	if($_GET[control]=="update"){
		if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不够","default.php");}
		zwzr();
		
		updatetable("yjcode_tuijian","bianhao='".$_POST[bianhao]."',sorts=".$_POST[sorts].",price=".$_POST[price].",state=".$_POST[state]." where id=".$_POST[id]);
		php_toheader("tuijian_weizhi.php?t=suc");
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理后台</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<style type="text/css">
.uk{float:left;width:100%;margin-top:10px;text-align:left;}
.uk li{float:left;}
.uk .l1{width:125px;height:38px;text-align:right;font-size:14px;padding:10px 5px 0 0;}
.uk .l2{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);height:48px;}
.uk .l2 .inp{float:left;height:27px;border:#B6B7C9 solid 1px;border-radius:2px;font-size:14px;padding:9px 0 0 5px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;background-color:#fff;}
.uk .l2 .redony{background-image:none;background-color:#EAEAEA;}
.uk .l2 .inp1{float:left;font-size:14px;margin:10px 0 0 0;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;}
.uk .l2 .fd{float:left;margin:11px 0 0 10px;}
.uk .l2 label{float:left;cursor:pointer;margin:0 10px 0 0;padding:9px 10px 0 10px;height:25px;background-color:#FCFCFD;border:#B6B7C9 solid 1px;border-radius:5px;font-size:14px;}
.uk .l3{width:888px;padding:0 0 0 130px;height:48px;}
.uk .l3 .btn1{float:left;color:#fff;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:92px;height:38px;cursor:pointer;border:0;background-color:#009688;border-radius:2px;}
.uk .l3 .btn1:hover{background-color:#33AB9F;}
.uk .l3 .btn2{float:left;color:#333;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:90px;height:38px;cursor:pointer;border:#C9C9C9 solid 1px;background-color:#fff;border-radius:2px;margin-left:10px;}
.uk .l3 .btn2:hover{background-color:#F7F7F7;}
.uk .l8{width:130px;text-align:right;height:76px;}
.uk .l9{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);height:76px;}
@media screen and (-webkit-min-device-pixel-ratio:0) {
.uk .l2 .inp{padding:0 0 0 5px;height:36px;}
}
.uk0{margin-top:0;}
</style>



<script language="javascript">
function tj(){
	if((document.f1.bianhao.value).replace(/\s/,"")==""){alert("请输入编号");document.f1.bianhao.focus();return false;}
	r=document.getElementsByName("state");rr="";for(i=0;i<r.length;i++){if(r[i].checked==true){rr=r[i].value;}}if(rr==""){alert("请选择状态！");return false;}
	layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
	f1.action="tuijian_weizhi.php?control=update";
}
</script>
</head>
<body style="overflow-x:hidden;">
<? if($_GET[t]=="suc"){systs("恭喜您，操作成功！[<a href='tuijian_weizhi.php?id=".$id."'>继续添加</a>]","tuijian_weizhi.php?id=".$id);}?>

<form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="caozuo" value="<?=$caozuo?>">
<input type="hidden" name="type" value="<?=$type?>" >
<ul class="uk">
<li class="l1">定位编号：</li>
<li class="l2"><input type="text" class="inp" name="bianhao" value="<?=$row[bianhao]?>" />
<li class="l1">价格：</li>
<li class="l2"><input type="text" class="inp" name="price" value="<?=$row[price]?>" /><span class="fd">元/月</span></li>
<li class="l1">排序：</li>
<li class="l2"><input type="text" class="inp" name="sorts" value="<?=$row[sorts]?>" /> <span class="fd">序号越小，越靠前</span></li>
<li class="l1">状态：</li>
<li class="l2">
<label><input name="state" type="radio" value="0"  <? if(0==$row[state]){?>checked="checked"<? }?>/> <strong>上架</strong></label> 
<label><input name="state" type="radio" value="1"  <? if(1==$row[state]){?>checked="checked"<? }?>/> <strong>下架</strong></label> 
</li>
</ul>

<ul class="uk uk0">
<li class="l3"><input type="submit" value="保存修改" class="btn1" /><input type="button" value="关闭" class="btn2" onclick="a8_close();"  /></li>
</ul>

</form>
<!--end-->
</body>
</html>