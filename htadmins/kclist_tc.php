<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$bh=$_GET[bh];
$tcid=$_GET[tcid];
while0("*","yjcode_taocan where probh='".$bh."' and id=".$tcid);if(!$row=mysqli_fetch_array($res)){php_toheader("taocanlist.php?bh=".$bh);}
$tcname=$row[tit];
if($row[admin]==2){$tcname=$tcname." ".$row[tit2];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<link href="css/product.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.tcname{width:-moz-calc(100% - 34px);width:-webkit-calc(100% - 34px);width:calc(100% - 34px);margin:10px 10px 0 10px;background-color:#f2f2f2;border:#CCC solid 1px;padding:10px 0 10px 10px;text-align:left;}
.upage{width:-moz-calc(100% - 22px);width:-webkit-calc(100% - 22px);width:calc(100% - 22px);margin-left:10px;margin-right:10px;}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<script language="javascript">
function ser(){
location.href="kclist_tc.php?bh=<?=$bh?>&tcid=<?=$tcid?>&st1="+document.getElementById("st1").value+"&st2="+document.getElementById("st2").value+"&sd1="+document.getElementById("sd1").value;
}
</script>
</head>
<body>
<div class="tcname">套餐名称：<?=$tcname?></div>
 <ul class="psel">
 <li class="l1">使用情况：</li>
 <li class="l2">
 <select id="sd1">
 <option value="">==不限==</option>
 <option value="0"<? if(0==$_GET[sd1] && $_GET[sd1]!=""){?> selected="selected"<? }?>>未使用</option>
 <option value="1"<? if(1==$_GET[sd1]){?> selected="selected"<? }?>>已使用</option>
 </select>
 </li>
 <li class="l1">卡号：</li><li class="l2"><input value="<?=$_GET[st1]?>" type="text" id="st1" size="15" /></li>
 <li class="l1">密码：</li><li class="l2"><input value="<?=$_GET[st2]?>" type="text" id="st2" size="15" /></li>
 <li class="l3"><a href="javascript:ser()" class="a2">搜索</a></li>
 </ul>
 <ul class="ksedi">
 <li class="l2">
 <a href="javascript:checkDEL('25t','yjcode_kc')" style="margin-left:10px;" class="a1">删除</a>
 <a href="kc_tc.php?bh=<?=$bh?>&tcid=<?=$tcid?>" class="a2">新增库存</a>
 <a href="taocanlist.php?bh=<?=$bh?>" class="a2">返回套餐列表</a>
 </li>
 </ul>
 <ul class="kclistcap">
 <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l2">卡号</li>
 <li class="l3">密码</li>
 <li class="l4">使用情况</li>
 <li class="l5">交易时间</li>
 </ul>
 <?
 $ses=" where probh='".$bh."' and tcid=".$tcid;
 if($_GET[st1]!=""){$ses=$ses." and ka like '%".$_GET[st1]."%'";}
 if($_GET[st2]!=""){$ses=$ses." and mi like '%".$_GET[st2]."%'";}
 if($_GET[sd1]!=""){$ses=$ses." and ifok=".$_GET[sd1];}
 $page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}
 pagef($ses,30,"yjcode_taocan_kc","order by id asc");while($row=mysqli_fetch_array($res)){
 ?>
 <ul class="kclist">
 <li class="l1"><input name="C1" type="checkbox" value="<?=$row[id]?>" /></li>
 <li class="l2"><a href="kc_tc.php?bh=<?=$bh?>&id=<?=$row[id]?>&tcid=<?=$tcid?>&action=update"><?=$row[ka]?></a></li>
 <li class="l3"><?=$row[mi]?></li>
 <li class="l4"><? if(1==$row[ifok]){?><span class="red">已使用</span><? }else{?><span class="blue">未使用</span><? }?></li>
 <li class="l5"><?=$row[sj]?></li>
 </ul>
 <? }?>
 <?
 $nowurl="kclist_tc.php";
 $nowwd="tcid=".$tcid."&bh=".$bh."&st1=".$_GET[st1]."&st2=".$_GET[st2]."&sd1=".$_GET[sd1];
 include("page.php");
 ?>
 <!--E-->
 
</body>
</html>