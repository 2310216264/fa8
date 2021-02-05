<?php
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
include("soft_function.php");
$sj=date("Y-m-d H:i:s");
// $getstr = $_GET[id];
$soft_name = "软件工具";
$soft_seokey = "软件下载,国外软件,破解软件,电脑软件,站长软件,站长工具,视频软件,编程软件";
$soft_seodes = "a8站下载中心,提供各种最新热门系统软件工具下载";

// //判断当前大类
// $ty1id=returnsxs("j");
// if($ty1id!=-1){
// 	$sqlty1="select * from yjcode_soft_type where id=".$ty1id;mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
// 	$soft_name = $rowty1[soft_type_name];
// 	$soft_seokey = $rowty1[soft_seokey];
// 	$soft_seodes = $rowty1[soft_seodes];
// }
// $ty1idk=returnsxs("k");
// if($ty1idk!=-1){
// 	$sqlty1="select * from yjcode_soft_type where id=".$ty1idk;mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
// 	$soft_name = $rowty1[soft_type_name];
// 	$soft_seokey = $rowty1[soft_seokey];
// 	$soft_seodes = $rowty1[soft_seodes];
// }


$soft="select * from yjcode_soft where id=".$_GET[id];mysqli_set_charset($conn,"utf8");$softs=mysqli_query($conn,$soft);$softname=mysqli_fetch_array($softs);
if($softname){
	$soft_name = $softname[soft_name];
	$soft_seokey = $softname[soft_seokey];
	$soft_seodes = $softname[soft_seodes];
}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title><?=$soft_name?> - <?=webname?></title>
<meta name="keywords" content="<?=$soft_seokey;?>">
<meta name="description" content="a8站,<?=$soft_seodes;?>">
<? include("../tem/cssjs.html");?>
<link rel="stylesheet" href="./css/soft.css">
</head>
<body>
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>
<div class="mainview m-t20" style="margin-top:20px;">
	<!--左侧列表-->
	<div class="soft-left fl">
		<div class="g-jp-box g-main-bg m-margin15 clearfix">
		<h4 class="u-right-title"><strong>所有分类</strong></h4>
		<ul>
			<li>
				<a <? if(!$getstr){?> class="libg"<? }?> href="view.php" title="今日更新" target="_self" style="">
					<i class="fst">·</i>今日更新
				</a>
			</li>
			<!--一级分类-->
			<? while1("*","yjcode_soft_type where level=1 order by id asc");while($row1=mysqli_fetch_array($res1)){	?>
			<li >
				<a <? if($row1[id]==$ty1id){?> class="libg" <? }?> href="view_j<?=$row1[id]?>v.html" title="<?=$row1[soft_seokey]?>" target="_self">
				<i class="fst">·</i>
				<?=$row1[soft_type_name]?>
				<!--<i class="ext">()</i>-->
				</a>
			</li>
			<?php }?>
			<!--一级分类-->
		</ul>
		</div>
	</div>
	<!--右侧-->
	<div class="soft-right fr">
		
		<!--二级分类-->
		<div class="subnav" style="margin-top:0px;">
		
			<a class="current" href="javascript:;" target="_self"><?=$softname[soft_name]?></a>
		
			<!--二级分类-->
		</div>
		<!--二级分类-->
		
		<!--简单详情-->
		<div class="lay-800 fr" style="margin-top:10px;width:800px;">
            
            <div class="main-detail-box" monkey="soft-info">
                <div class="soft-info clearfix">
                    <div class="soft-pic clearfix">
                        <div class="pic-item">
                            <img src="/soft/upload/<?=$softname[soft_img]?>" alt="<?=$softname[soft_name]?>">
                            <i></i>
                        </div>
                        <div class="pic-text-box clearfix">
                            <div class="soft-title">
                                <h1 class="blue"><?=$softname[soft_name]?></h1>
                            </div>
                            <div class="soft-desc">
                                <span class="til" style="display:none;">软件介绍：</span>
                                <p id="j_soft_desc">
                                	<span class="short-desc"><?=$softname[soft_seodes]?></span>
                                    <span class="all-desc" style="display:none;"><?=$softname[soft_seodes]?>
                                    </span>
                                </p>
                            </div>
                            <!--分享-->
                            <div class="soft-share">
                                
                            </div>
                        </div>
                        <!--<div class="soft-dl-button  soft-dl-nobr">-->
                        <!--    <a target="_blank" href="" dlcount="2966|2" class="dl-btn" monkey="downsoft" title="酷狗音乐--2966">-->
                        <!--    	<em title="酷狗音乐">立即下载</em>-->
                        <!--	</a>-->
                        <!--</div>-->
                    </div>
                    <div class="soft-text">
                        <ul class="soft-info-list">
                            <li>
                                <div class="item"><span class="t_title">大小：</span><?=$softname[soft_size]?></div>
                                <div class="item"><span class="t_title">人气：</span><font color="blue"><?=$softname[soft_renqi]?></font></div>
                            </li>
                            <li>
                                <div class="item"><span class="t_title">更新：</span><?=$softname[soft_addtime]?></div>
                                <div class="item"><span class="t_title">系统位数：</span><?=soft_weishu($softname[soft_xtsize]);?></div>
                            </li>
                            <li>
                                <div class="item"><span class="t_title">授权：</span><?=soft_shouquan($softname[soft_auth]);?></div>
                                <div class="item"><span class="t_title">语言：</span><?if($softname[soft_change]==1){echo "中文";}else{echo "英文";}?></div>                
                            </li>
                            <li>
                                <div class="item" style="width:64%;"><span class="t_title">适合系统：</span><?=soft_xitong($softname[soft_xttype]);?></div>
                            </li>
                        </ul>
                        
                        <div class="downs">
                        	<span class="soft_path"><a style="font-weight:700;" target="_blank" rel="nofollow"href="<?=$softname[soft_path]?>">百度网盘下载</a></span>
                        	<mi><a>提取码：<?=$softname[soft_pass]?></a></mi>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--简单详情-->
       
	</div>
</div>
<? include("../tem/bottom.html");?>
</body>
</html>