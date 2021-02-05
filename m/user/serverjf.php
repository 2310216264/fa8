<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();

$userid=returnuserid($_SESSION["SHOPUSER"]);
$orderbh=$_GET[orderbh];
$sj=getsj();
while0("*","yjcode_serverorder where orderbh='".$orderbh."' and (ddzt=9 or ddzt=10) and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("serverorder.php");}

if(sqlzhuru($_POST[yjcode])=="jf"){
 zwzr();
 $txt=sqlzhuru1($_POST[content]);
 if(empty($txt)){Audit_alert("申请理由内容不得为空，返回重试！","serverjf.php?orderbh=".$orderbh);}
 intotable("yjcode_serverorderlog","orderbh,userid,selluserid,admin,txt,sj","'".$orderbh."',".$row[userid].",".$row[selluserid].",1,'".$txt."','".$sj."'");
 updatetable("yjcode_serverorder","ddzt=10 where id=".$row[id]);
 php_toheader("serverorderview.php?orderbh=".$orderbh); 

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
 <div class="d1" onClick="gourl('serverorder.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">申请客服介入</div>
 <div class="d3"></div>
</div>


<script language="javascript">
function tj(){
if(confirm("确认要申请客服介入吗？")){}else{return false;}
layer.open({type: 2,content: '正在提交',shadeClose:false});
f1.action="serverjf.php?orderbh=<?=$orderbh?>";
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
 * <span class="red">申请客服介入后，订单资金将被冻结在平台，直至平台处理完本次纠纷</span><br>
 * 提供详细的退款申请理由，并且附上图片，将更有助于平台处理本次服务订单的纠纷，纠纷处理过程中，可以随时补充内容。
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

</body>
</html>