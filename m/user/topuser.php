<?
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}

$autoses="(selluserid=".$rowuser[id]." or userid=".$rowuser[id].")";
if(is_file("../../user/auto.php")){include("../../user/auto.php");}

$usertx="../../upload/".$rowuser[id]."/user.jpg";if(!is_file($usertx)){$usertx="../../user/img/nonetx.gif";}
$shoplogo="../../upload/".$rowuser[id]."/shop.jpg";if(!is_file($shoplogo)){$shoplogo="img/shoplogo.png";}

if(empty($qzmotweb) && empty($rowuser[ifmot]) && $rowcontrol["qzmot"]==1){Audit_alert("根据实名制要求，请先绑定您的手机号码","mobbd.php");}
if(empty($userztweb) && empty($rowuser[zt])){php_toheader("userzt.php");}

?>
<span id="webhttp" style="display:none"><?=weburl?></span>
<? if(strcmp(sha1("123456"),$rowuser[pwd])==0){?><div class="rts box"><div class="d1">您当前密码为123456，过于简单，建议您立即修改!<br><a href="pwd.php">点击修改登录密码</a></div></div><? }?>
