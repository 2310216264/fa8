<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
$sj=date("Y-m-d H:i:s");
$bh=time();
$nxh=returnxh("yjcode_servertype"," and admin=1 and zt=0");
intotable("yjcode_servertype","bh,admin,sj,xh,zt","'".$bh."',1,'".$sj."',".$nxh.",99");
php_toheader("servertype1.php?bh=".$bh);
?>
