<?php
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
AdminSes_audit();

//函数开始
if($_GET[control]=="update"){
 if(!strstr($adminqx,",0,")){Audit_alert("权限不够","mobanwap.php","parent.");}
 if(panduan("*","yjcode_admin where adminuid='test'")==1){Audit_alert("请先删除test管理员账户","mobanwap.php","parent.");}
 zwzr();
 $mb=sqlzhuru($_POST[t1]);
 if(empty($mb) || !preg_match("/^[_a-zA-Z0-9]*$/",$mb)){Audit_alert("模板名称无效","mobanwap.php","parent.");}
 createDir("../m/tem/moban/".$mb."/");
 $up1=$_FILES["inp1"]["name"];
 $mc=$mb.".".returnhz($up1);
 move_uploaded_file($_FILES["inp1"]['tmp_name'],"../m/tem/moban/".$mb."/".$mc);
 $zip_filename = "../m/tem/moban/".$mb."/".$mc;
 $zip_filepath = $zip_filename;
 if(!is_file($zip_filepath))
 {die('Error Code:1002');}
 $zip = new ZipArchive();
 $rs = $zip->open($zip_filepath);
 if($rs !== TRUE)
 {die('Error Code:1001');}
 $zip->extractTo("../m/tem/moban/".$mb."/");
 $zip->close();
 Audit_alert("模板更新成功，点击启用可以看效果啦","mobanwap.php","parent.");
 
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
.uk .l1{width:100px;height:38px;text-align:right;font-size:14px;padding:10px 5px 0 0;}
.uk .l21{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);height:38px;padding:10px 0 0 0;font-size:14px;}
.uk .l2{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);height:48px;}
.uk .l2 .inp{float:left;height:27px;border:#B6B7C9 solid 1px;border-radius:2px;font-size:14px;padding:9px 0 0 5px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;background-color:#fff;}
.uk .l2 .inp1{float:left;font-size:14px;margin:7px 0 0 0;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;}
.uk .l2 .fd{float:left;font-size:14px;margin:10px 0 0 5px;}
.uk .l3{width:360px;padding:10px 20px 10px 20px;}
.uk .l3 .btn1{float:left;color:#fff;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:320px;height:38px;cursor:pointer;border:0;background-color:#009688;border-radius:2px;}
.uk .l3 .btn1:hover{background-color:#33AB9F;}
.uk .l4{width:325px;padding:5px 0 10px 20px;color:red;line-height:20px;}
@media screen and (-webkit-min-device-pixel-ratio:0) {
.uk .l2 .inp{padding:0 0 0 5px;height:36px;}
}
</style>
<script language="javascript">
function tj(){
 if(!confirm("请务必上传官方原版模板压缩包，确认上传吗？")){return false;}
 layer.msg('正在处理', {icon: 16  ,time: 0,shade :0.25});
 f1.action="mbgxwap.php?control=update";
}
</script>
</head>
<body style="overflow-x:hidden;">
 
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <ul class="uk">
 <li class="l1">模板名称：</li>
 <li class="l2"><input type="text" name="t1" size="8" class="inp" value="<?=sqlzhuru($_GET[mb])?>" /><span class="fd blue">必须为官方原版名称</span></li>
 <li class="l1">选择文件：</li>
 <li class="l2"><input type="file" name="inp1" class="inp1" id="inp1" size="15" accept=".zip"></li>
 <li class="l3"><input type="submit" value="上传压缩包" class="btn1" /></li>
 <li class="l4">请务必只上传官方原版<strong>【手机端】</strong>模板，上传其他文件导致的网站崩溃问题均不免费受理</li>
 </ul>

 </form>
</body>
</html>