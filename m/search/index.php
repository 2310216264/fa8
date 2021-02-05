<?
include("../../config/conn.php");
include("../../config/function.php");

if(intval($_GET[admin])==1){  //商品搜索
zwzr();
$tv=sqlzhuru($_POST[topt]);
$nch="";
if(isset($_COOKIE['proserhis'])){
$nch=$_COOKIE['proserhis'];
if(check_in($tv."xcf",$nch)){$nch=str_replace($tv."xcf","",$nch);}
$a=preg_split("/xcf/",$nch);
if(count($a)>20){$ni=20;}else{$ni=count($a);}
 $nch="";
 for($i=0;$i<=$ni;$i++){
 $nch=$nch.$a[$i]."xcf";
 }
}
$Month = 864000 + time();
setcookie(proserhis,$tv."xcf".$nch, $Month,'/');
$k=$tv;
php_toheader("../product/search_s".$k."v.html");

}elseif(intval($_GET[admin])==2){  //表示店铺搜索
zwzr();
$tv=sqlzhuru($_POST[topt]);
$nch="";
if(isset($_COOKIE['shopserhis'])){
$nch=$_COOKIE['shopserhis'];
if(check_in($tv."xcf",$nch)){$nch=str_replace($tv."xcf","",$nch);}
$a=preg_split("/xcf/",$nch);
if(count($a)>20){$ni=20;}else{$ni=count($a);}
 $nch="";
 for($i=0;$i<=$ni;$i++){
 $nch=$nch.$a[$i]."xcf";
 }
}
$Month = 864000 + time();
setcookie(shopserhis,$tv."xcf".$nch, $Month,'/');
$k=$tv;
php_toheader("../shop/search_s".$k."v.html");

}elseif(intval($_GET[admin])==3){  //表示任务大厅搜索
zwzr();
$tv=sqlzhuru($_POST[topt]);
$nch="";
if(isset($_COOKIE['taskserhis'])){
$nch=$_COOKIE['taskserhis'];
if(check_in($tv."xcf",$nch)){$nch=str_replace($tv."xcf","",$nch);}
$a=preg_split("/xcf/",$nch);
if(count($a)>20){$ni=20;}else{$ni=count($a);}
 $nch="";
 for($i=0;$i<=$ni;$i++){
 $nch=$nch.$a[$i]."xcf";
 }
}
$Month = 864000 + time();
setcookie(taskserhis,$tv."xcf".$nch, $Month,'/');
$k=$tv;
php_toheader("../task/search_s".$k."v.html");

}elseif(intval($_GET[admin])==4){  //表示服务市场搜索
zwzr();
$tv=sqlzhuru($_POST[topt]);
$nch="";
if(isset($_COOKIE['serveserhis'])){
$nch=$_COOKIE['serveserhis'];
if(check_in($tv."xcf",$nch)){$nch=str_replace($tv."xcf","",$nch);}
$a=preg_split("/xcf/",$nch);
if(count($a)>20){$ni=20;}else{$ni=count($a);}
 $nch="";
 for($i=0;$i<=$ni;$i++){
 $nch=$nch.$a[$i]."xcf";
 }
}
$Month = 864000 + time();
setcookie(serveserhis,$tv."xcf".$nch, $Month,'/');
$k=$tv;
php_toheader("../serve/search_s".$k."v.html");

}elseif(intval($_GET[admin])==5){  //表示行业资讯搜索
zwzr();
$tv=sqlzhuru($_POST[topt]);
$nch="";
if(isset($_COOKIE['newsserhis'])){
$nch=$_COOKIE['newsserhis'];
if(check_in($tv."xcf",$nch)){$nch=str_replace($tv."xcf","",$nch);}
$a=preg_split("/xcf/",$nch);
if(count($a)>20){$ni=20;}else{$ni=count($a);}
 $nch="";
 for($i=0;$i<=$ni;$i++){
 $nch=$nch.$a[$i]."xcf";
 }
}
$Month = 864000 + time();
setcookie(newsserhis,$tv."xcf".$nch, $Month,'/');
$k=$tv;
php_toheader("../news/newslist_s".$k."v.html");

}
?>