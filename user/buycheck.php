<?
$carid=$_GET[carid];
if($carid==""){php_toheader("car.php");}
$c=preg_split("/c/",$carid);
$needmoney=0;
$caridarr="";
for($i=0;$i<count($c);$i++){
 if($c[$i]!=""){
 $d=preg_split("/-/",$c[$i]);
 $id=intval($d[0]);
 $caridarr=$caridarr.$id."xcf";
 $num=intval($d[1]);
 if($num<=0){Audit_alert("错误，购买数量不得少于1，返回重试","car.php");}
 
 while0("*","yjcode_car where userid=".$rowuser[id]." and id=".$id."");if(!$row=mysqli_fetch_array($res)){php_toheader("car.php");}
 
 while1("*","yjcode_pro where bh='".$row[probh]."' and zt=0 and ifxj=0");if(!$row1=mysqli_fetch_array($res1)){Audit_alert("商品已下架或未审核","car.php");}
 $money=returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]);
 $kcnum=$row1[kcnum];
 $profhxs=$row1[fhxs];
 $fhxsnum=$row1[fhxs];
 
 if(empty($row[tcid])){
  $djmoney=$money;$tcv="";
 }else{
  while2("*","yjcode_taocan where zt=0 and id=".$row[tcid]);if(!$row2=mysqli_fetch_array($res2)){Audit_alert("套餐已下架，请联系客服","car.php");}
  $djmoney=$row2[money1];
  $fhxsnum=$row2[fhxs];
  if(!empty($row2[fhxs])){$kcnum=$row2[kcnum];}
  if($row2[admin]==2){$tcv=$row2[tit]." ".$row2[tit2];}else{$tcv=$row2[tit];}
 }

 if($kcnum<$num){Audit_alert("库存不够了","car.php");}

 if(!empty($row1[ifuserdj])){
  $sqlu2="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resu2=mysqli_query($conn,$sqlu2);$rowu2=mysqli_fetch_array($resu2);
  if(!empty($rowu2[userdj])){$s=" and name1='".$rowu2[userdj]."'";$djname=$rowu2[userdj];}else{$s="";$djname="";}
  $sqlu4="select * from yjcode_prouserdj where probh='".$row[probh]."' and djname='".$djname."'";mysqli_set_charset($conn,"utf8");$resu4=mysqli_query($conn,$sqlu4);
  if($rowu4=mysqli_fetch_array($resu4)){
  $djmoney=$djmoney*($rowu4[zhi]/10);
  }else{
   $sqlu3="select * from yjcode_userdj where zt=0".$s." order by xh asc limit 1";mysqli_set_charset($conn,"utf8");$resu3=mysqli_query($conn,$sqlu3);
   if($rowu3=mysqli_fetch_array($resu3)){
   $djmoney=$djmoney*($rowu3[zhekou]/10);
   } 
  }
 }

 $needmoney=$needmoney+$djmoney*$num;
 if(!empty($row[yunfei])){$needmoney=$needmoney+$row[yunfei];}
 $shdz="";
 if(!empty($row[shdzid]) && ($fhxsnum==5 || ($fhxsnum==0 && $profhxs==5))){
  $sqlu1="select * from yjcode_shdz where id=".$row[shdzid];mysqli_set_charset($conn,"utf8");$resu1=mysqli_query($conn,$sqlu1);
  if($rowu1=mysqli_fetch_array($resu1)){
  $shdz=$rowu1[lxr]."(".$rowu1[mot].") ".$rowu1[add1v].$rowu1[add2v].$rowu1[add3v].$rowu1[addr]." 邮编:".$rowu1[yb];
  }
 }

 updatetable("yjcode_car","num=".$num.",tcv='".$tcv."',money1=".$djmoney.",fhxs=".$fhxsnum.",shdz='".$shdz."' where id=".$id);
 
 }
}

$usermoney=$rowuser[money1];

$usermoney=sprintf("%.2f",$usermoney);

$sxf=0;
if(!empty($rowcontrol[paysxf]) && $needmoney>$usermoney){
$sxf=str_replace("0.00",0,sprintf("%.2f",($needmoney-$usermoney)*$rowcontrol[paysxf]));
}
$needmoney=$needmoney+$sxf;

?>