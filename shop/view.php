<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$myweb=$_GET[str];

if(empty($myweb)){$uid=intval($_GET[id]);$ses="id=".$uid."";}else{$ses="myweb='".$myweb."'";}

$sqluser="select * from yjcode_user where zt=1 and (shopzt=2 or shopzt=4) and ".$ses;mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("./");}
if(4==$rowuser[shopzt]){php_toheader(weburl."shop/dqview".$rowuser[id].".html");}
$uid=$rowuser[id];
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$rowuser[shopname]?>的网上店铺 - <?=webname?></title>
<? $cssjsty="a";include("../tem/cssjs.html");?>
<link href="<?=weburl?>shop/shop.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?=weburl?>shop/js/index.js"></script>
<script language="javascript" src="<?=weburl?>js/tipso.min.js"></script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("shopmenu1").className="a1";
</script>

<? $ses="yjcode_shopbannar where userid=".$rowuser[id]." and zt=0";if(returncount($ses)>0){?>
<!--切换B-->
<div class="banner" id="banner" >
<? $i=0;while1("*",$ses." order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
<a href="<?=$row1[aurl]?>" class="d1"<? if(2==$row1[targ]){?> target="_blank"<? }?> style="background:url(../upload/<?=$row1[userid]?>/shopbannar_<?=$row1[bh]?>.jpg) center no-repeat;"></a>
<? $i++;}?>
<div class="d2" id="banner_id">
<ul style="margin-left:-<?=16*$i/2?>px;">
<? for($j=0;$j<$i;$j++){?><li></li><? }?>
</ul>
</div>
</div>
<script type="text/javascript">banner();</script>
<!--切换E-->
<div class="bfb"></div>
<? }?>

<div class="bfb bfbshop">
<div class="yjcode">

<!--左B-->
<? include("left.php");?>
<!--左E-->

<!--右B-->
<div class="iright">

<div class="rcap">
<div class="d1">店铺描述</div>
<div class="d2"><a href="<?=weburl?>shop/aboutview<?=$rowuser[id]?>.html">More>></a></div>
</div>
<div class="gywm">
<?=returnjgdw($rowuser[seodes],"","这家伙很懒，没写说明")?>
</div>


<div class="rcap">
<div class="d1">最新交易</div>
</div>
<div class="newjy">
<span class="icon"></span>
<ul id="rolltxt">
<? $i=0;while1("*","yjcode_order where (ddzt='wait' or ddzt='db' or ddzt='suc') and selluserid=".$uid." and admin=2 order by sj desc limit 20");while($row1=mysqli_fetch_array($res1)){?>
<li><?=returnjiami(returnnc($row1[userid]))?> 购买了 <span class="s1"><?=returntitdian($row1[tit],46)?></span> 单价：<span class="s2">￥<?=$row1[money1]?></span> [<?=returnorderzt($row1[ddzt])?>] </li>
<? $i++;}?>
</ul>
</div>
<span id="jynum" style="display:none;"><?=$i?></span>
<script language="javascript" src="<?=weburl?>shop/jy.js"> </script>

<div class="rcap">
<div class="d1">最新商品</div>
<div class="d2"><a href="<?=weburl?>shop/prolist_i<?=$rowuser[id]?>v.html">More>></a></div>
</div>



<style>
/*自动发货 标志*/
cite, em, i{font-style: normal;}
.clist dt .ly cite .xq i{background-position: -250px -217px;}
.clist dt .ly cite i{width: 25px; height: 25px; margin: 3px; background: url('./img/focus2018.png') no-repeat;}}
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
.plist{padding:10px 0px 0px 10px;}
.listss{float: left; width: 214px; margin: 0 0 10px 10px;}
.listss ul{width: 205px; float: left; padding: 5px; background: #fff; border: #F3F1F1 solid 1px}
.pic{overflow: hidden; float: left;width: 205px; height: 170px;}
.listss .sinfo{width: 95%; float: left; border-top: 1px solid #f5f5f5; padding: 2px 1%;padding: 2.5px 5px;}
.listss img{width: 100%;}
.listss a.sname{display: inline-block; color: #666; line-height: 20px; height: 40px; overflow: hidden; word-wrap: break-word; word-break: break-all; margin-top: 3px; width: 100%;}
.listss .sprice{padding: 5px 0 0 0;}
.listss em{float: left; height: 19px; line-height: 20px; font-size: 14px;}
.listss .sprice b{color: #f1453a;}
.listss span{float: right; margin-right: -5px;}
</style>

<div class="plist">

<?


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
			$sess="zt=0 and ifxj=0 and touchy=0";
		}else{
			$sess="zt=0 and ifxj=0";
		}
	//晚上
	}else if(in_array($H,$touchy_b_time)){
		$sess="zt=0 and ifxj=0";
	}else{
		$sess="zt=0 and ifxj=0 and touchy=0";
	}
}else{
	//关闭隐藏
	$sess="zt=0 and ifxj=0 and touchy=0";
}


while1("*","yjcode_pro where userid=".$uid." and ".$sess." order by lastsj desc limit 8");while($row1=mysqli_fetch_array($res1)){
while0("*","yjcode_user where id=".$row1[userid]);$row=mysqli_fetch_array($res);	
$au="../product/view".$row1[id].".html";
$tp=returntp("bh='".$row1[bh]."' order by iffm desc","-2");

?>

<div class="listss"> 
<ul> 
<a href="<?=$au?>" class="pic" target="_blank">
<img title="<?=$row1[tit]?>"  src="<?=$tp?>" onerror="this.src='./img/none180x180.gif'">
</a> 
<li class="sinfo"> 
<a href="<?=$au?>" class="sname"> <?=$row1[tit]?> </a> 
<p class="sprice"> <em><b>￥<?=returnjgdian(returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]))?></b></em> 

<span class="note_icon">
<? if($row1[fhxs]==2 || $row1[fhxs]==3 || $row1[fhxs]==4){?>
<a href="javascript:;" T-bg='#b68571' class="tips tipso_style zidong" title='自动发货商品，拍下后，即可收到来自该商品的发货（下载）链接'  target="_blank">
<i class="send" title="自动发货商品">自</i>
</a>
<? }else{?>
<a href="javascript:;" class="tips tipso_style shou" ><i>手</i></a>
<? }?>

<? if(1==$row1[ifuserdj]){?>
<a class="tips tipso_style zhe"><i class="install0">折</i></a>
<? }?>


<? if($row[baomoney]>0){?>
<a href="#" class="tips tipso_style bao-t" data-mn="<?=sprintf("%.2f",$row[baomoney])?>" ><i class="protect">保</i></a>
<? }?>
</span> 
</p>
</li> 
</ul> 
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
</script>





<div class="rcap">
<div class="d1">最新服务</div>
<div class="d2"><a href="<?=weburl?>shop/serlist_i<?=$rowuser[id]?>v.html">More>></a></div>
</div>


<div class="plist">
<? 
while1("*","yjcode_server where userid=".$uid." and zt=0 and ifxj=0 order by lastsj desc limit 8");while($row1=mysqli_fetch_array($res1)){
$au="../serve/view".$row1[id].".html";
$tp=returntp("bh='".$row1[bh]."' order by iffm desc","-1");
?>
<div class="listss"> 
<ul>
<a href="<?=$au?>" class="pic" target="_blank">
<img title="<?=$row1[tit]?>"  src="<?=$tp?>" onerror="this.src='../img/none180x180.gif'" style="height:100%;"> 
</a> 
<li class="sinfo"> 
<a href="<?=$au?>" class="sname"> <?=$row1[tit]?> </a> 
<p class="sprice"> <em><b>￥<?=returnjgdian($row1[money1])?></b></em> 
<span class="note_icon">
<a href="javascript:;">
<i class="send">成交：<?=$row1[xsnum]?>次</i>
</a>
</span> 
</p> 
</li> 
</ul> 
</div>
<? }?>
</div>



<div class="rcap">
<div class="d1">客户评价</div>
<div class="d2"><a href="<?=weburl?>shop/pjlist_i<?=$rowuser[id]?>v.html">More>></a></div>
</div>
<?
$a1=returncount("yjcode_order where selluserid=".$uid." and admin=1 and ifpj=1 and pf1=1")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf2=1")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf3=1");
$a2=returncount("yjcode_order where selluserid=".$uid." and admin=1 and ifpj=1 and pf1=2")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf2=2")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf3=2");
$a3=returncount("yjcode_order where selluserid=".$uid." and admin=1 and ifpj=1 and pf1=3")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf2=3")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf3=3");
$a4=returncount("yjcode_order where selluserid=".$uid." and admin=1 and ifpj=1 and pf1=4")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf2=4")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf3=4");
$a5=returncount("yjcode_order where selluserid=".$uid." and admin=1 and ifpj=1 and pf1=5")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf2=5")+returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1 and pf3=5");
$al=$a1+$a2+$a3+$a4+$a5;
if($al==0){$a1v=0;$a2v=0;$a3v=0;$a4v=0;$a5v=0;}
else{
$a1v=sprintf("%.1f",$a1/$al*100);
$a2v=sprintf("%.1f",$a2/$al*100);
$a3v=sprintf("%.1f",$a3/$al*100);
$a4v=sprintf("%.1f",$a4/$al*100);
$a5v=sprintf("%.1f",$a5/$al*100);
}
$hp=returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and pjlx=1 and admin=1");
$pa=returncount("yjcode_order where selluserid=".$uid." and ifpj=1 and admin=1");
if($pa==0){$av="100";}else{$av=sprintf("%.2f",$hp/$pa*100);}
?>
<ul class="pjcap">
<li class="l1"><span>好评率</span><strong><?=$av?>%</strong></li>
<li class="l1"><span>综合得分</span><strong><?=round(($mspf+$fhpf+$shpf)/3,2)?></strong></li>
<li class="l2">描述相符：<span><?=$mspf?></span>分<br>发货速度：<span><?=$fhpf?></span>分<br>服务态度：<span><?=$shpf?></span>分</li>
</ul>
<div class="pjcap1">
<ul class="u1">
<li class="l1"><span class="s0"><img src="<?=weburl?>shop/img/pjf1.gif" /></span><span class="s1"><strong>1</strong>分</span><span class="s2" style="width:<?=returnjgdw($a1v*1.2,"",1)?>px"></span><span class="s3"><?=$a1v?>%</span></li>
<li class="l1"><span class="s0"><img src="<?=weburl?>shop/img/pjf2.gif" /></span><span class="s1"><strong>2</strong>分</span><span class="s2" style="width:<?=returnjgdw($a2v*1.2,"",1)?>px"></span><span class="s3"><?=$a2v?>%</span></li>
<li class="l1"><span class="s0"><img src="<?=weburl?>shop/img/pjf3.gif" /></span><span class="s1"><strong>3</strong>分</span><span class="s2" style="width:<?=returnjgdw($a3v*1.2,"",1)?>px"></span><span class="s3"><?=$a3v?>%</span></li>
<li class="l1"><span class="s0"><img src="<?=weburl?>shop/img/pjf4.gif" /></span><span class="s1"><strong>4</strong>分</span><span class="s2" style="width:<?=returnjgdw($a4v*1.2,"",1)?>px"></span><span class="s3"><?=$a4v?>%</span></li>
<li class="l1"><span class="s0"><img src="<?=weburl?>shop/img/pjf5.gif" /></span><span class="s1"><strong>5</strong>分</span><span class="s2" style="width:<?=returnjgdw($a5v*1.2,"",1)?>px"></span><span class="s3"><?=$a5v?>%</span></li>
</ul>
</div>
<? 
while1("*","yjcode_order where selluserid=".$uid." and admin=2 and ifpj=1 order by sj desc limit 10");while($row1=mysqli_fetch_array($res1)){
$usertx="../upload/".$row1[userid]."/user.jpg";
if(!is_file($usertx)){$usertx="../user/img/nonetx.gif";}else{$usertx=$usertx."?id=".rnd_num(1000);}
$pjlx=returnjgdw($row1[pjlx],"",1);
if($pjlx==1){$pj="好评";}
elseif($pjlx==2){$pj="一般";}
elseif($pjlx==3){$pj="差评";}
?>
<div class="pj pj<?=$pjlx?>">
<ul class="u1"><li class="l1"><img src="../user/img/nonetx.gif" width="50" height="50" /></li><li class="l2"><?=returnjiami(returnnc($row1[userid]))?></li></ul>
<ul class="u2">
<li class="l1">
<?=strip_tags($row1[pjtxt])?><br>
<? 
if(1==$row1[ifpjtp]){
while2("*","yjcode_tp where bh='".$row1[zuorderbh]."' order by xh asc");while($row2=mysqli_fetch_array($res2)){$tp="../".str_replace(".","-1.",$row2[tp]);
?>
<a href="../<?=$row2[tp]?>" target="_blank"><img src="<?=$tp?>" width="50" height="50" /></a>&nbsp;&nbsp;
<? }}?>
</li>
<li class="l3"><?=$row1[pjsj]?></li>
</ul>
<div class="d2"><span class="s<?=$pjlx?>"><?=$pj?></span></div>
</div>
<? }?>

</div>
<!--右E-->

</div>
</div>
<? include("../tem/bottom.html");?>
</body>
</html>