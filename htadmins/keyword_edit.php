<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$id=$_GET[id];
$sj=date("Y-m-d H:i:s");
while0("*","yjcode_keyorder where id='".$id."'");if(!$row=mysqli_fetch_array($res)){php_toheader("keyword_order.php");}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/ad.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script type="text/javascript" src="../config/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../config/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" src="../config/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<style type="text/css">
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
<a href="javascript:void(0);" class="a1">详情</a>
<a href="keyword_order.php">返回列表</a>
</div> 
<!--B-->
<div class="rkuang">

<form name="f1" method="post">
<ul class="rcap"><li class="l1"></li><li class="l2">详情</li><li class="l3"></li></ul>

<ul class="viewul">
<li class="l1">编号：</li>
<li class="l2"><strong><?=$row[bh]?></strong></li>
<li class="l1">发布时间：</li>
<li class="l2"><?=$row[add_time]?></li>
<li class="l1">状态：</li>
<li class="l3">
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
<li class="l1">商家昵称：</li>
<li class="l3"><?=$row[sj_nc]?></li>
<li class="l1">联系QQ：</li>
<li class="l3"><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$row[sj_qq]?>&amp;site=https://www.a8zhan.com/&amp;menu=yes"><img src="../img/qq.png" border="0"></a></li>
<li class="l1">店铺链接：</li>
<li class="l2">
	<a href="<?=$row[sj_link]?>" target="_blank"><?=$row[sj_link]?></a>
</li>
<li class="l4" style="height:155px;">关键词组：</li>
<li class="l5" style="height:155px;">
	<textarea name="sj_keyword" id="sj_keyword" style="width:98%;height:155px;border:0px;padding-left:10px;"><?=$row[sj_keyword]?></textarea>
</li>



<?php if($row[content] != ""){ ?>
<li class="l4">验收内容：</li>
<li class="l5"><script id="editor" name="content" type="text/plain" style="width:853px;height:330px;"><?=$row[content]?></script></li>
<?php }?>

<!--验收内容 4 -->
</ul>


<ul class="rcap"><li class="l1"></li><li class="l2">管理员操作</li><li class="l3"></li></ul>
<ul class="viewul">

<!--请求验收 3 -->
<?php if($row[zt] == 3){?>
<li class="l4">验收内容：</li>
<li class="l5"><script id="editor" name="content" type="text/plain" style="width:853px;height:330px;"></script></li>
<li class="l8"><input type="button" value="保存修改" onclick="yanshou();" class="btn1"/>
<?php }?>
<!--请求验收 3 -->


<!--请求验收 3 -->
<?php if($row[zt] == 1){?>
<li class="l1">操作须知：</li>
<li class="l2 red">审核状态变更后，不能再次审核，请认真核实"关键词"是否合法合规</li>
<li class="l1">变更状态：</li>
<li class="l2">
<label><input name="zt" type="radio" value="2" onclick="fhxsonc(2)"/> <strong>通过审核</strong></label>
<label><input name="zt" type="radio" value="7" onclick="fhxsonc(3)"/> <strong>审核不通过</strong></label> 
</li>
<div id="fhxs2" style="display:none;">
<li class="l1">商家支付金额：</li>
<li class="l2" style="padding-top:0px;height:37px;line-height:37px;padding-left:10px;">
	<input name="zf_money" type="text" style="height:33px;padding-left:0px;" />
</li>
</div>
<li class="l8"><input type="button" value="保存修改" onclick="dosub();" class="btn1"/>
<?php }?>

<input type="hidden" name="id" value="<?=$row[id]?>">
</li>
</ul>
</form>
</div>
<!--E-->

<script type="text/javascript">
var ue= UE.getEditor('editor'
, {
    toolbars:[
    ['fullscreen', 'source', '|', 'undo', 'redo', '|',
        'removeformat', 'formatmatch' ,'|', 'forecolor',
         'fontsize', '|',
        'link', 'unlink',
        'insertimage', 'emotion', 'attachment']
]
});

function yanshou(){
	var id = $("input[name='id']").val();
	var content = ue.getContent();
	layer.confirm('确定提交吗？', {
		btn: ['确定','取消'] //按钮
	}, function(){
		$.ajax({
	    	type: 'POST',
	        url: 'keyword_yjadmin.php', 
	        data: {id:id,content:content,keyword_type:'yanshou'},
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


function fhxsonc(x){
    for(i=1;i<=5;i++){
        d=document.getElementById("fhxs"+i);
        if(d){d.style.display="none";}
    }
    d=document.getElementById("fhxs"+x);if(d){d.style.display="";}
}
function dosub(obj){
	
	r=document.getElementsByName("zt");rr="";
	for(i=0;i<r.length;i++){
		if(r[i].checked==true){
			rr=r[i].value;
			
		}
		
	}
	if(rr==""){
		layer.msg('请选择变更状态！');
		return false;
	}
	if(rr=="2"){
        if($("input[name='zf_money']").val() == ""){layer.msg('填写商家支付金额',{time:1000});return false;};
    }
	if($('#sj_keyword').val()==''){
		layer.msg('关键词不能为空！');
		return false;
	}
	var id = $("input[name='id']").val();
	var sj_keyword = $('#sj_keyword').val();
	var zf_money = $("input[name='zf_money']").val();
	layer.confirm('确定提交吗？', {
		btn: ['确定','取消'] //按钮
	}, function(){
		$.ajax({
	    	type: 'POST',
	        url: 'keyword_yjadmin.php', 
	        data: {id:id,keyword_type:'shenhe',zt:rr,sj_keyword:sj_keyword,zf_money:zf_money},
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
</div>
<?php include("bottom.php");?>


</body>
</html>