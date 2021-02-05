<div class="left-nav main-row ">
			<ul class="left-cat">
    		<li class="item open">
	        <strong class="sub-menu"><i class="ico ico-all"></i>所有分类<i class="ico ico-arr"></i></strong>
				<ul class="child-cat">
				<li class="sub"><a href="http://www.skycn.com/soft/today.html" class="red" title="今日更新"><i class="fst">·</i>今日更新 </a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/shipin.html" target="_self" title=" 视频软件 "><i class="fst">·</i>视频软件 <i class="ext">(2833)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/liaotian.html" target="_self" title=" 聊天工具 "><i class="fst">·</i> 聊天工具 <i class="ext">(981)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/liulanqi.html" target="_self" title=" 浏览器 "><i class="fst">·</i> 浏览器 <i class="ext">(538)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/yinyue.html" target="_self" title=" 音乐软件 " class="current"><i class="fst">·</i> 音乐软件 <i class="ext">(4072)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/anquanshadu.html" target="_self" title=" 安全杀毒 "><i class="fst">·</i> 安全杀毒 <i class="ext">(349)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/xitonggongju.html" target="_self" title=" 系统工具 "><i class="fst">·</i> 系统工具 <i class="ext">(13143)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/xiazai.html" target="_self" title=" 下载工具 "><i class="fst">·</i> 下载工具 <i class="ext">(6001)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/bangongruanjian.html" target="_self" title=" 办公软件 "><i class="fst">·</i> 办公软件 <i class="ext">(7128)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/shuma.html" target="_self" title=" 手机数码 "><i class="fst">·</i> 手机数码 <i class="ext">(626)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/shurufa.html" target="_self" title=" 输入法 "><i class="fst">·</i> 输入法 <i class="ext">(352)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/tuxingtuxiang.html" target="_self" title=" 图形图像 "><i class="fst">·</i> 图形图像 <i class="ext">(4504)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/gupiaowangyin.html" target="_self" title=" 股票网银 "><i class="fst">·</i> 股票网银 <i class="ext">(1013)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/yuedufanyi.html" target="_self" title=" 阅读翻译 "><i class="fst">·</i> 阅读翻译 <i class="ext">(514)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/wangluoyingyong.html" target="_self" title=" 网络应用 "><i class="fst">·</i> 网络应用 <i class="ext">(4665)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/zhutibizhi.html" target="_self" title=" 主题壁纸 "><i class="fst">·</i> 主题壁纸 <i class="ext">(1710)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/xuexi.html" target="_self" title=" 教育学习 "><i class="fst">·</i> 教育学习 <i class="ext">(2050)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/yasuokelu.html" target="_self" title=" 压缩刻录 "><i class="fst">·</i> 压缩刻录 <i class="ext">(528)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/bianchengkaifa.html" target="_self" title=" 编程开发 "><i class="fst">·</i> 编程开发 <i class="ext">(2234)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/hangyeruanjian.html" target="_self" title=" 行业软件 "><i class="fst">·</i> 行业软件 <i class="ext">(6253)</i></a></li>
				<li class="sub"><a href="http://www.skycn.com/soft/qita.html" target="_self" title=" 其它软件 "><i class="fst">·</i> 其它软件 <i class="ext">(9301)</i></a></li>
				</ul>
			</li>
			</ul>	
		</div>
		
		
		
		<div class="g-box-900 g-main-bg g-hotico">
			<span></span>
			<ul>
				<?
				while1("*","yjcode_soft order by id asc limit 0,8");while($row1=mysqli_fetch_array($res1)){
				?>
				<li>
					<a href="javascript:;" target="_blank" title="<?=$row1[soft_name]?>"><b>点击下载</b>
						<img src="/soft/upload/<?=$row1[soft_img]?>"><strong><?=$row1[soft_name]?></strong>
					</a>
				</li>
				<?}?>
			</ul>
		</div>
		
		
		<?php
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
$sj=date("Y-m-d H:i:s");
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>软件工具 - <?=webname?></title>
<meta name="keywords" content="软件下载,国外软件,破解软件,电脑软件,站长软件,站长工具,视频软件,编程软件">
<meta name="description" content="a8站下载中心,提供各种最新热门系统软件工具下载">
<? include("../tem/cssjs.html");?>
</head>
<body class="body">
<? include("../tem/top.html");?>
<? include("../tem/top1.html");?>

<div class="main">
<?
$i=1;
while1("*","yjcode_soft_type where level=1 order by id asc");while($row1=mysqli_fetch_array($res1)){
?>
<div class="tag t<?=$i?>">
<div class="tag_left"><a href="view_j<?=$row1[id]?>v.html"><em></em><?=$row1[soft_type_name]?></a></div>
<div class="tag_right">
<?
while2("*","yjcode_soft_type where fid=".$row1[id]." and level=2 order by id asc");while($row2=mysqli_fetch_array($res2)){
?>
<a href="view_j<?=$row1[id]?>v_k<?=$row2[id]?>v.html" target="_blank"><?=$row2[soft_type_name]?></a>
<?
}
?>
</div>
</div>

<? $i++;}?>
</div>

<? include("../tem/bottom.html");?>
</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		