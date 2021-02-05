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
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/ad.css" rel="stylesheet" type="text/css" />
<link href="css/product.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<style>
	.cen{text-align:center !important;}
</style>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("leftmenu5").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0102,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
<? $leftid=5;include("menu_product.php");?>

<div class="right">
	<div class="bqu1">
		<a class="a1" href="productlist_tuijian.php">首页推荐</a>
		<a href="productlist_tuijian2.php" id="rtit1">产品页推荐</a>
	</div>
	
	<ul class="ksedi">
		<li class="l2">
			<a href="javascript:void(0);" class="a1" onclick="weizhi(1)">新增位置</a>
		</li>
	</ul>
	
	<ul class="adtypecap cen" style="width:auto;">
		<li class="l3 cen">ID</li>
		<li class="l1 cen">编号</li>
		<li class="l3 cen">价格</li>
		<li class="l3 cen">状态</li>
		<li class="l3 cen">添加时间</li>
		<li class="l3 cen">默认推荐</li>
		<li class="l3 cen">操作</li>
	</ul>
	
	<? while1("id,bianhao,price,sorts,state,add_time,pro_default","yjcode_tuijian where type=1 order by id desc limit 10");while($row1=mysqli_fetch_array($res1)){?>
	<ul class="adtypelist" style="width:auto;">
		<li class="l3 cen"><?=$row1[id]?></li>
		<li class="l1 cen"><?=$row1[bianhao]?></li>
		<li class="l3 cen"><font color="red"><?=$row1[price]?></font> 元/月</li>
		<li class="l3 cen">
			<?php if($row1[state] == 0){?>
				<font color="green">上架</font>
			<?php }else{?>
				<font color="red">下架</font>
			<?php }?>
		</li>
		<li class="l3 cen"><?=$row1[add_time]?></li>
		<li class="l3 cen"><?if($row1[pro_default]){?><?=$row1[pro_default]?><?}else{?>无<?}?></li>
		<li class="l3 cen">
			 <a herf="javascript:;" style="float: none;margin:0;cursor:pointer"  onclick="defaults(<?=$row1[id]?>);">默认推荐</a> | <a herf="javascript:;" style="float: none;margin:0;cursor:pointer"  onclick="edit(<?=$row1[id]?>);">编辑</a> | <a herf="javascript:;" style="float: none;margin:0;cursor:pointer" onclick="del(<?=$row1[id]?>,'weizhi_del');">删除</a>
		</li>
	</ul>
	<?}?>

</div>
<script>
// 新增位置
function weizhi(types){
	layer.open({
		type: 2,
		shadeClose: false,
		area: ['600px', '450px'],
		title:["新增首页位置","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['tuijian_weizhi_add.php?type='+types, 'no'] 
	});
}
function defaults(id){
	layer.open({
		type: 2,
		shadeClose: false,
		area: ['600px', '450px'],
		title:["编辑","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['tuijian_default.php?id='+id, 'no'] 
	});
}
function edit(id){
	layer.open({
		type: 2,
		shadeClose: false,
		area: ['600px', '450px'],
		title:["编辑","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['tuijian_weizhi_update.php?id='+id, 'no'] 
	});
}
//删除
function del(id,weizhi_type){
	layer.confirm('确定要删除？', {
	  btn: ['确定','取消'] //按钮
	}, function(){
		$.ajax({
	        type: 'POST',
	        url: 'yjadmin_youhui.php', 
	        data: {id:id,weizhi_type:weizhi_type},
		    dataType: "json", 
	        success: function (data) {
				if(data.code == 1){
					layer.msg(data.msg,{time:2000},function(){
						window.location.reload();    
					})   
			    }else{
					layer.msg(data.msg);
				}
	        }
	    })
	}, function(){
	  
	});
}
</script>



</div>
<?php include("bottom.php");?>
</body>
</html>