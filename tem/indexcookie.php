<?
$admin=intval($_GET["admin"]);
if($admin==1){ //获取
 $str=$_COOKIE['SHOPCOOKIEYJTS'];
 if(empty($str)){$str="no";}
 echo $str;
}elseif($admin=2){ //设置
 if(!isset($_COOKIE['SHOPCOOKIEYJTS'])){
  setcookie(SHOPCOOKIEYJTS,"yes",28800 + time(),'/');
 }
}
?>