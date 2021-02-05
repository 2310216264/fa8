<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();

$sj=date("Y-m-d H:i:s");
//获取用户信息
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$money1 = str_replace("-0.00","0",sprintf("%.2f",$rowuser[money1]));



//获取推荐位置信息
$tuijian_id = $_GET['id'];
$sql_tuijian="select * from yjcode_tuijian where id='".$tuijian_id."'";mysqli_set_charset($conn,"utf8");$tuijian=mysqli_query($conn,$sql_tuijian);
$tuijian=mysqli_fetch_array($tuijian);
//获取推荐位置信息


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<style type="text/css">
body,td,th {
font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
.tishi{float: left; margin: 13px 0 0 0; width: 898px; padding: 10px 0 0 60px; height: 30px; font-size: 14px; border: #FFE8C2 solid 1px; text-align: left; background-color: #FEFEDA; background-position: 8px 8px; color: #E51F1F;}
</style>
<? include("cssjs.html");?>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
<div class="tishi">尊敬的卖家，购买之后联系客服</div>
<ul class="wz">
<li class="l1 l2"><a href="product_tuijian.php">购买推荐</a></li>
<li class="l1"><a href="product_mytuijian.php">我的推荐</a></li>
<li class="l1"><a href="product_tuijianlog.php">购买记录</a></li>
</ul> 

<!--白B-->
<div class="rkuang">

<form name="f1" method="post" onsubmit="return dosub(this)" enctype="multipart/form-data">
<ul class="uk">
<!---->
<li class="l1">编号/位置：</li>
<li class="l21"><?=$tuijian[bianhao]?>/ <a style="color:green;" onclick="yulan(<?=$tuijian[type]?>)">预览</a></li>

<li class="l1">价格：</li>
<li class="l21"><?=$tuijian[price]?> 元/月</a></li>

<li class="l1">您的余额：</li>
<li class="l21" style="color:red;"><?=$money1?>元  [<a href="pay.php" target="_blank">充值</a>]</li>

<li class="l1"><span class="red">*</span> 商品编码：</li>
<li class="l2">
	<input name="pro_bh" size="40" class="inp" type="text" />
	<!--<span style="height:34px;line-height:34px;">填写你要推荐的商品编码，商品编码在商品列表中查看</span>-->
</li>

<li class="l1"><li>
<li class="l2">
	填写你要推荐的商品编码，商品编码在商品列表中查看,请选择好推荐的商品，不支持修改,一个商品只支持一个位置
</li>
<li class="l1" style="padding-top:14px;"><span class="red">*</span> 购买套餐：</li>
<li class="l2">
<!--套餐信息-->
<? 
while0("*","yjcode_youhui where type=1 order by id asc");while($row=mysqli_fetch_array($res)){
if($row[d1]==0){ $d1='月';}else{$d1 = '年';}
if($row[zhekou]==10){ $row[zhekou]='无折扣';}else{$row[zhekou] = $row[zhekou].'折';}
$data = $row['das'].'/'.$d1.'&nbsp;&nbsp;'.$row[zhekou];
?>
<label><input name="R1" type="radio" value="<?=$row[id]?>" /><?=$data?></label>
<?}?>
<!--套餐信息-->
</li>
</ul>

<input name="price" value="<?=$tuijian[price]?>" type="hidden">
<input name="money1" value="<?=$money1?>" type="hidden">
<input name="uid" value="<?=$rowuser[uid]?>" type="hidden">
<input name="tuijian_id" value="<?=$tuijian_id?>" type="hidden">

<ul class="uk uk0">
<li class="l3">
<div id="tjbtn">
<input type="submit" class="btn1 tjinput" value="提交购买">
<input type="button" class="btn3 tjinput" value="返回" onclick="window.location.href='product_tuijian.php';">
</div>
</li>
</ul>
</form>

<script>
	function dosub(obj){
		var price = obj.price.value;
		var money1 = obj.money1.value;
		if(parseFloat(price) > parseFloat(money1)){
			layer.confirm('余额不足是否充值？', {
				btn: ['充值','取消'] //按钮
			}, function(){
				window.location.href='pay.php';
			}, function(){
				
			});
			return false;
		}
		if(obj.pro_bh.value==''){
			layer.msg('商品编码不能为空！');
			return false;
		}
		r=document.getElementsByName("R1");rr="";for(i=0;i<r.length;i++){if(r[i].checked==true){rr=r[i].value;}}if(rr==""){
			layer.msg('请选择套餐！');
			return false;
		}
		
	    $.ajax({
	        type: 'POST',
	        url: 'product_tuijianpay.php', 
	        data: $(obj).serialize(),
		    dataType: "json", 
	        success: function (data) {
				if(data.code == 1){
					layer.msg(data.msg,{time:2000},function(){
						// parent.location.reload();   
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
	}
	//位置预览
	function yulan(type){
		layer.open({
			type: 2,
			shadeClose: false,
			area: ['800px', '500px'],
			offset: ['100px',],
			title:["推荐位置预览","text-align:left"],
			skin: 'layui-layer-rim', //加上边框
			content:['product_yulan.php?type='+type, 'no'] 
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