<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$orderbh=$_GET[orderbh];
$sj=date("Y-m-d H:i:s");
while0("*","yjcode_serverorder where orderbh='".$orderbh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("serverorderlist.php");}
$tp=returntp("bh='".$row[probh]."' order by iffm desc","-1");

//函数开始
if($_GET[control]=="update" && sqlzhuru($_POST[jvs])=="order"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0401,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if($row[ddzt]!=10){Audit_alert("服务订单状态错误，返回列表重试","serverorderlist.php");}
 $sj=date("Y-m-d H:i:s");
 //同意B
 if(sqlzhuru($_POST[R1])=="yes"){
  $tkjg="管理员介入，退款纠纷判定买方胜诉。";
  PointUpdateM($row[userid],$row[money3]);
  PointIntoM($row[userid],$tkjg."服务订单编号：".$orderbh,$row[money3]);
  intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",3,'".$tkjg."','".$sj."'");
  updatetable("yjcode_serverorder","ddzt=12 where id=".$row[id]);
 }
 //同意E
 //不同意B
 if(sqlzhuru($_POST[R1])=="no"){
  $tkjg="管理员介入，退款纠纷判定商家胜诉";
  $sellblm=$rowcontrol[serversellbl]*$row[money3]; //卖家可得金额
  $ptyj=$row[money3]-$sellblm;
  PointUpdateM($row[selluserid],sprintf("%.2f",$sellblm));
  PointIntoM($row[selluserid],$tkjg."。已自动扣除平台佣金".$ptyj."元，服务订单编号".$orderbh,sprintf("%.2f",$sellblm));
  intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",3,'".$tkjg."','".$sj."'");
  updatetable("yjcode_serverorder","ddzt=11 where orderbh='".$orderbh."'");
 }
 //不同意E
 php_toheader("serverorderview.php?t=suc&orderbh=".$orderbh); 
 
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
f1.action="serverorderview.php?orderbh=<?=$orderbh?>&control=update";
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
 <a class="a1" href="serverorderlist.php">订单信息</a>
 </div>

 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","serverorderview.php?orderbh=".$orderbh);}?>
 <div class="rights">
 <strong>提示：</strong><br>
 <span class="red">只有当买卖双方在退款这一环节无法达成共识时，管理员才可介入订单调整，且只能调整一次，请根据实际情况慎重操作</span>
 </div>

 <div class="rkuang">
 <ul class="rcap"><li class="l1"></li><li class="l2">服务订单信息</li><li class="l3"></li></ul>
 <ul class="uk">
 <li class="l1">订单状态：</li>
 <li class="l21"><strong><?=returnserverorderzt($row[ddzt])?></strong></li>
 <li class="l1">订单金额：</li>
 <li class="l21 feng"><strong><?=$row[money3]?>元</strong> (单价<?=$row[money1]?>元 * <?=$row[num]?>件，含附加费<?=$row[money2]?>元)</li>
 <? if(!empty($row[taocan])){?>
 <li class="l1">选购套餐：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="60" value="<?=$row[taocan]?>" /></li>
 <? }?>
 <li class="l1">订单编号：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="30" value="<?=$row[orderbh]?>" /></li>
 <li class="l1">商品名称：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="100" value="<?=$row[tit]?>" /></li>
 <li class="l8"></li>
 <li class="l9"><img src="<?=$tp?>" onerror="this.src='../img/none60x60.gif'" width="54" height="54" /></li>
 <li class="l1">交易时间：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="20" value="<?=$row[sj]?>" /></li>
 <li class="l1">交易IP：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" size="20" value="<?=$row[uip]?>" /></li>
 </ul>
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
 <input type="hidden" name="jvs" value="order" />
 <ul class="rcap"><li class="l1"></li><li class="l2">管理员操作</li><li class="l3"></li></ul>
 <ul class="uk">
 <li class="l1">沟通记录：</li>
 <li class="l21"><a href="serverorderjf.php?orderbh=<?=$orderbh?>" class="red" target="_blank">【点击查看】</a></li>
 <? if($row[ddzt]==10){?>
 <li class="l1">退款纠纷处理：</li>
 <li class="l2">
 <label><input name="R1" type="radio" value="yes" /> <strong>买家胜诉</strong></label> 
 <label><input name="R1" type="radio" value="no" /> <strong>卖家胜诉</strong></label> 
 </li>
 <li class="l1">友情提示：</li>
 <li class="l21"><strong class="red">只能调整一次，请根据实际情况慎重操作</strong>。只有当买卖双方在退款这一环节无法达成共识时，管理员才可介入订单调整。</li>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /></li>
 <? }?>
 </ul>
 </form>
 </div>
 
</div>
</div>
<?php include("bottom.php");?>
<script type="text/javascript">
//实例化编辑器
var ue = UE.getEditor('editor');
</script>
</body>
</html>