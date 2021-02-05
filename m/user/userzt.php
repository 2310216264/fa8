<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userztweb=1;
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
</head>
<body>
<div class="bfbtop1 box">
 <div class="d1" onClick="gourl('../')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">系统提示</div>
 <div class="d3"></div>
</div>
<div class="wait box" onClick="gourl('../')">
 <div class="d1">
  <span class="s1">账号已经被禁用</span>
  <span class="s2">[点击返回首页]</span>
 </div>
</div>
</body>
</html>