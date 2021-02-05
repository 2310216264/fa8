<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("../reg/");}
$userid=$rowuser[id];
updatetable("yjcode_car","yunfei=0 where userid=".$userid);
$shdzid=intval($_GET[shdzid]);

//函数B
if($_GET[action]=="del"){
deletetable("yjcode_car where id=".intval($_GET[id])." and userid=".$userid);
php_toheader("car.php");
}
if($_GET[control]=="bn"){
updatetable("yjcode_car","num=".intval($_GET[num])." where id=".intval($_GET[id])." and userid=".$userid);
php_toheader("car.php?shdz=".intval($_GET[shdz]));
}
//函数E
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function xuanall(){
xuan();
fhxs5chk();
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
 layer.open({type: 2,content: '正在处理数据'});
 $.get("../../user/carifxj.php",{cid:cid},function(result){location.href="car.php?shdzid=<?=$shdzid?>";});
}

function carmoney(){
am=0;
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
  if(parseInt(document.getElementById("fhxs"+i).innerHTML)==5 && document.getElementById("check"+i).checked==true){fhxs5=1;}
 }
}
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
if(carid==""){layer.open({content: '未选择任何结算商品',btn: '我知道了'});return false;}
if(fhxs5==1){
shd=parseInt(document.getElementById("shdzid").innerHTML);
if(shd==0){layer.open({content: '请先选择收货地址',btn: '我知道了'});return false;}
}
 if(buystr!=""){
  layer.open({type: 2,content: '正在保存'});
  $.post("../../user/buyform.php",{bv:buystr,cid:carid},function(result){
   if(result=="ok"){location.href="carpay.php?carid="+carid;}
   else{alert('提交失败，请重试');return false;}
  });
 }else{
  location.href="carpay.php?carid="+carid;
 }
}

function txtonc(x){
carallv=parseInt(document.getElementById("carallnum").innerHTML);
for(i=1;i<carallv;i++){
d=document.getElementById("txta"+i);
if(d){d.style.display="none";document.getElementById("text"+i).className="";}
}
document.getElementById("txta"+x).style.display="";document.getElementById("text"+x).className="t1";
}

function txtaonc(x,y){
 layer.open({type: 2,content: '正在保存'});
 $.post("bzphp.php",{bzv:document.getElementById("text"+x).value,cid:y},function(result){
  if(result=="ok"){
  layer.close(layer.index);
  document.getElementById("txta"+x).style.display="none";
  document.getElementById("text"+x).className="";
  }
  else{layer.open({content: '保存失败，请重试',btn: '我知道了'});return false;}
 });
}

function cardel(x){
 if(!confirm("确认删除？")){return false;}
 layer.open({type: 2,content: '正在删除'});
 $.get("cardel.php",{id:x,ty:"one"},function(result){
 location.reload();
 });
}

function cardelall(){
 if(!confirm("确认清空？")){return false;}
 layer.open({type: 2,content: '正在清空'});
 $.get("cardel.php",{ty:"all"},function(result){
 location.reload();
 });
}

function buynumcha(x,y){
str="<div class='carnum'><div class='carnum1'><input type='text' autocomplete='off' id='buynumtext' disableautocomplete value='"+y+"' /></div>";
str=str+"<div class='carnum2'><input type='button' onClick='buynumonc("+x+")' value='保存数量' /></div></div>";
layer.open({
    content: str
  });
}
function buynumonc(x){
 location.href="car.php?shdzid=<?=$shdzid?>&num="+document.getElementById("buynumtext").value+"&control=bn&id="+x;
}
</script>
</head>
<body>
<? include("topuser.php");?>

<div class="glotop box">
 <div class="d1" onClick="gourl('index.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">购物车</div>
 <div class="d4 red" onClick="cardelall()">清空</div>
</div>
</div>

<? if(panduan("*","yjcode_car where userid=".$rowuser[id])==1){?>
<!--有B-->
<div id="shdzmain" style="display:none;">
 <? 
 $i=1;$nshdz=0;while1("*","yjcode_shdz where zt=0 and userid=".$rowuser[id]." order by ifmr desc");while($row1=mysqli_fetch_array($res1)){
 if(($row1[ifmr]==1 && $shdzid==0) or ($row1[id]==$shdzid)){
 $shdzid=$row1[id];
 $nshdz=$row1[add1];
 updatetable("yjcode_car","shdzid=".$shdzid." where userid=".$rowuser[id]);
 ?>
 <div class="shdz box" onClick="gourl('carshdz.php')">
  <div class="d1">收货人：<?=$row1[lxr]?></div>
  <div class="d2"><?=$row1[mot]?></div>
 </div>
 <div class="shdz1 box" onClick="gourl('carshdz.php')">
  <div class="d1"><img src="img/location.png" height="15" /></div>
  <div class="d2"><?=$row1[add1v].$row1[add2v].$row1[add3v].$row1[addr]?></div>
  <div class="d3"><img src="img/jianright.png" height="13" /></div>
 </div>
 <? }}?>
 <? if(empty($shdzid)){?>
 <div class="shdzaddt box"><div class="d1">收货信息</div></div>
 <div class="shdzadd box" onClick="gourl('carshdz.php')"><div class="d1">点击选择收货地址</div><div class="d2"><img src="img/jianright.png" height="16" /></div></div>
 <? }?>
 <span id="shdzid" style="display:none;"><?=$shdzid?></span>
</div>

<?
$bigi=1;
$i=1;
while0("distinct selluserid","yjcode_car where userid=".$rowuser[id]."");while($row=mysqli_fetch_array($res)){
$yunfeizl=0;
$ifwuliufh=0;
$sqlu="select * from yjcode_user where id=".$row[selluserid];mysqli_set_charset($conn,"utf8");$resu=mysqli_query($conn,$sqlu);$rowu=mysqli_fetch_array($resu);
$shoptp="../upload/".$rowu[id]."/shop.jpg";
?>
<div class="carM box">
 <div class="d1"><img src="img/shop.png" height="16" /></div>
 <div class="d2"><?=$rowu[shopname]?></div>
</div>

<?
while1("*","yjcode_car where userid=".$rowuser[id]." and selluserid=".$row[selluserid]." order by sj desc");while($row1=mysqli_fetch_array($res1)){
$tp=returntp("bh='".$row1[probh]."' order by iffm desc","-2");
while2("*","yjcode_pro where bh='".$row1[probh]."' and zt=0 and ifxj=0");if($row2=mysqli_fetch_array($res2)){
$money=returnyhmoney($row2[yhxs],$row2[money2],$row2[money3],$sj,$row2[yhsj1],$row2[yhsj2],$row2[id]);
$money1=$row2["money1"];
$au="../product/view".$row2[id].".html";
?>
<div class="car box">
 <div class="d1"><input onClick="carmoney()" <? if(empty($row1[ifxj])){?>checked="checked"<? }?> name="C1" id="check<?=$i?>" type="checkbox" value="<?=$row1[id]?>" /></div>
 <div class="d2">
 <img border="0" src="<?=$tp?>" onerror="this.src='../../img/none60x60.gif'" width="50" height="50" /><br>
 <img src="img/cardel.png" onClick="cardel(<?=$row1[id]?>)" width="15" style="margin:8px 0 0 0;" />
 </div>
 <div class="d3">
 <span class="s1">
 <?=$row2["tit"]?>
 
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
 <span id="fhxs<?=$i?>" style="display:none"><?=$fhxsnum?></span>

 <? 
 if(!empty($row1[tcid])){
 while3("*","yjcode_taocan where id=".$row1[tcid]);if($row3=mysqli_fetch_array($res3)){
 $money=$row3[money1];
 $money1=$row3[money2];
 $tit=$row3[tit];
 if($row3[admin]==2){$tit=$tit." ".$row3[tit2];}
 echo "<span class='hui'>(套餐:".$tit.")</span>";
 }}?>
 </span>

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

 <span class="s3"><strong>￥<?=$money?></strong></span>
 <span class="s4" onClick="buynumcha(<?=$row1[id]?>,<?=$row1[num]?>)">
  <span>-</span><input id="inpnum<?=$i?>" readonly class="tjinput" type="text" value="<?=$row1[num]?>" /><span>+</span>
 </span>

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
 <div class="ub">
 <input type="text" style="display:none;" value="<?=$a[$j]?>" id="buyt<?=$i?>_<?=$smalla?>" /><span class="ub1"><?=$a[$j]?></span>
 <input type="text" class="ub2 tjinput" id="buyv<?=$i?>_<?=$smalla?>" />
 </div>
 <? }}?>
 <div id="smalla<?=$i?>" style="display:none;"><?=$smalla?></div>
 <?
 }
 }
 ?>
 <!--购买模板E-->

 <div class="liuyan">
  <textarea id="text<?=$i?>" onClick="txtonc(<?=$i?>)" placeholder="选填：给卖家的留言"><?=$row1[bz]?></textarea>
  <a href="javascript:void(0);" id="txta<?=$i?>" onClick="txtaonc(<?=$i?>,<?=$row1[id]?>)" style="display:none;">保存</a>
 </div>
 <input style="display:none;" id="inpmoney<?=$i?>" type="text" value="<?=$money?>" />
 <span style="display:none;" id="zl_<?=$i?>"><?=$row2[zl]?></span>
 <span style="display:none;" id="allzl_<?=$i?>"><?=$row2[zl]*$row1[num]?></span>
<? if(empty($row1[ifxj])){$yunfeizl=$yunfeizl+$row2[zl]*$row1[num];}?>
 </div>
</div>

<?
$i++;
}}
?>

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
<div class="yunfei box"<? if($yf==0){?> style="display:none;<? }?>"><div class="d1 flex">运费：</div><div class="d2"><span id="yunfeimoney_<?=$bigi?>"><?=$yf?></span></div></div>
<!--运费E-->

<div class="carbottom box"></div>
<? $bigi++;}?>
<span style="display:none;" id="biginum"><?=$bigi?></span>

<div class="carjsF"></div>
<div class="carjs">
 <div class="d1">实付:￥<span class="s1" id="moneyall">0</span></div>
 <div class="d2" onClick="carjs()">结算</div>
</div>
<span id="carallnum" style="display:none;"><?=$i?></span>
<script language="javascript">
carmoney();
</script>
<!--有E-->
<? }else{?>
<!--无B-->
<div class="wait box" onClick="gourl('../product/')">
 <div class="d1">
  <span class="s0"><img src="img/cart.png" width="70" /></span>
  <span class="s1">您的购物车还是空的</span>
  <span class="s2">去挑一些中意的商品吧</span>
 </div>
</div>
<!--无E-->
<? }?>
</body>
</html>