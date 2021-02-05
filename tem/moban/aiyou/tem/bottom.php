<?
include("../../../../config/conn.php");
include("../../../../config/function.php");
?>
<div class="bfb bfbbottom">
<div class="yjcode">

 <div class="d1">
 <ul class="u1">
 <? while1("*","yjcode_helptype where admin=1 order by xh asc limit 5");while($row1=mysqli_fetch_array($res1)){?>
 <li>
 <span><a href="<?=weburl?>help/search_j<?=$row1[id]?>v.html" target="_blank" rel="nofollow"><?=$row1[name1]?></a></span>
 <? 
 while2("*","yjcode_helptype where admin=2 and name1='".$row1[name1]."' order by xh asc limit 5");while($row2=mysqli_fetch_array($res2)){
 $aurl="search_j".$row1[id]."v_k".$row2[id]."v.html";
 if(returncount("yjcode_help where ty1id=".$row1[id]." and ty2id=".$row2[id])==1){
 while3("id,ty1id,ty2id","yjcode_help where ty1id=".$row1[id]." and ty2id=".$row2[id]);$row3=mysqli_fetch_array($res3);
 $aurl="view".$row3[id].".html";
 }
 ?>
 <a href="<?=weburl?>help/<?=$aurl?>" rel="nofollow" target="_blank" class="a1"><?=$row2[name2]?></a><br>
 <? }?>
 </li>
 <? }?>
 </ul>
 </div>
 
 <div class="d2">
 <strong>联系我们</strong><br>
 <? while1("*","yjcode_ad where adbh='aiyou_03' and zt=0 order by xh asc");if($row1=mysqli_fetch_array($res1)){echo $row1[txt];}?>
 </div>
 
 <div class="d3">
 <? while1("*","yjcode_ad where adbh='aiyou_04' and zt=0 order by xh asc");if($row1=mysqli_fetch_array($res1)){?>
 <a href="<?=$row1[aurl]?>" target="_blank" rel="nofollow"><img src="<?=weburl?><?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh].".".$row1[jpggif]?>" width="100" height="100" /><br><?=$row1[tit]?></a>
 <? }?>
 </div>
 
 <ul class="u2">
 <li class="l1">
 <a href="<?=weburl?>help/aboutview2.html" rel="nofollow" target="_blank">关于我们</a>&nbsp;&nbsp;
 <a href="<?=weburl?>help/aboutview3.html" rel="nofollow" target="_blank">广告合作</a>&nbsp;&nbsp;
 <a href="<?=weburl?>help/aboutview4.html" rel="nofollow" target="_blank">联系我们</a>&nbsp;&nbsp;
 <a href="<?=weburl?>help/aboutview5.html" rel="nofollow" target="_blank">隐私条款</a>&nbsp;&nbsp;
 <a href="<?=weburl?>help/aboutview6.html" rel="nofollow" target="_blank">免责声明</a>&nbsp;&nbsp;
 <a href="<?=weburl?>help/map.html" target="_blank">网站地图</a>
 <br>
 <a href="http://www.beian.miit.gov.cn/"target="_blank"><?=$rowcontrol[beian]?></a><?=$rowcontrol[webtj]?><i>&nbsp;&nbsp;|&nbsp;&nbsp;Copyright <?=date("Y")+1?><?=webname?>版权所有</i>
 </li>
 <li class="l2">
 <? while1("*","yjcode_ad where adbh='aiyou_05' and zt=0 order by xh asc limit 5");while($row1=mysqli_fetch_array($res1)){?>
 <a href="<?=$row1[aurl]?>" rel="nofollow" target="_blank"><img src="<?=weburl?><?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh].".".$row1[jpggif]?>" width="106" height="40" /></a>
 <? }?>
 </li>
 </ul>
 
 <? adwhile("ADI01");?>
 
</div>
</div>

<? while1("*","yjcode_ad where adbh='ADKF' and zt=0 order by xh asc limit 1");if($row1=mysqli_fetch_array($res1)){echo $row1[txt];}?>

<? while1("*","yjcode_ad where adbh='ADTANG' and zt=0 order by xh asc limit 1");if($row1=mysqli_fetch_array($res1)){?>
<div class="indexYJTS" style="display:none;">
	<!--<a href="javascript:void(0);" onClick="indexYJTSCLO()">关闭这个提示</a>-->
</div>
<style type="text/css">
.indexYJTS{background:url(<?=weburl?><?=returnjgdw($rowcontrol[addir],"","gg")?>/<?=$row1[bh].".".$row1[jpggif]?>) no-repeat;float:left;width:200px;height:200px;}
.indexYJTS a{float:left;color:#fff;width:250px;margin:390px 0 0 325px;height:30px;border-radius:3px;text-align:center;padding:8px 0 0 0;font-size:15px;background-color:#1E9FFF;}
</style>
<script language="javascript">
function indexYJTSCLO(){
layer.closeAll();
}
getIndexCookie();
</script>
<? }?>




<!-- 右侧浮动开始 -->
<div class="right-btn-group"> 
<ul class="btn-group"> 
    <li>
        <a href="<?=weburl?>user/" rel="nofollow" class="icon-2 login-a">
        <span>个人中心</span>
        </a>
    </li> 
    <li class="sign-but">
        <a href="<?=weburl?>user/qiandao.php" rel="nofollow" class="icon-4 login-a" rel="nofollow">
        <span>点击签到</span>
        </a>
    </li> 
    <li>
        <a href="<?=weburl?>user/newslx.php" rel="nofollow" class="icon-3 login-a">
        <span>我要投稿</span>
        </a>
    </li> 
    <li>
        <a href="<?=weburl?>user/gdlx.php" rel="nofollow" class="icon-5">
        <span>意见反馈</span>
        </a>
    </li>
    <li>
	    <a href="<?=weburl?>/tool" rel="nofollow" class="icon-6">
	    <span>免费工具</span>
	    </a>
	</li> 
</ul> 
<div class="show-wechat"> 
    <a href="<?=weburl?>mt" rel="nofollow" class="icon-7">
    <span>
    <img src="<?=weburl?>tem/getqr.php?u=<?=weburl?>m&size=4" width="137" height="137" alt="手机二维码">
    <em>访问手机版</em>
    </span>
    </a>
</div> 
<div class="to-top" style="bottom:-22px;">
    <a href="javascript:;" onclick="gotoTop();return false;" class="icon-6" rel="nofollow"><span>返回顶部</span></a>
</div>
</div>
<!-- 右侧浮动结束 -->


