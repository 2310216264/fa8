<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$id=$_GET[id];
$sj=date("Y-m-d H:i:s");
while0("*","yjcode_keyorder where id='".$id."'");if(!$row=mysqli_fetch_array($res)){php_toheader("keyword_list.php");}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../config/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../config/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" src="../config/ueditor/lang/zh-cn/zh-cn.js"></script>
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
<li class="l1 l2"><a href="javascript:;">详情</a></li>
<li class="l1"><a href="keyword_list.php">返回列表</a></li>
</ul> 

<!--白B-->
<div class="rkuang">

<form name="f1" method="post" onsubmit="return dosub(this)" enctype="multipart/form-data">
	
<!--<div class="zt">-->
<!--<ul class="ztu">-->
<!--<li class="l1"><strong>发起任务</strong></li>-->
<!--<li class="l2"><strong>等待接手</strong></li>-->
<!--<li class="l3">雇主选标</li>-->
<!--<li class="l4">进行验收</li>-->
<!--<li class="l5">完成交易</li>-->
<!--</ul>-->
<!--<div class="ztok" id="ztok" style="width: 252px;"></div>-->
<!--</div>-->


<ul class="viewul" style="">
<li class="l1">任务编号：</li>
<li class="l3"><strong><?=$row[bh]?></strong></li>
<li class="l1">发布时间：</li>
<li class="l3"><?=$row[add_time]?></li>
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
<li class="l1">联系QQ：</li>
<li class="l2"><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?=$row[mj_qq]?>&amp;site=https://www.a8zhan.com/&amp;menu=yes"><img src="../img/qq.png" border="0"></a></li>
<li class="l1">店铺链接：</li>
<li class="l2"><a href="<?=$row[sj_link]?>" target="_blank"><strong><?=$row[sj_link]?></strong></a></li>
<li class="l4" style="height:100px;">关键词组：</li>
<li class="l5" style="width:805px;padding-left:10px;height:100px;"><?=$row[sj_keyword]?></li>
<?php if($row[content] != ""){ ?>
<li class="l4" style="height:400px;">验收内容：</li>
<li class="l5" style="height:400px;"><script id="editor" name="content" type="text/plain" style="width:805px;height:330px;"><?=$row[content]?></script></li>
<?php }?>

</ul>
</form>
<script>
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