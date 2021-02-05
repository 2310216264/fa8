<?
include("../config/conn.php");
include("../config/function.php");
$userid=returnuserid($_SESSION["SHOPUSER"]);
updatetable("yjcode_car","ifxj=1 where userid=".$userid);
$cid=preg_split("/,/",$_GET[cid]);
for($i=0;$i<count($cid);$i++){
 if(!empty($cid[$i])){
 updatetable("yjcode_car","ifxj=0 where id=".intval($cid[$i])." and userid=".$userid);
 }
}
?>