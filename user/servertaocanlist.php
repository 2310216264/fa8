<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$bh=$_GET[bh];
while0("*","yjcode_server where bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){Audit_alert("来源出错","serverlist.php","parent.");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<style type="text/css">
body{background-color:#fff;}
.ksedi{float:left;margin:10px 10px 0 10px;width:880px;}
.ksedi .d1{float:left;}
.ksedi .d1 a{float:left;padding:5px 20px 0 20px;height:22px;border-radius:5px;margin:0 20px 0 0;}
.ksedi .d1 a:hover{text-decoration:none;}
.ksedi .d1 .a1{color:#fff;background-color:#FE5241;}
.ksedi .d1 .a2{color:#fff;background-color:#535353;}
.tccap{float:left;border:#E1E1E2 solid 1px;width:880px;margin:10px 0 0 10px;height:40px;text-align:center;background-color:#F5F5F5;}
.tccap li{float:left;border-right:#e1e1e2 solid 1px;padding:12px 0 0 0;height:28px;}
.tccap .l0{width:30px;padding-top:13px;height:27px;}
.tccap .l1{width:342px;text-align:left;padding-left:10px;}
.tccap .l2{width:102px;}
.tccap .l4{width:148px;}
.tccap .l5{width:152px;}
.tccap .l6{width:90px;border-right:0;}
.tclist{float:left;border:#E1E1E2 solid 1px;width:880px;margin:0 0 0 10px;height:32px;border-top:0;text-align:center;}
.tclist li{float:left;border-right:#e1e1e2 solid 1px;padding:8px 0 0 0;height:24px;}
.tclist .l0{width:30px;}
.tclist .l1{width:342px;text-align:left;padding-left:10px;}
.tclist .l2{width:102px;}
.tclist .l4{width:148px;}
.tclist .l5{width:152px;color:#ff6600;}
.tclist .l6{width:90px;border-right:0;padding:6px 0 0 0;height:26px;}
.tclist .l6 .s1{float:left;width:59px;border:#E6E6E6 solid 1px;padding:1px 0 0 9px;height:18px;margin:0 0 0 10px;text-align:left;background:url(img/jian.gif) no-repeat;background-position:55px 8px;background-color:#fff;}
.tclist .l6 .gl{float:left;width:68px;border:#e6e6e6 solid 1px;border-top:0;margin:0 0 0 10px;position:relative;background-color:#fff;}
.tclist .l6 .gl a{float:left;width:68px;padding:3px 0 0 0;height:18px;}
.tclist .l6 .gl a:hover{text-decoration:none;background-color:#f2f2f2;}
.tclist:hover{background-color:#f9f9f9;}
.tclist1{background-color:#f9f9f9;}
</style>
<script language="javascript">
function glover(x){
 document.getElementById("gl"+x).style.display="";
}
function glout(x){
 document.getElementById("gl"+x).style.display="none";
}
</script>
</head>
<body>
 
 <div class="ksedi">
  <div class="d1">
  <a href="servertaocan1lx.php?bh=<?=$bh?>" class="a1">新增套餐</a>
  <a href="javascript:NcheckDEL('9a','yjcode_servertaocan')" class="a2">删除</a>
  </div>
 </div>

 <ul class="tccap">
 <li class="l0"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l1">套餐说明</li>
 <li class="l2">序号</li>
 <li class="l4">原价</li>
 <li class="l5">优惠价</li>
 <li class="l6">操作</li>
 </ul>
 <?
 while1("*","yjcode_servertaocan where serverbh='".$bh."' and userid=".$row[userid]." and zt=0 and admin=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){
 $nu="servertaocan1.php?id=".$row1[id]."&bh=".$bh;
 ?>
 <ul class="tclist tclist1">
 <li class="l0"><input name="C1" type="checkbox" value="<?=$row1[id]?>xcf0" /></li>
 <li class="l1"><a href="<?=$nu?>"><strong><?=$row1[tit1]?></strong></a></li>
 <li class="l2"><?=$row1[xh]?></li>
 <li class="l4"><?=$row1[money2]?></li>
 <li class="l5"><?=$row1[money1]?></li>
 <li class="l6" onmouseover="glover(<?=$row1[id]?>)" onmouseout="glout(<?=$row1[id]?>)">
  <span class="s1">管理</span>
  <div class="gl" style="display:none;" id="gl<?=$row1[id]?>">
  <a href="<?=$nu?>">编辑信息</a>
  <a href="servertaocan2lx.php?ty1id=<?=$row1[id]?>&bh=<?=$bh?>">添加二级</a>
  </div>
 </li>
 </ul>
 <?
 while2("*","yjcode_servertaocan where admin=2 and tit1='".$row1[tit1]."' and zt=0 and userid=".$row[userid]." and serverbh='".$bh."' order by xh asc");while($row2=mysqli_fetch_array($res2)){
 $nu="servertaocan2.php?id=".$row2[id]."&ty1id=".$row1[id]."&bh=".$bh; 
 ?>
 <ul class="tclist">
 <li class="l0"><input name="C1" type="checkbox" value="xcf<?=$row2[id]?>" /></li>
 <li class="l1">&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=$nu?>"><?=$row2[tit2]?></a></li>
 <li class="l2"><?=$row2[xh]?></li>
 <li class="l4"><?=$row2[money2]?></li>
 <li class="l5"><?=$row2[money1]?></li>
 <li class="l6" onmouseover="glover(<?=$row2[id]?>)" onmouseout="glout(<?=$row2[id]?>)">
  <span class="s1">管理</span>
  <div class="gl" style="display:none;" id="gl<?=$row2[id]?>">
  <a href="<?=$nu?>">编辑信息</a>
  </div>
 </li>
 </ul>
 <? }}?>

</body>
</html>