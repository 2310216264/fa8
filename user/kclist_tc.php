<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$bh=$_GET[bh];
$tcid=$_GET[tcid];
$_SESSION["tzURL"]=weburl."user/kclist_tc.php?tcid=".$tcid."&bh=".$bh;
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."' and zfmm='".$_SESSION[SAFEPWD]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){Audit_alert("卡密信息操作需要先进行安全码验证!","safepwd.php");}
$userid=$rowuser[id];

while0("*","yjcode_taocan where probh='".$bh."' and userid=".$userid." and id=".$tcid);if(!$row=mysqli_fetch_array($res)){php_toheader("taocanlist.php?bh=".$bh);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.userright .rproglo{margin-top:0;}
.userright .onets{margin-top:0;}
</style>
<script language="javascript">
function ser(){
location.href="kclist_tc.php?bh=<?=$bh?>&tcid=<?=$tcid?>&st1="+document.getElementById("st1").value+"&sd1="+document.getElementById("sd1").value;
}
function glover(x){
 document.getElementById("gl"+x).style.display="";
}
function glout(x){
 document.getElementById("gl"+x).style.display="none";
}
function del(x){
document.getElementById("chk"+x).checked=true;
NcheckDEL('5t','yjcode_kc');
}
</script>
</head>
<body>
<!--RB-->
<div class="userright">
 
 <? include("protop.php");?>

 <!--白B-->
 <div class="rkuang">
 
 <div class="onets">对应套餐：<? if(empty($row[admin])){echo $row[tit];}else{echo $row[tit2];}?></div>
 <div class="onets">
 库存统计：
 已使用（<strong class="red"><?=returncount("yjcode_taocan_kc where userid=".$userid." and probh='".$bh."' and ifok=1 and tcid=".$tcid)?></strong>）&nbsp;&nbsp;&nbsp;&nbsp;
 未使用（<strong class="blue"><?=returncount("yjcode_taocan_kc where userid=".$userid." and probh='".$bh."' and ifok=0 and tcid=".$tcid)?></strong>）
 </div>

 <div class="ksedi uk0">
 <div class="d1">
 <a href="javascript:NcheckDEL('5t','yjcode_kc')" class="a1">删除</a>
 <a href="kc_tc.php?bh=<?=$bh?>&tcid=<?=$tcid?>" class="a2">添加信息</a>
 <a href="taocanlist.php?bh=<?=$bh?>" class="a2">返回套餐列表</a>
 </div>
 <div class="d2">
  <input type="button" onclick="ser()" value="查询" class="btn" />
  <select id="sd1">
  <option value="">全部</option>
  <option value="0"<? if($_GET[sd1]=="0"){?> selected="selected"<? }?>>未使用</option>
  <option value="1"<? if($_GET[sd1]=="1"){?> selected="selected"<? }?>>已使用</option>
  </select>
  <span class="s1">使用情况：</span>
  <input type="text" id="st1" value="<?=$_GET[st1]?>" class="inp1" />
  <span class="s1">关键词：</span>
 </div>
 </div>

 <ul class="kamikccap">
 <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l2">排序</li>
 <li class="l3">卡号</li>
 <li class="l4">密码</li>
 <li class="l5">使用状况</li>
 <li class="l6">使用会员</li>
 <li class="l7">使用时间</li>
 <li class="l8">编辑</li>
 </ul>

 <?
 $ses=" where userid=".$userid." and probh='".$bh."' and tcid=".$tcid;
 if($_GET[st1]!=""){$ses=$ses." and ka like '%".$_GET[st1]."%'";}
 if($_GET[st2]!=""){$ses=$ses." and mi like '%".$_GET[st2]."%'";}
 if($_GET[sd1]!=""){$ses=$ses." and ifok=".$_GET[sd1];}
 $page=$_GET["page"];if($page==""){$page=1;}else{$page=intval($_GET["page"]);}
 pagef($ses,30,"yjcode_taocan_kc","order by id asc");while($row=mysqli_fetch_array($res)){
 $au="kc_tc.php?bh=".$bh."&id=".$row[id]."&tcid=".$tcid."&action=update";
 ?>
 <ul class="kamikclist">
 <li class="l1"><input name="C1" type="checkbox" id="chk<?=$row[id]?>" value="<?=$row[id]?>" /></li>
 <li class="l2"><?=$row[id]?></li>
 <li class="l3"><a href="<?=$au?>"><?=returntitdian($row[ka],35)?></a></li>
 <li class="l4"><?=returntitdian($row[mi],35)?></li>
 <li class="l5"><? if(1==$row[ifok]){?><span class="red">已使用</span><? }else{?><span class="blue">未使用</span><? }?></li>
 <li class="l6"><?=returnuser($row[userid1])?></li>
 <li class="l7"><?=$row[sj]?></li>
 <li class="l8" onmouseover="glover(<?=$row[id]?>)" onmouseout="glout(<?=$row[id]?>)">
  <span class="s1">管理</span>
  <div class="gl" style="display:none;" id="gl<?=$row[id]?>">
  <a href="<?=$au?>">编辑信息</a>
  <a href="javascript:;" onclick="del(<?=$row[id]?>)">删除卡密</a>
  </div>
 </li>
 </ul>
 <? }?>
 <div class="npa">
 <?
 $nowurl="kclist_tc.php";
 $nowwd="tcid=".$tcid."&bh=".$bh."&st1=".$_GET[st1]."&st2=".$_GET[st2]."&sd1=".$_GET[sd1];
 require("page.php");
 ?>
 </div>

 <div class="clear clear15"></div>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->
</body>
</html>