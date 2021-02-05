<?php
include("../config/conn.php");
include("../config/function.php");
require("../config/tpclass.php");
AdminSes_audit();
$id=intval($_GET[id]);

//函数开始
if(sqlzhuru($_POST[jvs])=="zz"){
 zwzr();
 $qyzch=sqlzhuru($_POST[tqyzch]);
 if(strlen(stripos($sfz,"/"))>0 || strlen(stripos($sfz,";"))>0){Audit_alert("身份证号码格式有误！","userrz.php?id=".$id);}
 updatetable("yjcode_user","
			 kdlx=".intval($_POST[d1]).",
			 qymc='".sqlzhuru($_POST[tqymc])."',
			 frdb='".sqlzhuru($_POST[tfrdb])."',
			 qyzch='".$qyzch."',
			 zzrz=".sqlzhuru($_POST[R1]).",
			 zzrzsm='".sqlzhuru($_POST[tzzrzsm])."' 
			 where id=".$id);
 uploadtpnodata(1,"upload/".$id."/",strgb2312($qyzch,0,15)."-zz.jpg","allpic",800,0,0,0,"no");
 php_toheader("zzrz.php?t=suc&id=".$id); 

}
//函数结果
while0("*","yjcode_user where id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("userlist.php");}
$zz1="../upload/".$id."/".strgb2312($row[qyzch],0,15)."-zz.jpg";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script language="javascript">
function tjzz(){
 if((document.fzz.tqymc.value).replace("/\s/","")==""){alert("请输入企业名称");document.fzz.tqymc.focus();return false;}
 if((document.fzz.tfrdb.value).replace("/\s/","")==""){alert("请输入法人代表");document.fzz.tfrdb.focus();return false;}
 if((document.fzz.tqyzch.value).replace("/\s/","")==""){alert("请输入企业注册号");document.fzz.tqyzch.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 fzz.action="zzrz.php?id=<?=$id?>";
}
function zzrzonc(x){
if(2==x){document.getElementById("zzrzsmv").style.display="";}else{document.getElementById("zzrzsmv").style.display="none";}
}
</script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu2").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0702,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
 <? $leftid=1;include("menu_user.php");?>

<div class="right">

 <? include("rightcap3.php");?>
 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","zzrz.php?id=".$id);}?>
 
 <script language="javascript">document.getElementById("rtit7").className="a1";</script>
 <!--B-->
 <div class="rights">
 执照认证状态<br>
 <? 
 if(0==$row[zzrz]){echo "&nbsp;<strong class='blue'>执照已提交，需要审核认证</strong>";}
 elseif(1==$row[zzrz]){echo "&nbsp;<strong class='green'>已经通过执照认证</strong>";}
 elseif(2==$row[zzrz]){echo "&nbsp;<strong class='red'>认证被拒，原因：".$row[zzrzsm]."</strong>";}
 elseif(3==$row[zzrz]){echo "&nbsp;<strong>未提交认证资料</strong>";}
 ?>
 </div>
 <div class="rkuang">
 <form name="fzz" method="post" onsubmit="return tjzz()" enctype="multipart/form-data">
 <input type="hidden" value="zz" name="jvs" />
 <ul class="uk">
 <li class="l1">会员帐号：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" name="tuid" size="20" value="<?=$row[uid]?>" /></li>
 <li class="l1">开店类型：</li>
 <li class="l2">
 <select name="d1" class="inp">
 <option value="0"<? if(empty($row[kdlx])){?> selected="selected"<? }?>>个人</option>
 <option value="1"<? if($row[kdlx]==1){?> selected="selected"<? }?>>个体户</option>
 <option value="2"<? if($row[kdlx]==2){?> selected="selected"<? }?>>企业</option>
 </select>
 </li>
 <li class="l1">执照审核：</li>
 <li class="l2">
 <label><input name="R1" type="radio" onclick="zzrzonc(0)" value="0"<? if(0==$row[zzrz]){?> checked="checked"<? }?> /> 等待审核</label>
 <label><input name="R1" type="radio" onclick="zzrzonc(0)" value="1"<? if(1==$row[zzrz]){?> checked="checked"<? }?> /> 通过认证</label>
 <label><input name="R1" type="radio" onclick="zzrzonc(2)" value="2"<? if(2==$row[zzrz]){?> checked="checked"<? }?> /> 认证不通过</label>
 <label><input name="R1" type="radio" onclick="zzrzonc(0)" value="3"<? if(3==$row[zzrz]){?> checked="checked"<? }?> /> 未提交认证</label>
 </li>
 </ul>
 <ul class="uk uk0" id="zzrzsmv" style="display:none;">
 <li class="l1">被拒原因：</li>
 <li class="l2"><input type="text" class="inp" name="tzzrzsm" size="90" value="<?=$row[zzrzsm]?>" /></li>
 </ul>
 <ul class="uk uk0">
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 企业名称：</li>
 <li class="l2"><input type="text" class="inp" name="tqymc" value="<?=$row[qymc]?>" /></li>
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 法人代表：</li>
 <li class="l2"><input type="text" class="inp" name="tfrdb" value="<?=$row[frdb]?>" /></li>
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 企业注册号：</li>
 <li class="l2"><input type="text" class="inp" name="tqyzch" value="<?=$row[qyzch]?>" /></li>
 <li class="l1"><span class="red" style="font-weight:normal;">*</span> 上传执照：</li>
 <li class="l2"><input type="file" name="inp1" class="inp1" id="inp1" size="25"></li>
 <? if(is_file($zz1)){?>
 <li class="l8"></li>
 <li class="l9"><a href="<?=$zz1?>" target="_blank"><img border="0" src="<?=$zz1?>?t=<?=time()?>" width="100" height="50" /></a></li>
 <? }?>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /></li>
 </ul>
 </form>
 </div>
 <script language="javascript">
 zzrzonc(<?=$row[zzrz]?>);
 </script>
 <!--E-->

</div>
</div>
<?php include("bottom.php");?>
</body>
</html>