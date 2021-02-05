<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
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
 
 <? include("serverorderv.php");?>
 
 <? if($row[ddzt]==7 || $row[ddzt]==9 || $row[ddzt]==10){?>
 <script language="javascript">
 function tj(){
 if(confirm("确认要提交本次内容吗？")){}else{return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="serverorderjf1.php?orderbh=<?=$orderbh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="ordercz">
 <li class="l1">
 <strong>* 站长提示：</strong><br>
 * <span class="red">在平台处理纠纷过程中，您可以继续提交有利于您的相关证据</span><br>
 </li>
 <li class="l5"><script id="editor" name="content" type="text/plain" style="width:856px;height:380px;"><?=$row[txt]?></script></li>
 <li class="l4"><?=tjbtnr("提交内容")?></li>
 </ul>
 <input type="hidden" value="jf" name="yjcode" />
 <input type="hidden" value="<?=$orderbh?>" name="orderbh" />
 </form>
 <? }?>
 
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