<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}

$ty1id=$_GET[ty1id];
while0("*","yjcode_servertype where zt=0 and admin=1 and id=".$ty1id);if(!$row=mysqli_fetch_array($res)){php_toheader("servertypelist.php");}

$bh=returnbh();
$nxh=returnxh("yjcode_servertype"," and admin=2 and name1='".$row[name1]."' and zt=0");
intotable("yjcode_servertype","bh,admin,name1,sj,xh,zt","'".$bh."',2,'".$row[name1]."','".getsj()."',".$nxh.",99");
php_toheader("servertype2.php?bh=".$bh."&ty1id=".$ty1id);
?>
