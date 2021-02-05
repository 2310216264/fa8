<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
$getstr=$_GET[str];
$tit="产品关键词列表";


while0("webkey,webdes,control_keywords","yjcode_control");$rowss=mysqli_fetch_array($res);
$H = date('H');
$seokey = $rowss[webkey];
$seodes = $rowss[webdes];

//关键字
// $control_keys = $rowss['control_keywords'];
$control_keys = explode(',',$rowss[control_keywords]);
// var_dump($control_keys);
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
<div class="yjcode" style="width: 1190px;overflow:hidden;">
	
	
<!--列表-->

<div class="list_left" style="width:1190px">

	<div class="screen_box"> 
		<div class="screen_lists"> 
			<!--类型1-->
			<div class="screen_list">
    			<!--<div class="screen_name"><i id="isx-1"></i><span style="letter-spacing:0em;margin-right:0em;">关键词</span>：</div>-->
    			<div class="screen_con" style="overflow:hidden;margin-left:20px;">
    				<?php 
    					foreach ($control_keys as $k=>$v){
    					$au = "search_s".$v."v.html";
    				?>
					<a title="<?=$v?>" href="<?=weburl?>product/<?=$au?>" target="_blank" style="width:180px;"><?=$v?></a>
					<?php }?>
 				</div>
    		</div>				
		</div> 
	</div>
	<!--列表-->
</div>
	
<!--列表-->
	
</div>
</div>
<? include("../tem/bottom.html");?>
</body>
</html>