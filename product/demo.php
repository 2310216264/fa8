<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$id=$_GET[id];
while0("*","yjcode_pro where zt<>99 and id=".$id);if(!$row=mysqli_fetch_array($res)){php_toheader("../");}
$nowmoney=returnyhmoney($row[yhxs],$row[money2],$row[money3],$sj,$row[yhsj1],$row[yhsj2],$row[id]);
$au="view".$row[id].".html";
?>
<!DOCTYPE html>
<html class="webkit safari  win webkit safari  win"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$row[tit]?>-<?=webname?></title> 
<meta name="keywords" content="<?=returnjgdw($row[wkey],"",$row[tit])?>,<?=webname?>">
<meta name="description" content="<?=delhtml(returnjgdw($row[wdes],"",strgb2312(strip_tags($row[txt]),0,100)))?>,<?=webname?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta http-equiv ="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon"> 
<link rel="stylesheet" href="./demo/css/livedemo.css" type="text/css">
<script src="./demo/js/jquery-min-1.7.js" type="text/javascript"></script>
</head> 

<body id="demo-page" class="is-responsive"> 
<div class="relative js-demo-upper-menu js-template-id " id="headerlivedemo"> 
<div id="advanced" style="margin-top: 0px;"> 
<div class="bg"> 
<div class="top_container live-container"> 
<a id="brand_livedemo" class="brand brand_livedemo" href="https://www.a8zhan.com/product/<?=$au?>"></a> 
<div class="name_template"> 
<h1 title="<?=$row[tit]?>"><a href="https://www.a8zhan.com/product/<?=$au?>" title="<?=$row[tit]?>-<?=webname?>"><?=$row[tit]?> - <?=webname?></a></h1> 
</div> 
<!--卖家B-->
<div class="js-demo-bar-phone demo-bar-phone block"> 
<!--<a class="js-popup-open" data-popupi="js-popupi-1"><span class="phone-inner">联系客服</span></a>-->
<!--<div class="box-drop js-popup-content js-popupi-1"> -->
<!--<ul class="list-drop"> -->
<!--<li class="js-demo-list-li"><a>2449976837</a></li>-->
<!--<li class="js-demo-list-li"><a>2449976837</a></li>-->
<!--</ul> -->
<!--</div>-->
</div> 
<!--卖家E-->
<div class="responsive-block"> 
<ul id="responsivator"> 
<li class="response active" id="desktop"></li> 
<li class="response" id="tablet-portrait"></li> 
<li class="response" id="tablet-landscape"></li> 
<li class="response" id="iphone-portrait"></li> 
<li class="response" id="iphone-landscape"></li> 
<li id="qr" class="qr"> 
<div class="_slide-down1 view_options"> 
<div id="qr-open" class="js-popup-open" data-popupi="js-popupi-2"><span></span></div> 
<div id="qr-content" class="clearfix js-popup-content js-popupi-2" style="display:none"> 
<div class="img-wrapper"> 
<div class="tm-icon icon-cross icon-close"></div>
<span id="qrcode"></span>
</div> 
<div id="qr-text">移动设备预览</div> 
<div class="clear"></div> 
</div> 
</div> </li> 
</ul> 
</div>

<!--右侧-->
<div class="topbar_info"> 
<div class="btn-group buy_now"> 
<a href="https://www.a8zhan.com/product/<?=$au?>"><span class="button btn-important tm-icon icon-download js-demo-buy-button js-btn" id="livedemo-buy-now-variant-regular"><span class="btn-inner">立即购买</span></span></a>
</div>

<div id="livedemo-offer-trigger" class="price-wrapper regular js-offer-trigger js-popup-open dropdown-arrow" data-popupi="js-popupi-3"> 
<span class="price-title">查看源码详情<span id="buy-button" class="icon-arrow-small-down" data-toggle="dropdown"></span></span> 
<span class="price  js-price js-price-topbar">￥<?=sprintf("%.2f",$nowmoney)?></span> 
</div> 
	<!--系统参数-->
	<div class="box-drop js-popup-content js-popupi-3" id="dropdown" style=""> 
		<ul class="list-drop"> 
			<? 
			$a=preg_split("/xcf/",$row[tysx]);
			$sx1arr=array();
			$sxall="xcf";
			$m=0;
			for($i=0;$i<=count($a);$i++){
			$ai=$a[$i];
			if($ai!=""){
			if(!is_numeric($ai)){$z1=preg_split("/:/",$ai);$ai=$z1[0];}
			while1("*","yjcode_typesx where id=".$ai);if($row1=mysqli_fetch_array($res1)){
			while2("*","yjcode_typesx where name1='".$row1[name1]."' and admin=1 and ifjd=1");if($row2=mysqli_fetch_array($res2)){
			 if(!in_array($row1[name1],$sx1arr)){$sx1arr[$m]=$row1[name1];$m++;}
			 if(!is_numeric($a[$i])){$z1=preg_split("/:/",$a[$i]);$v=$z1[1];}else{$v=$row1[name2];}
			 $sxall=$sxall.$row1[name1].":".$v."xcf";
			}
			}
			}
			}
			for($i=0;$i<count($sx1arr);$i++){
			?>
			<li id="livedemo-licence-exclusive" class="js-demo-list-li"><span class="js-drop">：</span> 
			
				<span class="pri js-price" style="width: 60px;display: block; float: left;"><?=$sx1arr[$i]?></span>
				<span class="price js-price"><? $b=preg_split("/xcf/",$sxall);for($j=0;$j<=count($b);$j++){if(check_in($sx1arr[$i],$b[$j])){echo str_replace($sx1arr[$i].":","",$b[$j])." ";}}?></span>
				
			</li> 
			<? }?>
		</ul> 
	</div> 
	<!--系统参数-->

<div class="clear" style="clear:both;"></div> 
</div> 
<!--右侧-->


</div> 
</div> 
</div> 
<span id="livedemo-toolbar-toggle" class="trigger icon-arrow-small-up"></span> 
</div> 

<div id="iframelive" class="" style="height: 887px;"> 
<div id="frameWrapper"> 
<iframe id="frame" src="<?=$row[ysweb]?>"></iframe> 
</div> 
</div> 

<script src="./demo/js/livedemo.js" type="text/javascript"></script> 
<script src="./demo/js/jquery.qrcode.min.js" type="text/javascript"></script> 
<script type="text/javascript">
jQuery('#qrcode').qrcode({width: 182,height: 182,text: $("#frame").attr("src")});
</script> 

</body>
</html>
