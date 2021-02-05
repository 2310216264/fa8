<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
$rowuser=mysqli_fetch_array($resuser);if($rowuser[zzrz]!=2 && $rowuser[zzrz]!=3){php_toheader("zzrz.php"); }

if($_POST[jvs]=="zzrz"){
 zwzr();
 if(panduan("uid,zzrz","yjcode_user where uid='".$_SESSION[SHOPUSER]."' and (zzrz=2 or zzrz=3)")==0){Audit_alert("错误的请求！","zzrz.php");}
 $qymc=sqlzhuru($_POST[tqymc]);
 $qyzch=sqlzhuru($_POST[tqyzch]);
 $frdb=sqlzhuru($_POST[tfrdb]);
 if(strlen(stripos($qyzch,"/"))>0 || strlen(stripos($qyzch,";"))>0){Audit_alert("号码格式有误！","zzrz1.php");}
 if(empty($qymc) || empty($qyzch) || empty($frdb)){Audit_alert("信息不完整，返回重试！","zzrz1.php");}
 updatetable("yjcode_user","kdlx=".intval($_POST[d1]).",qymc='".$qymc."',qyzch='".$qyzch."',frdb='".$frdb."' where uid='".$_SESSION[SHOPUSER]."'");
 php_toheader("zzrz2.php"); 
}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function tj(){
 if(document.f1.tqymc.value==""){layerts("请输入企业名称");document.f1.tqymc.focus();return false;}	
 if(document.f1.tqyzch.value==""){layerts("请输入企业注册号");document.f1.tqyzch.focus();return false;}	
 if(document.f1.tfrdb.value==""){layerts("请输入法人代表");document.f1.tfrdb.focus();return false;}	
 layer.open({type: 2,content: '正在提交',shadeClose:false});
 f1.action="zzrz1.php";
}
</script>
</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="javascript:window.history.go(-1);"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">执照认证</div>
 <div class="d3"></div>
</div>

<div class="tishi box">
<div class="d1">
认证步骤：<br>
<strong class="blue">一、请填写真实的企业名称或执照号码</strong><br>
二、上传认证图片<br>
</div>
</div>

<form name="f1" method="post" onSubmit="return tj()">
<input type="hidden" value="zzrz" name="jvs" />
<div class="uk box">
 <div class="d1">企业名称</div>
 <div class="d2"><input type="text" class="inp" name="tqymc" value="<?=$rowuser[qymc]?>" placeholder="请输入企业名称" /></div>
</div>

<div class="uk box">
 <div class="d1">执照号码</div>
 <div class="d2"><input type="text" class="inp" name="tqyzch" value="<?=$rowuser[qyzch]?>" placeholder="请输入企业注册号" /></div>
</div>

<div class="uk box">
 <div class="d1">法人代表</div>
 <div class="d2"><input type="text" class="inp" name="tfrdb" value="<?=$rowuser[frdb]?>" placeholder="请输入法人代表" /></div>
</div>

<div class="uk box">
 <div class="d1">认证类型</div>
 <div class="d2">
 <select name="d1" class="inp">
 <option value="0"<? if(empty($rowuser[kdlx])){?> selected="selected"<? }?>>个人</option>
 <option value="1"<? if($rowuser[kdlx]==1){?> selected="selected"<? }?>>个体户</option>
 <option value="2"<? if($rowuser[kdlx]==2){?> selected="selected"<? }?>>企业</option>
 </select>
 </div>
</div>

<div class="fbbtn box">
 <div class="d1"><? tjbtnr_m("下一步")?></div>
</div>
</form>

<? include("bottom.php");?>
</body>
</html>