<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理后台</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/quanju.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<style>
.typelistcap{width:100%;}
.typelistcap .l1{width:2%;}
.typelistcap .l2{width:40%;}
.typelistcap .l3{width:15%;}
.typelistcap .l4{width:20%;}
.typelistcap .l5{width:20%;text-align:right;}
.typelist{width:100%;background-color: #F4F4F4;}
.typelist .l1{width:2%;}
.typelist .l2{width:40%;}
.typelist .l3{width:15%;}
.typelist .l4{width:20%;}
.typelist .l5{width:20%;text-align:right;}
.ffff{background-color: #FFF;}

</style>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu3").className="a1";
</script>


<div class="yjcode">
<? $leftid=4;include("menu_product.php");?>

<div class="right">

<div class="bqu1">
<a class="a1" href="soft_type.php">软件分组</a>
</div>
<div class="rights">
<strong>提示：</strong><br>
1、每个分组的层级最少1级，最多2级。<br>
</div>

<!--begin-->
<ul class="ksedi">
<li class="l2">
<a href="javascript:;" class="a1" onclick="add();">新增分类</a>
<a href="javascript:;" class="a2">删除</a>
</li>
</ul>
<ul class="typelistcap">
<li class="l1"><input name="C2" type="checkbox" onclick="xuan()"/></li>
<li class="l2">大分类</li>
<li class="l3">序号</li>
<li class="l4">编辑时间</li>
<li class="l5">操作</li>
</ul>
<?
// while1("*","yjcode_soft_type where level=1 order by id asc");while($row1=mysqli_fetch_array($res1)){
	pagef("where level=1",6,"yjcode_soft_type","order by id asc");while($row1=mysqli_fetch_array($res)){
?>
<ul class="typelist">
<li class="l1"><input name="C1" type="checkbox" value="<?=$row1[id]?>" /></li>
<li class="l2">
<a href=""><strong><?=$row1[soft_type_name]?></strong></a>
</li>
<li class="l3"><?=$row1[sorts]?></li>
<li class="l4"><?=$row1[add_time]?></li>
<li class="l5">
<a href="javascript:;" onclick="del(<?=$row1[id]?>);">删除</a> |
<a href="javascript:;" onclick="edit(<?=$row1[id]?>);">编辑</a> | 
<span></span><a href="javascript:;" onclick="sadd(<?=$row1[id]?>);">添加子类</a>
</li>
</ul>
<?
while2("*","yjcode_soft_type where fid=".$row1[id]." and level=2 order by id asc");while($row2=mysqli_fetch_array($res2)){

?>
<ul class="typelist ffff">
<li class="l1"><input name="C1" type="checkbox" value="<?=$row2[id]?>" /></li>
<li class="l2" style="">
—— <?=$row2[soft_type_name]?>
</li>
<li class="l3"><?=$row2[sorts]?></li>
<li class="l4"><?=$row2[add_time]?></li>
<li class="l5">
<a href="javascript:;" onclick="sedit(<?=$row2[id]?>);">编辑</a> | 
<a href="javascript:;" onclick="del(<?=$row2[id]?>);">删除</a>
</li>
</ul>
<? }}?>
<?  

    include("page.php");
?>
<!--end-->
<script>
function del(id){
	layer.confirm('确定要删除？', {
		btn: ['确定','取消'] //按钮
	}, function(){
		$.ajax({
	        type: 'POST',
	        url: 'yjadmin_soft.php', 
	        data: {id:id,soft_type:'soft_type_del'},
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
function add(){
layer.open({
	type: 2,
	shadeClose: false,
	area: ['650px', '550px'],
	title:["新增父类","text-align:left"],
	skin: 'layui-layer-rim', //加上边框
	content:['soft_type_add.php', 'no'] 
});
}
function sadd(id){
layer.open({
	type: 2,
	shadeClose: false,
	area: ['650px', '550px'],
	title:["新增父类","text-align:left"],
	skin: 'layui-layer-rim', //加上边框
	content:['soft_type_sadd.php?id='+id, 'no'] 
});
}
function edit(id){
layer.open({
	type: 2,
	shadeClose: false,
	area: ['650px', '550px'],
	title:["修改父类","text-align:left"],
	skin: 'layui-layer-rim', //加上边框
	content:['soft_type_edit.php?id='+id, 'no'] 
});
}
function sedit(id){
layer.open({
	type: 2,
	shadeClose: false,
	area: ['650px', '550px'],
	title:["修改父类","text-align:left"],
	skin: 'layui-layer-rim', //加上边框
	content:['soft_type_sedit.php?id='+id, 'no'] 
});
}
</script>

</div>
</div>
<?php include("bottom.php");?>
</body>
</html>