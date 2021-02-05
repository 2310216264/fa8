<?
include("../config/conn.php");
include("../config/function.php");
$sj=date("Y-m-d H:i:s");
$getstr=$_GET[str];
// var_dump($getstr);
//已有标签 
$tit="服务市场";

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
			$ses="where zt=0 and ifxj=0 and touchy=0";
		}else{
			$ses="where zt=0 and ifxj=0";
		}
	//晚上
	}else if(in_array($H,$touchy_b_time)){
		$ses="where zt=0 and ifxj=0";
	}else{
		$ses="where zt=0 and ifxj=0 and touchy=0";
	}
}else{
	//关闭隐藏
	$ses="where zt=0 and ifxj=0 and touchy=0";
}


//$ses=" where zt=0 and ifxj=0";

$ty1id=intval(returnsx("j"));if($ty1id!=-1){
$sqlty1="select * from yjcode_servertype where admin=1 and zt=0 and id=".intval($ty1id);mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
$ty1name=$rowty1[name1];
$ses=$ses." and ty1id=".$ty1id;
$tit=$ty1name;
}

$ty2id=intval(returnsx("k"));if($ty2id!=-1){
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
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$seokey?>">
<meta name="description" content="<?=$seodes?>">
<title><?=$tit?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body style="background:#f5f5f5;">
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>

<div class="yjcode">

<? adwhile("ADSER01");?>

<!--左B-->
<div class="listleft">

<!--筛选B--> 
<div class="typelist">

<style type="text/css">
.i-1{background: url(https://statics.huzhan.com/image/witkey-icon-kf.png) no-repeat 8px center;}
.i-18{background: url(https://statics.huzhan.com/image/witkey-icon-sj.png) no-repeat 8px center;}
.i-19{background: url(https://statics.huzhan.com/image/witkey-icon-wl.png) no-repeat 8px center;}
.i-20{background: url(https://statics.huzhan.com/image/witkey-icon-qy.png) no-repeat 8px center;}
.i-30{background: url(https://statics.huzhan.com/image/witkey-icon-yx.png) no-repeat 8px center;}
.i-31{background: url(https://statics.huzhan.com/image/witkey-icon-ch.png) no-repeat 8px center;}

.screen_con a{margin-bottom: 7px; display: inline-block; padding: 2px 10px; margin-right: 15px; border-radius: 15px; cursor: pointer; line-height: 19px;}
.screen_box{padding: 0 0 20px 0; display: block; margin: 15px 0 0 0;font-size: 12px; position: relative;}
.screen_list{display: block; padding: 10px 0 3px; border-bottom: 1px solid #eee;position: relative;margin: 0 26px;}
.screen_witkey {padding-bottom: 0;}
.witkey_con{margin:0;border-bottom:0}
.witkey_con a{-moz-opacity:.9;opacity:.9;font-size:14px;display:inline-block;padding:6px 10px 5px 35px;margin:0 15px -1px 15px;border-radius:15px;cursor:pointer;line-height:25px;border-radius:0;border-top-left-radius:3px;border-top-right-radius:3px}
.witkey_con a.screen_default{-moz-opacity:1;opacity:1;border:1px solid #e0e0e0;border-bottom-color:#fff}
.witkey_con a.i-2{background:url(https://statics.huzhan.com/image/witkey-icon-kf.png) no-repeat 8px center}
.witkey_con a.i-14{background:url(https://statics.huzhan.com/image/witkey-icon-sj.png) no-repeat 8px center}
.witkey_con a.i-18{background:url(https://statics.huzhan.com/image/witkey-icon-wl.png) no-repeat 8px center}
.witkey_con a.i-24{background:url(https://statics.huzhan.com/image/witkey-icon-qy.png) no-repeat 8px center}
.witkey_con a.i-31{background:url(https://statics.huzhan.com/image/witkey-icon-yx.png) no-repeat 8px center}
.witkey_con a.i-38{background:url(https://statics.huzhan.com/image/witkey-icon-ch.png) no-repeat 8px center}

.witkey_two{border-bottom:0}
.witkey_two .screen_con{margin-left:0}
.witkey_two .screen_con a{font-size:13px; padding:3px 12px}

.screen_list:last-of-type{
    border: 0;
}

.screen_con .screen_default {
    background: #f60;
    color: #fff;
}

.screen_on{position:relative; padding:10px 0; display:block; background:#f5f5f5; border-radius:1px; margin:15px 26px 10px 26px}
.screen_on h3{width:90px; padding:0 5px 0 0; float:left; text-align:right; height:32px; line-height:32px; font-size:14px; color:#a5abb2}
.screen_on cite{margin:0 85px 0 95px; display:block}
.screen_on cite a{background:#fff url(../../img/evex.png) 9px 7px no-repeat; display:inline-block; margin:3px 8px 3px 0; height:24px; line-height:24px; padding:0 8px 0 22px; border:1px solid #e0e0e0; font-size:12px; box-shadow:2px 2px 0 #eee}
.screen_on cite a:hover{border:#ff6a2f solid 1px; background:#fff url(../../img/evex.png) 9px -16px no-repeat;color:#f60;}
.screen_on a.del_screen{position:absolute; top:16px; right:16px; line-height:20px; height:18px; padding-left:16px; BACKGROUND-POSITION:-306px 3px; color:#0d77a1}
</style>


<div class="screen_box">
	<div class="screen_on"  id="nser"><h3>筛选条件：</h3>
	
		<cite id="xuan">
			<? if($ty1id!=-1){?>
			<span><a href="./" class="g_ac0"><?=$ty1name?></a></span>
			<? }?>
			
			<? if($ty2id!=-1){?>
			<span><a href="search_j<?=$ty1id?>v.html" class="g_ac0"><?=$ty2name?></a></span>
			<? }?>
			
			<? 
			if(returnsx("b")!=-1 || returnsx("c")!=-1){ 
			if(returnsx("c")!=-1 && returnsx("b")!=-1){$tjv=returnsx("b")."-".returnsx("c")."元";}
			elseif(returnsx("c")==-1){$tjv=returnsx("b")."元以上";}
			elseif(returnsx("b")==-1){$tjv=returnsx("c")."元以下";}
			?>
			<span><a href="<?=rentser('b','','c','');?>" class="g_ac0"><?=$tjv?></a></span>
			<? }?>
			
			<? if($skey!=""){?>
			<span><a href="<?=rentser('s','','','');?>" class="g_ac0"><?=$skey?></a></span>
			<? }?>
			
		</cite>
		
		<a href="./" class="icons del_screen">清除筛选</a>
		<script language="javascript">
		a=(document.getElementById("xuan").innerHTML).replace(/\s*/g,"");
		if(a==""){document.getElementById("nser").style.display="none";}
		</script>
	</div>   

	<div class="screen_lists">
	<div class="screen_list screen_witkey" style="border-color:#e0e0e0">
		<div class="witkey_con">
			<? while1("*","yjcode_servertype where admin=1 and zt=0 order by xh asc");
			while($row1=mysqli_fetch_array($res1)){?>
			
			<a class="i-<?=$row1['id']?> <? if(check_in("_j".$row1[id]."v",$getstr)){echo "screen_default";}?>" href="search_j<?=$row1[id]?>v.html"><?=$row1[name1]?></a>
			
			<? }?>
		</div>
	</div>
	<? if($ty1id!=-1){if(panduan("*","yjcode_servertype where admin=2 and zt=0 and name1='".$ty1name."'")==1){?>
	<div class="screen_list witkey_two" style="">
		
		<div class="screen_con">
			<? while1("*","yjcode_servertype where admin=2 and zt=0 and name1='".$ty1name."' order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
			<a href="search_j<?=$ty1id?>v_k<?=$row1[id]?>v.html" <? if(check_in("_k".$row1[id]."v",$getstr) && check_in("_k".$row1[id]."v",$getstr)){?> class="screen_default"<? }?> ><?=$row1[name2]?></a>
			<? }?>
		</div>
	</div>   
	<? }}?>
	</div>
</div>


</div>
<!--筛选E--> 


<!--排序B-->
<div class="paixu">
<div class="d1">
<? 
$pxv=returnsx("f");
$p1s=-1;
$p2s=2;
$p3s=4;
$p4s=6;
$p5s=8;
if($pxv==-1){$p1a="a1";$p1s="1";}elseif($pxv==1){$p1a="a2";$p1s="-1";}
if($pxv==2){$p2a="a1";$p2s="3";}elseif($pxv==3){$p2a="a2";$p2s="2";}
if($pxv==4){$p3a="a1";$p3s="5";}elseif($pxv==5){$p3a="a2";$p3s="4";}
if($pxv==6){$p4a="a1";$p4s="7";}elseif($pxv==7){$p4a="a2";$p4s="6";}
if($pxv==8){$p5a="a1";$p5s="9";}elseif($pxv==9){$p5a="a2";$p5s="8";}
?>
<a href="<?=rentser('f',$p1s,'','');?>"<? if($pxv==-1 || $pxv==1){?> class="<?=$p1a?> g_ac1_h"<? }?>>综合</a>
<a href="<?=rentser('f',$p5s,'','');?>"<? if($pxv==8 || $pxv==9){?> class="<?=$p5a?> g_ac1_h"<? }?>>时间</a>
<a href="<?=rentser('f',$p2s,'','');?>"<? if($pxv==2 || $pxv==3){?> class="<?=$p2a?> g_ac1_h"<? }?>>销量</a>
<a href="<?=rentser('f',$p3s,'','');?>"<? if($pxv==4 || $pxv==5){?> class="<?=$p3a?> g_ac1_h"<? }?>>人气</a>
<a href="<?=rentser('f',$p4s,'','');?>"<? if($pxv==6 || $pxv==7){?> class="<?=$p4a?> g_ac1_h"<? }?>>价格</a>
</div>
<form name="f1" method="post" onSubmit="return psear('_j<?=$ty1id?>v_k<?=$ty2id?>v')">
<div class="d2">
<ul class="u2">
<li class="l4">价格：</li>
<li class="l5"><input name="money1" id="money1" value="<?=$mon1?>" type="text" /></li>
<li class="l6">-</li>
<li class="l5"><input name="money2" id="money2" value="<?=$mon2?>" type="text" /></li>
<li class="l7">关键字：</li>
<li class="l8"><input name="ink1" value="<?=$skey?>" id="ink1" type="text" /></li>
<li class="l9"><input name="" value="搜索" type="submit" /></li>
</ul>
</div>
</form>
</div>
<!--排序E-->

<!--大图列表B-->
<div class="biglist">
<? 
pagef($ses,20,"yjcode_server",$px);
while($row=mysqli_fetch_array($res)){
$au="view".$row[id].".html";
$tp=returntp("bh='".$row[bh]."' order by xh asc","-1");
?>
<ul class="u1">
<li class="l1"><a href="<?=$au?>" target="_blank"><img src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'" style="height:100%;"/><span>查看详情</span></a></li>
<li class="l2"><a href="<?=$au?>" target="_blank"><?=$row[tit]?></a></li>
<li class="l3"><span class="s1"><?=$row[djl]?>人关注</span><span class="s2"><?=$row[money1]?>元</span></li>
</ul>
<? }?>
</div>
<!--大图列表E-->

<div class="npa">
<?
$nowurl="search";
$nowwd="";
require("../tem/page.html");
?>
</div>

</div>
<!--左E-->

<!--右B-->
<div class="listright">
<ul class="u1">
<li class="l1">猜你喜欢</li>
<li class="l2"><a href="./">更多</a></li>
</ul>
<? while1("*","yjcode_server where zt=0 and ifxj=0 and iftj>0 order by iftj asc limit 10");while($row1=mysqli_fetch_array($res1)){?>
<ul class="u2">
<li class="l1"><a href="view<?=$row1[id]?>.html" target="_blank"><img src="<?=returntp("bh='".$row1[bh]."' order by xh asc","-1");?>" /></a></li>
<li class="l2"><a href="view<?=$row1[id]?>.html" target="_blank"><?=$row1[tit]?></a></li>
</ul>
<? }?>

<ul class="u1">
<li class="l1">最近更新</li>
<li class="l2"><a href="./">更多</a></li>
</ul>
<? while1("*","yjcode_server where zt=0 and ifxj=0 order by lastsj desc limit 5");while($row1=mysqli_fetch_array($res1)){?>
<ul class="u2">
<li class="l1"><a href="view<?=$row1[id]?>.html" target="_blank"><img src="<?=returntp("bh='".$row1[bh]."' order by xh asc","-1");?>" /></a></li>
<li class="l2"><a href="view<?=$row1[id]?>.html" target="_blank"><?=$row1[tit]?></a></li>
</ul>
<? }?>

</div>
<!--右E-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>