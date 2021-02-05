<?
include("../config/conn.php");
include("../config/function.php");

$a=intval(returnsx("a"));
switch($a){
case 1:  //楼盘相册
include("../config/loupandef.php");
$tptyarr=preg_split("/,/",tptyarr_d);
$tpnumarr=preg_split("/,/",tpnumarr_d);
$t=array_keys($tpnumarr,returnsx("j"));
$sqlloupan="select * from fcw_xq where id=".returnsx("i");mysql_query("SET NAMES 'GBK'");$resloupan=mysql_query($sqlloupan);
if(!$rowloupan=mysql_fetch_array($resloupan)){php_toheader(weburl);}
$tit=$rowloupan[xq]." ".$tptyarr[$t[0]];
break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://sc.chinaz.com/jiaoben/">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?=$tit?></title>
</head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/elastislide.css" />
		<noscript>
			<style>
				.es-carousel ul{
					display:block;
				}
			</style>
		</noscript>
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
    </head>
    <body>
		<div class="container">
			
			<div class="content">
				<h1 class="fontyh"><?=$tit?></h1>
				<div id="rg-gallery" class="rg-gallery">
					<div class="rg-thumbs">
						<!-- Elastislide Carousel Thumbnail Viewer -->
						<div class="es-carousel-wrapper">
							<div class="es-carousel">

						<ul>
<!--楼盘相册B-->		
<?
if(1==$a){
 if(returnsx("k")!=-1){
  while1("*","fcw_xqphoto where xqbh='".$rowloupan[bh]."' and zt=0 and tyid=".returnsx("j")." and id=".returnsx("k")." order by sj desc");
  if($row1=mysql_fetch_array($res1)){
  $tplj="../upload/".returnuserid($rowloupan[uid])."/f/".$rowloupan[bh]."/".$row1[bh];
?>
 <li><a href="#"><img src="<?=$tplj?>-1.jpg" data-large="<?=$tplj?>.jpg" data-description="" /></a></li>
<?
  }
  }
 while1("*","fcw_xqphoto where xqbh='".$rowloupan[bh]."' and zt=0 and tyid=".returnsx("j")." order by sj desc");while($row1=mysql_fetch_array($res1)){
 $tplj="../upload/".returnuserid($rowloupan[uid])."/f/".$rowloupan[bh]."/".$row1[bh];
?>
 <li><a href="#"><img src="<?=$tplj?>-1.jpg" data-large="<?=$tplj?>.jpg" /></a></li>
<? 
 }
}
?>
<!--楼盘相册E-->

								</ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div><!-- rg-gallery -->

</div><!-- content -->
		</div><!-- container -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.tmpl.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript" src="js/gallery.js"></script>
    </body>
</html>