<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

while0("touchy_time,is_touchy,touchy_b_time","yjcode_control");$row=mysqli_fetch_array($res);
$touchy_time=explode(',',$row[touchy_time]);
$touchy_b_time=explode(',',$row[touchy_b_time]);

if(sqlzhuru($_POST[jvs])=="control"){

if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
zwzr();
$data = implode(',',$_POST['touchy_time']);
$datas = implode(',',$_POST['touchy_b_time']);
// if(empty($data)){
// 	$data = 50;
// }
updatetable("yjcode_control","touchy_time='".$data."',touchy_b_time='".$datas."',is_touchy=".$_POST[is_touchy]."");
php_toheader("inf7.php?t=suc");


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
f1.action="inf7.php;
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
	
<? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","inf7.php");}?>


<? include("rightcap1.php");?>
<script language="javascript">document.getElementById("rtit8").className="a1";</script>

<div class="rkuang">
<form name="f1" method="post" onsubmit="return tj()">
<input type="hidden" name="jvs" value="control" />
<ul class="uk">
<li class="l1" style="color:red;">敏感内容隐藏：</li>
<li class="l2" style="height:auto;">
<div style="padding:0px;margin:0px;width:100%;height:auto;overflow:hidden;">
	<div style="width:100%;height:35px;float:left;">
	
		<label><input name="is_touchy" type="radio" value="0" <?if (0==$row[is_touchy]){?>checked="checked" <?}?> > 关闭</label>
		<label><input name="is_touchy" type="radio" value="1" <?if (1==$row[is_touchy]){?>checked="checked" <?}?> > 开启</label>
		<!--<label class="radio-inline"><input name="touchy_user" type="radio" value="1" onclick="touchy_user_notice(1);">游客可见</label>-->
		<!--<label class="radio-inline"><input name="touchy_user" type="radio" value="2" checked="" onclick="touchy_user_notice(2);">会员可见 </label>-->
		<!--<span  class="red" style="padding-left:10px;">仅会员可见，游客状态下隐藏；如再设置时间段，则会员只有在指定时间段访问时才会显示</span>-->
	</div>
	<!--<div>白天</div>-->
	<div style="width:100%;height:35px;line-height:35px;overflow:hidden;font-size:14px;">白天</div>
	<div style="width:100%;height:auto;float:left;">
		
		<?
			$touchy_time_12 = array();
			for($i=0;$i<12;$i++){
				$_i = str_pad($i,2,"0",STR_PAD_LEFT);
				$key = date($_i.':00');
				$touchy_time_12[$i] = $key;
			}
			foreach ($touchy_time_12 as $k=>$v){
		?>
		<label class="checkbox-inline <? if(in_array($k,$touchy_time) && !empty($touchy_time)){?> red <?}?>">
			<input name="touchy_time[]" type="checkbox"  <? if(in_array($k,$touchy_time) && !empty($touchy_time)){?> checked <?}?> value="<?=$k?>"><?=$v?>
		</label>
		<? } ?>
	</div>
	<div style="width:100%;height:auto;float:left;margin-top:10px;">
		<?
			$touchy_time_24 = array();
			for($i=12;$i<24;$i++){
				$key = date($i.':00');
				$touchy_time_24[$i] = $key;
			}
			foreach ($touchy_time_24 as $k=>$v){
		?>
		<label class="checkbox-inline <? if(in_array($k,$touchy_time) && !empty($touchy_time)){?> red <?}?>">
			<input name="touchy_time[]" type="checkbox" <? if(in_array($k,$touchy_time) && !empty($touchy_time)){?> checked <?}?> value="<?=$k?>"><?=$v?>
		</label>
		<?
			}
		?>
	</div>
	
	
	
	
	<div style="width:100%;height:35px;line-height:35px;overflow:hidden;font-size:14px;">晚上</div>
	<div style="width:100%;height:auto;float:left;">
		
		<?
			$touchy_time_12s = array();
			for($i=0;$i<12;$i++){
				$_i = str_pad($i,2,"0",STR_PAD_LEFT);
				$key = date($_i.':00');
				$touchy_time_12s[$i] = $key;
			}
			foreach ($touchy_time_12s as $k=>$v){
		?>
		<label class="checkbox-inline <? if(in_array($k,$touchy_b_time) && !empty($touchy_b_time)){?> red <?}?>">
			<input name="touchy_b_time[]" type="checkbox"  <? if(in_array($k,$touchy_b_time) && !empty($touchy_b_time)){?> checked <?}?> value="<?=$k?>"><?=$v?>
		</label>
		<? } ?>
	</div>
	<div style="width:100%;height:auto;float:left;margin-top:10px;">
		<?
			$touchy_time_24s = array();
			for($i=12;$i<24;$i++){
				$key = date($i.':00');
				$touchy_time_24s[$i] = $key;
			}
			foreach ($touchy_time_24s as $k=>$v){
		?>
		<label class="checkbox-inline <? if(in_array($k,$touchy_b_time) && !empty($touchy_b_time)){?> red <?}?>">
			<input name="touchy_b_time[]" type="checkbox" <? if(in_array($k,$touchy_b_time) && !empty($touchy_b_time)){?> checked <?}?> value="<?=$k?>"><?=$v?>
		</label>
		<?
			}
		?>
	</div>
	<div style="width:100%;height:auto;float:left;margin-top:20px;">
		<ul class="" style="font-size:12px;overflow:hidden;">
			<li style="width:100%;line-height:25px;">开启后，商家发布或编辑商品(默认商品)时，可选择是否为敏感内容；</li>
			<li style="width:100%;line-height:25px;">设为敏感内容后，前台不可撤销，仅后台管理可撤销；</li>
			<!--<li style="width:100%;line-height:25px;">设为敏感内容后，不可参与自助推广；(对以前已加入推广的商品无效)</li>-->
		</ul>
	</div>
</div>
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