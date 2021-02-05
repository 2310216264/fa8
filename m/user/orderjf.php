<?
include("../../config/conn.php");
include("../../config/function.php");
sesCheck_m();
$userid=returnuserid($_SESSION["SHOPUSER"]);
$zuorderbh=$_GET[zuorderbh];
while0("*","yjcode_order where zuorderbh='".$zuorderbh."' and admin=1 and ddzt='backerr' and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("order.php");}

if(sqlzhuru($_POST[yjcode])=="jf"){
 zwzr();
 $txt="申请平台介入。".sqlzhuru1($_POST[content]);
 intotable("yjcode_orderlog","zuorderbh,userid,selluserid,admin,txt,sj","'".$zuorderbh."',".$row[userid].",".$row[selluserid].",1,'".$txt."','".$sj."'");
 updatetable("yjcode_order","ddzt='jf' where zuorderbh='".$zuorderbh."'");
 php_toheader("orderview.php?zuorderbh=".$zuorderbh); 

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
 <div class="d1" onClick="gourl('order.php')"><img src="img/topleft.png" height="21" /></div>
 <div class="d2">申请客服介入</div>
 <div class="d3"></div>
</div>


<script language="javascript">
function tj(){
if(!confirm("确认要申请客服介入吗？")){return false;}
layer.open({type: 2,content: '正在提交',shadeClose:false});
f1.action="orderjf.php?zuorderbh=<?=$zuorderbh?>";
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
* 申请后，资金将被冻结直至处理完纠纷<br>
* 提供详细的退款申请理由，将更有助于平台处理本次纠纷	
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