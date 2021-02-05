<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$getstr=$_GET[str];
$tit="商品列表";

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



$ty1id=returnsx("j");if($ty1id!=-1){
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
$ty4id=returnsx("i");if($ty4id!=-1){$ty4name=returntype(4,$ty4id);$ses=$ses." and ty4id=".$ty4id;$tit=$tit."/".$ty4name;}
$ty5id=returnsx("l");if($ty5id!=-1){$ty5name=returntype(5,$ty5id);$ses=$ses." and ty5id=".$ty5id;$tit=$tit."/".$ty5name;}
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


if(!empty($_SESSION[SHOPUSER])){$myuserid=returnuserid($_SESSION[SHOPUSER]);}
?>

<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$seokey?>">
<meta name="description" content="<?=$seodes?>">
<title><?=$tit?> - <?=webname?></title>
<? include("../tem/cssjs.html");?>
<style type="text/css">
body{background-color:#F2F2F3;}
</style>
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>
<script language="javascript">topjconc(1,'商品');document.getElementById("topt").value="<?=$skey?>";</script>

<div class="yjcode" style="width: 1190px;">

	<? adwhile("ADP03");?>
	
	<!--左边开始-->
	<div class="list_left">
		<!--tab-->
		<div class="screen_box"> 
	    	
			<div class="screen_lists"> 
			
				<!--类型-->
				<div class="screen_list">
	    			<div class="screen_name"><i id="isx-1"></i><span>类型</span>：</div>
	    			<div class="screen_con">
	    				<? while1("*","yjcode_type where admin=1 and id<>3 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
						<a href="search_j<?=$row1[id]?>v.html"  class="<? if(check_in("_j".$row1[id]."v",$getstr)){echo "screen_default";}?>"><?=$row1[type1]?></a>
						<? }?>
	 				</div>
	    		</div>
				
				
				<!--类型1-->
				<? if($ty1id!=-1){if(panduan("*","yjcode_type where admin=2 and type1='".$ty1name."'")==1){?>
	    		<div class="screen_list">
	    			<div class="screen_name"><i id="isx-1"></i><span>类型</span>：</div>
	    			<div class="screen_con" style="overflow:hidden;">
	    				<? while1("*","yjcode_type where admin=2 and type1='".$ty1name."' order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
						<a href="search_j<?=$ty1id?>v_k<?=$row1[id]?>v.html" <? if(check_in("_k".$row1[id]."v",$getstr) && check_in("_k".$row1[id]."v",$getstr)){?> class="screen_default"<? }?>><?=$row1[type2]?></a>
						<? }?>
	 				</div>
	    		</div>
	    		<? }}?>
				
				
				<!--类型2-->
				<? if($ty2id!=-1){if(panduan("*","yjcode_type where admin=3 and type1='".$ty1name."' and type2='".$ty2name."'")==1){?>
				<div class="screen_list">
					<div class="screen_name"><i id="isx-1"></i><span>类型</span>：</div>
					<div class="screen_con">
					<? while3("*","yjcode_type where admin=3 and type1='".$ty1name."' and type2='".$ty2name."' order by xh asc");while($row3=mysqli_fetch_array($res3)){?>
					<a href="search_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$row3[id]?>v.html" <? if(check_in("_m".$row3[id]."v",$getstr)){?> class="screen_default"<? }?>><?=$row3[type3]?></a>
					<? }?>
					</div>
				</div>
				<? }}?>
			
				
				<!--类型3-->
				<? if($ty3id!=-1){if(panduan("*","yjcode_type where admin=4 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."'")==1){?>
				<div class="screen_list">
					<div class="screen_name"><i id="isx-1"></i><span>类型</span>：</div>
					<div class="screen_con" style="overflow:hidden;">
					<? while3("*","yjcode_type where admin=4 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."' order by xh asc");while($row3=mysqli_fetch_array($res3)){?>
					<a href="search_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_i<?=$row3[id]?>v.html" <? if(check_in("_i".$row3[id]."v",$getstr)){?> class="screen_default"<? }?>><?=$row3[type4]?></a>
					<? }?>
					</div>
				</div>
				<? }}?>
				
				
			
				<!--类型4-->
				<? if($ty4id!=-1){if(panduan("*","yjcode_type where admin=5 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."' and type4='".$ty4name."'")==1){?>
				<div class="screen_list">
					<div class="screen_name"><i id="isx-1"></i><span>类型</span>：</div>
					<div class="screen_con" style="overflow:hidden;">
					<? while3("*","yjcode_type where admin=5 and type1='".$ty1name."' and type2='".$ty2name."' and type3='".$ty3name."' and type4='".$ty4name."' order by xh asc");while($row3=mysqli_fetch_array($res3)){?>
					<a href="search_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_i<?=$ty4id?>v_l<?=$row3[id]?>v.html" <? if(check_in("_l".$row3[id]."v",$getstr)){?> class="screen_default"<? }?>><?=$row3[type5]?></a>
					<? }?>
					</div>
				</div>
				<? }}?>
				<!--类型4-->
				
				<? 
				$si=0;
				$sbarr=array();
				while1("*","yjcode_typesx where admin=1 and typeid=".$ty1id." and ifsel=1 order by xh asc");while($row1=mysqli_fetch_array($res1)){
				$ev="e".$row1[id]."_";
				$sbarr[$si]=$ev;
				?>
				
				<div class="screen_list">
					<div class="screen_name"><i id="isx-1"></i><span><?=$row1['name1']?></span>：</div>
				   
					<div class="screen_con <? if($row1['xh']=='2' && $row1['ifjd']=='1' && $row1['typeid']=='1'){?>brand_list<?}?>">
						
					<? while2("*","yjcode_typesx where admin=2 and name1='".$row1[name1]."' and typeid=".$row1[typeid]." order by xh asc");while($row2=mysqli_fetch_array($res2)){
					$ntp="../tem/moban/".$rowcontrol[nowmb]."/homeimg/".$rowcontrol[nowmb]."Img/typesx2_".$row2[id].".png";
					
					?>
					
					<? if($row1['xh']=='2' && $row1['ifjd']=='1' && $row1['typeid']=='1'){ ?>
						<a style="margin: -3px 0px 0px -4px" href="<?=rentser($ev,$row2[id],'','');?>" <? if(check_in("_".$ev.$row2[id]."v",$getstr)){?> class="screen_default"<? }?>><img src="<?=$ntp?>"><b><?=$row2[name2]?></b></a>
					<?}else{?>
					<a href="<?=rentser($ev,$row2[id],'','');?>" <? if(check_in("_".$ev.$row2[id]."v",$getstr)){?> class="screen_default"<? }?>><?=$row2[name2]?></a>
					<?}?>
					<? }?>
					</div>
				</div>
				<? 
				$si++;
				}
				for($si=0;$si<count($sbarr);$si++){if(returnsx($sbarr[$si])!=-1){$nsx="xcf".returnsx($sbarr[$si])."xcf";$ses=$ses." and tysx like '%".$nsx."%'";}}
				?>
				
			</div> 
	     
		    <!--筛选条件-->
		    <div class="screen_on" id="nser"><h3>筛选条件：</h3>
		    	
		    	<cite id="xuan">	
		    	<? if($ty1id!=-1){?>
				<span><a href="./" class="g_ac0"><?=$ty1name?></a></span>
				<? }?>
		    	<? if($ty2id!=-1){?>
				<span><a href="search_j<?=$ty1id?>v.html" class="g_ac0"><?=$ty2name?></a></span>
				<? }?>
				
				<? if($ty3id!=-1){?>
				<span><a href="search_j<?=$ty1id?>v_k<?=$ty2id?>v.html" class="g_ac0"><?=$ty3name?></a></span>
				<? }?>
				
				<? if($ty4id!=-1){?>
				<span><a href="search_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v.html" class="g_ac0"><?=$ty4name?></a></span>
				<? }?>
				
				<? if($ty5id!=-1){?>
					<span><a href="search_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_i<?=$ty4id?>v.html" class="g_ac0"><?=$ty5name?></a></span>
				<? }?>
				
				
				<? 
				for($si=0;$si<count($sbarr);$si++){
				$tsx=returnsx($sbarr[$si]);
				if($tsx!=-1){
				while1("*","yjcode_typesx where id=".$tsx);if($row1=mysqli_fetch_array($res1)){
				if($row1[admin]==2){
				?>
				<span><a href="<?=rentser($sbarr[$si],'','','');?>" class="g_ac0"><?=$row1[name1]."：".$row1[name2]?></a></span>
				<? }}}}?>
				
				
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
				
				<? if($ifjx==1){?>
				<span><a href="<?=rentser('a','','','');?>" class="g_ac0">本站精选</a></span>
				<? }?>
				
				<? if($ifzdfh==1){?>
				<span><a href="<?=rentser('d','','','');?>" class="g_ac0">自动发货</a></span>
				<? }?>
				
				<? if($area1!=-1){?>
				<span><a href="<?=rentser('n','','o','','search','q','');?>" class="g_ac0"><?=returnarea($area1)?></a></span>
				<? }?>
				
				<? if($area2!=-1){?>
				<span><a href="<?=rentser('o','','q','');?>" class="g_ac0"><?=returnarea($area2)?></a></span>
				<? }?>
				
				<? if($area3!=-1){?>
				<span><a href="<?=rentser('q','','','');?>" class="g_ac0"><?=returnarea($area3)?></a></span>
				<? }?>
				</cite>
				
				<a href="./" class="icons del_screen">清除筛选</a>
			</div>
			<script language="javascript">
			a=(document.getElementById("xuan").innerHTML).replace(/\s*/g,"");
			if(a==""){document.getElementById("nser").style.display="none";}
			</script>
			<!--筛选条件-->
			
		</div>
		<!--条件-->
		<div class="proxuan" id="proxuan" style="width:955px;border-radius:0;margin:10px 0;">
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
			<form name="f1" method="post" onSubmit="return psear('_j<?=$ty1id?>v_k<?=$ty2id?>v_m<?=$ty3id?>v_i<?=$ty4id?>v_l<?=$ty5id?>v')">
			<div class="d2">
			<ul class="u2">
			<li class="l2"><label><input id="C1" type="checkbox" value="1"<? if($ifjx==1){?> checked<? }?>> <span>精选</span></label></li>
			<li class="l2"><label><input id="C2" type="checkbox" value="1"<? if($ifzdfh==1){?> checked<? }?>> <span>自动发货</span></label></li>
			<li class="l2"><label><input id="C3" type="checkbox" value="1"<? if($ifuserdj==1){?> checked<? }?>> <span>会员折扣</span></label></li>
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
		</div>
		<!--条件-->
		
		
		<!--列表-->
<? 
function tyxs($tyxs){
	$a=preg_split("/xcf/",$tyxs);
	$rowarea=array();
	global $conn;
	for($i=2;$i<4;$i++){
		$sqlarea="select name2 from yjcode_typesx where id='".$a[$i]."'";mysqli_set_charset($conn,"utf8");$resarea=mysqli_query($conn,$sqlarea);
		$rowarea=mysqli_fetch_array($resarea);
		$ty .= $rowarea[name2].'/';
	}
	return rtrim($ty,'/');
}


// function whiless1($wzd,$wses){global $res1;global $conn;$sql1="select ".$wzd." from ".$wses;mysqli_set_charset($conn,"utf8");$res1=mysqli_query($conn,$sql1);}
pagef($ses,20,"yjcode_pro",$px);

?>

<? if(empty($ty1propx)){?>

<div class="biglist" style="width:955px;">

<?
$i=1;
while($row=mysqli_fetch_array($res)){
$au="view".$row[id].".html";
while1("*","yjcode_user where id=".$row[userid]);$row1=mysqli_fetch_array($res1);
$tit=strgb2312($row[tit],0,60);
if(!empty($skey)){$tit=str_replace($skey,"<span class='red'>".$skey."</span>",$tit);}
$tp=returntp("bh='".$row[bh]."' order by xh asc","-1");
$xy=returnjgdw($row1[xinyong],"",returnxy($row[userid],1));
$usertx="../upload/".$row[userid]."/user.jpg";
$ty = tyxs($row[tysx]);
// $ty=$row[tysx];

?>
<div class="clist" style="margin:0;">
<div class="list_items">
    <dl>
        <dt>
            <a href="<?=$au?>" target="_blank" class="pic">
                <img onerror="this.src='../img/none180x180.gif'" src="<?=$tp?>">
            </a>
            <div class="ly" style="display:none;">
                <span></span>
                <span class="cdes"><?=$row[tit]?></span>
                <cite>
                	<a href="<?=$au?>" class="xq" target="_blank"><i class="icons"></i>查看详情</a>
                	<? if(empty($row[ysweb])){?>
                		<a href="javascript:;"  class="ys"><i class="icons"></i>无演示站</a>
                	<? }else{?>
                		<a href="https://demo.a8zhan.com/product/demo.php?id=<?=$row[id]?>" rel="nofollow" target="_blank" class="ys"><i class="icons"></i>查看演示</a>
                	<? }?>
                </cite>
            </div>
        </dt>
        <dd>
        	<p class="attr">
        	<em>￥<strong><?=returnjgdian(returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]))?></strong></em>
        	<span>分类：<?=$ty?></span></p>
        	<p class="title">
        	<a href="<?=$au?>" title="<?=$row[tit]?>" target="_blank"><?=$row[tit]?></a></p>
        	<p class="info">
        	<a href="<?=$au?>" class="list_seller tips tipso_style" target="_blank" t-fc="#333" t-bg="#fff" t-bc="#fff" t-bs="0 0 16px 0 rgba(53,53,53,.2)" t-w="246px">
        	<img class="pic_Layer" src="<?=returntppd("../upload/".$row[userid]."/shop.jpg","../img/none180x180.gif")?>"></a>  	     
        	<span class="note_icon">
        		<? if($row[fhxs]==2 || $row[fhxs]==3 || $row[fhxs]==4){?>
        		<a href="javascript:;" T-bg='#b68571' class="tips tipso_style zidong">
        			<i class="send" rel="nofollow" title="">自</i>
        		</a>
        		<? }else{?>
        		<a href="#" rel="nofollow" class="tips tipso_style shou" ><i>手</i></a>
        		<? }?>
        		
        		<? if(1==$row[ifuserdj]){?>
        		<a rel="nofollow" class="tips tipso_style zhe"><i class="install0">折</i></a>
        		<? }?>
        		
        		<? if($row1[baomoney]>0){?>
        		<a rel="nofollow" href="<?=returnmyweb($row[id],$row[myweb])?>" class="tips tipso_style bao-t" data-mn="<?=sprintf("%.2f",$row1[baomoney])?>"><i class="protect">保</i></a>
        		<? }?>
        	</span>
        	</p>
        </dd>
    </dl>
</div>
</div>

<? $i++;}?>

</div>

<!--图片E-->
<? }?>




<div class="npa">
<?
$nowurl="search";
$nowwd="";
require("../tem/page.html");
?>
</div>
		<!--列表-->
	
	
	


	</div>
	<!--左边结束-->
	
	<!--右边区域开始-->
	<div class="list_right">
		<div class="lrtop"> 
		<div class="lrtop_help"> 
			<dl class="tit"> 
				<cite> <a class="curr">买家帮助</a> <a class="">卖家帮助</a> </cite> 
			</dl> 
			<dl class="post"> 
				<div class=""> 
					<a class="curr" rel="nofollow"><em><i class="iconfont"></i></em><p>如何购买</p></a> 
					<a class="" rel="nofollow"><em><i class="iconfont"></i></em><p>如何收货</p></a> 
					<a class="" rel="nofollow"><em><i class="iconfont" style="font-size: 28px;line-height: 33px;"></i></em><p>交易流程</p></a> 
				</div> 
				<div class="hide"> 
					<a class="curr" rel="nofollow"><em><i class="iconfont"></i></em><p>如何出售</p></a> 
					<a class="" rel="nofollow"><em><i class="iconfont"></i></em><p>如何发货</p></a> 
					<a class="" rel="nofollow"><em><i class="iconfont" style="font-size: 28px;line-height: 33px;"></i></em><p>交易规则</p></a> 
				</div> 
			</dl> 
		</div> 
	     
	    <script>
	    	$(".tlist ul,.tasklist ul").hover(function() {
    			$(this).addClass("curr")
		    }, function() {
		        $(this).removeClass("curr")
		    });
		    $(".tit a").on("click", function() {
		        $(this).addClass("curr").siblings().removeClass("curr");
		        $($(this).parent().parent().next().children().get($(this).index())).removeClass("hide").siblings().addClass("hide")
		    });
	    </script>
	 

		<div class="lrtop_xu">
			<dl class="tit">
				<em></em> <span>任务需求</span>
			</dl>
			<dl class="box scroll-box" times="3000" items="3" style="overflow: hidden; position: relative; height: 195px;">
				<ul style="position: absolute; margin: 0px; padding: 0px;">
					<? while1("*","yjcode_task where (zt=0 or zt=3 or zt=4 or zt=5 or zt=101 or zt=102) order by sj desc limit 3");while($row1=mysqli_fetch_array($res1)){?>
					<li style="margin: 0px; padding: 0px; height: 65px;">
						<a rel="nofollow" href="<?=weburl?>task/view<?=$row1[id]?>.html" target="_blank" title="<?=$row1[tit]?>">
							<i><?=returntitdian($row1[tit],10)?></i><b>￥<?=$row1[money1]?></b> 
							<div><?=returntitdian($row1[tit],10)?></div>
						</a>
					</li>
					<? }?>
				</ul>
			</dl>
			<dl class="post">
				<a href="<?=weburl?>task/taskadd.php" rel="nofollow" target="_blank"><i class="icons i-post"></i><span>发布需求</span></a><a href="<?=weburl?>task/" rel="nofollow" target="_blank"><i class="icons i-all"></i><span>全部需求</span></a></dl>
		</div>
		</div>
		<!--店长推荐-->
		<div class="right_rec">
			<h3><span>掌柜推荐</span> <i class="ad_tips" title="广告推广信息">AD</i></h3>
			
			<?
			
			$i=1;
			while1("*","yjcode_tuijian where type=2 order by id asc limit 5");while($row1=mysqli_fetch_array($res1)){
			// 有推荐
			if($row1[pro_bh] && $row1[zt]=1){
				$sqlss="select * from yjcode_pro where bh='".$row1[pro_bh]."' and zt=0 and ifxj=0";mysqli_set_charset($conn,"utf8");
				$res1s=mysqli_query($conn,$sqlss);
				$row = mysqli_fetch_array($res1s);
				$au = "view".$row[id].".html";
				while2("*","yjcode_user where id=".$row[userid]);$row2=mysqli_fetch_array($res2);
				$tit=strgb2312($row[tit],0,60);
				$tp=returntp("bh='".$row[bh]."' order by xh asc","-1");
				$xy=returnjgdw($row2[xinyong],"",returnxy($row[userid],1));
				$usertx="../upload/".$row[userid]."/user.jpg";
			?>
			<dl>
				<dt>
					<a href="<?=$au?>" target="_blank" class="pic">
						<img onerror="this.src='../img/none180x180.gif'" src="<?=$tp?>">
					</a>
					<div class="ly">
						<a href="<?=$au?>" target="_blank">
						<span style="left:0;"></span>
						<span class="cdes"><?=$row[tit]?></span>
						</a>
						<cite>
							<a href="<?=$au?>" class="xq" target="_blank"><i class="icons"></i>查看详情</a>
		                	<? if(empty($row[ysweb])){?>
		                		<a href="javascript:;" rel="nofollow" class="ys"><i class="icons"></i>无演示站</a>
		                	<? }else{?>
		                		<a href="<?=$row[ysweb]?>" rel="nofollow" target="_blank" class="ys"><i class="icons"></i>查看演示</a>
		                	<? }?>
						</cite>
					</div>
				</dt>
				<dd>
					<a class="title" href="<?=$au?>" title="<?=$row[tit]?>" target="_blank"><?=$row[tit]?></a>
					<div class="info"><em>￥<strong><?=returnjgdian(returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]))?></strong></em>
						<p class="note_icon">
							<? if($row[fhxs]==2 || $row[fhxs]==3 || $row[fhxs]==4){?>
		        		<a href="javascript:;" rel="nofollow" T-bg='#b68571' class="tips tipso_style zidong">
		        			<i class="send" title="">自</i>
			        		</a>
			        		<? }else{?>
			        		<a href="/help/list/26" rel="nofollow" class="tips tipso_style shou" ><i>手</i></a>
			        		<? }?>
			        		<? if($row2[baomoney]>0){?>
			        		<a href="/protection/" rel="nofollow" class="tips tipso_style bao-t" data-mn="<?=sprintf("%.2f",$row2[baomoney])?>"><i class="protect">保</i></a>
			        		<? }?>					
						</p>
					</div>
				</dd>
			</dl>
			
			<?}else{?>
			<?
				$sqlss="select * from yjcode_pro where bh='".$row1[pro_default]."' and zt=0 and ifxj=0";mysqli_set_charset($conn,"utf8");
				$res1s=mysqli_query($conn,$sqlss);
				$row = mysqli_fetch_array($res1s);
				$au = "view".$row[id].".html";
				while2("*","yjcode_user where id=".$row[userid]);$row2=mysqli_fetch_array($res2);
				$tit=strgb2312($row[tit],0,60);
				$tp=returntp("bh='".$row[bh]."' order by xh asc","-1");
				$xy=returnjgdw($row2[xinyong],"",returnxy($row[userid],1));
				$usertx="../upload/".$row[userid]."/user.jpg";
			?>
			<dl>
				<dt>
					<a href="<?=$au?>" target="_blank" class="pic">
						<img onerror="this.src='../img/none180x180.gif'" src="<?=$tp?>">
					</a>
					<div class="ly">
						<a href="<?=$au?>" target="_blank">
						<span style="left:0;"></span>
						<span class="cdes"><?=$row[tit]?></span>
						</a>
						<cite>
							<a href="<?=$au?>" class="xq" target="_blank"><i class="icons"></i>查看详情</a>
		                	<? if(empty($row[ysweb])){?>
		                		<a href="javascript:;" rel="nofollow" class="ys"><i class="icons"></i>无演示站</a>
		                	<? }else{?>
		                		<a href="<?=$row[ysweb]?>" rel="nofollow" target="_blank" class="ys"><i class="icons"></i>查看演示</a>
		                	<? }?>
						</cite>
					</div>
				</dt>
				<dd>
					<a class="title" href="<?=$au?>" title="<?=$row[tit]?>" target="_blank"><?=$row[tit]?></a>
					<div class="info"><em>￥<strong><?=returnjgdian(returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]))?></strong></em>
						<p class="note_icon">
							<? if($row[fhxs]==2 || $row[fhxs]==3 || $row[fhxs]==4){?>
		        		<a href="javascript:;" rel="nofollow" T-bg='#b68571' class="tips tipso_style zidong">
		        			<i class="send" title="">自</i>
			        		</a>
			        		<? }else{?>
			        		<a href="/help/list/26" rel="nofollow" class="tips tipso_style shou" ><i>手</i></a>
			        		<? }?>
			        		<? if($row2[baomoney]>0){?>
			        		<a href="/protection/" rel="nofollow" class="tips tipso_style bao-t" data-mn="<?=sprintf("%.2f",$row2[baomoney])?>"><i class="protect">保</i></a>
			        		<? }?>					
						</p>
					</div>
				</dd>
			</dl>
			<?}?>
			<? $i++;}?>
			<? if($ty1id==1){?>
			<div class="g_box" style="margin:15px 0 0 0;">
			<? adwhile("ADP01",0,220,220)?>
			<!--<a href="" target="_blank"><img src="https://statics.huzhan.com/ad/CR1_1627921744.jpg?20200717" title="" alt="" border="0" height="220" width="220"></a>-->
			</div>
			<? }?>
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
		$(".list .slist").hover(function() {
		    $(this).addClass("slcur")
		},
		function() {
		    $(this).removeClass("slcur")
		});
		$(".tlist ul,.tasklist ul").hover(function() {
		    $(this).addClass("curr")
		},
		function() {
		    $(this).removeClass("curr")
		});
		</script>
		<!--店长推荐-->
	</div>
	<!--右边区域结束-->
</div>
<? include("../tem/bottom.html");?>
</body>
</html>