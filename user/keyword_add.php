<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$sj=date("Y-m-d H:i:s");
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
.prou1 .l1{width:190px;}
.prou1 .l3{width:130px;}
.prou3{float: left; margin: 0px 10px 0 10px; width: 938px; height: 33px; border-bottom: #e4e4e6 solid 1px; border-left: #e4e4e6 solid 1px; border-right: #e4e4e6 solid 1px;}
.prou3 li{float: left; padding-top: 8px; text-align: center;}
.prou3 .l1{width: 190px;background-color:#fff;}
.prou3 .l2{width: 120px;background-color:#fff;}
.prou3 .l3{width: 130px;background-color:#fff;}
.prou3 .l6{width: 100px;background-color:#fff;}
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
<li class="l1 l2"><a href="keyword_add.php">提交优化</a></li>
<li class="l1"><a href="keyword_list.php">我的优化</a></li>
<!--<li class="l1"><a href="product_tuijianlog.php">购买记录</a></li>-->
</ul> 
<div class="tishi">尊敬的卖家，禁止提交违规关键词，关键词之间用，隔开，提交审核之后需要支付</div>
<!--搜索B-->
<!--搜索E-->

<!--白B-->
<div class="rkuang">

<form name="f1" method="post" onsubmit="return dosub(this)">
<ul class="uk">


<li class="l1"><span class="red">*</span> 商铺连接：</li>
<li class="l2">
	<input name="sj_link"  class="inp" type="text" style="width:70%;"/>
	<!--<span style="height:34px;line-height:34px;">查看</span>-->
</li>

<li class="l1"><span class="red">*</span> 关键词：</li>
<li class="l2" style="height:153px;">
	<textarea name="sj_keyword" style="width:80%;height:150px;"></textarea>
</li>
<!--<li class="l1"></li>-->
<!--<li class="l2">-->
<!--	<span style="height:34px;line-height:34px;">不能填写敏感词</span>-->
<!--</li>-->

</ul>
<!--商家UID-->
<input type="hidden" name="sj_uid" value="<?=$rowuser[uid]?>">
<!--商家昵称-->
<input type="hidden" name="sj_nc" value="<?=$rowuser[nc]?>">
<!--商家QQ-->
<input type="hidden" name="sj_qq" value="<?=$rowuser[uqq]?>">
<!--添加-->
<input type="hidden" name="yjcode_keyorder" value="add">



<ul class="uk uk0">
<li class="l3">
<div id="tjbtn">
<input type="submit" class="btn1 tjinput" value="提交">
<input type="button" class="btn3 tjinput" value="返回" onclick="window.location.href='product_tuijian.php';">
</div>
</li>
</ul>
</form>

<script>
	function dosub(obj){
		
		if(obj.sj_link.value==''){
			layer.msg('商铺连接不能为空！');
			return false;
		}
		if(obj.sj_keyword.value==''){
			layer.msg('关键词不能为空！');
			return false;
		}
		
	    $.ajax({
	        type: 'POST',
	        url: 'keyword_yjadmin.php', 
	        data: $(obj).serialize(),
		    dataType: "json", 
	        success: function (data) {
	        	// console.log(data);
				if(data.code == 1){
					layer.msg(data.msg,{time:2000},function(){
						// parent.location.reload();   
						window.location.href=data.data;
					})
			  }else{
					layer.msg(data.msg);
				}
	        }
	    })		 
		return false;			 
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