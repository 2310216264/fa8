<?
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
sesCheck();

$sj=date("Y-m-d H:i:s");
$bh=returndeldian($_GET[bh]);
$userid=returnuserid($_SESSION[SHOPUSER]);
while0("*","yjcode_server where userid=".$userid." and bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("serverlist.php");}
$tit=$row[tit];
$id=intval($_GET[id]);

while0("*","yjcode_servertaocan where userid=".$userid." and id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("servertaocanlist.php?bh=".$bh);}
 
//函数开始
if($_GET[control]=="update"){
 zwzr();
 if(panduan("*","yjcode_servertaocan where userid=".$userid." and serverbh='".$bh."' and admin=1 and tit1='".sqlzhuru($_POST[t1])."' and id<>".$id)==1){Audit_alert("该套餐内容已存在！","servertaocan1.php?id=".$_GET[id]."&bh=".$bh);}
 
 updatetable("yjcode_servertaocan","tit1='".sqlzhuru($_POST[t1])."',
                              xh=".sqlzhuru($_POST[t2]).",
							  money1=".sqlzhuru($_POST[tmoney1]).",
							  money2=".sqlzhuru($_POST[tmoney2]).",
							  zt=0
							  where id=".$id);
							  
 updatetable("yjcode_servertaocan","tit1='".sqlzhuru($_POST[t1])."' where tit1='".sqlzhuru($_POST[oldty1])."' and serverbh='".$bh."'");
 uploadtpnodata(2,"upload/".$row[userid]."/".$row[serverbh]."/","tc".$id.".png","allpic",254,167,254,167,"no");
 php_toheader("servertaocan1.php?t=suc&id=".$id."&bh=".$bh);

}elseif($_GET[control]=="del"){
 zwzr();
 delFile("../upload/".$row[userid]."/".$row[serverbh]."/tc".$row[id].".png");
 php_toheader("servertaocan1.php?t=suc&id=".$id."&bh=".$bh);

}
//函数结果

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<style type="text/css">
.uk{float:left;margin:0 0 0 0;width:900px;font-size:14px;text-align:left;}
.uk li{float:left;}
.uk .l1{width:160px;text-align:right;padding:19px 10px 0 0;height:30px;color:#666666;}
.uk .l21{width:730px;height:30px;padding:19px 0 0 0;}
.uk .l2{width:730px;height:38px;padding:11px 0 0 0;}
.uk .l2 label{float:left;cursor:pointer;margin:-2px 10px 0 0;padding:7px 10px 0 10px;height:24px;background-color:#FCFCFD;border:#ECECEC solid 1px;border-radius:5px;}
.uk .l2 .fd{float:left;margin:6px 7px 0 0;}
.uk .l2 .inp{float:left;border:#CCCCCC solid 1px;height:34px;padding:0 0 0 5px;margin-right:7px;}
.uk .l2 .finp{float:left;}
@media screen and (-webkit-min-device-pixel-ratio:0) {
.uk .l2 .finp{padding:5px 0 0 0;}
}
.uk .l3{width:730px;padding:10px 0 20px 170px;}
.uk .l3 .btn1{cursor:pointer;float:left;border:0;color:#fff;width:173px;height:44px;margin-right:10px;background-color:#E83A17;font-size:16px;}
.uk .l3 .btn2{background-color:#D43211;}
.uk .l3 .btn3{cursor:pointer;float:left;color:#C9C9C9;width:172px;height:44px;margin-right:10px;background-color:#FBFBFB;font-size:16px;border:#E6E6E6 solid 1px;}
.uk .l3 .btn4{background-color:#F3F3F3;}
.uk .l5{width:160px;text-align:right;padding:13px 10px 0 0;height:90px;}
.uk .l6{width:730px;height:90px;padding:13px 0 0 0;}
.uk .l9{width:160px;text-align:right;padding:39px 10px 0 0;height:80px;}
.uk .l10{width:730px;height:106px;padding:13px 0 0 0;}
.uk .l10 textarea{width:592px;height:90px;border:#B6B7C9 solid 1px;}
.uk0{margin-top:0;}
.systs{float:left;width:878px;margin:10px 10px 0 10px;background-color:#EBF8A4;border:#A2D246 solid 1px;color:#FF6600;padding:9px 0 0 0;height:24px;text-align:center;}
</style>
<script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入套餐说明！");document.f1.t1.focus();return false;}
 if((document.f1.tmoney2.value).replace(/\s/,"")==""){alert("请输入原价！");document.f1.tmoney2.focus();return false;}
 if((document.f1.tmoney1.value).replace(/\s/,"")==""){alert("请输入优惠价！");document.f1.tmoney1.focus();return false;}
 if((document.f1.t2.value).replace(/\s/,"")=="" || isNaN(document.f1.t2.value)){alert("请输入有效的排序号！");document.f1.t2.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="servertaocan1.php?control=update&id=<?=$row[id]?>&bh=<?=$bh?>";
 }
function deltp(){
 if(confirm("确定要删除该图标吗？")){location.href="servertaocan1.php?id=<?=$id?>&bh=<?=$bh?>&control=del";}else{return false;}
}
</script>
</head>
<body style="overflow-x:hidden;">
 
 <? systs("恭喜您，操作成功!","servertaocan1.php?id=".$id."&bh=".$bh)?>
 
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <input type="hidden" value="<?=$row[tit1]?>" name="oldty1" />
 <ul class="uk">
 <li class="l1">套餐说明：</li>
 <li class="l2"><input type="text" class="inp" name="t1" value="<?=$row[tit1]?>" /></li>
 <li class="l1">套餐图标：</li>
 <li class="l2"><span class="finp"><input type="file" class="inp1" name="inp2" id="inp2" size="15" accept=".jpg,.gif,.jpeg,.png"> 推荐尺寸：254*167,不上传则显示文字形式</span></li>
 <? $ntp="../upload/".$row[userid]."/".$row[serverbh]."/tc".$row[id].".png";if(is_file($ntp)){?>
 <li class="l5"></li>
 <li class="l6"><img src="<?=$ntp?>" width="55" height="55" /><br><br>[<a href="javascript:void(0);" onclick="deltp()">删除</a>]</li>
 <? }?>
 <li class="l1">原价：</li>
 <li class="l2"><input type="text" class="inp" name="tmoney2" value="<?=$row[money2]?>" /> 元</li>
 <li class="l1">优惠价：</li>
 <li class="l2"><input type="text" class="inp" name="tmoney1" value="<?=$row[money1]?>" /> 元</li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=$row[xh]?>" /> <span class="fd">序号越小，越靠前</span></li>
 <li class="l3"><? tjbtnr("保存修改","servertaocanlist.php?bh=".$bh);?></li>
 </ul>
 </form>

</body>
</html>