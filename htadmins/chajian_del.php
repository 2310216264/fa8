<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

//切记，这里的顺序不能调整，不能删除，只能往后面增加
$dtable=array("yjcode_propj","yjcode_moneyrecord","yjcode_order");
$dname=array("商品评价","资金记录","购买订单");

//函数开始
if($_GET[control]=="ok"){
 if(!strstr($adminqx,",0,")){Audit_alert("权限不够","default.php");}
 zwzr();
 
 for($i=0;$i<count($dtable);$i++){
  $ni=$i+1;
  $rv=sqlzhuru($_POST["R".$ni]);
  if($rv=="yes"){
   $rt1=sqlzhuru($_POST["r".$ni."t1"]);
   $rt2=sqlzhuru($_POST["r".$ni."t2"]);
   if(!empty($rt1) && !empty($rt2)){
    //删除订单关联B
	if($dtable[$i]=="yjcode_order"){
	 while1("*","yjcode_order where sj>='".$rt1."' and sj<='".$rt2."'");while($row1=mysqli_fetch_array($res1)){
	 deletetable("yjcode_propj where orderbh='".$row1[orderbh]."'");
     deletetable("yjcode_tk where orderbh='".$row1[orderbh]."'");
     deletetable("yjcode_db where orderbh='".$row1[orderbh]."'");
     deletetable("yjcode_order where orderbh='".$row1[orderbh]."'");
     deletetable("yjcode_orderlog where orderbh='".$row1[orderbh]."'");
	 }
	}
	//删除订单关联E
   deletetable($dtable[$i]." where sj>='".$rt1."' and sj<='".$rt2."'");
   }
  }
 }
 //商品评价E
 
 php_toheader("chajian_del.php?t=suc");
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
<script language="javascript" src="../js/adddate.js"></script>
<script language="javascript">
function tj(){
 c=document.getElementsByName("Cok");
 cstr="";
 for(i=0;i<c.length;i++){if(c[i].checked==true){cstr="ok";}}
 if(cstr==""){alert("请知晓风险，并勾选");return false;}
 if(!confirm("确定执行吗？")){return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="chajian_del.php?control=ok"; 
}
function ronc(x,y){
 if(y==1){document.getElementById("r"+x+"v").style.display="";}
 else if(y==0){document.getElementById("r"+x+"v").style.display="none";}
}
</script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu7").className="a1";
</script>

<div class="yjcode">
 <? $leftid=1;include("menu_chajian.php");?>

<div class="right">
 <!--B-->
 <? systs("恭喜您，操作成功!","chajian_del.php")?>

 <div class="bqu1">
 <a href="javascript:void(0);" class="a1">数据批量清除</a>
 </div> 

 <div class="rkuang">
 <form name="f1" method="post" onsubmit="return tj()">
 
 <ul class="uk">
 <li class="l1">友情提示：</li>
 <li class="l21 red">我们建议先备份好数据库及网站文件，一旦删除，将无法恢复数据（有备份的除外）</li>
 </ul>
 
 <?
 for($i=0;$i<count($dtable);$i++){
  $ni=$i+1;
 ?>
 <ul class="uk uk0">
 <li class="l1"><?=$dname[$i]?>：</li>
 <li class="l2">
 <label><input name="R<?=$ni?>" type="radio" value="yes" checked="checked" onchange="ronc(<?=$ni?>,1)" /> 删除</label>
 <label><input name="R<?=$ni?>" type="radio" value="no" onclick="ronc(<?=$ni?>,0)" /> 不删除</label>
 <div id="r<?=$ni?>v">
 <span class="fd" style="margin-left:30px;font-size:14px;">选择时间：</span>
 <input class="inp" name="r<?=$ni?>t1" readonly="readonly" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" size="20" type="text"/> 
 <span class="fd" style="margin-right:10px;font-size:14px;">到</span> 
 <input class="inp" name="r<?=$ni?>t2" readonly="readonly" onclick="SelectDate(this,'yyyy-MM-dd hh:mm:ss')" size="20" type="text"/>
 </div>
 <span class="fd" style="font-size:14px;">现有数据：<?=returncount($dtable[$i])?>条</span>
 </li>
 </ul>
 <? }?>

 <ul class="rcap"><li class="l1"></li><li class="l2">管理员操作</li><li class="l3"></li></ul>
 <ul class="uk">
 <li class="l1">风险提示：</li>
 <li class="l2">
 <label><input name="Cok" type="checkbox" value="ok" /> 清除数据后将无法恢复，请知晓</label> 
 </li>
 <li class="l3"><input type="submit" value="开始执行" class="btn1" /></li>
 </ul>
 </form>

 </div>
 <!--E-->
 
</div>

</div>

<?php include("bottom.php");?>
</body>
</html>