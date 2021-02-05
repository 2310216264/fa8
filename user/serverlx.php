<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();

$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."' and shopzt=2";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("openshop3.php");}
$userid=$rowuser[id];
$sj=getsj();
$uip=getuip();
$bh=returnbh()."n".$userid;
intotable("yjcode_server","bh,userid,sj,lastsj,uip,ty1id,ty2id,djl,xsnum,pf1,pf2,pf3,ifxj,zt,iftj","'".$bh."',".$userid.",'".$sj."','".$sj."','".$uip."',0,0,0,0,5,5,5,0,99,0");
php_toheader("server.php?bh=".$bh);
?>
