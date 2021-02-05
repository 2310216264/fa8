<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

if($_GET[control]=="add"){
 zwzr();
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0101,")){Audit_alert("权限不够","default.php");}
 $uid=$_POST[t1];
 while1("id,uid,zt,shopzt","yjcode_user where uid='".$uid."' and zt=1 and shopzt=2");if(!$row1=mysqli_fetch_array($res1)){Audit_alert("会员不存在！","serverlx.php");}
 $userid=$row1[id];
 $bh=returnbh()."n".$userid;
 intotable("yjcode_server","bh,userid,sj,lastsj,uip,ty1id,ty2id,djl,xsnum,money1,pf1,pf2,pf3,ifxj,zt,iftj","'".$bh."',".$userid.",'".getsj()."','".getsj()."','".getuip()."',0,0,0,0,0,5,5,5,0,99,0");
 php_toheader("server.php?bh=".$bh);

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link rel="stylesheet" href="layui/css/layui.css">
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script language="javascript">
function tj(){
if(document.f1.t1.value==""){alert("请输入会员账号!");document.f1.t1.select();return false;}
layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
f1.action="serverlx.php?control=add";
}
function uidsel(){
document.f1.t1.value=document.f1.d1.value;	
}
</script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu3").className="a1";
</script>

<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0102,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
 <? $leftid=3;include("menu_product.php");?>

<div class="right">

<? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","pwd.php");}?>

<div class="bqu1">
<a class="a1" href="serverlx.php">服务编辑</a>
<a href="serverlist.php">服务列表</a>
</div>
  
<div class="rkuang">

 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="uk">
 <li class="l1">发布会员：</li>
 <li class="l2">
 <input type="text" class="inp" name="t1" size="30" />
 <select name="d1" class="inp" style="margin-left:10px;" onchange="uidsel()">
 <option value="">最近使用</option>
 <? while1("uid,nc,zt,shopzt","yjcode_user where zt=1 and shopzt=2 order by sj desc limit 5");while($row1=mysqli_fetch_array($res1)){?>
 <option value="<?=$row1[uid]?>"><?=$row1[uid]." ".$row1[nc]?></option>
 <? }?>
 </select>
 </li>
 <li class="l3"><input type="submit" value="下一步" class="btn1" /></li>
 </ul>
 </form>

</div>

</div>

</div>
<? include("bottom.php");?>
</body>
</html>