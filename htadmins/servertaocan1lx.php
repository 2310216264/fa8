<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$sj=date("Y-m-d H:i:s");
$bh=$_GET[bh];
while0("*","yjcode_server where bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("serverlist.php");}

if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不够","default.php");}
$nxh=returnxh("yjcode_servertaocan"," and admin=1 and serverbh='".$bh."' and zt<>99");
intotable("yjcode_servertaocan","xh,serverbh,userid,admin,zt","".$nxh.",'".$bh."',".$row[userid].",1,99");
$id=mysqli_insert_id($conn);
php_toheader("servertaocan1.php?bh=".$bh."&id=".$id);

?>
