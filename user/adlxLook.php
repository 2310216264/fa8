<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION["SHOPUSER"]);
while0("*","yjcode_ad where id=".intval($_GET[id])." and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
adreadID($row[id],0,0);
?>
