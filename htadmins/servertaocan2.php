<?php
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
AdminSes_audit();
$sj=date("Y-m-d H:i:s");
$bh=$_GET[bh];
while0("*","yjcode_server where bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){Audit_alert("来源出错","default.php","parent.");}
$tit=$row[tit];

$ty1id=$_GET[ty1id];
while0("*","yjcode_servertaocan where id=".$ty1id);$row=mysqli_fetch_array($res);
$ty1tit=$row[tit1];

$id=$_GET[id];
while0("*","yjcode_servertaocan where id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("servertaocanlist.php?bh=".$bh);}

//函数开始
if($_GET[control]=="update"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if(panduan("*","yjcode_servertaocan where admin=2 and tit1='".sqlzhuru($_POST[t0])."' and tit2='".sqlzhuru($_POST[t1])."' and serverbh='".$bh."' and id<>".$id)==1){Audit_alert("该套餐已存在！","servertaocan2.php?action=update&id=".$id."&ty1id=".$ty1id."&bh=".$bh);}
 
 updatetable("yjcode_servertaocan","tit2='".sqlzhuru($_POST[t1])."',
                              xh=".sqlzhuru($_POST[t2]).",
							  money1=".sqlzhuru($_POST[tmoney1]).",
							  money2=".sqlzhuru($_POST[tmoney2]).",
							  zt=0
							  where id=".$id);

 uploadtpnodata(2,"upload/".$row[userid]."/".$row[serverbh]."/","tc".$id.".png","allpic",254,167,254,167,"no");

 php_toheader("servertaocan2.php?t=suc&id=".$id."&ty1id=".$ty1id."&bh=".$bh);

}elseif($_GET[control]=="del"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不足","default.php","parent.");}
 zwzr();
 delFile("../upload/".$row[userid]."/".$row[serverbh]."/tc".$row[id].".png");
 php_toheader("servertaocan2.php?t=suc&id=".$id."&ty1id=".$ty1id."&bh=".$bh);

}
//函数结果

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理后台</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<style type="text/css">
.uk{float:left;width:100%;margin-top:10px;text-align:left;}
.uk li{float:left;}
.uk .l1{width:125px;height:38px;text-align:right;font-size:14px;padding:10px 5px 0 0;}
.uk .l2{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);height:48px;}
.uk .l2 .inp{float:left;height:27px;border:#B6B7C9 solid 1px;border-radius:2px;font-size:14px;padding:9px 0 0 5px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;background-color:#fff;}
.uk .l2 .redony{background-image:none;background-color:#EAEAEA;}
.uk .l2 .inp1{float:left;font-size:14px;margin:10px 0 0 0;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;}
.uk .l2 .fd{float:left;margin:11px 0 0 10px;}
.uk .l2 label{float:left;cursor:pointer;margin:0 10px 0 0;padding:9px 10px 0 10px;height:25px;background-color:#FCFCFD;border:#B6B7C9 solid 1px;border-radius:5px;font-size:14px;}
.uk .l3{width:888px;padding:0 0 0 130px;height:48px;}
.uk .l3 .btn1{float:left;color:#fff;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:92px;height:38px;cursor:pointer;border:0;background-color:#009688;border-radius:2px;}
.uk .l3 .btn1:hover{background-color:#33AB9F;}
.uk .l3 .btn2{float:left;color:#333;font-size:14px;font-family:"Microsoft YaHei",微软雅黑,"MicrosoftJhengHei",华文细黑,STHeiti,MingLiu;width:90px;height:38px;cursor:pointer;border:#C9C9C9 solid 1px;background-color:#fff;border-radius:2px;margin-left:10px;}
.uk .l3 .btn2:hover{background-color:#F7F7F7;}
.uk .l8{width:130px;text-align:right;height:76px;}
.uk .l9{width:-moz-calc(100% - 130px);width:-webkit-calc(100% - 130px);width:calc(100% - 130px);height:76px;}
@media screen and (-webkit-min-device-pixel-ratio:0) {
.uk .l2 .inp{padding:0 0 0 5px;height:36px;}
}
.uk0{margin-top:0;}
</style>
<script language="javascript">
function tj(){
if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入套餐说明！");document.f1.t1.focus();return false;}
if((document.f1.tmoney2.value).replace(/\s/,"")==""){alert("请输入原价！");document.f1.tmoney2.focus();return false;}
if((document.f1.tmoney1.value).replace(/\s/,"")==""){alert("请输入优惠价！");document.f1.tmoney1.focus();return false;}
if((document.f1.t2.value).replace(/\s/,"")=="" || isNaN(document.f1.t2.value)){alert("请输入有效的排序号！");document.f1.t2.focus();return false;}
layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
f1.action="servertaocan2.php?control=update&id=<?=$row[id]?>&ty1id=<?=$ty1id?>&bh=<?=$bh?>";
}
function deltp(){
 if(confirm("确定要删除该图标吗？")){location.href="servertaocan2.php?id=<?=$id?>&ty1id=<?=$ty1id?>&bh=<?=$bh?>&control=del";}else{return false;}
}
</script>
</head>
<body style="overflow-x:hidden;">
 
 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！[<a href='servertaocan2lx.php?bh=".$bh."&ty1id=".$ty1id."'>继续添加新套餐</a>]","servertaocan2.php?ty1id=".$ty1id."&id=".$id."&bh=".$bh);}?>
 
 <!--begin-->
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <ul class="uk">
 <li class="l1">一级套餐：</li>
 <li class="l2"><input type="text" class="inp redony" value="<?=$ty1tit?>" name="t0" readonly="readonly" /></li>
 <li class="l1">二级套餐：</li>
 <li class="l2"><input type="text" class="inp" name="t1" onfocus="inpf(this)" value="<?=$row[tit2]?>" onblur="inpb(this)" /></li>
 <li class="l1">套餐图标：</li>
 <li class="l2"><input type="file" name="inp2" id="inp2" class="inp1" size="15" accept=".jpg,.gif,.jpeg,.png"><span class="fd">最佳尺寸：254*167,不上传则显示文字形式</span></li>
 <? $ntp="../upload/".$row[userid]."/".$row[serverbh]."/tc".$row[id].".png";if(is_file($ntp)){?>
 <li class="l8"></li>
 <li class="l9"><img src="<?=$ntp?>" width="55" height="55" /> [<a href="javascript:void(0);" onclick="deltp()">删除</a>]</li>
 <? }?>
 <li class="l1">原价：</li>
 <li class="l2"><input type="text" class="inp" name="tmoney2" value="<?=$row[money2]?>" /><span class="fd">元</span></li>
 <li class="l1">优惠价：</li>
 <li class="l2"><input type="text" class="inp" name="tmoney1" value="<?=$row[money1]?>" /><span class="fd">元</span></li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=$row[xh]?>" /><span class="fd">序号越小，越靠前</span></li>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /><input type="button" onclick="gourl('servertaocanlist.php?bh=<?=$bh?>')" value="返回列表" class="btn2" /></li>
 </ul>
 </form>
 <!--end-->

</body>
</html>