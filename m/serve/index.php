<?
include("../../config/conn.php");
include("../../config/function.php");
$getstr=$_GET[str];

$tit="服务市场";
$ses=" where zt=0 and ifxj=0";
$ty1id=intval(returnsx("j"));if($ty1id!=-1){
 $sqlty1="select * from yjcode_servertype where admin=1 and zt=0 and id=".intval($ty1id);mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
 $ty1name=$rowty1[name1];
 $lastty=$ty1name;
 $ses=$ses." and ty1id=".$ty1id;
 $tit=$ty1name;
}

$ty2id=intval(returnsx("k"));if($ty2id!=-1){
 $sqlty2="select * from yjcode_servertype where admin=2 and zt=0 and id=".$ty2id;mysqli_set_charset($conn,"utf8");$resty2=mysqli_query($conn,$sqlty2);$rowty2=mysqli_fetch_array($resty2);
 $ty2name=$rowty2[name2];
 $lastty=$ty2name;
 $ses=$ses." and ty2id=".$ty2id;
 $tit=$tit."_".$ty2name;
}

if(returnsx("s")!=-1){
 $skey=returnsx("s");
 $a=preg_split("/\s/",$skey);
 $bs="(";
 for($i=0;$i<=count($a);$i++){
 if(!empty($a[$i])){$bs=$bs."tit like '%".$a[$i]."%' and ";}
 }
 $ses=$ses." and ".$bs." tit<>'')";
 $tit=$tit."/".$skey;
}

$pxsm="排序方式";
$px="order by lastsj desc";
$pxv=returnsx("f");
$pxvarr=array("默认排序","按更新时间","销量从高到低","销量从低到高","关注从高到低","关注从低到高","价格从高到低","价格从低到高");
if($pxv==1){$px="order by lastsj desc";}
elseif($pxv==2){$px="order by xsnum desc";}
elseif($pxv==3){$px="order by xsnum asc";}
elseif($pxv==4){$px="order by djl desc";}
elseif($pxv==5){$px="order by djl asc";}
elseif($pxv==6){$px="order by money1 desc";}
elseif($pxv==7){$px="order by money1 asc";}
elseif($pxv==8){$px="order by lastsj desc";}
elseif($pxv==9){$px="order by lastsj asc";}

if(returnsx("p")!=-1){$page=returnsx("p");}else{$page=1;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta name="keywords" content="<?=$seokey?>">
<meta name="description" content="<?=$seodes?>">
<title><?=$tit?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<!--头部B-->
<div class="topfix">

<div class="glotop box">
 <div class="d1" onClick="javascript:history.go(-1);"><img src="../img/back-vector.png" height="20" /></div>
 <div class="d2">服务市场</div>
 <div class="d4"><a href="./">重置</a></div>
</div>

<div class="listtop box">
 <div class="d1" onClick="gourl('../search/main.php?admin=4')"><span class="s1"><img src="../img/ser.png" /></span><span class="s2"><?=returnjgdw($skey,"","请输入搜索关键词！")?></span></div>
</div>

<!--选择1B-->
<div class="psel box">
 <div class="search">
 
  <div class="d1" onClick="sertjonc(1,2)"><span class="s1"><span><?=returnjgdw($lastty,"","全部分类")?></span></span></div>
  <div class="d1 d0" onClick="sertjonc(2,2)"><span class="s1"><span><?=$pxsm?></span></span></div>
 
 </div>
</div>
<!--选择1E-->

</div>
<div class="ntopv box"><div class="d1"></div></div>
<!--头部E-->

<!--选择2B-->
<div class="sertj box" id="sertj1" style="display:none;">

 <div class="d1">
 <a href="search.html"<? if($ty1id==-1){?> class="nx"<? }?>>不限</a>
 <? while1("*","yjcode_servertype where admin=1 and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
 <a href="search_j<?=$row1[id]?>v.html" <? if(check_in("_j".$row1[id]."v",$getstr)){?> class="nx"<? }?>><?=$row1[name1]?></a>
 <? }?>
 </div>
 
 <? if($ty1id!=-1){?>
 <div class="d1">
 <a href="search_j<?=$ty1id?>v.html"<? if($ty2id==-1){?> class="nx"<? }?>>不限</a>
 <? while2("*","yjcode_servertype where admin=2 and zt=0 and name1='".$ty1name."' order by xh asc");while($row2=mysqli_fetch_array($res2)){?>
 <a href="search_j<?=$ty1id?>v_k<?=$row2[id]?>v.html" <? if(check_in("_k".$row2[id]."v",$getstr)){?> class="nx"<? }?>><?=$row2[name2]?></a>
 <? }?>
 </div>
 <? }?>
 
</div>
<div class="sertj box" id="sertj2" style="display:none;">
 <div class="d1">
 <a href="<?=rentser('f','','','');?>" <? if(check_in("_fv",$getstr) || !check_in("_f",$getstr)){?> class="nx"<? }?>>不限</a>
 <? for($i=1;$i<=7;$i++){?>
 <a href="<?=rentser('f',$i,'','');?>" <? if(check_in("_f".$i."v",$getstr)){?> class="nx"<? }?>><?=$pxvarr[$i]?></a>
 <? }?>
 </div>
</div>
<!--选择2E-->

<? 
pagef($ses,10,"yjcode_server",$px);while($row=mysqli_fetch_array($res)){
$tp=returntp("bh='".$row[bh]."' order by xh asc","-1");
$au="view".$row[id].".html";
$sqlsell="select * from yjcode_user where id=".$row[userid];mysqli_set_charset($conn,"utf8");$ressell=mysqli_query($conn,$sqlsell);$rowsell=mysqli_fetch_array($ressell);
?>
<div class="list1 box">
 <div class="d1"><span class="s0"><img src="img/shop.png" width="14" /></span><span class="s1"><?=$rowsell[shopname]?></span></div>
</div>
<div class="list2 box" onclick="gourl('<?=$au?>')">
 <div class="d1"><img border="0" src="<?=$tp?>" onerror="this.src='../img/none200x160.gif'" width="120" height="80" /></div>
 <div class="d2">
  <a href="<?=$au?>" class="a1"><?=$row[tit]?></a>
  <div class="dn1">
  <? if($rowsell[baomoney]>0){?>
  <span class="s2">已缴保证金</span>
  <? }?>
  </div>
  <div class="dn2">￥<strong><?=$row[money1]?></strong></div>
 </div>
</div>
<? }?>
<div class="npa">
<?
$nowurl="search";
$nowwd="";
require("../tem/page.html");
?>
</div>

<? include("../tem/moban/".$rowcontrol[wapmb]."/tem/bottom.php");?>
</body>
</html>