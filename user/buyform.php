<?
header('Content-type: text/html; charset=utf-8');
include("../config/conn.php");
include("../config/function.php");
$bv=sqlzhuru1($_POST[bv]);
$cid=intval($_POST[cid]);
if(empty($bv) || empty($cid)){echo "err";exit;}
$userid=returnuserid($_SESSION[SHOPUSER]);
$bvarr=preg_split("/yj99yjcode/",$bv);
$c=preg_split("/c/",$cid);
for($i=0;$i<count($c);$i++){
$d=preg_split("/-/",$c[$i]);
if(!empty($d[0])){
updatetable("yjcode_car","buyform='".$bvarr[$i]."' where id=".intval($d[0])." and userid=".$userid);echo "ok";exit;
}
}
?>
