<?php
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
AdminSes_audit();
$sj=date("Y-m-d H:i:s");
$bh=$_GET[bh];
while0("*","yjcode_pro where bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){Audit_alert("来源出错","default.php","parent.");}
$tit=$row[tit];

$ty1id=$_GET[ty1id];
while0("*","yjcode_taocan where id=".$ty1id);$row=mysqli_fetch_array($res);
$ty1tit=$row[tit];

$id=$_GET[id];
while0("*","yjcode_taocan where id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("taocanlist.php?bh=".$bh);}

//函数开始
if($_GET[control]=="update"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if(panduan("*","yjcode_taocan where admin=2 and tit='".sqlzhuru($_POST[t0])."' and tit2='".sqlzhuru($_POST[t1])."' and probh='".$bh."' and id<>".$id)==1){Audit_alert("该套餐说明已存在！","taocan1.php?action=update&id=".$id."&ty1id=".$ty1id."&bh=".$bh);}
 
 $kcnum=sqlzhuru($_POST[tkcnum]);if(!is_numeric($kcnum)){$kcnum=0;}
 $fhxs=intval(sqlzhuru($_POST[Rfhxs]));
 updatetable("yjcode_taocan","tit2='".sqlzhuru($_POST[t1])."',
                              xh=".sqlzhuru($_POST[t2]).",
							  money1=".sqlzhuru($_POST[tmoney1]).",
							  money2=".sqlzhuru($_POST[tmoney2]).",
							  zt=0,
			                  fhxs=".$fhxs.",
			                  wpurl='".sqlzhuru($_POST[twpurl])."',
			                  wppwd='".sqlzhuru($_POST[twppwd])."',
			                  wppwd1='".sqlzhuru($_POST[twppwd1])."',
							  kcnum=".$kcnum."
							  where id=".$id);

 uploadtpnodata(2,"upload/".$row[userid]."/".$row[probh]."/","tc".$id.".png","allpic",350,350,150,150,"no");
 //上传B
 if(3==$fhxs){
  $up1=$_FILES["inp1"]["name"];
  if(!empty($up1)){
  $mc=MakePassAll(15)."-".time()."-".$row[userid].".".returnhz($up1);
  $lj="../upload/".$row[userid]."/".$bh."/";
  move_uploaded_file($_FILES["inp1"]['tmp_name'],$lj.$mc);
  delFile($lj.$row[upf]);
  updatetable("yjcode_taocan","upf='".$mc."' where id=".$id);
  }
 }
 //上传E
 if(4==$fhxs){kamikc_tc($bh,$id);}

 php_toheader("taocan1.php?t=suc&id=".$id."&ty1id=".$ty1id."&bh=".$bh);

}elseif($_GET[control]=="del"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不足","default.php","parent.");}
 zwzr();
 delFile("../upload/".$row[userid]."/".$row[probh]."/tc".$row[id].".png");
 delFile("../upload/".$row[userid]."/".$row[probh]."/tc".$row[id]."-1.png");
 php_toheader("taocan1.php?t=suc&id=".$id."&ty1id=".$ty1id."&bh=".$bh);

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
f1.action="taocan1.php?control=update&id=<?=$row[id]?>&ty1id=<?=$ty1id?>&bh=<?=$bh?>";
}
function fhxsonc(x){
for(i=0;i<=4;i++){
d=document.getElementById("fhxs"+i);if(d){d.style.display="none";}
}
d=document.getElementById("fhxs"+x);if(d){d.style.display="";}
}
function deltp(){
 if(confirm("确定要删除该图标吗？")){location.href="taocan1.php?id=<?=$id?>&ty1id=<?=$ty1id?>&bh=<?=$bh?>&control=del";}else{return false;}
}
</script>
</head>
<body style="overflow-x:hidden;">
 
 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！[<a href='taocan1lx.php?bh=".$bh."&ty1id=".$ty1id."'>继续添加新套餐</a>]","taocan1.php?ty1id=".$ty1id."&id=".$id."&bh=".$bh);}?>
 
 <!--begin-->
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <ul class="uk">
 <li class="l1">一级套餐：</li>
 <li class="l2"><input type="text" class="inp redony" value="<?=$ty1tit?>" name="t0" readonly="readonly" /></li>
 <li class="l1">二级套餐：</li>
 <li class="l2"><input type="text" class="inp" name="t1" onfocus="inpf(this)" value="<?=$row[tit2]?>" onblur="inpb(this)" /></li>
 <li class="l1">套餐图标：</li>
 <li class="l2"><input type="file" name="inp2" id="inp2" class="inp1" size="15" accept=".jpg,.gif,.jpeg,.png"><span class="fd">最佳尺寸：350*350,不上传则显示文字形式</span></li>
 <? $ntp="../upload/".$row[userid]."/".$row[probh]."/tc".$row[id].".png";if(is_file($ntp)){?>
 <li class="l8"></li>
 <li class="l9"><img src="<?=$ntp?>" width="55" height="55" /> [<a href="javascript:void(0);" onclick="deltp()">删除</a>]</li>
 <? }?>
 <li class="l1">原价：</li>
 <li class="l2"><input type="text" class="inp" name="tmoney2" value="<?=$row[money2]?>" /><span class="fd">元</span></li>
 <li class="l1">优惠价：</li>
 <li class="l2"><input type="text" class="inp" name="tmoney1" value="<?=$row[money1]?>" /><span class="fd">元</span></li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=$row[xh]?>" /><span class="fd">序号越小，越靠前</span></li>
 </ul>
 
 <ul class="uk uk0">
 <li class="l1"><span class="red">*</span> 库存量：</li>
 <li class="l2"><input class="inp" name="tkcnum" value="<?=$row[kcnum]?>" size="10" type="text"/><span class="fd">(如果是点卡交易类，库存值无需填写，将自动读取)</span></li>
 <li class="l1 red">* 发货形式：</li>
 <li class="l2">
 <label><input name="Rfhxs" type="radio" value="0" onclick="fhxsonc(0)" <? if(0==$row[fhxs]){?>checked="checked"<? }?> /> 跟商品保持一致</label>
 <? if(strstr($rowcontrol[fhxs],"1") || empty($rowcontrol[fhxs])){?>
 <label><input name="Rfhxs" type="radio" value="1" onclick="fhxsonc(1)" <? if(1==$row[fhxs]){?>checked="checked"<? }?> /> 手动发货(独立)</label>
 <? }?>
 <? if(strstr($rowcontrol[fhxs],"2") || empty($rowcontrol[fhxs])){?>
 <label><input name="Rfhxs" type="radio" value="2" onclick="fhxsonc(2)" <? if(2==$row[fhxs]){?>checked="checked"<? }?> /> 网盘下载(独立)</label>
 <? }?>
 <? if(strstr($rowcontrol[fhxs],"3") || empty($rowcontrol[fhxs])){?>
 <label><input name="Rfhxs" type="radio" value="3" onclick="fhxsonc(3)" <? if(3==$row[fhxs]){?>checked="checked"<? }?> /> 网站直接下载(独立)</label>
 <? }?>
 <? if(strstr($rowcontrol[fhxs],"4") || empty($rowcontrol[fhxs])){?>
 <label><input name="Rfhxs" type="radio" value="4" onclick="fhxsonc(4)" <? if(4==$row[fhxs]){?>checked="checked"<? }?> /> 点卡交易(独立)</label>
 <? }?>
 </li>
 </ul> 
 <ul class="uk" id="fhxs2" style="display:none;">
 <li class="l1">网盘地址：</li>
 <li class="l2"><input class="inp" name="twpurl" value="<?=$row[wpurl]?>" size="80" type="text"/></li>
 <li class="l1">网盘密码：</li>
 <li class="l2"><input class="inp" name="twppwd" value="<?=$row[wppwd]?>" size="20" type="text"/></li>
 <li class="l1">解压密码：</li>
 <li class="l2"><input class="inp" name="twppwd1" value="<?=$row[wppwd1]?>" size="20" type="text"/></li>
 </ul>
 <ul class="uk" id="fhxs3" style="display:none;">
 <li class="l1">上传文件：</li>
 <li class="l2"><input type="file" name="inp1" id="inp1" size="25"></li>
 <? if(!empty($row[upf])){?>
 <li class="l1">文件预览：</li>
 <li class="l21">【<a href="../upload/<?=$row[userid]?>/<?=$row[probh]?>/<?=$row[upf]?>" class="blue" target="_blank">点击预览</a>】</li>
 <? }?>
 </ul>

 <ul class="uk uk0">
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /><input type="button" onclick="gourl('taocanlist.php?bh=<?=$bh?>')" value="返回列表" class="btn2" /></li>
 </ul>
 </form>
 <!--end-->
 
 <script language="javascript">
 fhxsonc(<?=$row[fhxs]?>);
 </script>

</body>
</html>