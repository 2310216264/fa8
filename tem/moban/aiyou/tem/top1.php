<?
include("../../../../config/conn.php");
include("../../../../config/function.php");
?>

<style type="text/css">
.fl{float:left;}
</style>

<div class="index-sm">
    <div class="container-sm">
        <div class="ssfl">
            <div class="ssflz">
                
                <div class="fenlei"><i class="icon icon-p-fenlei"></i>分类</div>
                <form name="topf1" method="post" id="w_submit" style="display:none;">
					<input name="topt" id="w_text" value="">
				</form>
                <div class="fenlei1"><i class="icont-close"></i><b id="w_show">商品</b></div>
                <div class="fl search-input">
                    <div>
                        <input type="text" class="fl" id="search-text"  placeholder="请输入搜索内容" value="" >
                    </div>
                </div>
                <input type="hidden" id="w_search" value="1">
                <div class="sm-hy btn-green-linear btn-search fr" id="search_btn"><i class="icon icon-p-search"></i></div>

                <!-- 分类 -->
                <div class="search-classify " style="display: none;">
                    <dl class="list-box">
                        <dt>产品中心<em></em></dt>
                        <dd data-catename="网站源码" data-cateid="2">
                            <div class="list-sec list-11">
								<div class="fl" style="width: 320px;">                    	
									<? while2("*","yjcode_type where type1='网站源码' and admin=2 order by xh asc");while($row2=mysqli_fetch_array($res2)){?>
                                	<!-- 子类 -->
                                    <div class="fl">
                                        <p class="sec-title short">
                                        	<a href="<?=weburl?>product/search_j1v_k<?=$row2[id]?>v.html" target="_blank"><?=$row2[type2]?></a>
                                        </p>
                                    </div> 
                                    <? }?>
                                </div>
                                
                                <!-- 热门推荐 -->
                                <div class="fl hot">             
                                    <p class="pic-title">热门推荐</p>
                                    <div class="sec-list">
                                        <?
										  $i=1;
										  while1("*","yjcode_pro where ifxj=0 and zt=0 order by xsnum desc limit 6");
										  while($row1=mysqli_fetch_array($res1)){   
										  $au="product/view".$row1[id].".html";
										 ?>
                                        <a href="<?=weburl?><?=$au?>" title="<?=$row1[tit]?>" target="_blank">                     
                                            <img src="<?=returntp("bh='".$row1[bh]."'","-1")?>" >
                                        </a>
                                        <? $i++;}?>
                                    </div>
                                    
                                </div>
                            </div> 
                            <a href="/product/search_j1v.html"><i class="icon icon-fire"></i>网站源码</a>
                        </dd>

                        <!-- 网络服务 -->
                        <dd data-catename="设计素材" data-cateid="3">
                            <div class="list-sec list-11">
                                 <!--子类 -->
                                <div class="fl" style="width: 320px">
                                   <? while2("*","yjcode_type where type1='设计素材' and admin=2 order by xh asc");while($row2=mysqli_fetch_array($res2)){?>
                                	<!-- 子类 -->
                                    <div class="fl">
                                        <p class="sec-title short">
                                        	<a href="<?=weburl?>product/search_j7v_k<?=$row2[id]?>v.html" target="_blank"><?=$row2[type2]?></a>
                                        </p>
                                    </div> 
                                    <? }?>    
                                </div>
                                <!--热门推荐 -->
                                <div class="fl hot">             
                                    <p class="pic-title">热门推荐</p>
                                    <div class="sec-list">
                                        <?
										  $i=1;
										  while1("*","yjcode_pro where ifxj=0 and zt=0 order by xsnum desc limit 6");
										  while($row1=mysqli_fetch_array($res1)){   
										  $au="product/view".$row1[id].".html";
										 ?>
                                        <a href="<?=weburl?><?=$au?>" title="<?=$row1[tit]?>" target="_blank">                     
                                            <img src="<?=returntp("bh='".$row1[bh]."'","-1")?>" >
                                        </a>
                                        <? $i++;}?>
                                    </div>
                                    
                                </div>
                            </div> 
                            <a href="/product/search_j7v.html"><i class="icon icon-fire"></i>设计素材</a>
                        </dd>
                    </dl>
                </div>

                <!-- 商品搜索 -->
                <div class="search-type" style="display: none;">
                    <dl class="list-box">
                        <dd data-id="1" onclick="topsetya(1)">商品</dd>
                        <dd data-id="2" onclick="topsetya(2)">店铺</dd>
                        <dd data-id="3" onclick="topsetya(3)">资讯</dd>
                    </dl>
                </div>
            </div>
         

        </div>
        <!-- 热门搜索 -->
        <div class="rmss"><span>热门搜索 :</span>
        	<a href="<?=weburl?>product/search_s支付v.html">支付</a>
            <a href="<?=weburl?>product/search_j1v_k68v.html" >影视源码</a>
            <a href="<?=weburl?>product/search_j1v_k71v.html" >小说源码</a>
            <a href="<?=weburl?>product/search_j1v_e26_36v.html" >WordPress</a>
            <a href="<?=weburl?>product/search_j1v_e26_27v.html">织梦</a>
        </div>
    </div>
</div>