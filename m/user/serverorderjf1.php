<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
$sj=date("Y-m-d H:i:s");
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("serverorder.php");}

if(sqlzhuru($_POST[yjcode])=="jf"){
 zwzr();
 $txt=sqlzhuru1($_POST[content]);
 if(empty($txt)){Audit_alert("申请理由内容不得为空，返回重试！","serverorderjf1.php?orderbh=".$orderbh);}
 intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",1,'".$txt."','".$sj."'");
 php_toheader("serverorderjf1.php?orderbh=".$orderbh); 

}
?>
<html>
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>会员中心 <?=webname?></title>
<? include("../tem/cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../../config/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../../config/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" src="../../config/ueditor/lang/zh-cn/zh-cn.js"></script>

</head>
<body>
<? include("topuser.php");?>

<div class="bfbtop1 box">
 <div class="d1" onClick="gourl('serverorderview.php?orderbh=<?=$orderbh?>')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">沟通记录</div>
 <div class="d3"></div>
</div>

<? if($row[ddzt]==7 || $row[ddzt]==9 || $row[ddzt]==10){?>
<script language="javascript">
function tj(){
if(!confirm("确认要提交本次内容吗？")){return false;}
layer.open({type: 2,content: '正在提交',shadeClose:false});
f1.action="serverorderjf1.php?orderbh=<?=$orderbh?>";
}
</script>
<form name="f1" method="post" onSubmit="return tj()">
<input type="hidden" value="jf" name="yjcode" />

<div class="txtbox box">
<div class="dmain">
 <script id="editor" name="content" type="text/plain" style="width:100%;height:250px;"><?=$row[txt]?></script>
</div>
</div>
<div class="fbbtn box">
 <div class="d1"><? tjbtnr_m("提交内容")?></div>
</div>

</form>

<div class="tishi box">
<div class="d1">
 <strong>* 站长提示：</strong><br>
 * <span class="red">在平台处理纠纷过程中，您可以继续提交有利于您的相关证据</span><br>
</div>
</div>

<script type="text/javascript">

var ue= UE.getEditor('editor'

, {

            toolbars:[

            [ 'source', '|', 'forecolor',

                 'fontsize', '|',

                'link', 'unlink',

                'simpleupload']

        ]

        });
</script>
<? }?>

<? include("serverorderv.php");?>

<div class="return-top" onClick="gotoTop()" style="display: none;"></div>

</body>
</html>