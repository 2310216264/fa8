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
<link href="css/quanju.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("leftmenu5").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0302,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
<? $leftid=5;include("menu_product.php");?>

<div class="right">

<div class="bqu1">
<a class="a1" href="userdjlist.php">优惠等级</a>
</div>

<div class="rights">
<strong>提示：</strong><br>
<span class="red"> 如10表示无折扣，9表示9折，依次类推，0表示免费</span>
</div>

<!--B-->
<ul class="ksedi">
<li class="l2">
<!--<a href="javascript:;" class="a2">删除</a>-->
<a href="javascript:;" class="a1" onclick="weizhi()">新增等级</a>
</li>
</ul>
<ul class="qjlistcap" style="width:auto;">

<li class="l2" style="width:120px;">等级信息</li>
<li class="l3">等级折扣</li>
<li class="l4">排序</li>
<li class="l4">最后更新</li>
<li class="l4">操作</li>
</ul>
<?
while0("*","yjcode_youhui where type=1 order by id asc");while($row=mysqli_fetch_array($res)){
?>
<ul class="qjlist2" style="width:auto;">
<li class="l2" style="width:120px;"><a href="<?=$aurl?>"><strong><?=$row[das]?></strong>/<? if(empty($row[d1])){echo "月";}else{echo "年";}?></a></li>
<li class="l3"><?=$row[zhekou]?>折</li>
<li class="l4"><?=$row[sorts]?></li>
<li class="l4"><?=$row[add_time]?></li>
<li class="l4">
	 <a herf="javascript:;" style="float: none;margin:0;cursor:pointer"  onclick="update(<?=$row[id]?>)">编辑</a> | <a herf="javascript:;" style="float: none;margin:0;cursor:pointer" onclick="del(<?=$row[id]?>,'youhui_del');">删除</a>
</li>
</ul>
<? }?>
<!--E-->

</div>
<script>
// 新增位置
function weizhi(types,caozuo){
	layer.open({
		type: 2,
		shadeClose: false,
		area: ['800px', '450px'],
		title:["新增等级信息","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['productlist_youhui_add.php', 'no'] 
	});
}
//修改
function update(id){
	layer.open({
		type: 2,
		shadeClose: false,
		area: ['800px', '450px'],
		title:["修改等级信息","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['productlist_youhui_update.php?id='+id, 'no'] 
	});
}
//删除
function del(id,youhui_type){
	layer.confirm('确定要删除？', {
	  btn: ['确定','取消'] //按钮
	}, function(){
		$.ajax({
	        type: 'POST',
	        url: 'yjadmin_youhui.php', 
	        data: {id:id,youhui_type:youhui_type},
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