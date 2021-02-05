<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

$ses=" where id>0";
if($_GET[st1]!=""){$ses=$ses." and sj_nc like '%".$_GET[st1]."%'";}
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
.tool .l45{width:20%;}
.tool .l5{width:20%;text-align:right;}
.toollist{width:100%;height:40px;}
.toollist li{height:40px;line-height:40px;}
.toollist .l11{width:2%;padding: 2px 0 0 8px;}
.toollist .l11 input{margin-top: 10px;}
.toollist .l22{width:35%;line-height:40px;}
.toollist .l33{width:10%;line-height:40px;text-align:center;padding-left:0px;}
.toollist .l33 a{display:block;margin-top:10px;}
.toollist .l44{width:10%;line-height:40px;}
.toollist .l45{width:20%;line-height:40px;}
.toollist .l55{width:20%;text-align:right;line-height:40px;}

/*审核中-橙色*/
.zt1{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #ff6600;}
/*审核成功-淡蓝色*/
.zt2{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #3bb4f2;}
/*进行中-蓝色*/
.zt3{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #5a98de;}
/*成功-绿色*/
.zt4{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #5eb95e;}
/*失败-红色*/
.zt5{padding: 1px 10px 2px 10px;border-radius: 5px;color: #fff;background-color: #dd514c;}

</style>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu3").className="a1";
function ser(){
location.href="keyword_order.php?st1="+document.getElementById("st1").value;	
}
</script>

<div class="yjcode">
    <? $leftid=3;include("menu_order.php");?>
    <div class="right">
        <div class="bqu1">
            <a class="a1" href="keyword_order.php">优化列表</a>
        </div>
        <!--搜索-->
        <ul class="psel">
            <li class="l1">关键词：</li><li class="l2"><input value="<?=$_GET[st1]?>" type="text" id="st1" size="15" /></li>
            <li class="l3"><a href="javascript:ser()" class="a2">搜索</a></li>
        </ul>
        <!--搜索结束-->

        <!--列表-->
        <ul class="tool">
            <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
            <li class="l3">编号</li>
            <li class="l3">商家</li>
            <li class="l3">联系QQ</li>
            <li class="l45">店铺链接</li>
            <li class="l4">发布时间</li>
            <li class="l4">状态</li>
            <li class="l5">操作</li>
        </ul>
        <?
            pagef($ses,12,"yjcode_keyorder","order by id desc");while($row=mysqli_fetch_array($res)){
        ?>
        <ul class="toollist">
            <li class="l11"><input name="C1" type="checkbox" value="<?=$row[id]?>" /></li>
            <li class="l33"><?=$row[bh]?></li>
            <li class="l33"><?=$row[sj_nc]?></li>
            <li class="l33">
            	<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$row[sj_qq]?>&amp;site=https://www.a8zhan.com/&amp;menu=yes"><img src="../img/qq.png" border="0"></a>
            </li>
            <li class="l45">
            	<a href="<?=$row[sj_link]?>" target="_blank"><?=$row[sj_link]?></a>
            </li>
            <li class="l44"><?=$row[add_time]?></li>
            <li class="l44">
	            <?php	
				if($row[zt]==1){echo "<span class='zt1'>审核中</span>";}
				elseif($row[zt]==2){echo "<span class='zt3'>审核成功</span>";}
				elseif($row[zt]==3){echo "<span class='zt3'>进行中</span>";}
				elseif($row[zt]==4){echo "<span class='zt1'>等待验收</span>";}
				elseif($row[zt]==5){echo "<span class='zt4'>成功</span>";}
				elseif($row[zt]==6){echo "<span class='zt5'>不满意</span>";}
				elseif($row[zt]==7){echo "<span class='zt5'>审核不通过</span>";}
				?>
            </li>
            <li class="l55">
            	<?php if($row[zt] == 3){?>
            	<a href="keyword_edit.php?id=<?=$row[id]?>"><span class='zt1'>请求验收</span></a>
            	<?php }else{?>
                <a href="keyword_edit.php?id=<?=$row[id]?>"><span class='zt3'>编辑</span></a>
                <?php }?>
                <a href="javascript:;" onclick="del(<?=$row[id]?>);"><span class='zt5'>删除</span></a>
            </li>
        </ul>
        <? }?>
        <?  
            $nowurl="keyword_order.php";
            $nowwd="st1=".$_GET[st1];
            include("page.php");
        ?>
    </div>
</div>
<script>
	function del(id){
		
		layer.confirm('确定要删除？', {
			btn: ['确定','取消'] //按钮
		}, function(){
			
			$.ajax({
		        type: 'POST',
		        url: 'keyword_yjadmin.php', 
		        data: {id:id,keyword_type:'del'},
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





