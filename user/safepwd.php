<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();

//入库操作开始
if($_POST[yjcode]=="safepwd"){
 zwzr();
 $pwd=sha1(sqlzhuru($_POST[t1]));
 if(panduan("*","yjcode_user where uid='".$_SESSION[SHOPUSER]."' and zfmm='".$pwd."'")==0){Audit_alert("支付密码验证失败，返回重试！","safepwd.php");}
 $_SESSION[SAFEPWD]=$pwd;
 php_toheader(returnjgdw($_SESSION["tzURL"],"","safepwd.php"));
}
//入库操作结束

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<link href="../css/global.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.uk{float:left;width:940px;font-size:14px;padding:10px;margin:30px 0 0 0;text-align:left;}
.uk li{float:left;}
.uk .l1{width:90px;padding:7px 10px 0 0;height:46px;text-align:right;}
.uk .l2{width:840px;height:53px;}
.uk .l2 .inp{float:left;border:#CCCCCC solid 1px;height:27px;padding:4px 0 0 5px;outline:medium;}
.uk .l21{width:840px;height:53px;}
.uk .l3{width:840px;padding-left:100px;}
.uk .l3 input{cursor:pointer;float:left;width:211px;border:0;font-weight:700;color:#fff;background-color:#ff6600;height:35px;}
</style>
<script language="javascript" src="../js/jquery.min.js"></script>
<script language="javascript" src="../js/layer.js"></script>
</head>
<body>

 <? if(empty($_SESSION[SAFEPWD])){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入支付密码");document.f1.t1.focus();return false;}	
 f1.action="safepwd.php";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <input type="hidden" value="safepwd" name="yjcode" />
 <ul class="uk">
 <li class="l1"><span class="red">*</span> 支付密码：</li>
 <li class="l2"><input type="password" class="inp" name="t1" /></li>
 <li class="l1"></li>
 <li class="l21 blue">如果没有设置支付密码，请用帐号密码进行登录，为了安全起见，建议您 <a href="zfmm.php" target="_blank" class="red">【设置独立的支付密码】</a></li>
 <li class="l3"><?=tjbtnr("登录")?></li>
 </ul>
 </form>
 <? }else{?>
 <ul class="uk">
 <li class="l1"></li>
 <li class="l21 blue">您的支付密码已经通过验证，可进行更多操作</li>
 </ul>
 <? }?>
 
</body>
</html>