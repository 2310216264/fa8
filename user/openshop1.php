<?
include("../config/conn.php");
include("../config/function.php");
include("../config/tpclass.php");
sesCheck();
$sj=date("Y-m-d H:i:s");
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
$rowuser=mysqli_fetch_array($resuser);
if(1==$rowuser[shopzt] || 2==$rowuser[shopzt] || 3==$rowuser[shopzt]){php_toheader("openshop3.php");}
$usertx="../upload/".$rowuser[id]."/shop.jpg";
if(!is_file($usertx)){$usertx="img/none100x100.gif";}else{$usertx=$usertx."?id=".rnd_num(1000);}
$ifarea="yes";
$add1=$rowuser[areaid1];
$add2=$rowuser[areaid2];
$add3=$rowuser[areaid3];




//入库操作开始
if($_POST[jvs]=="openshop"){
zwzr();
$t1=sqlzhuru($_POST[t1]);
$t2=sqlzhuru($_POST[t2]);
$s1=sqlzhuru($_POST[s1]);
if(empty($t1) || empty($t2) || empty($s1)){Audit_alert("信息不完整，返回重试！","openshop1.php");}
if(panduan("*","yjcode_user where shopname='".$t1."' and uid<>'".$_SESSION[SHOPUSER]."'")==1){Audit_alert("店铺名称已经被其他用户使用，返回重试！","openshop1.php");}
$area1=intval($_POST[area1]);
$area2=intval($_POST[add2]);
$area3=intval($_POST[add3]);

updatetable("yjcode_user","shopname='".$t1."',seokey='".$t2."',seodes='".$s1."',txt='".sqlzhuru1($_POST[content])."',areaid1=".$area1.",areaid2=".$area2.",areaid3=".$area3." where uid='".$_SESSION[SHOPUSER]."'");
uploadtpnodata(1,"upload/".$rowuser[id]."/","shop.jpg","allpic",300,300,0,0,"no");
if($rowcontrol[ifsell]=="on"){
	
$dqsj=date('Y-m-d H:i:s',strtotime ("+24 month",strtotime($sj)));
updatetable("yjcode_user","shopzt=2,dqsj='".$dqsj."' where id=".$rowuser[id]);
php_toheader("openshop3.php");

}else{
php_toheader("openshop2.php");
}
}
//入库操作结束

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户管理面板 - <?=webname?></title>
<? include("cssjs.html");?>
<link href="css/sell.css" rel="stylesheet" type="text/css" />
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

<? if($rowcontrol[ifsell]!="on"){?>
<? include("kdcap.php");?>
<script language="javascript">
document.getElementById("step1").className="l1 l11";
</script>
<? }?>

<!--白B-->
<div class="rkuang">

<form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
<input type="hidden" value="openshop" name="jvs" />
<ul class="uk">
<li class="l1">店铺名称：</li>
<li class="l2"><input type="text" class="inp" value="<?=$rowuser[shopname]?>" name="t1" /></li>
<li class="l1">店铺LOGO：</li>
<li class="l2"><span class="finp"><input type="file" name="inp1" id="inp1" size="25"> 最佳尺寸：300*300</span></li>
<li class="l5"></li>
<li class="l6"><img src="<?=$usertx?>" width="100" height="100" /></li>
<li class="l1"><span class="red">*</span> 所在区域：</li>
<li class="l2"><? include("../tem/area.php");?></li>
<li class="l1">主营产品：</li>
<li class="l2"><input type="text" class="inp" value="<?=$rowuser[seokey]?>" name="t2" size="60" /></li>
<li class="l9">店铺描述：</li>
<li class="l10">
<textarea  id="Introduce" name="s1">
<?=$rowuser[seodes]?>
</textarea>
</li>
<li class="l1" style="height: 18px;padding-top: 0px;"></li>
<li class="l2" style="height: 20px;padding-top: 0px;">店铺简介必须输入50字数,<font color="red">重复不通过</font></li>

<li class="l7">关于我们：</li>
<li class="l8"><script id="editor" name="content" type="text/plain" style="width:770px;height:400px;"></script></li>

<li class="l1"></li>
<li class="l2"><label><input id="C1" type="checkbox" value="1" /> 我已阅读《<a href="../help/aboutview7.html" class="feng" target="_blank">开店协议</a>》并同意</label></li>
<li class="l3"><?=tjbtnr("下一步")?></li>
</ul>
</form>

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
function tj(){
if((document.f1.t1.value).replace(/\s/,"")==""){layer.msg("请输入店铺名称",{time:2000});document.f1.t1.focus();return false;}
if((document.f1.t2.value).replace(/\s/,"")==""){layer.msg("请输入主营产品",{time:2000});document.f1.t2.focus();return false;}
if((document.f1.s1.value).replace(/\s/,"")==""){layer.msg("请输入店铺描述",{time:2000});document.f1.s1.focus();return false;}
if(document.f1.s1.value.length<50){layer.msg("店铺简要描述要多余50字",{time:2000});document.f1.s1.focus();return false;}

var content = ue.hasContents();
if (content == false) {
layer.msg("请输入关于我们",{time:2000});return false;
}

if(document.getElementById("C1").checked==false){layer.msg("请先阅读并同意开店协议",{time:2000});return false;}

layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
tjwait();
f1.action="openshop1.php";
}
function area1cha(){
farea2.location="../tem/area2.php?area1id="+document.getElementById("area1").value;	
}


</script>
<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>