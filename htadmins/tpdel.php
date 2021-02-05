<?
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
while1("*","yjcode_tp where id=".intval($_GET[id]));if($row1=mysqli_fetch_array($res1)){
 if(!empty($row1[tp])){
  delFile("../".str_replace(".","-1.",$row1[tp]));
  delFile("../".str_replace(".","-2.",$row1[tp]));
  delFile("../".$row1[tp]);
 }
 deletetable("yjcode_tp where id=".intval($_GET[id]));
}
?>
