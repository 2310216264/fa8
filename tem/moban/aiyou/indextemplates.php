<?
include("../../../config/conn.php");
include("../../../config/function.php");
include("../../../config/xy.php");
$sj=date("Y-m-d H:i:s");
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=$rowcontrol[webkey]?>">
<meta name="description" content="<?=$rowcontrol[webdes]?>">
<meta name="shenma-site-verification" content="0610bcba6cd4221c4fdc8978369db0d7_1596425442">
<meta name="sogou_site_verification" content="xMt3VSgToj"/>
<title><?=webname?> - <?=$rowcontrol[webtit]?></title>
<? $cssjsty="b";include("../../../tem/cssjs.html");?>
<script language="javascript" src="homeimg/aiyouImg/index1.js?t=<?=$glosxbh?>"></script>
<script language="javascript" src="homeimg/aiyouImg/layui.js?t=<?=$glosxbh?>"></script>
<script language="javascript" src="homeimg/aiyouImg/common.js?t=<?=$glosxbh?>"></script>
<? if(empty($rowcontrol[ifwap])){?>
<script language="javascript">
if(is_mobile()) {document.location.href= '<?=weburl?>m/';}
</script>
<? }?>
</head>
<body>
	
	
<!--广告-->
<? 
while1("*","yjcode_ad where adbh='ADI00' and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){
$tp=returnjgdw($rowcontrol[addir],"","gg")."/".$row1[bh].".".$row1[jpggif];
$image_size= getimagesize("../../../".$tp);
?>
<div class="topbanner_hj" style="background:url(<?=$tp?>) no-repeat center 0;height:<?=$image_size[1]?>px;"><a href="<?=$row1[aurl]?>" target="_blank"></a></div>
<? }?>
<!--广告-->


<? include("../../../tem/top.html");?>
<? include("../../../tem/top1.html");?>

<div class="yjcode">
<? while1("*","yjcode_ad where adbh='ADLP' and zt=0 order by xh asc limit 1");if($row1=mysqli_fetch_array($res1)){?>
<div class="clear clear10"></div>
<div style="width:1150px;display:none" id="js_ads_banner_top"> 
  <a href="/" rel="nofollow" target=_blank><img src="<?=weburl?><?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh]?>-99.<?=$row1[jpggif]?>" width=1150 height=80></a> 
</div> 
<div style="width:1150px;display:block" id="js_ads_banner_top_slide"> 
  <a href="/" rel="nofollow" target=_blank><img src="<?=weburl?><?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh]?>.<?=$row1[jpggif]?>" width=1150 height=400></a> 
</div> 
<script type=text/javascript src="js/ss.js"></script>
<div class="clear clear10"></div>
<? }?>
</div>

<span id="leftnone" style="display:none">0</span>
<script language="javascript">
leftmenuover();
yhifdis(0);
document.getElementById("topmenu1").className="a1";
</script>

<!--对联广告判断开始-->
<? while1("*","yjcode_ad where adbh='ADDL' and zt=0 order by xh asc limit 1");if($row1=mysqli_fetch_array($res1)){?>
<script language="JavaScript" src="js/dlad.js"></script>
<script language="javascript">
var theFloaters= new floaters();
//右面
theFloaters.addItem('followDiv1','document.body.clientWidth-106',80,'<?=adwhile("ADDL",1)?><span class="dlclo" onclick="dlonc()">关闭</span>');
//左面
theFloaters.addItem('followDiv2',6,80,'<?=adwhile("ADDL",1)?><span class="dlclo" onclick="dlonc()">关闭</span>');
theFloaters.play();
</script>
<? }?>
<!--对联广告判断结束-->

<div class="yjcode">
	<!--左侧评论栏目-->
	<div class="gdmain">
	    <div class="sidebar_top">最新交易</div>
	    <div class="igd" id="Marquee">
	        <!--滚动开始-->
	        <!--滚动结束-->
	        <?
				$i=1;
				while1("*","yjcode_order where (ddzt='wait' or ddzt='db' or ddzt='suc') and admin=2 order by sj desc limit 10");
				while($row1=mysqli_fetch_array($res1)){   
				$tp=returntp("bh='".$row1['probh']."' order by iffm desc","-2");
			?>
	        <div class="gd">
	            <table align="left" width="212">
	                <tbody>
	                    <tr>
	                        <td width="60" valign="middle">
	                            <a href="product/view<?=returnproid($row1['probh'])?>.html" target="_blank">
	                                <img alt="<?=$row1['tit']?>" src="<?=$tp?>" width="53" height="53" class="tp">
	                            </a>
	                        </td>
	                        <td width="152" style="line-height:20px;" overflow="hidden">
	                            <?=returnjiami(returnnc($row1[userid]))?>购买了<br> <span class="hui"><?=strgb2312($row1['tit'],0,9)?><br><?=$row1['sj']?></span>
	                        </td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	        <? $i++;}?>
	    </div>
	</div>
	<!--左侧评论栏目-->
	<script>
	    var Mar = document.getElementById("Marquee");
	    var child_div=Mar.getElementsByTagName("div")
	    var picH = 67;//移动高度
	    var scrollstep=3;//移动步幅,越大越快
	    var scrolltime=20;//移动频度(毫秒)越大越慢
	    var stoptime=3000;//间断时间(毫秒)
	    var tmpH = 0;
	    Mar.innerHTML += Mar.innerHTML;
	    function start(){
	    if(tmpH < picH){
	    tmpH += scrollstep;
	    if(tmpH > picH )tmpH = picH ;
	    Mar.scrollTop = tmpH;
	    setTimeout(start,scrolltime);
	    }else{
	    tmpH = 0;
	    Mar.appendChild(child_div[0]);
	    Mar.scrollTop = 0;
	    setTimeout(start,stoptime);
	    }
	    }
	    setTimeout(start,stoptime);
	</script>
	<!--左侧评论栏目-->

	<!--轮播图-->
	<div class="banner" id="banner">
		<?
		$i=1;
		while1("*","yjcode_ad where adbh='aiyou_02' and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){
		?>
	    <a href="<?=$row1[aurl]?>" rel="nofollow" class="d1" target="_blank" style="background: url(<?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh]?>.<?=$row1[jpggif]?>) center center no-repeat; display: none; z-index: 2;"></a>
	    <?
		$i++;
		}
		?>
	    <div class="d2" id="banner_id">
	        <ul style="margin-left:-156px;">
	        <? for($j=1;$j<$i;$j++){?>	
	        <li class=""></li>
	        <? }?>
	        </ul>
	    </div>
	</div>
	<script type="text/javascript">banner();</script>
	<!--轮播图-->

	<!--公告B-->
	<? $wxlogin=preg_split("/,/",$rowcontrol[wxlogin]);?>
	<div class="ggright">
	<ul class="u1" id="idlno">
	<li class="l1"><a href="reg/reg.php" rel="nofollow" class="a1"></a><a href="reg/" rel="nofollow" class="a2"></a></li>
	<li class="l2">第三方帐号登录：</li>
	<li class="l3">
	<? if($rowcontrol[wxlogin]!="" && $rowcontrol[wxlogin]!=","){?>
	<a rel="nofollow" href="https://open.weixin.qq.com/connect/qrconnect?appid=<?=$wxlogin[0]?>&redirect_uri=<?=urlencode(weburl."reg/wxlogin.php")?>&response_type=code&scope=snsapi_login#wechat_redirect" target="_blank" class="a1"></a>
	<? }?>
	<? if(!empty($rowcontrol[qqappid])){?>
	<a href="<?=weburl?>config/qq/oauth/index.php" rel="nofollow" target="_blank" class="a2"></a>
	<? }?>
	</li>
	</ul>
	
	<ul class="u11" id="idlyes" style="display:none;">
	<li class="l1"><a href="user/" rel="nofollow"><img border=0 src="" id="itouxiang"></a></li>
	<li class="l2">
	<span class="s1">欢 迎 您：<a id="iuserid" href="user/" rel="nofollow"></a></span>
	<span class="s2">可用余额：<span id="imoney"></span>元</span>
	</li>
	
	<li class="l3">
	<a href="user/" rel="nofollow" target="_blank">会员中心</a>
	<a href="user/favpro.php" rel="nofollow" target="_blank">我的收藏</a>
	<a href="user/order.php" rel="nofollow" target="_blank">订单</a>
	<a href="user/jflog.php" rel="nofollow" target="_blank">积分</a>
	<a href="user/un.php" rel="nofollow">退出</a>
	</li>
	</ul>
	
	<script language="javascript">idldl();</script>
	<?
	$inittjarr=array(0,0,0,0);
	$inittjb=preg_split("/,/",$rowcontrol[inittj]);
	for($i=0;$i<count($inittjb);$i++){
	if(is_numeric($inittjb[$i])){$inittjarr[$i]=$inittjb[$i];}
	}
	?>
	<ul class="u2">
	<li class="l1">平台统计指数：</li>
	<li class="l2">商品: <strong><?=$inittjarr[1]+returncount("yjcode_pro where zt=0 and ifxj=0")?></strong> 个</li>
	<li class="l2">会员: <strong><?=$inittjarr[0]+returncount("yjcode_user")?></strong> 位</li>
	<li class="l2">交易: <strong><?=$inittjarr[2]+returncount("yjcode_order where (ddzt='wait' or ddzt='db' or ddzt='back' or ddzt='suc') and admin=1")?></strong> 笔</li>
	<li class="l2">成交: <strong><?=sprintf("%.0f",$inittjarr[3]+returnsum("allmoney3","yjcode_order where admin=1 and ddzt<>'backsuc' and ddzt<>'close'"))?></strong> 元</li>
	</ul>
	<ul class="u3">
	  <li class="l1"></li>
	  <li class="l2"><a href="help/gglist.html" target="_blank"></a></li>
	  <? while0("*","yjcode_gg where zt=0 order by sj desc limit 5");while($row=mysqli_fetch_array($res)){?>
	  <li class="l3">· <a rel="nofollow" href="help/ggview<?=$row[id]?>.html" title="<?=$row[tit]?>" target="_blank"><?=strgb2312($row[tit],0,26)?></a></li>
	  <li class="l4">[<?=dateMD($row[sj])?>]</li>
	  <? }?>
	</ul>
	</div>
	<!--公告E-->
	<!--最新交易修改-->
	<div class="newjy">
	<span class="s1">最新交易</span>
	<span class="s2"></span>
	<ul id="rolltxt">
		<? $i=0;while1("*","yjcode_order where (ddzt='wait' or ddzt='db' or ddzt='suc') and admin=2 order by sj desc limit 10");while($row1=mysqli_fetch_array($res1)){?>
		<li><?=returnjiami(returnnc($row1[userid]))?> 购买了 <span class="bluee"><a rel="nofollow" href="product/view<?=returnproid($row1[probh])?>.html"  target="_blank" ><?=returntitdian($row1[tit],40)?></a></span> 单价：<strong>￥<?=$row1[allmoney3]?></strong> [<?=returnorderzt($row1[ddzt])?>]</li>
		<? $i++;}?>
	</ul>
	</div>
	<span id="jynum" style="display:none;">10</span>
	<script language="javascript" src="js/jy.js?t=<?=$glosxbh?>"></script>
	<!--最新交易修改-->

 <? adwhile("aiyou_06");?>
 <!--推荐产品B-->
 
 <!-- 切换 -->
<div class="index_title">
    <h2><i>New</i></h2>
    <div class="index_tab" style="left:60px;width:700px;">
    	<div class="sell_21"  id="cur"><i></i><span>限时优惠</span></div>
        <div class="sell_11"><i></i><span>今日刷新</span></div>
        <!--<div class="sell_21"><i></i><span>限时优惠</span></div>-->
        <!--<div class="sell_31"><i></i><span>任务</span></div> -->
         <div class="sell_51"><i></i><span>任务</span></div> 
    </div>
    <a target="_blank" rel="nofollow" href="product/">More&gt;</a>
</div>
<!-- 切换 -->

<!-- 今日刷新开始 -->
<div id="sell_11" class="i_c_div" style="display: none;">
  <div class="jrsxmain">
  	
  <?

  $sql="yjcode_pro where zt=0 and ifxj=0 and touchy=0 order by lastsj desc limit 10";
  $i=1;
  while1("*",$sql);while($row1=mysqli_fetch_array($res1)){
  $money1=returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]);
  $au="product/view".$row1[id].".html";
  while2("*","yjcode_user where id=".$row1[userid]);$row2=mysqli_fetch_array($res2);
  ?>
  <ul class="u1<? if($i % 5 ==0){?> u0<? }?>">
  <li class="l1"><a href="<?=$au?>" target="_blank"><img border="0" src="<?=returntp("bh='".$row1[bh]."'","-1")?>" /></a></li>
  <li class="l2"><a href="<?=returnmyweb($row2[id],$row2[myweb])?>" class="a1" target="_blank"><?=$row2[shopname]?></a> | <a href="<?=$au?>" target="_blank" class="a2" title="<?=$row1[tit]?>"><?=$row1[tit]?></a></li>
  <li class="l3" style="color: #ff6900;font-size: 14px;"><h2>￥<?=sprintf("%.2f",$money1)?></h2></li>
  <li class="l4"><a href="<?=$au?>" target="_blank">查看详情</a></li>
  </ul>
  <? $i++;}?>
  </div>
  <!-- 温馨提示 -->
  <? adwhile("aiyou_07");?>
  <!-- 温馨提示 -->
</div>
<!-- 今日刷新结束 -->

<!-- 限时优惠开始 -->
<div id="sell_21" class="i_c_div" >

  
  
  
	<div class="dtj">
	<div class="dtjs">
	<!--推荐位置-->
	<? 
	
	//这里更新推荐是否到期
	$i=1;
	while1("*","yjcode_tuijian where type=1 order by id asc limit 5");while($row1=mysqli_fetch_array($res1)){
	// 有推荐
	if($row1[pro_bh] && $row1[zt]=1){
		
		$sqlss="select * from yjcode_pro where bh='".$row1[pro_bh]."' and zt=0 and ifxj=0";mysqli_set_charset($conn,"utf8");
		$res1s=mysqli_query($conn,$sqlss);
		$row = mysqli_fetch_array($res1s);
		
		$money1=returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]);
		$au="product/view".$row[id].".html";
		$dqsj=str_replace("-","/",$row1[end_time]);
		
		while2("*","yjcode_user where id=".$row[userid]);$row2=mysqli_fetch_array($res2);
	?>
	<ul class="u1">
		<li class="l1">
		<span id="dqsj<?=$i?>" style="display:none;"><?=$dqsj?></span>
		<img border="0" src="<?=returntp("bh='".$row[bh]."'","-1")?>" />
		<div class="d1">
  			<a target="_blank" href="<?=$au?>">
  			<span class="list-name" id="djs<?=$i?>">正在加载</span>
  			<span class="sfont">限时推荐<br>安全放心</span>
  			<em class="look-but">立即购买 ></em>
  			</a>
  		</div>
	</li>
	<li class="l3">
  		<a href="<?=$au?>" target="_blank" title="<?=$row[tit]?>"><?=$row[tit]?></a>
	</li>
  
	<li class="l2" style="width:80px;color: #ff6900;font-size: 14px;"><h2>￥<?=$money1?></h2></li>
	<li class="l5" style="width:123px;padding:4px 5px 6px 1px;">
  	<span style="float:right;">
		<img style="float: left;width: 18px;border-radius: 100%;border: 1px solid #eee;" src="<?=returntppd("../../../upload/".$row[userid]."/shop.jpg","../img/none180x180.gif")?>"> 
		<a style="float: left;color: #777;margin-left: 3px;"title="<?=$row2[shopname]?>" href="<?=returnmyweb($row2[id],$row2[myweb])?>" target="_blank"><?=$row2[shopname]?></a>
	</span>
	</li>
	</ul>
	
	<?}else{?>
	<!--无推荐-->
	<?
		$sqlss="select * from yjcode_pro where bh='".$row1[pro_default]."' and zt=0 and ifxj=0";mysqli_set_charset($conn,"utf8");
		$res1s=mysqli_query($conn,$sqlss);
		$row = mysqli_fetch_array($res1s);
		
		$money1=returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]);
		$au="product/view".$row[id].".html";
		$dqsj=str_replace("-","/",$row[yhsj2]);
		
		while2("*","yjcode_user where id=".$row[userid]);$row2=mysqli_fetch_array($res2);
	?>
	<ul class="u1">
		<li class="l1">
		<span id="dqsj<?=$i?>" style="display:none;"><?=$dqsj?></span>
		<img border="0" src="<?=returntp("bh='".$row[bh]."'","-1")?>" />
		<div class="d1">
  			<a target="_blank" href="<?=$au?>">
  			<span class="list-name" id="djs<?=$i?>">正在加载</span>
  			<span class="sfont">限时销售<br>安全放心</span>
  			<em class="look-but">立即购买 ></em>
  			</a>
  		</div>
	</li>
	<li class="l3">
  		<a href="<?=$au?>" target="_blank" title="<?=$row[tit]?>"><?=$row[tit]?></a>
	</li>
  
	<li class="l2" style="width:80px;color: #ff6900;font-size: 14px;"><h2>￥<?=$money1?></h2></li>
	<li class="l5" style="width:123px;padding:4px 5px 6px 1px;">
  	<span style="float:right;">
		<img style="float: left;width: 18px;border-radius: 100%;border: 1px solid #eee;" src="<?=returntppd("../../../upload/".$row[userid]."/shop.jpg","../img/none180x180.gif")?>"> 
		<a style="float: left;color: #777;margin-left: 3px;"title="<?=$row2[shopname]?>" href="<?=returnmyweb($row2[id],$row2[myweb])?>" target="_blank"><?=$row2[shopname]?></a>
	</span>
	</li>
	</ul>
	<?}?>
 
  <!--推荐位置-->
  <? $i++;}?>
  </div>
  </div>
  
  
  
  
  
  <!-- 热门商品导航 -->
  <div class="index_tj">
      <div>
          <strong>
              热门商品
          </strong>
          <span>
              <? while1("*","yjcode_ad where adbh='aiyou_10' and zt=0 order by xh asc");while($row1=mysqli_fetch_array($res1)){?>
              <a href="<?=$row1[aurl]?>" target="_blank"><?=$row1[tit]?></a>
              <? }?>
          </span>
      </div>
  </div>
  <!-- 热门商品导航 -->
  <!-- 热门商品列表 -->
  <div class="rmlist">
  <?
  $i=1;
  while1("*","yjcode_pro where ifxj=0 and zt=0 and touchy=0 order by xsnum desc limit 8");while($row1=mysqli_fetch_array($res1)){
  $money1=returnyhmoney($row1[yhxs],$row1[money2],$row1[money3],$sj,$row1[yhsj1],$row1[yhsj2],$row1[id]);
  $au="product/view".$row1[id].".html";
  while2("*","yjcode_user where id=".$row1[userid]);$row2=mysqli_fetch_array($res2);
  ?>
  <ul class="u1 ua<?=$i?>">
  <li class="l1">￥<?=sprintf("%.2f",$money1)?></li>
  <li class="l2"><a href="<?=$au?>" target="_blank" title="<?=$row1[tit]?>"><?=$row1[tit]?></a></li>
  <li class="l3"><a href="shop/view<?=$row2[id]?>.html" target="_blank" title="<?=$row2[shopname]?>"><?=$row2[shopname]?></a></li>
  </ul>
  <? $i++;}?>
  </div>
  <!-- 热门商品列表 -->

</div>


<!--限时优惠结束-->

<!--倒计时-->
<script language="javascript">
userChecksj();
</script>
<!-- 限时优惠结束 -->



<div id="sell_51" class="i_c_div" style="display: none;">
<!--任务B-->
<div class="taskm">
<ul class="u1">
<li class="l1 l11" id="taska1" onMouseOver="taskover(1)">热点需求</li>
<li class="l0"><span></span></li>
<li class="l1" id="taska2" onMouseOver="taskover(2)">最新需求</li>
<li class="l0"><span></span></li>
<li class="l1"  onclick="javascript:window.location.href='task/taskadd.php'">发布任务</li>
<li class="l2" style="width:770px;"><a href="task/" rel="nofollow">更多需求>></a></li>
</ul>

<div class="tasklist" id="taskm1">
	<ul class="rwbt">
	<li class="l1">任务标题</li>
	<li class="l2">托管金额</li>
	<li class="l3">任务形式</li>
	<li class="l4">剩余数量</li>
	<li class="l5">总预算</li>
	<li class="l6">任务进度</li>
	<li class="l7">操作</li>
	</ul>
	

	<? while1("*","yjcode_task where (zt=0 or zt=3 or zt=4 or zt=5 or zt=101 or zt=102) order by djl desc limit 8");while($row1=mysqli_fetch_array($res1)){?>
	<ul class="ulist fontyh">
	<li class="l1">
	<a rel="nofollow" href="<?=weburl?>task/view<?=$row1[id]?>.html" title="<?=$row1[tit]?>" target="_blank" class="g_ac2"><?=returntitdian($row1[tit],50)?></a><br>
	<span class="hui"><?=strgb2312(strip_tags($row1[txt]),0,60)?></span>
	</li>
	<li class="l2"><? if($row1[money3]>0){?><span class="s1">已托管金额</span><? }else{?><span class="s2">选标后托管</span><? }?></li>
	<li class="l3"><?=returntaskxs($row1[taskty])?></li>
	
	<?
	
	if(empty($row1[taskty])){
	?>
	<li class="l4">
	<? if(empty($row1[zt])){?><strong>1</strong>份<? }else{?><strong>0</strong>份<? }?>
	</li>
	<? }else{?>
	<li class="l41">
	<span class="s1"><strong><?=$row1[tasknum]-$row1[taskcy]?></strong>份(共<?=$row1[tasknum]?>份)</span>
	<span class="s2"></span>
	<span class="s3" style="width:<? $okbfb=$row1[taskcy]/$row1[tasknum];echo 100*(1-$okbfb);?>px;"></span>
	<span class="s4"><?=sprintf("%.2f",(1-$okbfb)*100)?>%</span>
	</li>
	<? }?>
	<li class="l5"><strong><?=$row1[money1]?></strong>元</li>
	<li class="l6"><?=returntask($row1[zt])?></li>
	<li class="l7">
	<?
	if((empty($row1[taskty]) && 0==$row1[zt]) || (1==$row1[taskty] && 101==$row1[zt])){
	?>
	<a href="<?=weburl?>task/view<?=$row1[id]?>.html" class="a1" rel="nofollow" target="_blank">抢此任务</a>
	<?
	}else{
	?>
	<a href="<?=weburl?>task/view<?=$row1[id]?>.html" class="a2" rel="nofollow" target="_blank">查看任务</a>
	<? }?>
	</li>
	</ul>
	<? }?>


</div>

<div class="tasklist" id="taskm2" style="display:none;">
	<ul class="rwbt">
	<li class="l1">任务标题</li>
	<li class="l2">托管金额</li>
	<li class="l3">任务形式</li>
	<li class="l4">剩余数量</li>
	<li class="l5">总预算</li>
	<li class="l6">任务进度</li>
	<li class="l7">操作</li>
	</ul>

	<? while1("*","yjcode_task where (zt=0 or zt=3 or zt=4 or zt=5 or zt=101 or zt=102) order by sj desc limit 8");while($row1=mysqli_fetch_array($res1)){?>
	<ul class="ulist fontyh">
	<li class="l1">
	<a href="<?=weburl?>task/view<?=$row1[id]?>.html" rel="nofollow" title="<?=$row1[tit]?>" target="_blank" class="g_ac2"><?=returntitdian($row1[tit],50)?></a><br>
	<span class="hui"><?=strgb2312(strip_tags($row1[txt]),0,60)?></span>
	</li>
	<li class="l2"><? if($row1[money3]>0){?><span class="s1">已托管金额</span><? }else{?><span class="s2">选标后托管</span><? }?></li>
	<li class="l3"><?=returntaskxs($row1[taskty])?></li>
	
	<?
	
	if(empty($row1[taskty])){
	?>
	<li class="l4">
	<? if(empty($row1[zt])){?><strong>1</strong>份<? }else{?><strong>0</strong>份<? }?>
	</li>
	<? }else{?>
	<li class="l41">
	<span class="s1"><strong><?=$row1[tasknum]-$row1[taskcy]?></strong>份(共<?=$row1[tasknum]?>份)</span>
	<span class="s2"></span>
	<span class="s3" style="width:<? $okbfb=$row1[taskcy]/$row1[tasknum];echo 100*(1-$okbfb);?>px;"></span>
	<span class="s4"><?=sprintf("%.2f",(1-$okbfb)*100)?>%</span>
	</li>
	<? }?>
	<li class="l5"><strong><?=$row1[money1]?></strong>元</li>
	<li class="l6"><?=returntask($row1[zt])?></li>
	<li class="l7">
	<?
	if((empty($row1[taskty]) && 0==$row1[zt]) || (1==$row1[taskty] && 101==$row1[zt])){
	?>
	<a href="<?=weburl?>task/view<?=$row1[id]?>.html" rel="nofollow" class="a1" target="_blank">抢此任务</a>
	<?
	}else{
	?>
	<a href="<?=weburl?>task/view<?=$row1[id]?>.html" rel="nofollow" class="a2" target="_blank">查看任务</a>
	<? }?>
	</li>
	</ul>
	<? }?>


</div>
</div>
<!--任务E-->
</div>
<!--切换替换结束位置-->

<? adwhile("aiyou_08");?>


<!--推荐商家开始-->
<div class="index_title">
    <h2><i>Shop</i></h2>
    <div class="index_tab" style="left:60px;">
    <div class="no_ck" id="cur"><span>推荐商家</span></div>
    </div>
    <div class="index_tab" style="right:50px;">
    <div class="no_ck" id="cur"><span>近期收入榜</span></div>
    </div>
    <a target="_blank" rel="nofollow" href="<?=weburl?>shop/">More&gt;</a>
</div>

<div class="index_shop">
    <!-- 商家列表 -->
    <div class="shop_sj">
        <div class="8">
            <? 
            while1("*","yjcode_user where zt=1 and shopzt=2 and shopname<>'' and pm>0 order by pm asc limit 8");while($row1=mysqli_fetch_array($res1)){
            $sucnum=returnjgdw($row1[xinyong],"",returnxy($row1[id],1));
            $au=returnmyweb($row1[id],$row1[myweb]);
            ?>
            <ul>
                <li>
                    <a href="<?=$au?>" class="avatar" target="_blank"><img alt="<?=$row1[shopname]?>" src="upload/<?=$row1[id]?>/shop.jpg" onerror="this.src='img/none180x180.gif'" ></a>
                    <span class="info"><a href="<?=$au?>" target="_blank" class="name" title="<?=$row1[shopname]?>"><?=$row1[shopname]?></a>
                    <p class="i_bz"><img class="xy" src="img/dj/<?=returnxytp($sucnum)?>" alt="信用值<?=$sucnum?>"></p>
                    <p><a class="slink" href="<?=$au?>" target="_blank">TA的店铺</a></p>
                    </span>
                    </li>
                    <li class="hot_goods">
                    <strong>TA的宝贝<i>(<?=returncount("yjcode_pro where userid=".$row1[id]." and zt=0 and ifxj=0")?>)</i></strong>
                    <? 
                    while2("*","yjcode_pro where userid=".$row1[id]." and zt=0 and ifxj=0 order by lastsj desc");if($row2=mysqli_fetch_array($res2)){
                    $money1=returnjgdian(returnyhmoney($row2[yhxs],$row2[money2],$row2[money3],$sj,$row2[yhsj1],$row2[yhsj2],$row2[id]));
                    ?>
                    <p>
                        <em>￥<?=sprintf("%.2f",$money1)?></em>
                        <a href="product/view<?=$row2[id]?>.html" target="_blank" title="<?=$row2[tit]?>"><?=$row2[tit]?></a>
                    </p>
                    <? }?>
                </li>
            </ul>
            <? }?>

        </div>
    </div>		
    <!-- 商家列表 -->
    <!-- 近期商家排行 -->
    <div class="shop_ph">
		<? 
		$i=1;while1("*","yjcode_user where shopname<>'' and shopzt=2 and zt=1 order by sellmyue desc limit 5");if($row1=mysqli_fetch_array($res1)){
		$au=returnmyweb($row1[id],$row1[myweb]);
		?>
		<div class="r_s_1">
		<a class="avatar" href="<?=$au?>" target="_blank"><img src="upload/<?=$row1[id]?>/shop.jpg" onerror="this.src='img/none180x180.gif'" /></a>
		<span><i></i>
		<a class="name" href="<?=$au?>" target="_blank"><?=$row1[shopname]?></a>
		<p>收入：<em>￥</em><b><?=$row1[sellmyue]?></b></p> </span>
		</div>
		<? }?>
		<? $a=2;while($row1=mysqli_fetch_array($res1)){$au=returnmyweb($row1[id],$row1[myweb]);?>
		
		<div class="r_s_<?=$a?>">
		<a class="avatar" href="<?=$au?>" target="_blank"><img src="upload/<?=$row1[id]?>/shop.jpg" onerror="this.src='img/none180x180.gif'" /></a>
		<span><i></i>
		<a class="name" href="<?=$au?>" target="_blank"><?=$row1[shopname]?></a>
		<p>收入：<em>￥</em><b><?=$row1[sellmyue]?></b></p> </span>
		</div>
		<? $a++;}?>
    
    </div>
    <!-- 近期商家排行 -->
</div>
<!--推荐商家结束-->
 
 
 
 
 
<!--友情链接-->

<div class="index_title">
    <h2><i>Link</i></h2>
    <div class="index_tab" style="left:60px;">
    <div class="no_ck" id="cur"><span>友情链接</span></div>
    </div>
    <a target="_blank" href="help/aboutview3.html">申请友情链接&gt;</a>
</div>
<dl class="link">
    <dd class="u2">
        <? while0("*","yjcode_ad where adbh='ADI13' and zt=0 order by xh asc");while($row=mysqli_fetch_array($res)){?>
        <a href="<?=$row[aurl]?>" target="_blank" rel="nofollow"><img alt="<?=$row[tit]?>" src="<?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row[bh]?>.<?=$row[jpggif]?>"></a>
        <? }?>
    </dd>
    <dd class="u3">
        <? while0("*","yjcode_ad where adbh='ADI14' and zt=0 and type1='文字' order by xh asc");while($row=mysqli_fetch_array($res)){?>
        <a href="<?=$row[aurl]?>" title="<?=$row[tit]?>" target="_blank"><?=$row[tit]?></a>
        <? }?>
    </dd>
</dl>
<!--友情链接-->

</div>

<? include("../../../tem/bottom.html");?>



</body>
</html>