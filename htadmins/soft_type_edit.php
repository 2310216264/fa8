<?php
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
AdminSes_audit();
$sqlsoft="select * from yjcode_soft_type where id='".$_GET[id]."'";mysqli_set_charset($conn,"utf8");
$ressoft=mysqli_query($conn,$sqlsoft);if(!$row=mysqli_fetch_array($ressoft,MYSQLI_ASSOC));

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
.uk .l2 .inp1{width:250px;float:left;font-size:14px;margin:10px 0 0 0;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;}
.uk .l2 .fd{float:left;margin:11px 0 0 10px;}
.uk .l2 label{float:left;cursor:pointer;margin:0 10px 0 0;padding:9px 10px 0 10px;height:25px;background-color:#FCFCFD;border:#B6B7C9 solid 1px;border-radius:5px;font-size:14px;}
.uk .l3{width:888px;padding:0 0 0 130px;height:48px;}
.uk .l3 .btn1{float:left;color:#fff;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:92px;height:38px;cursor:pointer;border:0;background-color:#009688;border-radius:2px;}
.uk .l3 .btn1:hover{background-color:#33AB9F;}
.uk .l3 .btn2{float:left;color:#333;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:90px;height:38px;cursor:pointer;border:#C9C9C9 solid 1px;background-color:#fff;border-radius:2px;margin-left:10px;}
.uk .l3 .btn2:hover{background-color:#F7F7F7;}
.uk .l8{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);text-align:right;height:76px;margin-bottom: 10px;}
.uk .l9{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);height:76px;}
@media screen and (-webkit-min-device-pixel-ratio:0) {
.uk .l2 .inp{width:250px;padding:0 0 0 5px;height:36px;}
}
.tseodes{float:left;width:255px;height:76px;}
.uk0{margin-top:0;}.inpw{width:455px !important;}
</style>

</head>
<body style="overflow-x:hidden;">

<form method="post" name="youhui" onsubmit="return dosub(this)">
<input type="hidden" name="soft_type" value="soft_edit">
<input type="hidden" name="id" value="<?php echo $_GET[id];?>">
<ul class="uk">
<li class="l1"><span class="red">*</span> 父类名称：</li>
<li class="l2"><input type="text" class="inp" name="soft_type_name" value="<?=$row[soft_type_name]?>" /></li>

<li class="l1"><span class="red">*</span> 关键词：</li>
<li class="l2"><input type="text" class="inp inpw" name="soft_seokey" value="<?=$row[soft_seokey]?>" /></li>

<li class="l1"><span class="red">*</span> 描述：</li>
<li class="l8"><textarea class="tseodes inpw" name="soft_seodes"><?=$row[soft_seodes]?></textarea></li>

<li class="l1"><span class="red">*</span> 排序：</li>
<li class="l2"><input type="text" class="inp" name="sorts" value="<?=$row[sorts]?>" /></li>
<li class="l3"><input type="submit" value="保存修改" class="btn1" /><input type="button" value="关闭" class="btn2" onclick="a8_close();" /></li>
</ul>
</form>
<!--end-->
<script>
function dosub(obj){
	if(obj.soft_type_name.value==''){
		layer.msg('父类名称不能为空！');
		return false;
	}
    $.ajax({
        type: 'POST',
        url: 'yjadmin_soft.php', 
        data: $(obj).serialize(),
	    dataType: "json", 
        success: function (data) {
			if(data.code == 1){
				layer.msg(data.msg,{time:2000},function(){
					parent.location.reload();    
				})
		    }else{
				layer.msg(data.msg);
			}
        }
    })		 
	return false;			 
}
</script>
</body>
</html>