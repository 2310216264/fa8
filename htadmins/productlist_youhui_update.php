<?php
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
AdminSes_audit();
while0("*","yjcode_youhui where id='".$_GET[id]."' and type='1'");if(!$row=mysqli_fetch_array($res)){}
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
<body style="overflow-x:hidden;">
<form method="post" name="youhui" onsubmit="return dosub(this)">
<input type="hidden" value="youhui_update" name="youhui_type" />
<input type="hidden" value="<?php echo $_GET[id];?>" name="id">
<ul class="uk">
<li class="l1"><span class="red">*</span> 优惠等级：</li>
<li class="l2">

<input type="text" value="<?=$row['das']?>" class="inp" size="20" name="das" />
<select name="d1" class="inp" style="margin-left:10px;">
<option value="0" <? if(0==$row[d1]){?>selected="selected"<?}?>>月</option>
<option value="1" <? if(1==$row[d1]){?>selected="selected"<?}?>>年</option>
</select>
</li>

<input type="hidden" name="type" value="1" >
<li class="l1"><span class="red">*</span> 享受折扣：</li>
<li class="l2"><input type="text" value="<?=$row[zhekou]?>" class="inp" size="5" name="zhekou" /> <span class="fd">如10表示无折扣，9表示9折，依次类推，0表示免费</span></li>

<li class="l1"><span class="red">*</span> 排序：</li>
<li class="l2"><input type="text" class="inp" name="sorts" value="<?=$row[sorts]?>" /> <span class="fd">序号越小，越靠前</span></li>
<li class="l3"><input type="submit" value="保存修改" class="btn1" /><input type="button" value="关闭" class="btn2" onclick="a8_close();" /></li>

</ul>
</form>
<!--end-->
<script>
function dosub(obj){
	if(obj.das.value==''){
		layer.msg('优惠等级不能为空！');
		return false;
	}
	if(obj.zhekou.value==''){
		layer.msg('折扣不能为空！');
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
</body>
</html>