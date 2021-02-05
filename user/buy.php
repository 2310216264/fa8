<?
 global $rowcontrol;
 $sj=getsj();
 $sjchuo=strtotime($sj);
 $uip=getuip();
 $gloorderbh=returnbh()."-".rnd_num(10000); //一轮付款只有一个
 //开始执行购买
 $carid=preg_split("/xcf/",$caridarr);
 for($i=0;$i<=count($carid);$i++){
 if($carid[$i]!=""){
  $sqlc="select * from yjcode_car where id=".$carid[$i];mysqli_set_charset($conn,"utf8");$resc=mysqli_query($conn,$sqlc);if($rowc=mysqli_fetch_array($resc)){
  $userid=$rowc[userid];
  $sql="select * from yjcode_pro where bh='".$rowc[probh]."' and zt=0 and ifxj=0";mysqli_set_charset($conn,"utf8");$res=mysqli_query($conn,$sql);
  if($row=mysqli_fetch_array($res)){
  /////////////////////////////////开始逐一购买
  $orderbh=time().$i.rnd_num(100); //每一笔独立的订单编号
  $txt="";
  $allmoney=$rowc[money1]*$rowc[num];
  if(!empty($rowc[yunfei])){$allmoney=$allmoney+$rowc[yunfei];}
  $sqlu="select id,money1 from yjcode_user where id=".$rowc[userid];mysqli_set_charset($conn,"utf8");$resu=mysqli_query($conn,$sqlu);if(!$rowu=mysqli_fetch_array($resu)){exit;}
  
  $usermoney=sprintf("%.2f",$rowu[money1]);
  $allmoney=sprintf("%.2f",$allmoney);
  if($usermoney<$allmoney){exit;}
  $fhxs=$row[fhxs];
  
  //开始计算套餐库存B，这个判断必须要最高优先
  if( (empty($rowc[tcid]) && 4==$row[fhxs]) ||  (!empty($rowc[tcid]) && empty($rowc[fhxs]) && 4==$row[fhxs]) ){
	$fhxs=4;
	$sqla="select * from yjcode_kc where probh='".$row[bh]."' and ifok=0 and userid=".$row[userid]." order by id asc limit ".$rowc[num];
	mysqli_set_charset($conn,"utf8");$resa=mysqli_query($conn,$sqla);while($rowa=mysqli_fetch_array($resa)){
	$txt=$txt."卡号：".$rowa[ka]." 密码：".$rowa[mi]."<br>";
    updatetable("yjcode_kc","ifok=1,sj='".$sj."',uip='".$uip."',userid1=".$rowc[userid]." where id=".$rowa[id]);
	} 
  
  }
  
  if( !empty($rowc[tcid]) && 4==$rowc[fhxs] ){
    
	$fhxs=4;
	$sqla="select * from yjcode_taocan_kc where probh='".$row[bh]."' and tcid=".$rowc[tcid]." and ifok=0 and userid=".$row[userid]." order by id asc limit ".$rowc[num];
	mysqli_set_charset($conn,"utf8");$resa=mysqli_query($conn,$sqla);while($rowa=mysqli_fetch_array($resa)){
	$txt=$txt."卡号：".$rowa[ka]." 密码：".$rowa[mi]."<br>";
    updatetable("yjcode_taocan_kc","ifok=1,sj='".$sj."',uip='".$uip."',userid1=".$rowc[userid]." where id=".$rowa[id]);
	} 
  
  }
  //结束计算套餐库存E


  $nt="";
  $sqlg="select * from yjcode_order where admin=1 and gloorderbh='".$gloorderbh."' and selluserid=".$row[userid]." and fhxs=".$fhxs."";
  mysqli_set_charset($conn,"utf8");$resg=mysqli_query($conn,$sqlg);if(!$rowg=mysqli_fetch_array($resg)){
   $zuorderbh=returnbh()."zu".$i;
   $nt=sqlzhuru($row[tit]);
   intotable("yjcode_order","selluserid,userid,admin,gloorderbh,zuorderbh,allmoney1,allmoney2,allmoney3,sj,uip,ddzt,fhxs,ifpj","".$row[userid].",".$rowc[userid].",1,'".$gloorderbh."','".$zuorderbh."',".$allmoney.",0,".$allmoney.",'".$sj."','".$uip."','wait',".$fhxs.",0");
  }else{
   $zuorderbh=$rowg[zuorderbh];
   $nt=$rowg["tit"]." ".sqlzhuru($row[tit]);
   updatetable("yjcode_order","allmoney1=allmoney1+".$allmoney.",allmoney3=allmoney3+".$allmoney." where id=".$rowg[id]);
  }
  updatetable("yjcode_order","tit='".$nt."' where zuorderbh='".$zuorderbh."' and admin=1");
  
  $yunfei=$rowc[yunfei];
  $shdz=$rowc[shdz];
  if(!empty($yunfei)){updatetable("yjcode_order","yunfei=".$yunfei." where zuorderbh='".$zuorderbh."'");}
  if(!empty($shdz)){updatetable("yjcode_order","shdz='".$shdz."' where gloorderbh='".$gloorderbh."'");}
  
  intotable("yjcode_order","selluserid,userid,admin,gloorderbh,zuorderbh,allmoney1,allmoney2,allmoney3,sj,uip,ddzt,orderbh,probh,money1,num,tit,txt,tcid,tcv,buyform,liuyan,fhxs,ifpj","".$row[userid].",".$rowc[userid].",2,'".$gloorderbh."','".$zuorderbh."',".$allmoney.",0,".$allmoney.",'".$sj."','".$uip."','wait','".$orderbh."','".$row[bh]."',".$rowc[money1].",".$rowc[num].",'".sqlzhuru($row[tit])."','".$txt."',".$rowc[tcid].",'".$rowc[tcv]."','".$rowc[buyform]."','".$rowc[bz]."',".$fhxs.",0");
  PointUpdateM($rowc[userid],$allmoney*(-1));
  PointIntoM($rowc[userid],"购买商品,数量".$rowc[num],$allmoney*(-1));
  $kc=$row[kcnum]-$rowc[num];
  updatetable("yjcode_pro","xsnum=xsnum+".$rowc[num].",lastsj='".$sj."',kcnum=".$kc." where id=".$row[id]);
  
  if($fhxs==2 || $fhxs==3 || $fhxs==4){
   $dbsj=$rowcontrol[dbsj];
   $dboksj=date("Y-m-d H:i:s",strtotime("+".$dbsj." day"));
   updatetable("yjcode_order","fhsj='".$sj."',ddzt='db',dbautosj=".strtotime($dboksj)." where ddzt='wait' and zuorderbh='".$zuorderbh."'");
  }
  
  //写入邮件B
  $sqlm="select id,email,ifemail,ordertx2 from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$resm=mysqli_query($conn,$sqlm);if(!$rowm=mysqli_fetch_array($resm)){exit;}
  if(1==$rowm[ifemail] && !empty($rowm[email]) && empty($rowm[ordertx2])){
   $t="亲，有新订单啦！请尽快登录网站发货，".weburl;
   $sqls="select * from yjcode_smsmail where admin=1 and tyid=1 and fa='".$rowm[email]."' and userid=".$rowu[id]."";mysqli_set_charset($conn,"utf8");$ress=mysqli_query($conn,$sqls);
   if(!$rows=mysqli_fetch_array($ress)){
   intotable("yjcode_smsmail","admin,fa,tyid,userid,selluserid,txt,tit","1,'".$rowm[email]."',1,".$rowu[id].",".$rowm[id].",'".$t."','您的订单信息'");
   }
  }
  //写入邮件E
  
  //写入短信B
  $sqlm="select id,mot,ifmot,ordertx1 from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$resm=mysqli_query($conn,$sqlm);if(!$rowm=mysqli_fetch_array($resm)){exit;}
  if(1==$rowm[ifmot] && !empty($rowm[mot]) && empty($rowm[ordertx1])){
   $t="亲，有新订单啦！请尽快登录网站发货，购买商品为：\${tit}";
   $sqls="select * from yjcode_smsmail where admin=2 and tyid=1 and fa='".$rowm[mot]."' and userid=".$rowu[id]."";mysqli_set_charset($conn,"utf8");$ress=mysqli_query($conn,$sqls);
   if(!$rows=mysqli_fetch_array($ress)){
   $dt=sprintf("%.2f",$allmoney);
   intotable("yjcode_smsmail","admin,fa,tyid,userid,selluserid,txt,tit","2,'".$rowm[mot]."',1,".$rowu[id].",".$rowm[id].",'".$t."','".$dt."'");
   }
  }
  //写入短信E
  
  deletetable("yjcode_car where id=".$rowc[id]);
  //////////////////////////////////结束逐一购买
  }
 }	 
 }
 }
 //结束执行购买
 updatetable("yjcode_car","ifxj=0 where userid=".intval($userid));
?>