<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$shdzid=intval($_GET[shdzid]);
updatetable("yjcode_car","yunfei=0 where userid=".$rowuser[id]);
//函数B
if($_GET[action]=="del"){
deletetable("yjcode_car where id=".$_GET[id]." and userid=".$rowuser[id]);
php_toheader("car.php");
}elseif($_GET[action]=="dall"){
deletetable("yjcode_car where userid=".$rowuser[id]);
echo "ok";exit;
}
//函数E
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/pay.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function xuanall(){
xuan();
fhxs5chk();
}

function txtonc(x){
layer.open({
  type: 2,
  area: ['610px', '510px'],
  title:["给卖家的留言","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['carmsg.php?id='+x, 'no'] 
});
}

function delcar(){
layer.open({
		content: '您确认要清空购物车吗？',
		btn: ['确认', '取消'],
		shadeClose: false,
		yes: function(){
			layer.msg('正在清空', {icon: 16  ,time: 0,shade :0.25});
 $.get("car.php",{action:"dall"},function(result){
  if(result=="ok"){location.href="car.php";}
  else{layer.alert('清理失败，请重试', {icon:5});return false;}
 });
		}, no: function(){
			layer.close(layer.index);
		}
		});
		

}

function addshdz(){
layer.open({
  type: 2,
  area: ['700px', '420px'],
  title:["编辑收货地址","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['shdzlx.php', 'no'] 
});
}

function ediadd(b){
layer.open({
  type: 2,
  area: ['700px', '420px'],
  title:["编辑收货地址","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['shdz.php?bh='+b, 'no'] 
});
}

function buynumcha(x){
layer.open({
  type: 2,
  area: ['200px', '150px'],
  shadeClose :true,
  title:["修改购买数量","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['buynum.php?id='+x, 'no'] 
});
}

var fhxs5=0;
function fhxs5chk(){ //检测是否有物流发货形式
fhxs5=0;
cid="";
carallv=parseInt(document.getElementById("carallnum").innerHTML);
 for(i=1;i<carallv;i++){
 c=document.getElementById("check"+i).checked;
  if(c==true){
   cid=cid+document.getElementById("check"+i).value+",";
  }
 }
 layer.msg('正在处理数据', {icon: 16  ,time: 0,shade :0.25});
 $.get("carifxj.php",{cid:cid},function(result){location.href="car.php?shdzid=<?=$shdzid?>";});
}

function carmoney(){
am=0;
xok=0;
yhm=0; //优惠值
carallv=parseInt(document.getElementById("carallnum").innerHTML);
for(i=1;i<carallv;i++){
 c=document.getElementById("check"+i).checked;
 if(c==true){
  inpmoney=parseFloat(document.getElementById("inpmoney"+i).value);
  inpnum=parseInt(document.getElementById("inpnum"+i).value);
  ddm=accMul(inpnum,inpmoney);//单个商品总价
  yhz=parseFloat(document.getElementById("yhzhi"+i).innerHTML);
  if(yhz!=10){yhm=yhm+ddm-ddm*yhz/10;ddm=ddm*yhz/10;}
  am=addNum(am,ddm);
  xok++;
  if(parseInt(document.getElementById("fhxs"+i).innerHTML)==5 && document.getElementById("check"+i).checked==true){fhxs5=1;}
 }else{
 document.getElementById("cxuanall").checked=false;
 }
}
document.getElementById("xuanok").innerHTML=xok;
document.getElementById("yhmoney").innerHTML=yhm.toFixed(2);
for(i=1;i<parseInt(document.getElementById("biginum").innerHTML);i++){
 am=addNum(am,parseFloat(document.getElementById("yunfeimoney_"+i).innerHTML));
}
document.getElementById("moneyall").innerHTML=am.toFixed(2);
if(fhxs5==1){document.getElementById("shdzmain").style.display="";}else{document.getElementById("shdzmain").style.display="none";}
}

function carjs(){
carid="";
buystr="";
carallv=parseInt(document.getElementById("carallnum").innerHTML);
for(i=1;i<carallv;i++){
 c=document.getElementById("check"+i).checked;
 if(c==true){
  carid=carid+document.getElementById("check"+i).value+"-"+document.getElementById("inpnum"+i).value+"c";
  //购买模板B
  buystrs="";
  if(document.getElementById("smalla"+i)){
   b=parseInt(document.getElementById("smalla"+i).innerHTML);
   for(j=1;j<=b;j++){
	 bf1=document.getElementById("buyt"+i+"_"+j).value;
	 bf2=document.getElementById("buyv"+i+"_"+j).value;
	 if(bf1.indexOf("*")!=-1){
     if(bf2==""){alert("有信息未填写，请补充完整(带红色*号为必填项)");return false;}
	 }
	 buystrs=buystrs+bf1+bf2+"<br>";
   }
  }
  buystr=buystr+buystrs+"yj99yjcode";
  //购买模板E
 }
}
if(carid==""){alert("未选择任何结算商品");return false;}
if(fhxs5==1){
shd=parseInt(document.getElementById("shdzid").innerHTML);
if(shd==0){alert("请先选择收货地址");return false;}
}
 if(buystr!=""){
  layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
  $.post("buyform.php",{bv:buystr,cid:carid},function(result){
   if(result=="ok"){location.href="carpay.php?carid="+carid;}
   else{alert('提交失败，请重试');return false;}
  });
 }else{
  location.href="carpay.php?carid="+carid;
 }
}

</script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>
<div class="yjcode">
<ul class="dqwz">
<li class="l1">您的位置：<a href="../" class="acy">首页</a> > <a href="./" class="acy">会员中心</a> > 购物车</li>
</ul>

<div id="shdzmain" style="display:none;">
 <div class="d1">选择收货地址</div>
 <? $i=1;$nshdz=0;while1("*","yjcode_shdz where zt=0 and userid=".$rowuser[id]." order by ifmr desc");while($row1=mysqli_fetch_array($res1)){?>
 <ul class="u1<? if($i % 4==0){?> u0<? }?><? if(($row1[ifmr]==1 && $shdzid==0) or ($row1[id]==$shdzid)){$shdzid=$row1[id];$nshdz=$row1[add1];echo " u11";}?>">
 <li class="l1"><?=$row1[add1v]?> <strong><?=$row1[add2v]?></strong> <?=$row1[add3v]." ".$row1[addr]." ".$row1[mot]?> (<?=$row1[lxr]?> 收)</li>
 <li class="l2"><a href="car.php?shdzid=<?=$row1[id]?>" class="feng">选择</a> | <a href="javascript:void(0);" onclick="ediadd('<?=$row1[bh]?>')" class="feng">修改</a></li>
 </ul>
 <? $i++;}?>
 <div class="adddz"><a href="javascript:void(0);" onclick="addshdz()">添加收货地址</a></div>
</div>
<? if(!empty($shdzid)){updatetable("yjcode_car","shdzid=".$shdzid." where userid=".$rowuser[id]);}?>
<span id="shdzid" style="display:none;"><?=$shdzid?></span>

<ul class="cartbcap">
<li class="l1"><label><input name="C2" onclick="xuanall()" checked="checked" id="cxuanall" type="checkbox" value="" />&nbsp;&nbsp; 全选</label></li>
<li class="l2">商品信息</li>
<li class="l3">给卖家的留言</li>
<li class="l4">单价</li>
<li class="l5">数量</li>
<li class="l6">总价</li>
<li class="l7">操作</li>
</ul>

<? 
$bigi=1;
$i=1;
while0("distinct selluserid","yjcode_car where userid=".$rowuser[id]."");while($row=mysqli_fetch_array($res)){
$ifwuliufh=0;
$yunfeizl=0;
$sqlu="select * from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$resu=mysqli_query($conn,$sqlu);$rowu=mysqli_fetch_array($resu);
$shoptp="../upload/".$rowu[id]."/shop.jpg";
?>
<ul class="cartcap">
<? if(is_file($shoptp)){?>
<li class="l1"><img src="<?=$shoptp?>" /></li>
<? }?>
<li class="l2">店铺：<?=$rowu[shopname]?></li>
<li class="l3"><a href="javascript:void(0);" onclick="opentangqq('<?=$rowu[uqq]?>')"><img src="../img/qq5.gif" /></a></li>
</ul>
<div class="cartlist">
<?
while1("*","yjcode_car where userid=".$rowuser[id]." and selluserid=".$row[selluserid]." order by sj desc");while($row1=mysqli_fetch_array($res1)){
$tp=returntp("bh='".$row1[probh]."' order by iffm desc","-2");
while2("*","yjcode_pro where bh='".$row1[probh]."' and zt=0 and ifxj=0");if($row2=mysqli_fetch_array($res2)){
$money=returnyhmoney($row2[yhxs],$row2[money2],$row2[money3],$sj,$row2[yhsj1],$row2[yhsj2],$row2[id]);
$money1=$row2["money1"];
$au="../product/view".$row2[id].".html";
?>
<ul class="u1">
<li class="l1"><input name="C1" id="check<?=$i?>" type="checkbox" <? if(empty($row1[ifxj])){?>checked="checked"<? }?> onclick="fhxs5chk()" value="<?=$row1[id]?>" /></li>
<li class="l2"><a href="<?=$au?>" target="_blank"><img border="0" src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'" width="80" height="80" /></a></li>
<li class="l3">
<a href="<?=$au?>" target="_blank" class="a2" title="<?=$row2["tit"]?>"><?=returntitdian($row2["tit"],128)?></a><br>
<? 
$fhxsnum=0;
if(!empty($row1[tcid])){
 while3("*","yjcode_taocan where zt=0 and id=".$row1[tcid]);if($row3=mysqli_fetch_array($res3)){
 $money=$row3[money1];
 $money1=$row3[money2];
 $tit=$row3[tit];
 if(!empty($row3[fhxs])){$fhxsnum=$row3[fhxs];}else{$fhxsnum=$row2[fhxs];}
 if($row3[admin]==2){$tit=$tit." ".$row3[tit2];}
 echo $tit;
 }
}else{
 $fhxsnum=$row2[fhxs];
}
if($fhxsnum==5){$ifwuliufh=1;}
if(empty($row1[ifxj]) && $fhxsnum==5){$yfid=$row1[id];}
?>
 (发货形式：<?=returnfhxs($fhxsnum)?>)<span id="fhxs<?=$i?>" style="display:none"><?=$fhxsnum?></span><br>
</li>
<li class="l4">
<textarea id="text<?=$row1[id]?>" readonly="readonly" onclick="txtonc(<?=$row1[id]?>)"><?=returnjgdw(strip_tags($row1[bz]),"","未填写留言")?></textarea>
</li>
<li class="l5"><s>￥<?=returnjgdian($money1)?></s><br><strong>￥<?=returnjgdian($money)?></strong></li>
<li class="l6">
<input style="display:none;" id="inpmoney<?=$i?>" type="text" value="<?=$money?>" />
<input class="inp1" id="inpnum<?=$i?>" readonly="readonly" onclick="buynumcha(<?=$row1[id]?>)" type="text" value="<?=$row1[num]?>" />
</li>
<li class="l7">
<strong class="s1">￥<span id="moneyz<?=$i?>"><?=$money*$row1[num]?></span></strong>
<span style="display:none;" id="zl_<?=$i?>"><?=$row2[zl]?></span>
<span style="display:none;" id="allzl_<?=$i?>"><?=$row2[zl]*$row1[num]?></span>
<? if(empty($row1[ifxj])){$yunfeizl=$yunfeizl+$row2[zl]*$row1[num];}?>
<?
/*读取优惠B*/
$yhzhi=10;
if(!empty($row2[ifuserdj])){
 if(!empty($rowuser[userdj])){$s=" and name1='".$rowuser[userdj]."'";$djname=$rowuser[userdj];}else{$s="";$djname="";}
 $sqlu4="select * from yjcode_prouserdj where probh='".$row2[bh]."' and djname='".$djname."'";mysqli_set_charset($conn,"utf8");$resu4=mysqli_query($conn,$sqlu4);
 if($rowu4=mysqli_fetch_array($resu4)){
  $userdj=$rowu4[djname];
  $yhzhi=$rowu4[zhi];
 }else{
  $sqlu3="select * from yjcode_userdj where zt=0".$s." order by xh asc limit 1";mysqli_set_charset($conn,"utf8");$resu3=mysqli_query($conn,$sqlu3);
  if($rowu3=mysqli_fetch_array($resu3)){
  $userdj=$rowu3[name1];
  $yhzhi=$rowu3[zhekou];
  } 
 }
}
if($yhzhi!=10 && !empty($yhzhi)){echo "<span class='yh'>".$userdj."享".$yhzhi."折</span>";}
elseif(empty($yhzhi)){echo "<span class='yh'>".$userdj."免费</span>";}
/*读取优惠E*/
?>
<span id="yhzhi<?=$i?>" style="display:none;"><?=$yhzhi?></span>
</li>
<li class="l8"><a href="car.php?action=del&id=<?=$row1[id]?>">删除</a></li>
</ul>
<!--购买模板B-->
<?
$sqlt1="select * from yjcode_type where admin=2 and id=".$row2[ty2id];mysqli_set_charset($conn,"utf8");$rest1=mysqli_query($conn,$sqlt1);if($rowt1=mysqli_fetch_array($rest1)){
if(!empty($rowt1[buyform])){
 $av=str_replace("\r","",$rowt1[buyform]);
 $a=preg_split("/\n/",$av);
 $smalla=0;
 for($j=0;$j<=count($a);$j++){
 if(!empty($a[$j])){
 $smalla++;
?>
<ul class="ub">
<li class="l1"><input type="text" style="display:none;" value="<?=$a[$j]?>" id="buyt<?=$i?>_<?=$smalla?>" /><?=str_replace("*","<span class='red'>*</span>",$a[$j])?></li>
<li class="l2"><input type="text" value="<?=$bv1v?>" class="inp" id="buyv<?=$i?>_<?=$smalla?>" /></li>
</ul>
<? }}?>
<div id="smalla<?=$i?>" style="display:none;"><?=$smalla?></div>
<?
}
}
?>
<!--购买模板E-->
<? $i++;}}?>
<!--运费B-->
<span id="yunfeizl_<?=$bigi?>" style="display:none;"><?=$yunfeizl?></span>
<? 
if(!empty($shdzid) && $ifwuliufh==1){
 $yf=returnyunfei($row[selluserid],$yunfeizl,$nshdz);
}else{
 $yf=0;
}
updatetable("yjcode_car","yunfei=".$yf." where id=".$yfid);
?>
<ul class="yunfei"<? if($yf==0){?> style="display:none;<? }?>"><li class="l1">运费：</li><li class="l2"><span id="yunfeimoney_<?=$bigi?>"><?=$yf?></span></li></ul>
<!--运费E-->
</div>
<? $bigi++;}?>
<span style="display:none;" id="biginum"><?=$bigi?></span>


<ul class="carjs">
<li class="l2"><a href="javascript:void(0);" onclick="delcar()">清空购物车</a></li>
<li class="l3">已选商品 <strong id="xuanok">0</strong> 件</li>
<li class="l4">已优惠<span id="yhmoney">0</span>元，实付：￥<span class="s1" id="moneyall">0</span></li>
<li class="l5"><img src="img/js.gif" style="cursor:pointer;" onclick="carjs()" /></li>
</ul>
<span id="carallnum" style="display:none;"><?=$i?></span>
<script language="javascript">
carmoney();
</script>

</div>
<? include("../tem/bottom.html");?>
</body>
</html>