<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
if(!strstr($adminqx,",0,") && !strstr($adminqx,",0701,")){Audit_alert("权限不够","default.php");}
$sql="select id,uid,pwd from yjcode_user where uid='".$_GET[uid]."'";mysqli_set_charset($conn,"utf8");$res=mysqli_query($conn,$sql);$row=mysqli_fetch_array($res);
$_SESSION["SHOPUSER"]=$row[uid];
$_SESSION["SHOPUSERPWD"]=$row[pwd];
php_toheader("../user/");
?>