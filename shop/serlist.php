<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$getstr=$_GET[str];

$uid=intval(returnsx("i"));
$sqluser="select * from yjcode_user where zt=1 and shopzt=2 and id=".$uid;mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("./");}

$tit="服务市场";

$ses=" where zt=0 and ifxj=0 and userid=".$uid;
$ty1id=returnsx("j");if($ty1id!=-1){
$sqlty1="select * from yjcode_servertype where admin=1 and zt=0 and id=".intval($ty1id);mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
$ty1name=$rowty1[name1];
$ses=$ses." and ty1id=".$ty1id;
$tit=$ty1name;
}

$ty2id=returnsx("k");if($ty2id!=-1){
$sqlty2="select * from yjcode_servertype where admin=2 and zt=0 and id=".$ty2id;mysqli_set_charset($conn,"utf8");$resty2=mysqli_query($conn,$sqlty2);$rowty2=mysqli_fetch_array($resty2);
$ty2name=$rowty2[name2];
$ses=$ses." and ty2id=".$ty2id;
$tit=$tit."_".$ty2name;
}

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

$px="order by lastsj desc";
$pxv=returnsx("f");
if($pxv==1){$px="order by lastsj asc";}
elseif($pxv==2){$px="order by xsnum desc";}
elseif($pxv==3){$px="order by xsnum asc";}
elseif($pxv==4){$px="order by djl desc";}
elseif($pxv==5){$px="order by djl asc";}
elseif($pxv==6){$px="order by money1 desc";}
elseif($pxv==7){$px="order by money1 asc";}
elseif($pxv==8){$px="order by lastsj desc";}
elseif($pxv==9){$px="order by lastsj asc";}

if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}

$nserU="serlist";
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$seokey?>">
<meta name="description" content="<?=$seodes?>">
<title><?=$rowuser[shopname]?>的网上店铺_<?=$tit?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="shop.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
</style>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("shopmenu2").className="a1";
</script>

<div class="yjcode">

<!--B-->
<div class="psel">
<ul class="u2">
<li class="l1">服务类目：</li>
<li class="l2">
<a href="serlist_i<?=$rowuser[id]?>v.html"<? if($ty1id==-1){?> class="ax"<? }?>>不限</a>
</li>
<li class="l3">
<? while1("*","yjcode_servertype where admin=1 and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
<a href="serlist_j<?=$row1[id]?>v_i<?=$uid?>v.html"  class="<? if(check_in("_j".$row1[id]."v",$getstr)){echo "ax";}?>"><?=$row1[name1]?></a>
<? }?>
</li>
</ul>

<? if($ty1id!=-1){if(panduan("*","yjcode_servertype where admin=2 and zt=0 and name1='".$ty1name."'")==1){?>
<ul class="u2">
<li class="l1">具体分类：</li>
<li class="l2">
<a href="<?=rentser('k','','','',$nserU);?>"<? if($ty2id==-1){?> class="ax"<? }?>>不限</a>
</li>
<li class="l3">
<? while1("*","yjcode_servertype where admin=2 and zt=0 and name1='".$ty1name."' order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
<a href="serlist_j<?=$ty1id?>v_k<?=$row1[id]?>v_i<?=$uid?>v.html" <? if(check_in("_k".$row1[id]."v",$getstr) && check_in("_k".$row1[id]."v",$getstr)){?> class="ax"<? }?>><?=$row1[name2]?></a>
<? }?>
</li>
</ul>
<? }}?>
</div>


<!--已选条件B-->
<div class="nser fontyh">
<ul class="u1">
<li class="l1">已选条件：</li>
<li class="l2">
<? if($ty1id!=-1){?>
<span class="s1" onMouseOver="this.className='s2';" onMouseOut="this.className='s1';"><a title="取消" href="<?=rentser('j','','k','',$nserU);?>"><?=$ty1name?></a></span>
<? }?>

<? if($ty2id!=-1){?>
<span class="s1" onMouseOver="this.className='s2';" onMouseOut="this.className='s1';"><a title="取消" href="<?=rentser('k','','','',$nserU);?>"><?=$ty2name?></a></span>
<? }?>
</li>
</ul>
</div>
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
<form name="f1" onSubmit="return sser(<?=$rowuser[id]?>)" method="post">
<ul class="slistsea"> 
<li class="l1"><input name="t1" type="text"  autocomplete="off" disableautocomplete value="<?=$skey?>" /></li>
<li class="l2"><input type="image" src="img/ser.gif" /></li>
</ul>
</form>
</div>
</div>
<!--排序E-->

<div class="srlist">
<? 
$i=1;
pagef($ses,20,"yjcode_server",$orderpx);while($row=mysqli_fetch_array($res)){
$au="../serve/view".$row[id].".html";
$tp=returntp("bh='".$row[bh]."' order by iffm desc","-1");
?>
<ul class="u2<? if($i % 5==0){echo " u21";}?>">
<li class="l1"><a href="<?=$au?>" target="_blank"><img onerror="this.src='../img/none180x180.gif'" border="0" title="<?=$row[tit]?>" src="<?=$tp?>" width="190" height="120" /></a></li>
<li class="l2"><strong>￥<?=returnjgdian($row[money1])?></strong></li>
<li class="l3"><a href="<?=$au?>" target="_blank" title="<?=$row[tit]?>"><?=strgb2312s($row[tit],0,30)?></a></li>
<li class="l4">成交：<?=$row[xsnum]?>次</li>
<li class="l5"><a href="<?=$au?>" target="_blank">立即购买</a></li>
</ul>
<? $i++;}?>

<div class="npa">
<?
$nowurl="serlist";
$nowwd="";
require("../tem/page.html");
?>
</div>

</div>
<!--E-->

</div>

<? include("../tem/bottom.html");?>
</body>
</html>