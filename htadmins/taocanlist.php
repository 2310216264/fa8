<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$bh=$_GET[bh];
while0("*","yjcode_pro where bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("productlist.php");}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理后台</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
<style type="text/css">
/*视频*/
.tccap{float:left;border:#CACACA solid 1px;border-left:0;margin:7px 10px 0 10px;height:38px;width:880px;background-color:#E8E8E8;font-weight:700;}
.tccap li{float:left;padding-top:10px;border-left:#CACACA solid 1px;height:28px;}
.tccap .l1{width:27px;height:26px;text-align:left;padding:12px 0 0 8px;}
.tccap .l1 input{float:left;width:16px;height:16px;}
.tccap .l2{width:288px;text-align:left;padding-left:10px;}
.tccap .l3{width:60px;}
.tccap .l7{width:100px;}
.tccap .l4{width:80px;}
.tccap .l5{width:100px;}
.tccap .l6{width:200px;}
.tclist{float:left;border:#CACACA solid 1px;border-left:0;margin:0 10px;border-top:0;height:37px;width:880px;background-color:#F4F4F4;}
.tclist li{float:left;padding-top:10px;border-left:#CACACA solid 1px;height:27px;}
.tclist .l1{width:27px;height:25px;text-align:left;padding:12px 0 0 8px;background-color:#F1F1F1;}
.tclist .l1 input{float:left;width:16px;height:16px;}
.tclist .l2{width:288px;text-align:left;padding-left:10px;}
.tclist .l3{width:60px;}
.tclist .l7{width:100px;}
.tclist .l4{width:80px;}
.tclist .l5{width:100px;}
.tclist .l6{width:200px;color:#999;text-align:center;}
.tclist .l6 a{color:#333;}
.tclist .l6 a:hover{color:#ff6600;text-decoration:underline;}
.tclist:hover{background:rgba(235,235,235,1);-webkit-transition:background-color 0.3s linear;-moz-transition:background-color 0.3s linear;-o-transition:background-color 0.3s linear;transition:background-color 0.3s linear;}
.tclist1{background-color:#fff;}
.tclist1:hover{background:rgba(249,249,249,1);}
.upage{width:-moz-calc(100% - 22px);width:-webkit-calc(100% - 22px);width:calc(100% - 22px);margin:0 10px;}
</style>
</head>
<body>

 <!--begin-->
 <ul class="ksedi">
 <li class="l2">
 <a href="taocanlx.php?bh=<?=$bh?>" style="margin-left:10px;" class="a1">新增套餐</a>
 <a href="javascript:checkDEL(33,'yjcode_taocan')" class="a2">删除</a>
 </li>
 </ul>
 <ul class="tccap">
 <li class="l1"><input name="C2" type="checkbox" onclick="xuan()" /></li>
 <li class="l2">套餐说明</li>
 <li class="l3">序号</li>
 <li class="l7">库存</li>
 <li class="l4">原价</li>
 <li class="l5">优惠价</li>
 <li class="l6">操作</li>
 </ul>
 <?
 while1("*","yjcode_taocan where probh='".$bh."' and zt=0 and admin is null order by xh asc");while($row1=mysqli_fetch_array($res1)){
 $nu="taocan.php?id=".$row1[id]."&bh=".$bh;
 ?>
 <ul class="tclist">
 <li class="l1"><input name="C1" type="checkbox" value="<?=$row1[id]?>xcf0" /></li>
 <li class="l2"><a href="<?=$nu?>"><strong><?=$row1[tit]?></strong></a></li>
 <li class="l3"><?=$row1[xh]?></li>
 <li class="l7"><?=$row1[kcnum]?></li>
 <li class="l4"><?=$row1[money2]?></li>
 <li class="l5"><?=$row1[money1]?></li>
 <li class="l6">
 <? if(4==$row1[fhxs]){?><a href="kclist_tc.php?tcid=<?=$row1[id]?>&bh=<?=$bh?>">库存</a>&nbsp;&nbsp;|&nbsp;&nbsp;<? }?>
 <a href="taocan1lx.php?ty1id=<?=$row1[id]?>&bh=<?=$bh?>">添加二级套餐</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?=$nu?>">编辑</a>
 </li>
 </ul>
 <?
 while2("*","yjcode_taocan where admin=2 and zt=0 and tit='".$row1[tit]."' and probh='".$bh."' order by xh asc");while($row2=mysqli_fetch_array($res2)){
 $nu="taocan1.php?id=".$row2[id]."&ty1id=".$row1[id]."&bh=".$bh; 
 ?>
 <ul class="tclist tclist1">
 <li class="l1"><input name="C1" type="checkbox" value="xcf<?=$row2[id]?>" /></li>
 <li class="l2">&nbsp;&nbsp;- <a href="<?=$nu?>"><?=$row2[tit2]?></a></li>
 <li class="l3"><?=$row2[xh]?></li>
 <li class="l7"><?=$row2[kcnum]?></li>
 <li class="l4"><?=$row2[money2]?></li>
 <li class="l5"><?=$row2[money1]?></li>
 <li class="l6">
 <? if(4==$row2[fhxs]){?><a href="kclist_tc.php?tcid=<?=$row2[id]?>&bh=<?=$bh?>">库存</a>&nbsp;&nbsp;|&nbsp;&nbsp;<? }?>
 <a href="<?=$nu?>">编辑</a>
 </li>
 </ul>
 <? }}?>
 <!--end-->
 
</body>
</html>