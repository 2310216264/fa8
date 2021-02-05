<?php
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$sj=date("Y-m-d H:i:s");
$bh=$_GET[bh];
$userid=returnuserid($_SESSION[SHOPUSER]);
while0("*","yjcode_server where userid=".$userid." and bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("serverlist.php");}

$nxh=returnxh("yjcode_servertaocan"," and admin=1 and serverbh='".$bh."' and zt<>99");
intotable("yjcode_servertaocan","xh,serverbh,userid,admin,zt","".$nxh.",'".$bh."',".$row[userid].",1,99");
$id=mysqli_insert_id($conn);
php_toheader("servertaocan1.php?bh=".$bh."&id=".$id);

?>
