<?
include("../config/conn.php");
include("../config/function.php");
include("../config/tpclass.php");
sesCheck();
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}

if(sqlzhuru($_POST[jvs])=="zzrz"){
 zwzr();
 if(panduan("uid,zzrz","yjcode_user where uid='".$_SESSION[SHOPUSER]."' and (zzrz=2 or zzrz=3)")==0){Audit_alert("错误的请求！","zzrz.php");}
 $qymc=sqlzhuru($_POST[tqymc]);
 $qyzch=sqlzhuru($_POST[tqyzch]);
 $frdb=sqlzhuru($_POST[tfrdb]);
 if(strlen(stripos($qyzch,"/"))>0 || strlen(stripos($qyzch,";"))>0){Audit_alert("号码格式有误！","zzrz.php");}
 if(empty($qymc) || empty($qyzch) || empty($frdb)){Audit_alert("信息不完整，返回重试！","zzrz.php");}
 updatetable("yjcode_user","kdlx=".intval($_POST[d1]).",qymc='".$qymc."',qyzch='".$qyzch."',frdb='".$frdb."',zzrz=0 where uid='".$_SESSION[SHOPUSER]."'");
 uploadtpnodata(1,"upload/".$rowuser[id]."/",strgb2312($qyzch,0,15)."-zz.jpg","allpic",800,0,0,0,"no");

 php_toheader("zzrz.php?t=suc"); 
}

$zz1="../upload/".$rowuser[id]."/".strgb2312($rowuser[qyzch],0,15)."-zz.jpg";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<script language="javascript">
function tj(){
if(document.f1.tqymc.value==""){alert("请输入企业名称");document.f1.tqymc.focus();return false;}	
if(document.f1.tqyzch.value==""){alert("请输入企业注册号");document.f1.tqyzch.focus();return false;}	
if(document.f1.tfrdb.value==""){alert("请输入法人代表");document.f1.tfrdb.focus();return false;}	
layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
f1.action="zzrz.php";
}
</script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <? include("rcap4.php");?>
 <script language="javascript">
 document.getElementById("rcap7").className="l1 l2";
 </script>

 <!--白B-->
 <div class="rkuang">
 
 <? systs("恭喜您，操作成功!","zzrz.php")?>
 <div class="rts">
 认证状态<br>
 <? 
 if(0==$rowuser[zzrz]){echo "<strong class='blue'>已提交资料，正在审核认证，请耐心等待</strong>";}
 elseif(1==$rowuser[zzrz]){echo "<strong class='green'>已经通过执照认证</strong>";}
 elseif(2==$rowuser[zzrz]){echo "<strong class='red'>认证被拒，原因：".$rowuser[zzrzsm]."</strong>";}
 elseif(3==$rowuser[zzrz]){echo "<strong>未提交认证资料，请填写以下信息并提交</strong>";}
 ?>
 </div>
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <input type="hidden" value="zzrz" name="jvs" />
 <ul class="uk">
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 企业名称：</li>
 <li class="l2"><input type="text" class="inp" name="tqymc" size="36" value="<?=$rowuser[qymc]?>" /></li>
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 企业注册号：</li>
 <li class="l2"><input type="text" class="inp" name="tqyzch" size="36" value="<?=$rowuser[qyzch]?>" /></li>
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 法人代表：</li>
 <li class="l2"><input type="text" class="inp" name="tfrdb" value="<?=$rowuser[frdb]?>" /></li>
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 企业执照：</li>
 <li class="l2"><input type="file" class="inp" name="inp1" id="inp1" size="25"></li>
 <? if(is_file($zz1)){?>
 <li class="l5"></li>
 <li class="l6"><a href="<?=$zz1?>" target="_blank"><img border="0" src="<?=$zz1?>" width="170" height="100" /></a></li>
 <? }?>
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 执照类型：</li>
 <li class="l2">
 <select name="d1" class="inp">
 <option value="0"<? if(empty($rowuser[kdlx])){?> selected="selected"<? }?>>个人</option>
 <option value="1"<? if($rowuser[kdlx]==1){?> selected="selected"<? }?>>个体户</option>
 <option value="2"<? if($rowuser[kdlx]==2){?> selected="selected"<? }?>>企业</option>
 </select>
 </li>
 <? if(2==$rowuser[zzrz] || 3==$rowuser[zzrz]){?>
 <li class="l3"><? tjbtnr("提交认证")?></li>
 <? }?>
 </ul>
 </form>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>