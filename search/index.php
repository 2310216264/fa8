<?
include("../config/conn.php");
include("../config/function.php");

if(intval($_GET[admin])==1){  //商品搜索
zwzr();
$k=sqlzhuru($_POST[topt]);
php_toheader("../product/search_s".$k."v.html");

}elseif(intval($_GET[admin])==2){  //表示店铺搜索
zwzr();
$k=sqlzhuru($_POST[topt]);
php_toheader("../shop/search_s".$k."v.html");

}elseif(intval($_GET[admin])==3){  //表示资讯搜索
zwzr();
$k=sqlzhuru($_POST[topt]);
php_toheader("../news/newslist_s".$k."v.html");

}elseif(intval($_GET[admin])==4){  //表示商品内页搜索
zwzr();
$k=sqlzhuru($_POST[ink1]);
php_toheader("../product/search_s".$k."v".$_GET[getv].".html");

}elseif(intval($_GET[admin])==5){  //店铺内搜索
zwzr();
$k=sqlzhuru($_POST[t1]);
php_toheader("../shop/prolist_i".$_GET[id]."v_s".$k."v".$_GET[getv].".html");

}elseif(intval($_GET[admin])==6){  //表示服务内页搜索
zwzr();
$k=sqlzhuru($_POST[ink1]);
php_toheader("../serve/search_s".$k."v".$_GET[getv].".html");

}elseif(intval($_GET[admin])==7){  //店铺内搜索
zwzr();
$k=sqlzhuru($_POST[t1]);
php_toheader("../shop/serlist_i".$_GET[id]."v_s".$k."v".$_GET[getv].".html");

}else{
php_toheader("../");
}
?>