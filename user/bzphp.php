<?
header('Content-type: text/html; charset=utf-8');
include("../config/conn.php");
include("../config/function.php");
$bzv=sqlzhuru($_POST[bzv]);
$cid=intval($_POST[cid]);
if(empty($bzv) || empty($cid)){echo "err";exit;}
$userid=returnuserid($_SESSION[SHOPUSER]);
updatetable("yjcode_car","bz='".$bzv."' where id=".$cid." and userid=".$userid);echo "ok";exit;
?>
