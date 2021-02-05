<?
include("../config/conn.php");
include("../config/function.php");
$bh=returndeldian($_GET[bh]);
$buynum=intval($_GET[buynum]);
if(empty($bh)){exit;}
if(empty($_SESSION["SHOPUSER"])){echo "err1";exit;}
while1("bh,userid,tit,money1","yjcode_server where bh='".$bh."' and zt=0 and ifxj=0");if(!$row1=mysqli_fetch_array($res1)){exit;}
$money1=$row1[money1];
$userid=returnuserid($_SESSION["SHOPUSER"]);
if($userid==$row1[userid]){echo "err2";exit;}
$orderbh=returnbh()."-".$userid;
$tcid=intval($_GET[tcid]);
if(!empty($tcid)){
 while3("*","yjcode_servertaocan where id=".$tcid);if($row3=mysqli_fetch_array($res3)){
 $money1=$row3[money1];
 $taocan=$row3[tit1];
 if($row3[admin]==2){$taocan=$taocan." ".$row3[tit2];}
 }
}
$money3=$buynum*$money1;
intotable("yjcode_serverorder","serverbh,orderbh,selluserid,userid,tit,num,money1,money2,money3,sj,uip,taocan,ddzt,ifpj","'".$row1[bh]."','".$orderbh."',".$row1[userid].",".$userid.",'".sqlzhuru($row1[tit])."',".$buynum.",".$money1.",0,".$money3.",'".getsj()."','".getuip()."','".$taocan."',99,0");
echo "ok|".$orderbh;exit;
?>
