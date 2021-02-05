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
	.productcap .l3{padding-left:0px;width:130px;}
	.productcap .l6{width:230px;}
	.productlist .l3{padding-left:0px;width:130px;}
	.productlist .l6{width:230px;}
	.productlist{height:70px;}
	.productlist li{padding-top:0px;line-height:70px;}
	.productlist .l2{padding-top:10px;height:60px;}
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
		<a href="pro_tuijian.php" >首页推荐商品</a>
		<a class="a1" href="pro_tuijian2.php" id="rtit1">产品页推荐商品</a>
	</div>
	
	

	<ul class="productcap">
		<li class="l3">编号</li>
		<li class="l3">会员账号</li>
		<li class="l2" style="width: calc(100% - 740px);">商品名称</li>
		<li class="l6">到期时间</li>
		<li class="l6">操作</li>
	</ul>
	
	<? while1("*","yjcode_tuijian where type=2 order by id asc limit 10");while($row1=mysqli_fetch_array($res1)){?>

	<ul class="productlist">
		<li class="l3"><?=$row1[bianhao]?></li>
		<li class="l3"><?if($row1[user_id]){?><?=$row1[user_id]?><?}else{?>闲置<?}?></li>

		<li class="l2" style="width: calc(100% - 740px);">
		<?	
		if($row1[pro_bh]){
			$sqlss="select * from yjcode_pro where bh='".$row1[pro_bh]."' and zt=0 and ifxj=0";mysqli_set_charset($conn,"utf8");
			$res1s=mysqli_query($conn,$sqlss);
			$row = mysqli_fetch_array($res1s);
			if(0==$row[ifxj]){$xjv="<span class='blue'>上架</span>";}else{$xjv="<span class='red'>已下架</span>";}
				
		?>		
		<a href="<?=$aurl?>"><img border="0" class="imgtp" src="<?=returntp("bh='".$row[bh]."' order by xh asc","-2")?>" onerror="this.src='../img/none60x60.gif'" width="52" height="52" align="left" /></a>
		<a title="<?=$row["tit"]?>" href="<?=$aurl?>" class="a1"><?=returntitdian($row["tit"],43)?></a><br>
		<?=$xjv." | ".returnztv($row[zt],$row[ztsm])."<br>".returntype(1,$row[ty1id])." - ".returntype(2,$row[ty2id])?>
		<?	}else{?>
		
		闲置
				
		<?	}?>
		</li>
		
		<li class="l6">
			<?if($row1['end_time'] < $sj){?>
			正在出售
			<?}else{?>
			<?=$row1[end_time]?>
			<?}?>
		</li>
		<li class="l6">
			<a href="javascript:;">编辑</a><span></span> | 
			<?if($row[id]){?>
			<a href="../product/view<?=$row[id]?>.html" target="_blank">预览</a>
			<?}else{?>
			<a href="javascript:;">预览</a>
			<?}?>
		</li>
	</ul>
	 
	<? }?>
	

</div>
<script>
// 新增位置
function weizhi(types,caozuo){
	layer.open({
		type: 2,
		shadeClose: false,
		area: ['600px', '450px'],
		title:["新增首页位置","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['tuijian_weizhi.php?type='+types+'&caozuo='+caozuo, 'no'] 
	});
}

function edit(types,id,caozuo){
	layer.open({
		type: 2,
		shadeClose: false,
		area: ['600px', '450px'],
		title:["编辑","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['tuijian_weizhi.php?type='+types+'&id='+id+'&caozuo='+caozuo, 'no'] 
	});
}
function del(id,bianhao,caozuo){
	layer.confirm('确定要删除编号<font color="red">'+ bianhao +'</font>？', {
	  btn: ['确定','取消'] //按钮
	}, function(){
		$.ajax({
            type: "GET",
            url: "productlist_tuijian.php",
            data: {id:id,bianhao:bianhao,caozuo:caozuo},
            success: function(data){
            	
            	// console.log(data);
        		if(data.code==1){
        			layer.msg('删除成功', {time: 2000}, function () {
					    window.location.reload();
					});
        		}else if(data=="Err9"){
        			layer.msg('删除失败，权限不够', {time: 2000});
        			return false;
        		}else{
        			layer.msg('删除失败', {time: 2000});
        			return false;
        		}
            } 
        });
	}, function(){
	  
	});
}
</script>



</div>
<?php include("bottom.php");?>
</body>
</html>