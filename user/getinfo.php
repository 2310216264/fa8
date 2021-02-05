
<?
include("../config/conn.php");
include("../config/function.php");
include("../config/xy.php");
sesCheck();
while0("*","yjcode_user where uid='".$_SESSION[SHOPUSER]."'");if(!$row=mysqli_fetch_array($res)){php_toheader("un.php");}
$sj=date("Y-m-d H:i:s");
updatetable("yjcode_user","yxsj='".$sj."' where id=".$row[id]);
createDir("../upload/".$row[id]."/");
$userdj=returnuserdj($row[id]);
if(empty($userdj)){
while1("*","yjcode_userdj where zt=0 order by xh asc");if($row1=mysqli_fetch_array($res1)){$userdj=$row1[name1];}
}
$usertx="../upload/".$row[id]."/user.jpg";if(!is_file($usertx)){$usertx="img/nonetx.gif";}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>



<div class="container-sm">
<!-- logo -->
<div class="logo-sm fl">
<!-- logo  320x35 -->
<a href="<?=weburl?>">
    <img src="<?=weburl?>img/logo.png" width="310" height="30" alt="logo">
&nbsp;</a>
</div>
<!-- 登录注册 -->
<!-- 未登录 -->

<div class="header-user login fr" id="notlogin" style="display:block;">
<p class="sm-hy"><a href="/user/">登录</a></p>
<p class="sm-hy btn-green-linear"><a href="<?=weburl?>reg/reg.php">注册</a></p>
</div>

<!-- 个人中心 -->
<!-- 已经登录 -->
<div class="header-user info header-right fr" id="yeslogin" style="display:none;">
<div class="user-img"><a href="<?=weburl?>user/">
	<img src="<?=weburl?>img/user-default.png" onerror="this.src='<?=weburl?>img/user-default.png'" id="topuimg" width="40" height="40" alt="ico"></a></div>
<div class="user-info js-copy-id">
    <p><span id="yesuid" class="s1">免注册用户</span></p>
    <p class="clearfix"></p>
</div>
<div class="header-drop">
    <!-- 认证 -->
    <div class="user-header">
        <span class="int-img v0"></span>
        <a href="<?=weburl?>user/" target="_self" class="user-name" id="yesuid"></a>
        <div id="topurz">
           
        </div>
    </div>
    <div class="user-int">
        <span class="fl"><a href="<?=weburl?>user/userdj.php" id="topudj">普通(到期:永久不到期)</a></span>
        <a href="<?=weburl?>user/paylog.php" target="_self" class="fr int-count">余额&nbsp;:&nbsp;<span id="topmoney"></span></a>
        <a href="<?=weburl?>user/jflog.php" target="_self" class="fr int-count">积分&nbsp;:&nbsp;<span id="topjf"></span></a>
    </div>
    <!-- 会员级别 -->

    <!-- 会员级别 -->

    <!-- 个人中心快捷设置 -->
    <div class="user-nav">
        <a href="/user/" class="fl" title="个人中心" target="_self"><i class="icon icon-rengezhongxin"></i>个人中心</a>
        <a href="/user/order.php" class="fl" title="我的订单" target="_self" rel="nofollow"><i class="icon icon-shourumingxi"></i>我的订单</a>
        <a href="/user/pay.php" class="fl" title="用户充值" target="_self" rel="nofollow"><i class="icon icon-credit-card"></i>用户充值</a>
        <a href="/help/" class="fl" title="新手帮助" target="_self"><i class="icon icon-shoucang"></i>新手帮助</a>
    </div>

    <div class="user-footer">
        <a href="/user/" target="_self" class="fl">帐号设置</a>
        <a href="<?=weburl?>user/un.php" class="fr" target="_self" rel="nofollow">退出</a>
    </div>
</div>

</div>
<!-- 个人中心 -->
<!--购物车-->

<div class="header-upload hover-box header-right fr"><i class="icon icon-p-shangchuan"></i><a href="<?=weburl?>user/productlx.php" target="_blank">发布</a></div>
</div>
        
        
        
        
        
        
        
        
        
        
<span id="webhttp" style="display:none"><?=weburl?></span>

<script language="javascript">
userCheckses();

userinfo();
</script>


<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>