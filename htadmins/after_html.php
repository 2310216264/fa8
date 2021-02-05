<?
require("../config/conn.php");
require("../config/function.php");
AdminSes_audit();
$sj=date("Y-m-d H:i:s");

$admin=$_GET[admin];
if(empty($admin)){$admin="0";}

switch($admin)
{
 case "0": //常规缓存清理
 html1();
 break;
 case "1": //订单/店铺状态/订单评价触发变更
 $autoses="id>0";
 include("../user/auto.php");
 
 while1("id,uid,pwd,shopzt,dqsj","yjcode_user where dqsj<'".$sj."' and shopzt=2 and dqsj is not null");while($row1=mysqli_fetch_array($res1)){
 updatetable("yjcode_user","shopzt=4 where id=".$row1[id]);
 }
 
 $jysj=date("Y-m-d H:i:s",strtotime("-".$rowcontrol[dbsj]." day"));
 while1("*","yjcode_order where ddzt='suc' and oksj<='".$jysj."' and admin=2 and (ifpj is null or ifpj=0) order by id asc");while($row1=mysqli_fetch_array($res1)){
   $uip=$_SERVER["REMOTE_ADDR"];
   $pj="交易完成超过".$rowcontrol[dbsj]."天未评价，默认好评";
   $oksj=date('Y-m-d H:i:s',strtotime ("+".$rowcontrol[dbsj]." day",strtotime($row1[sj])));
   updatetable("yjcode_order","ifpj=1,pjtxt='".$pj."',pjsj='".$sj."',pf1=5,pf2=5,pf3=5,ifpjtp=0,ifpjvideo=0,pjlx=1 where zuorderbh='".$row1[zuorderbh]."'");
   $sqla1="select avg(pf1) as pf1v,avg(pf2) as pf2v,avg(pf3) as pf3v from yjcode_order where probh='".$row1[probh]."' and ifpj=1";
   mysqli_set_charset($conn,"utf8");$resa1=mysqli_query($conn,$sqla1);$rowa1=mysqli_fetch_array($resa1);
   updatetable("yjcode_pro","pf1=".round($rowa1[pf1v],2).",pf2=".round($rowa1[pf2v],2).",pf3=".round($rowa1[pf3v],2)." where bh='".$row1[probh]."'");
   $sqlp="select avg(pf1) pf1v,avg(pf2) pf2v,avg(pf3) pf3v from yjcode_pro where zt=0 and userid=".$row1[selluserid];
   mysqli_set_charset($conn,"utf8");$resp=mysqli_query($conn,$sqlp);$rowp=mysqli_fetch_array($resp);
   updatetable("yjcode_user","pf1=".round($rowp[pf1v],2).",pf2=".round($rowp[pf2v],2).",pf3=".round($rowp[pf3v],2)." where id=".$row1[selluserid]);
 }
 
 deletetable("yjcode_smsmail");
 
 break;
}
 echo "ok";
?>