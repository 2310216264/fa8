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

</style>

</head>
<body style="overflow-x:hidden;">
    
<div style="width:100%;height:90%;overflow:hidden;">
<? if($_GET[type]==1){?>
	<img src="./img/yulan.png" style="width:100%;height:100%;">
<?}else{?>
	<img src="./img/yulan2.png" style="width:100%;height:95%;">
<?}?>
	
<div style="width:100%;height:30px;line-height:30px;text-align:center;font-size:16px;background-color: #33AB9F;color:#FFF;cursor:pointer;" onclick="a8_close();">
	关闭
<div>
</div>
<!--end-->
<script>
//关闭弹出层
function a8_close(){
	var index = parent.layer.getFrameIndex(window.name);
	parent.layer.close(index);
}
</script>
</body>
</html>