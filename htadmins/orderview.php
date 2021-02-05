<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where admin=1 and zuorderbh='".$zuorderbh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("orderlist.php");}
$tp=returntp("bh='".$row[probh]."' order by iffm desc","-2");

//函数开始
if($_GET[control]=="update" && sqlzhuru($_POST[yjcode])=="order"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0401,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if($row[ddzt]!="jf"){Audit_alert("订单状态错误，返回列表重试","orderlist.php");}
 //买方胜诉B
 if(sqlzhuru($_POST[R1])=="yes"){
  $tkjg="管理员介入，退款纠纷判定买方胜诉，订单：".$row[zuorderbh];
  PointUpdateM($row[userid],$row[tkmoney]);
  PointIntoM($row[userid],$tkjg,$row[tkmoney]);
  //推荐/平台佣金B
  $v=returntjuserid($row[userid]);
  while2("*","yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc");while($row2=mysqli_fetch_array($res2)){
   if($row2[allmoney3]>$row2[tkmoney]){
	$sjmoney=$row2[allmoney3]-$row2[tkmoney];
    PointUpdateM($row2[selluserid],$sjmoney);
    PointIntoM($row2[selluserid],"买家进行了部分的退款，剩余的划入您账号内，订单：".$row[zuorderbh],$sjmoney);
    $ptyj=$sjmoney-returnsellbl($row2[selluserid],$row2[probh])*$sjmoney;
	if($ptyj>0){PointUpdateM($row2[selluserid],$ptyj*(-1));PointIntoM($row2[selluserid],"扣除平台佣金 ".$ptyj."元，订单：".$row[zuorderbh],$ptyj*(-1));}
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
  intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$zuorderbh."',".$row[userid].",".$row[selluserid].",3,'".$tkjg."','".$sj."'");
  updatetable("yjcode_order","ddzt='jfbuy' where zuorderbh='".$zuorderbh."'");
 }
 //买方胜诉E
 //商家胜诉B
 if(sqlzhuru($_POST[R1])=="no"){

  $allmoney=$row[allmoney3];
  $tkjg="管理员介入，退款纠纷判定商家胜诉，订单：".$row[zuorderbh];
  PointUpdateM($row[selluserid],$allmoney);
  PointIntoM($row[selluserid],$tkjg,$allmoney);
  updatetable("yjcode_order","ddzt='jfsell' where zuorderbh='".$row[zuorderbh]."'");
  intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$row[zuorderbh]."',".$row[userid].",".$row[selluserid].",3,'".$tkjg."','".getsj()."'");
  //推荐/平台佣金B
  $v=returntjuserid($row[userid]);
  while2("*","yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc");while($row2=mysqli_fetch_array($res2)){
   $ptyj=$row2[allmoney3]-returnsellbl($row2[selluserid],$row2[probh])*$row2[allmoney3];
   if($ptyj>0){PointUpdateM($row2[selluserid],$ptyj*(-1));PointIntoM($row2[selluserid],"扣除平台佣金 ".$ptyj."元，订单：".$row[zuorderbh],$ptyj*(-1));}
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
 //商家胜诉E
 php_toheader("orderview.php?t=suc&orderbh=".$orderbh); 
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>

<script type="text/javascript" charset="utf-8" src="../config/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../config/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="../config/ueditor/lang/zh-cn/zh-cn.js"></script>

<script language="javascript">
function tj(){
r=document.getElementsByName("R1");rr="";for(i=0;i<r.length;i++){if(r[i].checked==true){rr=r[i].value;}}if(rr==""){alert("请选择纠纷处理！");return false;}
if(!confirm("确定要提交该操作吗？")){return false;}
layer.msg('正在验证', {icon: 16  ,time: 0,shade :0.25});
f1.action="orderview.php?zuorderbh=<?=$zuorderbh?>&control=update";
}
</script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu6").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0402,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
 <? $leftid=1;include("menu_order.php");?>

<div class="right">
 <div class="bqu1">
 <a class="a1" href="orderlist.php">订单信息</a>
 </div>

 <!--B-->
 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","orderview.php?zuorderbh=".$zuorderbh);}?>
 <div class="rights">
 <strong>提示：</strong><br>
 <span class="red">只有当买卖双方在退款这一环节无法达成共识时，管理员才可介入订单调整，且只能调整一次，请根据实际情况慎重操作</span>
 </div>

 <div class="rkuang">
 <ul class="rcap"><li class="l1"></li><li class="l2">订单信息</li><li class="l3"></li></ul>
 <ul class="uk">
 <li class="l1">订单编号：</li>
 <li class="l21"><?=$zuorderbh?></li>
 <li class="l1">订单状态：</li>
 <li class="l21"><strong><?=returnorderzt($row[ddzt])?></strong></li>
 <li class="l1">订单实付款：</li>
 <li class="l21 feng"><strong><?=$row[allmoney3]?>元</strong></li>
 <? if($row[ddzt]=="back" || $row[ddzt]=="backsuc" || $row[ddzt]=="backerr" || $row[ddzt]=="jfbuy" || $row[ddzt]=="jfsell" || $row[ddzt]=="jf"){?>
 <li class="l1">申请退款金额：</li>
 <li class="l21"><strong><?=$row[tkmoney]?>元</strong></li>
 <? }?>
 <li class="l1">下单时间：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="20" value="<?=$row[sj]?>" /></li>
 <li class="l1">下单IP：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="20" value="<?=$row[uip]?>" /></li>
 </ul>

 <?
 $lii=1;
 $sqlli="select * from yjcode_order where admin=2 and zuorderbh='".$row[zuorderbh]."' order by id asc";
 mysqli_set_charset($conn,"utf8");$resli=mysqli_query($conn,$sqlli);while($rowli=mysqli_fetch_array($resli)){
 $tp=returntp("bh='".$rowli[probh]."' order by iffm desc","-2");
 ?>
 <ul class="rcap"><li class="l1"></li><li class="l2">第<?=$lii?>件商品</li><li class="l3"></li></ul>
 <ul class="uk">
 <li class="l1">商品标题：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="100" value="<?=$rowli[tit]?>" /></li>
 <li class="l8"></li>
 <li class="l9"><a href="../product/view<?=returnproid($rowli[probh])?>.html" target="_blank"><img src="<?=$tp?>" onerror="this.src='../img/none60x60.gif'" width="54" height="54" /></a></li>
 <? if(!empty($rowli[tcv])){?>
 <li class="l1">购买套餐：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="100" value="<?=$rowli[tcv]?>" /></li>
 <? }?>
 <li class="l1">商品单价：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="20" value="<?=$rowli[money1]?>元" /></li>
 <li class="l1">购买件数：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="20" value="<?=$rowli[num]?>件" /></li>
 </ul>
 <? $lii++;}?>
 
 <ul class="rcap"><li class="l1"></li><li class="l2">买卖双方</li><li class="l3"></li></ul>
 <ul class="uk">
 <? while1("*","yjcode_user where id=".$row[userid]);$row1=mysqli_fetch_array($res1);?>
 <li class="l1">买家信息：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="100" value="帐号:<?=$row1[uid]?> 昵称:<?=$row1[nc]?> 手机:<?=$row1[mot]?> QQ:<?=$row1[uqq]?>" /></li>
 <? while1("*","yjcode_user where id=".$row[selluserid]);$row1=mysqli_fetch_array($res1);?>
 <li class="l1">卖家信息：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="100" value="帐号:<?=$row1[uid]?> 昵称:<?=$row1[nc]?> 手机:<?=$row1[mot]?> QQ:<?=$row1[uqq]?>" /></li>
 </ul>
 
 <form name="f1" method="post" onsubmit="return tj()">
 <input type="hidden" name="yjcode" value="order" />
 <ul class="rcap"><li class="l1"></li><li class="l2">管理员操作</li><li class="l3"></li></ul>
 <ul class="uk">
 <li class="l1">沟通记录：</li>
 <li class="l21"><a href="orderjf.php?zuorderbh=<?=$zuorderbh?>" class="red" target="_blank">【点击查看】</a></li>
 <? if($row[ddzt]=="jf"){?>
 <li class="l1">退款纠纷处理：</li>
 <li class="l2">
 <label><input name="R1" type="radio" value="yes" /> <strong>买家胜诉</strong></label> 
 <label><input name="R1" type="radio" value="no" /> <strong>卖家胜诉</strong></label> 
 </li>
 <li class="l1">友情提示：</li>
 <li class="l21">只有当买卖双方在退款这一环节无法达成共识时，管理员才可介入订单调整，且<strong class="red">只能调整一次，请根据实际情况慎重操作</strong>。</li>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /></li>
 <? }?>
 </ul>
 </form>
 </div>

 <!--E-->
 
</div>
</div>
<?php include("bottom.php");?>
<script type="text/javascript">
//实例化编辑器
var ue = UE.getEditor('editor');
</script>
</body>
</html>