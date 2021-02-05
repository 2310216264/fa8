<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

$ses=" where id>0";
if($_GET[st1]!=""){$ses=$ses." and soft_name like '%".$_GET[st1]."%'";}

$page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/tool.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<style>
.tool{width:100%;}
.tool .l1{width:2%;}
.tool .l2{width:35%;padding-left:0px;text-align:center;}
.tool .l3{width:10%;}
.tool .l4{width:10%;}
.tool .l5{width:20%;text-align:right;}
.toollist{width:100%;}
.toollist .l11{width:2%;}
.toollist .l22{width:35%;}
.toollist .l33{width:10%;text-align:center;padding-left:0px;}
.toollist .l44{width:10%;line-height:50px;}
.toollist .l55{width:20%;text-align:right;line-height:50px;}
</style>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu3").className="a1";
function ser(){
location.href="soft_list.php?st1="+document.getElementById("st1").value;	
}
</script>

<div class="yjcode">
    <? $leftid=4;include("menu_product.php");?>
    <div class="right">
        <div class="bqu1">
            <a class="a1" href="soft_list.php">软件列表</a>
        </div>
        <!--搜索-->
        <ul class="psel">
            <li class="l1">关键词：</li><li class="l2"><input value="<?=$_GET[st1]?>" type="text" id="st1" size="15" /></li>
            <li class="l3"><a href="javascript:ser()" class="a2">搜索</a></li>
        </ul>
        <!--搜索结束-->
        
        <ul class="ksedi">
            <li class="l2">
                <!--<a href="javascript:checkDEL(66,'yjcode_tool')" class="a2">删除</a>-->
                <a href="soft_add.php" class="a1">新增软件</a>
            </li>
        </ul>
        <!--列表-->
        <ul class="tool">
            <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
            <li class="l3">缩略图</li>
            <li class="l2">软件名称</li>
            <li class="l3">软件类别</li>
            <li class="l4">时间</li>
            <li class="l4">状态</li>
            <li class="l5">操作</li>
        </ul>

        <?
            pagef($ses,12,"yjcode_soft","order by id desc");while($row=mysqli_fetch_array($res)){
            
        ?>
    
        <ul class="toollist">
            <li class="l11"><input name="C1" type="checkbox" value="<?=$row[id]?>" /></li>
            <li class="l33" style="padding-top:2px;"><img src="/soft/upload/<?=$row[soft_img]?>" onerror="this.src='../img/none60x60.gif'" width="50" height="45"  alt=""></li>
            <li class="l22"><?=$row[soft_name]?></li>
            <li class="l33"><?=$row[soft_type_name]?></li>
            <li class="l44"><?=$row[soft_addtime]?></li>
            <li class="l44">
            <? if($row[soft_states] == 1){?>
            	<font color="green">上架</font>
            <?}else{?>
            	<font color="red">下架</font>
            <?}?>
            </li>
            <li class="l55">
                <a href="soft_edit.php?id=<?=$row[id]?>">编辑</a> | 
                <a href="javascript:;" onclick="del(<?=$row[id]?>);">删除</a>
            </li>
        </ul>
        
        <? }?>
        <?  
            $nowurl="soft_list.php";
            $nowwd="st1=".$_GET[st1];
            include("page.php");
        ?>
        <!--列表-->
    </div>
</div>
<script>
	function del(id){
		layer.confirm('确定要删除？', {
			btn: ['确定','取消'] //按钮
		}, function(){
			$.ajax({
		        type: 'POST',
		        url: 'yjadmin_soft.php', 
		        data: {id:id,soft_type:'soft_onedel'},
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

<?php include("bottom.php");?>
</body>
</html>





