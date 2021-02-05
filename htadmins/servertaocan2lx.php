<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$sj=date("Y-m-d H:i:s");
$bh=$_GET[bh];
$ty1id=$_GET[ty1id];
while0("*","yjcode_server where bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("serverlist.php");}

if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不够","default.php");}
while1("*","yjcode_servertaocan where id=".$ty1id);if(!$row1=mysqli_fetch_array($res1)){php_toheader("serverlist.php");}
$nxh=returnxh("yjcode_servertaocan"," and admin=2 and tit1='".$row1[tit1]."' and serverbh='".$bh."'");
intotable("yjcode_servertaocan","tit1,xh,admin,serverbh,userid,zt","'".$row1[tit1]."',".$nxh.",2,'".$bh."',".$row[userid].",99");
$id=mysqli_insert_id($conn);
php_toheader("servertaocan2.php?ty1id=".intval($_GET[ty1id])."&bh=".$bh."&id=".$id);
?>
