<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/buy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../config/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../config/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" src="../config/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <!--白B-->
 <div class="rkuang">
 
 <script language="javascript">
 function tj(){
 if(confirm("确认要申请客服介入吗？")){}else{return false;}
 layer.msg('正在处理数据，请稍候', {icon: 16  ,time: 0,shade :0.25});
 f1.action="orderjf.php?zuorderbh=<?=$zuorderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="ordercz">
 <li class="l1">
 <strong>* 站长提示：</strong><br>
 * <span class="red">申请客服介入后，订单资金将被冻结在平台，直至平台处理完本次纠纷</span><br>
 * 提供详细的退款申请理由，并且附上图片，将更有助于平台处理本次纠纷，纠纷处理过程中，可以随时补充内容。
 </li>
 <li class="l5"><script id="editor" name="content" type="text/plain" style="width:856px;height:180px;"><?=$row[txt]?></script></li>
 <li class="l4"><?=tjbtnr("申请客服介入")?></li>
 </ul>
 <input type="hidden" value="jf" name="yjcode" />
 </form>

 <? include("orderv.php");?>
 
 <div class="clear clear10"></div>

 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<script language="javascript">
//实例化编辑器
var ue= UE.getEditor('editor'
, {
            toolbars:[
            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'removeformat', 'formatmatch' ,'|', 'forecolor',
                 'fontsize', '|',
                'link', 'unlink',
                'insertimage', 'emotion', 'attachment']
        ]
        });
</script>
<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>