<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

if($_GET[control]=="update"){
 $mb=str_replace(".","",sqlzhuru($_GET[mb]));
 $mb=str_replace("/","",$mb);
 if(!preg_match("/^[_a-zA-Z0-9]*$/",$mb)){php_toheader("mobanwap.php");}
 updatetable("yjcode_control","wapmb='".$mb."'");
 php_toheader("tohtml.php?admin=0&action=gx");

}elseif($_GET[control]=="del"){
 if(!strstr($adminqx,",0,")){Audit_alert("权限不够","mobanwap.php");}
 if(panduan("*","yjcode_admin where adminuid='test'")==1){Audit_alert("请先删除test管理员账户","mobanwap.php");}
 $mb=sqlzhuru($_GET[mb]);
 $mb=str_replace(".","",$mb);
 $mb=str_replace("/","",$mb);
 if(!preg_match("/^[_a-zA-Z0-9]*$/",$mb)){php_toheader("mobanwap.php");}
 if($rowcontrol["wapmb"]==$mb){Audit_alert("模板正在使用中，不能删除","mobanwap.php");}
 delDirAndFile("../m/tem/moban/".$mb."/");
 php_toheader("mobanwap.php");

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.right .mblist{float:left;width:100%;}
.right .mblist .u1{float:left;width:200px;padding:10px;margin:10px 10px 0 0;text-align:center;}
.right .mblist .u1 li{float:left;}
.right .mblist .u1 .l1{width:200px;height:200px;}
.right .mblist .u1 .l1 img{width:200px;height:200px;}
.right .mblist .u1 .l1 span{float:left;margin:176px 0 0 0;position:absolute;color:#fff;padding:4px 0 0 0;text-align:center;width:200px;height:20px;}
.right .mblist .u1 .l1 .s1{background-color:#ff0000}
.right .mblist .u1 .l1 .s0{background:url(img/bg1.png) repeat;}
.right .mblist .u1 .l2{height:26px;width:200px;padding:10px 0 0 0;}
.right .mblist .u1 .l2 a{float:left;width:58px;text-align:center;height:20px;padding:4px 0 0 0;color:#fff;}
.right .mblist .u1 .l2 .a1{background-color:#1E9FFF;border:#1E9FFF solid 1px;}
.right .mblist .u1 .l2 .a2{background-color:#009688;border:#009688 solid 1px;margin:0 10px;}
.right .mblist .u1 .l2 .a3{background-color:#FBFBFB;border:#E6E6E6 solid 1px;color:#C9C9C9;}
.right .mblist .u1:hover{background-color:#e1e1e1;}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script language="javascript">
function mbcha(x){
 if(confirm("是否启用"+x+"模板")){location.href="mobanwap.php?control=update&mb="+x;}else{return false;}
}
function mbgx(x){
 layer.open({
  type:2,
  shadeClose: false,
  scrollbar: true,
  area: ['360px', '270px'],
  title:["手机端模板更新","text-align:left"],
  //skin: 'layui-layer-rim', //加上边框
  content:['mbgxwap.php?mb='+x, 'yes'] 
 });
}
function del(x){
 if(confirm("确定要删除模板文件吗？操作不可恢复。请慎重！")){location.href="mobanwap.php?control=del&mb="+x;}else{return false;}
}
</script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu1").className="a1";
</script>

<div class="yjcode">
 <? $leftid=1;include("menu_quan.php");?>

<div class="right">
 
 <? include("rightcap5.php");?>
 <script language="javascript">document.getElementById("rtit2").className="a1";</script>

 <ul class="ksedi">
 <li class="l2">
 <a href="javascript:void(0);" onclick="mbgx('')" class="a2">添加新模板</a>
 </li>
 </ul>
 
 <!--Begin-->
 <div class="rights">
 温馨提示：<br>
 1、您的网站目前共配置了<strong class="red" id="mbnum">...</strong>套手机端模板，更多模板请访问<a href="http://www.yj99.cn" target="_blank" class="blue">友价官网</a>获取<br>
 2、点击模板图片可以查看全图，但为了节省您的带宽，效果图采用高压缩模式，但启用后您的网站是高清效果<br>
 </div>
 <div class="mblist">
 <? 
 $i=0;
 foreach(getDir("../m/tem/moban/") as $color){
 if(is_file("../m/tem/moban/".$color."/homeimg/".$color."Img/moban_small.jpg")){
 ?>
 <ul class="u1">
 <li class="l1">
 <? if($rowcontrol[wapmb]==$color){?><span class="s1">当前模板(<?=$color?>)</span><? }else{?><span class="s0"><?=$color?></span><? }?>
 <a href="../m/tem/moban/<?=$color?>/homeimg/<?=$color?>Img/moban_big.jpg" target="_blank"><img border="0" src="../m/tem/moban/<?=$color?>/homeimg/<?=$color?>Img/moban_small.jpg" /></a>
 </li>
 <li class="l2">
 <a href="javascript:void(0);" onclick="mbgx('<?=$color?>')" class="a1">更新</a>
 <a href="javascript:void(0);" onclick="mbcha('<?=$color?>')" class="a2">启用</a>
 <a href="javascript:void(0);" onclick="del('<?=$color?>')" class="a3">删除</a>
 </li>
 </ul>
 <? $i++;}}?>
 </div>
 <script language="javascript">
 document.getElementById("mbnum").innerHTML=<?=$i?>;
 </script>
 <!--End-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>