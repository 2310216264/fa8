<?php
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
include("soft_function.php");
$sj=date("Y-m-d H:i:s");
$getstr = $_GET[id];

$soft_name = "软件工具";
$soft_seokey = "软件下载,国外软件,破解软件,电脑软件,站长软件,站长工具,视频软件,编程软件";
$soft_seodes = "a8站下载中心,提供各种最新热门系统软件工具下载";
//判断当前大类
$ty1id=returnsxs("j");
if($ty1id!=-1){
	$sqlty1="select * from yjcode_soft_type where id=".$ty1id;mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
	$soft_name = $rowty1[soft_type_name];
	$soft_seokey = $rowty1[soft_seokey];
	$soft_seodes = $rowty1[soft_seodes];
}
$ty1idk=returnsxs("k");
if($ty1idk!=-1){
	$sqlty1="select * from yjcode_soft_type where id=".$ty1idk;mysqli_set_charset($conn,"utf8");$resty1=mysqli_query($conn,$sqlty1);$rowty1=mysqli_fetch_array($resty1);
	$soft_name = $rowty1[soft_type_name];
	$soft_seokey = $rowty1[soft_seokey];
	$soft_seodes = $rowty1[soft_seodes];
}


if(returnsxs("p")!=-1){$page=returnsxs("p");}else{$page=1;}

?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title><?=$soft_name?> - <?=webname?></title>
<meta name="keywords" content="<?=$soft_seokey;?>">
<meta name="description" content="a8站下载中心,<?=$soft_seodes;?>">
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
				<a <? if(!$getstr){?> class="libg"<? }?> href="view.html" title="今日更新" target="_self" style="">
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
			<? if(!$getstr){?>
			<a class="current" href="javascript:;" target="_self">今日更新</a>
			<? }?>
			
			<!--全部软件-->
			<? if($ty1id!=-1){?>
				<a <?if($ty1idk==-1){?>class="current"<?}?> href="view_j<?=$ty1id?>v.html" target="_self">全部软件</a>
			<?}?>
			
			<!--全部软件-->
			<!--二级分类-->
			<?
			if($ty1id!=-1){
				if($ty1id!=-1){
					$reson = "where fid=".$ty1id." and level=2 order by id asc";
				}
				while2("*","yjcode_soft_type $reson");while($row2=mysqli_fetch_array($res2)){
			?>
				<a  <? if(check_in("_k".$row2[id]."v",$getstr) && check_in("_k".$row2[id]."v",$getstr)){?> class="current"<? }?> href="view_j<?=$row2[fid]?>v_k<?=$row2[id]?>v.html" target="_self">
					<?=$row2[soft_type_name]?>
				</a>
			<?
			}}
			?>
			<!--二级分类-->
		</div>
		<!--二级分类-->
		
		
		<div class="g-listbox g-main-bg">
			<ul>
				<!--今日更新软件--><? if(!$getstr){?>
					<? 
					$sesnow = "where to_days(soft_addtime) = to_days(now())";
					pagef($sesnow,8,"yjcode_soft","order by id desc");while($row=mysqli_fetch_array($res)){
					?>
					<!--判断发布时间是否是今天-->
					<li>
						<div class="m-cont-list">
							<strong><a href="viewweb.php?id=<?=$row[id]?>" title="" target="_blank"><?=$row[soft_name]?></a></strong>
						<div class="m-jzbox">
							<p>
								<a href="" title="" target="_blank">
									<img src="/soft/upload/<?=$row[soft_img]?>" alt="<?=$row[soft_name]?>">
								</a>
							</p>
						</div>
						<div class="f-fl m-leftbox">
							<p><?=$row[soft_seodes]?></p>
							<span>大小：<i><?=$row[soft_size]?></i>更新时间：<i><?=$row[soft_addtime]?></i>类别：<i><?=$row[soft_type_name]?></i>授权：<i>免费软件</i></span>
						</div>
						<div class="f-fr m-rightbox">
							<img src="./images/s4.gif"><span class="m-bth"><a href="" target="_blank">安全下载</a></span><b>人气：<?=$row[soft_renqi]?></b></div>
						</div>
					</li>
					<?}}?>
	
				<?php
					if($ty1idk==-1){
						$s = soft_sid($ty1id);
						$ses = "where soft_type_id in($s) and soft_states = 1 ";
					}else{
						$ses = "where soft_type_id = ".$ty1idk." and soft_states = 1";
					}
				
					pagef($ses,3,"yjcode_soft","order by id desc");while($row=mysqli_fetch_array($res)){
				?>
					<li>
						<div class="m-cont-list">
							<strong><a href="viewweb.php?id=<?=$row[id]?>" title="" target="_blank"><?=$row[soft_name]?></a></strong>
						<div class="m-jzbox">
							<p>
								<a href="" title="" target="_blank">
									<img src="/soft/upload/<?=$row[soft_img]?>" alt="<?=$row[soft_name]?>">
								</a>
							</p>
						</div>
						<div class="f-fl m-leftbox">
							<p><?=$row[soft_seodes]?></p>
							<span>大小：<i><?=$row[soft_size]?></i>更新时间：<i><?=$row[soft_addtime]?></i>类别：<i><?=$row[soft_type_name]?></i>授权：<i><?=soft_shouquan($row[soft_auth]);?></i></span>
						</div>
						<div class="f-fr m-rightbox">
							<img src="./images/s4.gif"><span class="m-bth"><a href="" target="_blank">安全下载</a></span><b>人气：<?=$row[soft_renqi]?></b></div>
						</div>
					</li>
				<?
					}
				?>
			</ul>
		</div>
		<div class="npa">
		<?
		$nowurl="view";
		require("./page.html");
		?>
		</div>
		
	
	</div>
</div>

<? include("../tem/bottom.html");?>
</body>
</html>