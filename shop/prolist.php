<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$getstr=$_GET[str];

$uid=returnsx("i");
$sqluser="select * from yjcode_user where zt=1 and shopzt=2 and id=".$uid;mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("./");}

while0("touchy_time,is_touchy,touchy_b_time","yjcode_control");$rowss=mysqli_fetch_array($res);
$H = date('H');

$touchy_time=explode(',',$rowss[touchy_time]);
$touchy_b_time=explode(',',$rowss[touchy_b_time]);

//判断是否开启敏感过滤
if(1==$rowss[is_touchy]){
	//白天
	if(in_array($H,$touchy_time)){
			//开启	
		if($_SESSION["SHOPUSER"]==""){
			//未登录
			$ses="where zt=0 and ifxj=0 and touchy=0 and userid=".$uid;
		}else{
			$ses="where zt=0 and ifxj=0 and userid=".$uid;
		}
	//晚上
	}else if(in_array($H,$touchy_b_time)){
		$ses="where zt=0 and ifxj=0 and userid=".$uid;
	}else{
		$ses="where zt=0 and ifxj=0 and touchy=0 and userid=".$uid;
	}
}else{
	//关闭隐藏
	$ses="where zt=0 and ifxj=0 and touchy=0 and userid=".$uid;
}

//$ses=" where zt=0 and ifxj=0 and userid=".$uid;


$ty1id=returnsx("j");


if($ty1id!=-1){
$sqlty1="select * from yjcode_type where admin=1 and id=".$ty1id;mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
$ty1name=$rowty1[type1];
$ty1propx=intval($rowty1[propx]);
$ses=$ses." and ty1id=".$ty1id;
if(empty($rowty1[seotit])){$tit=$ty1name;}else{$tit=$rowty1[seotit];}
$seokey=$rowty1[seokey];
$seodes=$rowty1[seodes];
}


$ty2id=returnsx("k");if($ty2id!=-1){
$sqlty2="select * from yjcode_type where admin=2 and id=".$ty2id;mysqli_set_charset($conn,"utf8");$resty2=mysqli_query($conn,$sqlty2);$rowty2=mysqli_fetch_array($resty2);
$ty2name=$rowty2[type2];
$ses=$ses." and ty2id=".$ty2id;
if(empty($rowty2[seotit])){$tit=$tit."/".$ty2name;}else{$tit=$rowty2[seotit];}
$seokey=$rowty2[seokey];
$seodes=$rowty2[seodes];
}


$ty3id=returnsx("m");if($ty3id!=-1){$ty3name=returntype(3,$ty3id);$ses=$ses." and ty3id=".$ty3id;$tit=$tit."/".$ty3name;}
$ty4id=returnsx("r");if($ty4id!=-1){$ty4name=returntype(4,$ty4id);$ses=$ses." and ty4id=".$ty4id;$tit=$tit."/".$ty4name;}
$ty5id=returnsx("l");if($ty5id!=-1){$ty5name=returntype(5,$ty5id);$ses=$ses." and ty5id=".$ty5id;$tit=$tit."/".$ty5name;}


// $ty1id=returnsx("j");
// $ty2id=returnsx("k");
// if($ty1id!=-1){$ses=$ses." and myty1id=".$ty1id;$name1=returntypem(1,$ty1id);}
// if($ty2id!=-1){$ses=$ses." and myty2id=".$ty2id;}



if(returnsx("s")!=-1){
$skey=safeEncoding(returnsx("s"));
$a=preg_split("/\s/",$skey);
$bs="(";
for($i=0;$i<=count($a);$i++){
if(!empty($a[$i])){$bs=$bs."tit like '%".$a[$i]."%' and ";}
}
$ses=$ses." and ".$bs." tit<>'')";
$tit=$tit."/".$skey;
}
if(returnsx("a")!=-1){$ifjx=returnsx("a");$ses=$ses." and admintj>0";}
if(returnsx("b")!=-1){$mon1=returnsx("b");$ses=$ses." and money2>=".$mon1;}
if(returnsx("c")!=-1){$mon2=returnsx("c");$ses=$ses." and money2<=".$mon2;}
if(returnsx("d")!=-1){$ifzdfh=returnsx("d");$ses=$ses." and (fhxs=2 or fhxs=3 or fhxs=4)";}
if(returnsx("g")!=-1){$ifuserdj=returnsx("g");$ses=$ses." and ifuserdj=1";}
$area1=returnsx("n");$area2=returnsx("o");$area3=returnsx("q");
if($area1!=-1 && $area2==-1 && $area3==-1){$x1="|".$area1.",";$ses=$ses." and (ysarea like '%".$x1."%' or ysarea is null or ysarea='')";}
elseif($area1!=-1 && $area2!=-1 && $area3==-1){$x1="|".$area1.",".$area2.",";$ses=$ses." and (ysarea like '%".$x1."%' or ysarea is null or ysarea='')";}
elseif($area1!=-1 && $area2!=-1 && $area3!=-1){$x1="|".$area1.",".$area2.",".$area3."|";$ses=$ses." and (ysarea like '%".$x1."%' or ysarea is null or ysarea='')";}

if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}
$px="order by lastsj desc";
$pxv=returnsx("f");
if($pxv==1){$px="order by lastsj asc";}
elseif($pxv==2){$px="order by xsnum desc";}
elseif($pxv==3){$px="order by xsnum asc";}
elseif($pxv==4){$px="order by djl desc";}
elseif($pxv==5){$px="order by djl asc";}
elseif($pxv==6){$px="order by money2 desc";}
elseif($pxv==7){$px="order by money2 asc";}
elseif($pxv==8){$px="order by lastsj desc";}
elseif($pxv==9){$px="order by lastsj asc";}




if(returnsx("s")!=-1){
$skey=safeEncoding(returnsx("s"));
$a=preg_split("/\s/",$skey);
$bs="(";
for($i=0;$i<=count($a);$i++){
if(!empty($a[$i])){$bs=$bs."tit like '%".$a[$i]."%' and ";}
}
$ses=$ses." and ".$bs." tit<>'')";
}

if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}

$orderpx="order by lastsj desc";
$f=intval(returnsx("f"));
if($f==1){$orderpx="order by xsnum asc";}
elseif($f==11){$orderpx="order by xsnum desc";}
elseif($f==2){$orderpx="order by pf1 asc";}
elseif($f==21){$orderpx="order by pf1 desc";}
elseif($f==3){$orderpx="order by money2 asc";}
elseif($f==31){$orderpx="order by money2 desc";}
elseif($f==4){$orderpx="order by lastsj asc";}
elseif($f==41){$orderpx="order by lastsj desc";}

$nserU="prolist";
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title><?=$rowuser[shopname]?>的网上店铺 - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="shop.css" rel="stylesheet" type="text/css" />
</head>
<style>
/*自动发货 标志*/
cite, em, i {font-style: normal;}
.clist dt .ly cite .xq i {
    background-position: -250px -217px;
}
.clist dt .ly cite i {
    width: 25px;
    height: 25px;
    margin: 3px;
    background: url('../img/focus2018.png') no-repeat;}
}

.note_icon a:hover{color:red}
.note_icon a{padding-right:5px; float:left}
/*手自*/
.note_icon a:hover{color:red}
.note_icon a{padding-right:5px; float:left}
.note_icon a i{color:#999; border:1px solid #ddd; background:#f9f9f9; float:left; overflow:hidden; text-align:center; height:19px; line-height:19px; padding:0 4.5px}
.note_icon a i.protect{color:#6a4; border-color:#6a4; background:#eff}
.note_icon a i.score{color:#f60; border-color:#FF7E00; background:#FFF5EE}
.note_icon a i.send{color:#b68571; border-color:#e3c8bd; background:#fffbf6}
.note_icon a i.install0{color:#498BF8; border-color:#71a3f5; background:#EEF9FF;}

</style>
<body >
	
<? include("top.php");?>


<!--min-->
<div class="main">
<div class="yjcode">
	
	
	

		
		
		
	
<div class="proxuan" id="proxuan">
<!--条件-->
<ul class="u1">
<li class="l1">商品类目：</li>
<li class="l2">
<span><a href="./prolist_i<?=$rowuser[id]?>v.html" class="<? if($ty1id==-1){echo "ah";}else{echo "an";}?>">全部</a></span>
<? while1("*","yjcode_type where admin=1 and id<>3 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$row1[id]?>v.html"  class="<? if(check_in("_j".$row1[id]."v",$getstr)){echo "a1";}?>"><?=$row1[type1]?></a></span>
<? }?>
</li>
</ul>


<? if($ty1id!=-1){if(panduan("*","yjcode_type where admin=2 and type1='".$ty1name."'")==1){?>
<ul class="u1">
<li class="l1"><?=$ty1name?>：</li>
<li class="l2">
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v.html" class="<? if($ty2id==-1){echo "ah";}else{echo "an";}?>">不限</a></span>
<? while1("*","yjcode_type where admin=2 and type1='".$ty1name."' order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v_k<?=$row1[id]?>v.html" <? if(check_in("_k".$row1[id]."v",$getstr) && check_in("_k".$row1[id]."v",$getstr)){?> class="a1"<? }?>><?=$row1[type2]?></a></span>
<? }?>
</li>
</ul>
<? }}?>


<? if($ty2id!=-1){if(panduan("*","yjcode_type where admin=3 and type1='".$ty1name."' and type2='".$ty2name."'")==1){?>
<ul class="u1">
<li class="l1"><?=$ty2name?>：</li>
<li class="l2">
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v_k<?=$ty2id?>v.html" class="<? if($ty3id==-1){echo "ah";}else{echo "an";}?>">不限</a></span>
<? while3("*","yjcode_type where admin=3 and type1='".$ty1name."' and type2='".$ty2name."' order by xh asc");while($row3=mysqli_fetch_array($res3)){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$row3[id]?>v.html" <? if(check_in("_m".$row3[id]."v",$getstr)){?> class="a1"<? }?>><?=$row3[type3]?></a></span>
<? }?>
</li>
</ul>
<? }}?>


<? if($ty3id!=-1){if(panduan("*","yjcode_type where admin=4 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."'")==1){?>
<ul class="u1">
<li class="l1"><?=$ty3name?>：</li>
<li class="l2">
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v.html" class="<? if($ty4id==-1){echo "ah";}else{echo "an";}?>">不限</a></span>
<? while3("*","yjcode_type where admin=4 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."' order by xh asc");while($row3=mysqli_fetch_array($res3)){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_r<?=$row3[id]?>v.html" <? if(check_in("_i".$row3[id]."v",$getstr)){?> class="a1"<? }?>><?=$row3[type4]?></a></span>
<? }?>
</li>
</ul>
<? }}?>

<? if($ty4id!=-1){if(panduan("*","yjcode_type where admin=5 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."' and type4='".$ty4name."'")==1){?>
<ul class="u1">
<li class="l1"><?=$ty4name?>：</li>
<li class="l2">
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_r<?=$ty4id?>v.html" class="<? if($ty5id==-1){echo "ah";}else{echo "an";}?>">不限</a></span>
<? while3("*","yjcode_type where admin=5 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."' and type4='".$ty4name."' order by xh asc");while($row3=mysqli_fetch_array($res3)){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_r<?=$ty4id?>v_l<?=$row3[id]?>v.html" <? if(check_in("_l".$row3[id]."v",$getstr)){?> class="a1"<? }?>><?=$row3[type5]?></a></span>
<? }?>
</li>
</ul>
<? }}?>


<? 
$si=0;
$sbarr=array();
while1("*","yjcode_typesx where admin=1 and typeid=".$ty1id." and ifsel=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){
$ev="e".$row1[id]."_";
$sbarr[$si]=$ev;
?>
<ul class="u1">
<li class="l1"><?=$row1[name1]?>：</li>
<li class="l2">
<span><a href="<?=rentsers($ev,'','','');?>" class="<? if(check_in("_".$ev."_v",$getstr) || !check_in("_".$ev,$getstr)){echo "ah";}else{echo "an";}?>">不限</a></span>
<? while2("*","yjcode_typesx where admin=2 and name1='".$row1[name1]."' and typeid=".$row1[typeid]." order by xh asc");while($row2=mysqli_fetch_array($res2)){?>
<span><a href="<?=rentsers($ev,$row2[id],'','');?>" <? if(check_in("_".$ev.$row2[id]."v",$getstr)){?> class="a1"<? }?>><?=$row2[name2]?></a></span>
<? }?>
</li>
</ul>
<? 
$si++;
}
for($si=0;$si<count($sbarr);$si++){if(returnsx($sbarr[$si])!=-1){$nsx="xcf".returnsx($sbarr[$si])."xcf";$ses=$ses." and tysx like '%".$nsx."%'";}}



function rentsers($x,$xv,$y,$yv,$nq="prolist",$z='',$zv='',$w='',$wv=''){
if(empty($nq)){$nq="prolist";}
$nstr=$_GET[str];
if(!check_in("_".$x.$xv."v",$nstr)){
if(check_in("_".$x,$nstr)){
 $a=preg_split("/_".$x."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$x.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$x.$xv."v".$d[1];
}else{
 $nstr=$nstr."_".$x.$xv."v";
}
}
if($y!=""){
if(!check_in("_".$y.$yv."v",$nstr)){
if(check_in("_".$y,$nstr)){
 $a=preg_split("/_".$y."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$y.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$y.$yv."v".$d[1];
}else{
 $nstr=$nstr."_".$y.$yv."v";
}
}
}
if($z!=""){
if(!check_in("_".$z.$zv."v",$nstr)){
if(check_in("_".$z,$nstr)){
 $a=preg_split("/_".$z."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$z.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$z.$zv."v".$d[1];
}else{
 $nstr=$nstr."_".$z.$zv."v";
}
}
}
if($w!=""){
if(!check_in("_".$w.$wv."v",$nstr)){
if(check_in("_".$w,$nstr)){
 $a=preg_split("/_".$w."/",$nstr);
 $re3=preg_split("/_/",$a[1]);
 $b=preg_split("/v/",$re3[0]);
 $ssr="";for($ri=0;$ri<count($b);$ri++){$ssr=$ssr.$b[$ri];if($ri<(count($b)-2)){$ssr=$ssr."v";}}
 $d=preg_split("/_".$w.$ssr."v/",$nstr);
 $nstr=$a[0]."_".$w.$wv."v".$d[1];
}else{
 $nstr=$nstr."_".$w.$wv."v";
}
}
}
if($xv==""){$nstr=str_replace("_".$x."v","",$nstr);}
if($yv==""){$nstr=str_replace("_".$y."v","",$nstr);}
if($zv==""){$nstr=str_replace("_".$z."v","",$nstr);}
if($wv==""){$nstr=str_replace("_".$w."v","",$nstr);}
return ($nq.$nstr).".html";}


?>




<!--已选条件B-->
<!--已选条件B-->
<div class="nser" id="nser">

<div class="xsm">已选条件：</div>

<div class="xuan" id="xuan">

<? if($ty1id!=-1){?>
<span><a href="./prolist_i<?=$rowuser[id]?>v.html" class="g_ac0"><?=$ty1name?></a></span>
<? }?>

<? if($ty2id!=-1){?>
<span><a href="prolist_i<?=$rowuser[id]?>v.html" class="g_ac0"><?=$ty2name?></a></span>
<? }?>

<? if($ty3id!=-1){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_k<?=$ty2id?>v.html" class="g_ac0"><?=$ty3name?></a></span>
<? }?>

<? if($ty4id!=-1){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_k<?=$ty2id?>v_m<?=$ty3id?>v.html" class="g_ac0"><?=$ty4name?></a></span>
<? }?>

<? if($ty5id!=-1){?>
<span><a href="prolist_i<?=$rowuser[id]?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_i<?=$ty4id?>v.html" class="g_ac0"><?=$ty5name?></a></span>
<? }?>

<? 
for($si=0;$si<count($sbarr);$si++){
$tsx=returnsx($sbarr[$si]);
if($tsx!=-1){
while1("*","yjcode_typesx where id=".$tsx);if($row1=mysqli_fetch_array($res1)){
if($row1[admin]==2){
?>
<span><a href="<?=rentsers($sbarr[$si],'','','');?>" class="g_ac0"><?=$row1[name1]."：".$row1[name2]?></a></span>
<? }}}}?>

<? 
if(returnsx("b")!=-1 || returnsx("c")!=-1){ 
if(returnsx("c")!=-1 && returnsx("b")!=-1){$tjv=returnsx("b")."-".returnsx("c")."元";}
elseif(returnsx("c")==-1){$tjv=returnsx("b")."元以上";}
elseif(returnsx("b")==-1){$tjv=returnsx("c")."元以下";}
?>
<span><a href="<?=rentsers('b','','c','');?>" class="g_ac0"><?=$tjv?></a></span>
<? }?>

<? if($skey!=""){?>
<span><a href="<?=rentsers('s','','','');?>" class="g_ac0"><?=$skey?></a></span>
<? }?>

<? if($ifjx==1){?>
<span><a href="<?=rentsers('a','','','');?>" class="g_ac0">本站精选</a></span>
<? }?>

<? if($ifzdfh==1){?>
<span><a href="<?=rentsers('d','','','');?>" class="g_ac0">自动发货</a></span>
<? }?>

<? if($area1!=-1){?>
<span><a href="<?=rentsers('n','','o','','search','q','');?>" class="g_ac0"><?=returnarea($area1)?></a></span>
<? }?>

<? if($area2!=-1){?>
<span><a href="<?=rentsers('o','','q','');?>" class="g_ac0"><?=returnarea($area2)?></a></span>
<? }?>

<? if($area3!=-1){?>
<span><a href="<?=rentsers('q','','','');?>" class="g_ac0"><?=returnarea($area3)?></a></span>
<? }?>

</div>

</div>
<script language="javascript">
a=(document.getElementById("xuan").innerHTML).replace(/\s*/g,"");
if(a==""){document.getElementById("nser").style.display="none";}
</script>
<!--已选条件E-->







<!--已选条件E--> 

<!--排序B 1向上有色 11向下有色 a1向上有色 a2向下有色 a3向下无色-->
<div class="paixu fontyh">
<div class="d1">
<a href="<?=rentser("f",'','','',$nserU);?>" <? if(returnsx("f")==-1){?> class="a4"<? }?>>综合</a>

<? if(returnsx("f")==1){?>
<a href="<?=rentser("f",11,'','',$nserU);?>" class="a1">成交量</a>
<? }elseif(returnsx("f")==11){?>
<a href="<?=rentser("f",1,'','',$nserU);?>" class="a2">成交量</a>
<? }else{?>
<a href="<?=rentser("f",1,'','',$nserU);?>" class="a3">成交量</a>
<? }?>

<? if(returnsx("f")==2){?>
<a href="<?=rentser("f",21,'','',$nserU);?>" class="a1">评分</a>
<? }elseif(returnsx("f")==21){?>
<a href="<?=rentser("f",2,'','',$nserU);?>" class="a2">评分</a>
<? }else{?>
<a href="<?=rentser("f",2,'','',$nserU);?>" class="a3">评分</a>
<? }?>

<? if(returnsx("f")==3){?>
<a href="<?=rentser("f",31,'','',$nserU);?>" class="a1">价格</a>
<? }elseif(returnsx("f")==31){?>
<a href="<?=rentser("f",3,'','',$nserU);?>" class="a2">价格</a>
<? }else{?>
<a href="<?=rentser("f",3,'','',$nserU);?>" class="a3">价格</a>
<? }?>

<? if(returnsx("f")==4){?>
<a href="<?=rentser("f",41,'','',$nserU);?>" class="a1">最新</a>
<? }elseif(returnsx("f")==41){?>
<a href="<?=rentser("f",4,'','',$nserU);?>" class="a2">最新</a>
<? }else{?>
<a href="<?=rentser("f",4,'','',$nserU);?>" class="a3">最新</a>
<? }?>

</div>
<div class="d2">
<form name="f1" onSubmit="return ser(<?=$rowuser[id]?>)" method="post">
<ul class="slistsea"> 
<li class="l1"><input name="t1" type="text"  autocomplete="off" disableautocomplete value="<?=$skey?>" /></li>
<li class="l2"><input type="image" src="img/ser.gif" /></li>
</ul>
</form>
</div>
</div>





</div>


<!--排序E-->
<div class="clist shop">
	<div class="list_items">
		<? 
		$i=1;
		pagef($ses,20,"yjcode_pro",$orderpx);while($row=mysqli_fetch_array($res)){
			
		while1("*","yjcode_user where id=".$row[userid]);$row1=mysqli_fetch_array($res1);
		$au="../product/view".$row[id].".html";
		$tp=returntp("bh='".$row[bh]."' order by iffm desc","-2");
		?>

		<dl>
		    <dt>
		      <a href="<?=$au?>" target="_blank" class="pic"><img title="<?=$row[tit]?>"  src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'"></a>
		      <div class="ly" style="display: none;">
		        <span></span>
		        <span class="cdes"><?=$row[tit]?></span>
		        <cite>
		          	<a href="<?=$au?>" class="xq" target="_blank"><i class="icons"></i>查看详情</a>
                	<? if(empty($row[ysweb])){?>
                		<a href="javascript:;" class="ys"><i class="icons"></i>无演示站</a>
                	<? }else{?>
                		<a href="<?=$row[ysweb]?>" target="_blank" class="ys"><i class="icons"></i>查看演示</a>
                	<? }?>       
		        </cite>
		      </div>
		    </dt>
			<dd>
				<p class="title">
			    <a href="<?=$au?>" title="<?=$row[tit]?>" target="_blank"><?=$row[tit]?></a>
				</p><p class="info"><em>￥<strong><?=returnjgdian(returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]))?></strong></em>
				
				<span class="note_icon">
					<? if($row[fhxs]==2 || $row[fhxs]==3 || $row[fhxs]==4){?>
	        		<a href="javascript:;" class="tips tipso_style zidong">
	        			<i class="send" title="">自</i>
	        		</a>
	        		<? }else{?>
	        		<a href="javascript:;" class="tips tipso_style shou"><i>手</i></a>
	        		<? }?>
	        		
	        		<? if(1==$row[ifuserdj]){?>
					<a class="tips tipso_style zhe"><i class="install0">折</i></a>
					<? }?>

	        		<? if($row1[baomoney]>0){?>
	        		<a href="#" class="tips tipso_style bao-t" data-mn="<?=sprintf("%.2f",$row1[baomoney])?>"><i class="protect">保</i></a>
	        		<? }?>
				</span>
				</p>
			</dd>
		</dl>
		
		<? $i++;}?>
		
	
	</div>	
		<div class="npa">
		<?
		$nowurl="prolist";
		$nowwd="";
		require("../tem/page.html");
		?>
		</div>
</div>

<script>


	var nowtips;
    $(".shou").hover(function () {
	    var that = $(this);
	    nowtips = layer.tips('手动发货商品，付款后联系商家发货', that, {
	        tips: [1, '#cc805b'],
	        time: 10000
	    });
	}, function () {
	    layer.close(nowtips);
	});
	
	
	$(".zhe").hover(function () {
	    var that = $(this);
	    nowtips = layer.tips('该商品已经加入会员等级折扣体系，本站会员可以享受相应的折价优惠', that, {
	        tips: [1, '#40affe'],
	        time: 10000
	    });
	}, function () {
	    layer.close(nowtips);
	});
	
	$(".zidong").hover(function () {
	    var that = $(this);
	    nowtips = layer.tips('自动发货商品，拍下后，即可收到来自该商品的发货（下载）链接', that, {
	        tips: [1, '#cc805b'],
	        time: 10000
	    });
	}, function () {
	    layer.close(nowtips);
	});
    
    $(".bao-t").hover(function () {
        var that = $(this);
        var mn = $(that).data("mn");
        nowtips = layer.tips('已加入消保，商家已缴纳保证金￥： <span class="mn-p">' + mn + '</span> 元', that, {
            tips: [1, '#0f9c0b'],
            time: 10000
        });
    }, function () {
        layer.close(nowtips);
    })
    
    
    
	$(".clist dt,.wlist .pic").mouseenter(function() {
        var a = $(this);
        enter = setTimeout(function() {
            a.find(".ly").show()
        },
        300)
    }).mouseleave(function() {
        clearTimeout(enter);
        $(this).find(".ly").hide()
    });
    

</script>

</div>
<!--E-->

</div>
</div>	
<!--min-->

<? include("../tem/bottom.html");?>
</body>
</html>