<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$id=$_GET[id];
$sj=date("Y-m-d H:i:s");
while0("*","yjcode_keyorder where id='".$id."'");if(!$row=mysqli_fetch_array($res)){php_toheader("keyword_list.php");}

$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$money1 = str_replace("-0.00","0",sprintf("%.2f",$rowuser[money1]));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
<style>
.tishi{float: left; margin: 13px 0 0 0; width: 898px; padding: 10px 0 0 60px; height: 30px; font-size: 14px; border: #FFE8C2 solid 1px; text-align: left; background-color: #FEFEDA; background-position: 8px 8px; color: #E51F1F;}
.viewul { float: left; margin: 20px 20px 20px 20px;width: 921px; text-align: left;border-bottom: #E3E3E4 solid 1px; border-right: #E3E3E4 solid 1px;background-color: #fff;}
.viewul li{float:left;padding-top:10px;height:27px;border-top:#E3E3E4 solid 1px;border-left:#E3E3E4 solid 1px;}
.viewul .l1{width:100px;text-align:center;background-color:#F4F4F4;}
.viewul .l2{width:808px;padding-left:10px;}
.viewul .l3{width:195px;padding-left:10px;}
.viewul .l4{width:100px;text-align:center;background-color:#F4F4F4;height:200px;}
.viewul .l5{width:819px;height:200px;}
.viewul .l6{width:100px;text-align:center;background-color:#F4F4F4;height:auto;padding:10px 0;}
.viewul .l7{width:800px;height:auto;padding:10px;}
.viewul .l8{width:800px;padding:10px 0 10px 110px;height:40px;}
.viewul .l8 .btn1{float:left;color:#fff;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:92px;height:38px;cursor:pointer;border:0;background-color:#009688;border-radius:2px;}
.viewul .l8 .btn1:hover{background-color:#33AB9F;}
.ztu{
    width: 620px;
    background: url(./img/ddzt.gif) center top no-repeat;
    height: 50px;
    padding: 40px 0 0 0;
}
.zt .ztu li{float:left;text-align:center;}
.zt .ztu li strong{float:left;text-align:center;width:100%;}
.zt .ztu li span{float:left;text-align:center;width:100%;margin:10px 0 0 0;color:#999;}
.zt .ztu .l1{width:83px;}
.zt .ztu .l2{width:186px;}
.zt .ztu .l3{width:83px;}
.zt .ztu .l4{width:186px;}
.zt .ztu .l5{width:82px;}
.zt .ztok{height:38px;float:left;margin:-90px 0 0 30px;background:url(./img/ddzt1.gif) left top no-repeat;display:hidden;}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">
<? include("left.php");?>

<!--RB-->
<div class="userright">
<!--<div class="tishi">尊敬的卖家，禁止推荐违规商品，否则不退款。</div>-->
<ul class="wz">
<li class="l1 l2"><a href="javascript:;">支付</a></li>
<li class="l1"><a href="keyword_list.php">返回列表</a></li>
</ul> 

<div class="rkuang">
<form name="f1" method="post" onsubmit="return dosub(this)" enctype="multipart/form-data">
<ul class="viewul" style="">
<li class="l1">任务编号：</li>
<li class="l3"><strong><?=$row[bh]?></strong></li>
<li class="l1">发布时间：</li>
<li class="l3"><strong><?=$row[add_time]?></strong></li>
<li class="l1">联系QQ：</li>
<li class="l3"><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$row[mj_qq]?>&amp;site=https://www.a8zhan.com/&amp;menu=yes"><img src="../img/qq.png" border="0"></a></li>
<li class="l1">店铺链接：</li>
<li class="l2"><a href="<?=$row[sj_link]?>" target="_blank"><strong><?=$row[sj_link]?></strong></a></li>
<li class="l4" style="height:100px;">关键词组：</li>
<li class="l5" style="width:805px;padding-left:10px;height:100px;"><?=$row[sj_keyword]?></li>
<li class="l1">余额：</li>
<li class="l2" style="padding-top:0px;height:37px;line-height:37px;padding-left:0px;">
	<input  value="<?=$money1?>元" type="text" style="color:red;height:33px;width:100px;padding-left:10px;border:0px;" readonly="readonly"/>
	[<a href="pay.php" target="_blank">充值</a>]
</li>
<li class="l1">交易金额：</li>
<li class="l2" style="padding-top:0px;height:37px;line-height:37px;padding-left:0px;">
	<input value="<?=$row[zf_money]?>元" type="text" style="color:red;height:33px;width:100px;padding-left:10px;border:0px;" readonly="readonly" />
</li>
<li class="l8"><input type="button" value="支付" onclick="zhifu();" class="btn1"/>
</ul>

<input name="id" value="<?=$row[id]?>" type="hidden">
<input name="uid" value="<?=$rowuser[uid]?>" type="hidden">
<input name="yue" value="<?=$money1?>" type="hidden">
<input name="zf_money" value="<?=$row[zf_money]?>" type="hidden">

</form>

<script>
function zhifu(){
	var yue = $("input[name='yue']").val();
	var zf_money = $("input[name='zf_money']").val();
	if(parseFloat(zf_money) > parseFloat(yue)){
		layer.confirm('余额不足是否充值？', {
			btn: ['充值','取消'] //按钮
		}, function(){
			window.location.href='pay.php';
		}, function(){
			
		});
		return false;
	}
	var uid = $("input[name='uid']").val();//用户ID
	var id = $("input[name='id']").val();//用户ID
	layer.confirm('确定要支付？', {
			btn: ['确定','取消'] //按钮
		}, function(){
		    $.ajax({
		        type: 'POST',
		        url: 'keyword_yjadmin.php', 
		        data: {id:id,zf_money:zf_money,uid:uid,yjcode_keyorder:'pay'},
			    dataType: "json", 
		        success: function (data) {
					if(data.code == 1){
						layer.msg(data.msg,{time:2000},function(){ 
							window.location.href=data.data;
						})
				    }else if(data.code == 2){
						layer.confirm(data.msg, {
							btn: ['充值','取消'] //按钮
						}, function(){
							window.location.href=data.data;
						}, function(){
							
						});
						return false;
					}else{
						layer.msg(data.msg);
					}
		        }
		    })		 
			return false;	
		    
		}, function(){
		
		});
}
</script>
</div>
<!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>