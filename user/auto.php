<?
$sj1=date("Y-m-d H:i:s");
$sj1c=returnsjc();
//$autoses在管理员后台有调用，千万不要在这里写死

//资金处理的文件有：auto.php、selltk.php、shouhuo.php，m/user下的selltk.php、shouhuo.php，后台的orderview.php

//申请退款未处理判断
while1("*","yjcode_order where admin=1 and ddzt='back' and ".$autoses);while($row1=mysqli_fetch_array($res1)){
 if($sj1c>$row1[tkautosj]){  //表示已经达到生效时间，自动同意退款
  if($row1[tkmoney]<=$row1[allmoney3]){
  $allmoney=$row1[tkmoney];
  PointUpdateM($row1[userid],$allmoney);
  $tkjg="卖家未在指定时间内处理退款申请，系统默认同意退款，订单：".$row1[zuorderbh];
  PointIntoM($row1[userid],$tkjg,$allmoney);
  updatetable("yjcode_order","ddzt='backsuc',tkclsj='".$sj1."' where zuorderbh='".$row1[zuorderbh]."'");
  intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$row1[zuorderbh]."',".$row1[userid].",".$row1[selluserid].",3,'".$tkjg."','".getsj()."'");
  //推荐/平台佣金B
  $v=returntjuserid($row1[userid]);
  while2("*","yjcode_order where admin=2 and zuorderbh='".$row1[zuorderbh]."' order by id asc");while($row2=mysqli_fetch_array($res2)){
   if($row2[allmoney3]>$row2[tkmoney]){
	$sjmoney=$row2[allmoney3]-$row2[tkmoney];
    PointUpdateM($row2[selluserid],$sjmoney);
    PointIntoM($row2[selluserid],"买家进行了部分的退款，剩余的划入您账号内，订单：".$row1[zuorderbh],$sjmoney);
    $ptyj=$sjmoney-returnsellbl($row2[selluserid],$row2[probh])*$sjmoney;
	if($ptyj>0){PointUpdateM($row2[selluserid],$ptyj*(-1));PointIntoM($row2[selluserid],"扣除平台佣金 ".$ptyj."元，订单：".$row1[zuorderbh],$ptyj*(-1));}
    $tjmoney=returntjmoney($row2[probh]);
    if(!empty($v) && !empty($tjmoney)){
    $tjm=$sjmoney*$tjmoney;
    $nc1=returnnc($row2[userid]);
    PointUpdateM($v,$tjm);
    PointIntoM($v,"您推荐的买家(".$nc1.")成功交易了".$sjmoney."元，您获得相应佣金",$tjm);
    }
   }
  }
  //推荐/平台佣金E
  }
 }
}

//申请处理后不同意退款 买家一直未处理，判定为交易成功
while1("*","yjcode_order where admin=1 and ddzt='backerr' and ".$autoses);while($row1=mysqli_fetch_array($res1)){
 if($sj1c>$row1[tkautosj]){  //表示已经达到生效时间，退款失败，商家交易成功
  $allmoney=$row1[allmoney3];
  $tkjg="买家未在规定时间内及时处理，判定交易自动完成，订单：".$row1[zuorderbh];
  PointUpdateM($row1[selluserid],$allmoney);
  PointIntoM($row1[selluserid],$tkjg,$allmoney);
  updatetable("yjcode_order","ddzt='suc',tkclsj='".returnsj($row1[tkautosj])."',oksj='".returnsj($row1[tkautosj])."' where zuorderbh='".$row1[zuorderbh]."'");
  intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$row1[zuorderbh]."',".$row1[userid].",".$row1[selluserid].",3,'".$tkjg."','".getsj()."'");
  //推荐/平台佣金B
  $v=returntjuserid($row1[userid]);
  while2("*","yjcode_order where admin=2 and zuorderbh='".$row1[zuorderbh]."' order by id asc");while($row2=mysqli_fetch_array($res2)){
   $ptyj=$row2[allmoney3]-returnsellbl($row2[selluserid],$row2[probh])*$row2[allmoney3];
   if($ptyj>0){PointUpdateM($row2[selluserid],$ptyj*(-1));PointIntoM($row2[selluserid],"扣除平台佣金 ".$ptyj."元，订单：".$row1[zuorderbh],$ptyj*(-1));}
   $tjmoney=returntjmoney($row2[probh]);
   if(!empty($v) && !empty($tjmoney)){
   $tjm=$row2[allmoney3]*$tjmoney;
   $nc1=returnnc($row2[userid]);
   PointUpdateM($v,$tjm);
   PointIntoM($v,"您推荐的买家(".$nc1.")成功交易了".$row2[allmoney3]."元，您获得相应佣金",$tjm);
   }
  }
  //推荐/平台佣金E
 }
}

//自动确认收货
while1("*","yjcode_order where admin=1 and ddzt='db' and ".$autoses);while($row1=mysqli_fetch_array($res1)){
 if($sj1c>$row1[dbautosj]){  //表示自动确认收货
  $allmoney=$row1[allmoney3];
  $tkjg="担保时间结束，交易成功，订单：".$row1[zuorderbh];
  PointUpdateM($row1[selluserid],$allmoney);
  PointIntoM($row1[selluserid],$tkjg,$allmoney);
  updatetable("yjcode_order","ddzt='suc',oksj='".returnsj($row1[dbautosj])."' where zuorderbh='".$row1[zuorderbh]."'");
  intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$row1[zuorderbh]."',".$row1[userid].",".$row1[selluserid].",3,'".$tkjg."','".getsj()."'");
  //推荐/平台佣金B
  $v=returntjuserid($row1[userid]);
  while2("*","yjcode_order where admin=2 and zuorderbh='".$row1[zuorderbh]."' order by id asc");while($row2=mysqli_fetch_array($res2)){
   $ptyj=$row2[allmoney3]-returnsellbl($row2[selluserid],$row2[probh])*$row2[allmoney3];
   if($ptyj>0){PointUpdateM($row2[selluserid],$ptyj*(-1));PointIntoM($row2[selluserid],"扣除平台佣金 ".$ptyj."元，订单：".$row1[zuorderbh],$ptyj*(-1));}
   $tjmoney=returntjmoney($row2[probh]);
   if(!empty($v) && !empty($tjmoney)){
   $tjm=$row2[allmoney3]*$tjmoney;
   $nc1=returnnc($row2[userid]);
   PointUpdateM($v,$tjm);
   PointIntoM($v,"您推荐的买家(".$nc1.")成功交易了".$row2[allmoney3]."元，您获得相应佣金",$tjm);
   }
  }
  //推荐/平台佣金E
 }
}
 

?>