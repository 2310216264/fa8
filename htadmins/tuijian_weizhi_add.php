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
</head>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0102,")){echo "<div class='noneqx'>无权限</div>";exit;}?>
<body style="overflow-x:hidden;">
<form name="f1" method="post" onsubmit="return dosub(this)" enctype="multipart/form-data">
<input type="hidden" name="type" value="<?php echo $_GET[type];?>">
<input type="hidden" value="weizhi_add" name="weizhi_type" />
<ul class="uk">
<li class="l1">定位编号：</li>
<li class="l2"><input type="text" class="inp" name="bianhao" value="" />
<li class="l1">价格：</li>
<li class="l2"><input type="text" class="inp" name="price" value="" /><span class="fd">元/月</span></li>
<li class="l1">排序：</li>
<li class="l2"><input type="text" class="inp" name="sorts" value="" /> <span class="fd">序号越小，越靠前</span></li>
<li class="l1">状态：</li>
<li class="l2">
<label><input name="state" type="radio" value="0"  checked="checked"/> <strong>上架</strong></label> 
<label><input name="state" type="radio" value="1"  /> <strong>下架</strong></label> 
</li>
</ul>

<ul class="uk uk0">
<li class="l3"><input type="submit" value="保存修改" class="btn1" /><input type="button" value="关闭" class="btn2" onclick="a8_close();"  /></li>
</ul>
</form>
<script>
function dosub(obj){
	if(obj.bianhao.value==''){
		layer.msg('编号不能为空！');
		return false;
	}
	if(obj.price.value==''){
		layer.msg('价格不能为空！');
		return false;
	}
    $.ajax({
        type: 'POST',
        url: 'yjadmin_youhui.php', 
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
<!--end-->
</body>
</html>