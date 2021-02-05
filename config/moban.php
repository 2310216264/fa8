<?
include("../config/conn.php");
include("../config/function.php");
$name1=sqlzhuru($_GET[name1]);
if(empty($name1)){Audit_alert("错误的路径来源","../");}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>即将进入演示站 - <?=webname?></title>
<link href="../css/global.css" rel="stylesheet" type="text/css" />
<link href="../css/basic.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/global.js"></script>
<script language="javascript" src="../js/basic.js"></script>
<style type="text/css">
body{background-color:#E7E7E7;}
.yanshi{float:left;width:500px;height:200px;margin:100px 0 0 314px;background-color:#fff;border:#808080 solid 5px;}
.yanshi .u1{float:left;width:500px;}
.yanshi .u1 li{float:left;}
.yanshi .u1 .l1{width:500px;font-size:20px;text-align:center;padding:50px 0 30px 0;}
.yanshi .u1 .l2{width:500px;}
.yanshi .u1 .l3{width:500px;padding:20px 0 0 0;text-align:center;}
.yanshi .u1 .l3 strong{font-size:18px;color:green;}
.yanshi .u1 .l3 .red{font-size:16px;}
.yanshi #qhok{float:left;width:500px;margin:15px 0 0 0;font-size:14px;padding:105px 0 0 0;text-align:center;background:url(../img/suc.jpg) center top no-repeat;line-height:33px;}
.yanshi #qhok strong{font-size:18px;color:green;}
.yanshi #qhok .red{font-size:16px;}
.yanshi #qhkf{float:left;width:500px;font-size:14px;padding:50px 0 0 0;text-align:center;}
.yanshi #qhkf .d1{float:left;width:333px;margin:40px 0 0 83px;}
.yanshi #qhkf a{float:left;padding:3px 0 0 30px;background:url(../img/qq4.gif) left top no-repeat;width:72px;height:21px;text-align:left;margin:0 0 6px 9px;line-height:normal;}
.yanshi #qhkf a:hover{text-decoration:none;color:red;}
.yanshitj{float:left;width:1150px;margin:20px 0 0 0;text-align:center;}
body,td,th {
	font-family: "Microsoft YaHei", "微软雅黑", MicrosoftJhengHei, "华文细黑", STHeiti, MingLiu;
}
</style>
<script language="javascript">
//演示
var xmlHttpys = false;
var nowmb;
try {
  xmlHttpys = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttpys = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttpys = false;
  }
}
if (!xmlHttpys && typeof XMLHttpRequest != 'undefined') {
  xmlHttpys = new XMLHttpRequest();
}

function yanshi(x,y){
setInterval("rgkfDjs()",1000);
url = "mobanChk.php?name1=<?=$name1?>";
xmlHttpys.open("get", url, true);
xmlHttpys.onreadystatechange = updatePageys;
xmlHttpys.send(null);
}

function updatePageys() {
 if(xmlHttpys.readyState == 4) {
 response = xmlHttpys.responseText;
 response=response.replace(/[\r\n]/g,'');
  if(response=="err1"){alert("错误的路径来源");return false;}
  else{
  document.getElementById("qhing").style.display="none";
  document.getElementById("qhok").style.display="";
  nowmb=response;
  setInterval("ysDJS()",1000);
  }
 }
}

function ysDJS(){
a=parseInt(document.getElementById("djs").innerHTML);
if(a>1){document.getElementById("djs").innerHTML=a-1;}
else{location.href="<?=weburl?>";}
}

var rgkf=60;
function rgkfDjs(){
 if(rgkf>0){rgkf=rgkf-1;}
 else{
 document.getElementById("qhing").style.display="none";
 document.getElementById("qhok").style.display="none";
 document.getElementById("qhkf").style.display="";
 }
}
</script>
</head>
<body>
<div class="yjcode">

 <div class="yanshi">
 
 <ul class="u1" id="qhing">
 <li class="l1">正在为您切换当前模板，请稍候</li>
 <li class="l2"><img src="../img/ajax_loader.gif" width="208" height="13" /></li>
 <li class="l3">
 <strong>提示：切换后如果未成功，请尝试同时按住 <span class="red">Ctrl+F5</span> 键</strong>
 </li>
 </ul>
 
 <div id="qhok" style="display:none">
 切换成功，<span id="djs">4</span>秒后进入演示站<br>
 <strong>提示：切换后如果未成功，请尝试同时按住 <span class="red">Ctrl+F5</span> 键</strong>
 </div>
 
 <div id="qhkf" style="display:none">
 已超过1分钟未切换成功，请刷新重试，或者联系客服<br>
 <div class="d1">
 <?
 $qq=preg_split("/,/",$rowcontrol[webqqv]);
 for($qqi=0;$qqi<count($qq);$qqi++){
 $qv=preg_split("/\*/",$qq[$qqi]);
 if($qv[0]!=""){
 if($qv[1]==""){$qtit="网站客服";}else{$qtit=$qv[1];}
 ?>
 <a href="http://wpa.qq.com/msgrd?v=3&uin=<?=$qv[0]?>&site=<?=weburl?>&menu=yes" target="_blank"><?=$qtit?></a>
 <? }}?>
 </div>
 </div>
 
 </div>
 
 <div class="yanshitj"><?=$rowcontrol[webtj]?></div>
 
</div>
<script language="javascript">
yanshi('<?=$name1?>');
</script>
</body>
</html>