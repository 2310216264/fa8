<?
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

if(!strstr($adminqx,",0,") && !strstr($adminqx,",0201,")){Audit_alert("权限不够","default.php");}
$sj=date("Y-m-d H:i:s");
$uip=$_SERVER["REMOTE_ADDR"];
$bh=time()."g".rnd_num(100);
$djl=rnd_num(10);
intotable("yjcode_gg","bh,sj,djl,uip,zt","'".$bh."','".$sj."',".$djl.",'".$uip."',99");
php_toheader("gg.php?bh=".$bh);
?>
