<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."' and shopzt=2";mysqli_set_charset($conn,"utf8");$resuser=mysqli_query($conn,$sqluser);
if(!$rowuser=mysqli_fetch_array($resuser)){php_toheader("openshop3.php");}
$userid=$rowuser[id];
$bh=$_GET[bh];
while0("*","yjcode_server where bh='".$bh."' and userid=".$userid);if(!$row=mysqli_fetch_array($res)){php_toheader("serverlist.php");}

if($_GET[control]=="add"){
$sj=getsj();
$tyid=preg_split("/xcf/",sqlzhuru($_POST[d1]));
if(panduan("bh","yjcode_tp where bh='".$bh."'")==1){$iftp=1;}else{$iftp=0;}

$txt=sqlzhuru1($_POST[content]);
$wdes=sqlzhuru($_POST[twdes]);if(empty($wdes)){$wdes=strgb2312(strip_tags($txt),0,220);}
$tit=sqlzhuru($_POST[ttit]);
$wkey=sqlzhuru($_POST[twkey]);if(empty($wkey)){$wkey=$tit;}
$money1=sqlzhuru($_POST[tmoney1]);if(!is_numeric($money1)){$money1=0;}
if($rowcontrol[ifserver]=="on"){$nzt=0;}else{$nzt=1;}

if(empty($_POST[touchy])){
	$_POST[touchy] = 0;
}


updatetable("yjcode_server","
		 mybh='".sqlzhuru($_POST[tmybh])."',
		 lastsj='".$sj."',
		 uip='".getuip()."',
		 ty1id=".$tyid[0].",
		 ty2id=".$tyid[1].",
		 tit='".$tit."',
		 txt='".$txt."',
		 wdes='".$wdes."',
		 wkey='".$wkey."',
		 money1=".$money1.",
		 iftp=".$iftp.",
		 touchy=".$_POST[touchy].",
		 zt=".$nzt." where bh='".$bh."' and userid=".$row[userid]);
php_toheader("server.php?t=suc&bh=".$bh);
}
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
<script type="text/javascript">
function tj(){
 if((document.f1.ttit.value).replace(/\s/,"")==""){alert("请输入标题");document.f1.ttit.focus();return false;}	
 a=document.f1.tmoney1.value;if(a.replace("/\s/","")=="" || isNaN(a)){alert("请输入有效的价格");document.f1.tmoney1.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 tjwait();
 f1.action="server.php?control=add&bh=<?=$bh?>";
}

function taocanonc(){
 layer.open({
  type: 2,
  shadeClose: false,
  area: ['901px', '550px'],
  title:["套餐管理","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['servertaocanlist.php?bh=<?=$bh?>', 'yes'] 
 });
}
</script>
</head>
<body>
<? include("../tem/top.html");?>
<? include("top.php");?>
<div class="yjcode">

<? include("left.php");?>

<!--RB-->
<div class="userright">
 
 <? include("servertop.php");?>
 <? include("rcap18.php");?>
 <script language="javascript">
 document.getElementById("rcap1").className="l1 l2";
 </script>

 <!--白B-->
 <div class="rkuang">
 
 <? systs("恭喜您，操作成功![<a href='serverlx.php'>继续添加服务</a>]","server.php?bh=".$bh)?>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="rcap"><li class="l1"></li><li class="l2">必填项目</li><li class="l3"></li></ul>
 <ul class="uk">
 <li class="l1"><span class="red">*</span> 分组：</li>
 <li class="l2">
 <select name="d1" class="inp">
 <? while1("*","yjcode_servertype where admin=1 and zt=0");while($row1=mysqli_fetch_array($res1)){?>
 <option value="<?=$row1[id]?>xcf0"<? if($row1[id]==$row[ty1id] && $row[ty2id]==0){?> selected="selected"<? }?> style="background-color:#EFEFEF;color:#333;"><?=$row1[name1]?></option>
 <? while2("*","yjcode_servertype where admin=2 and name1='".$row1[name1]."' and zt=0");while($row2=mysqli_fetch_array($res2)){?>
 <option value="<?=$row1[id]?>xcf<?=$row2[id]?>"<? if($row1[id]==$row[ty1id] && $row2[id]==$row[ty2id]){?> selected="selected"<? }?>> - <?=$row2[name2]?></option>
 <? }?>
 <? }?>
 </select>
 </li>
 <li class="l1"><span class="red">*</span> 标题：</li>
 <li class="l2"><input type="text" size="80" value="<?=$row[tit]?>" class="inp" name="ttit" /></li>
 <li class="l1"><span class="red">*</span> 当前售价：</li>
 <li class="l2"><input class="inp" name="tmoney1" value="<?=$row[money1]?>" size="10" type="text"/><span class="fd">元</span></li>
 </ul>
 
 <ul class="uk uk0">
 <li class="l1"><span class="red">*</span> 效果图：</li>
 <li class="l2">
 <iframe style="float:left;" src="tpupload.php?admin=7&bh=<?=$bh?>" width="150" scrolling="no" height="33" frameborder="0"></iframe>
 <span class="fd" style="margin-left:10px;">最佳尺寸：600*400，可最多上传7张效果图</span>
 </li>
 </ul>
 <div class="xgtp">
  <div id="xgtp1" style="display:none;">正在处理</div>
  <div id="xgtp2"></div>
 </div>

 <ul class="uk uk0">
 <li class="l7"><span class="red">*</span> 详细内容：</li>
 <li class="l8"><script id="editor" name="content" type="text/plain" style="width:770px;height:330px;"><?=$row[txt]?></script></li>
 </ul>

 <ul class="rcap"><li class="l1"></li><li class="l2">选填信息</li><li class="l3"></li></ul>
 <ul class="uk uk0">
 <li class="l1">SEO关键词：</li>
 <li class="l2"><input type="text" class="inp" value="<?=$row[wkey]?>" name="twkey" size="60" /></li>
 <li class="l9">SEO描述：</li>
 <li class="l10"><textarea name="twdes"><?=$row[wdes]?></textarea></li>
 <li class="l1">自定义编码：</li>
 <li class="l2"><input type="text" size="10" value="<?=$row[mybh]?>" class="inp" name="tmybh" /></li>
 </ul>
 
 <? 
 while0("touchy_time,is_touchy","yjcode_control");
 $rowss=mysqli_fetch_array($res); 
 if(1==$rowss[is_touchy]){
 ?>
 <ul class="uk1">
 <li class="l1" style="color:red;">敏感内容：</li>
 <li class="l2" style="width:30px;">
 <label><input name="touchy" type="checkbox" value="1" <? if(1==$row[touchy]){?> checked<?}?> style="width:20px;height:20px;"/> </label>
 </li>
 <li class="l1" style="width:600px;text-align:left;color:red;">所有涉及敏感、灰色、及相关擦边内容必选；不主动选择者如发现后严肃处理！</li>
 </ul>
 
 <?}?>
 
 <ul class="uk uk0">
 <li class="l3"><? tjbtnr("下一步","serverlist.php")?></li>
 </ul>
 </form>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<script language="javascript">
//实例化编辑器
var ue = UE.getEditor('editor');
		
function xgtread(x){
 $.get("protp.php",{bh:x},function(result){
  $("#xgtp2").html(result);
 });
}
function deltp(x){
 document.getElementById("xgtp1").style.display="";
 $.get("protpdel.php",{id:x},function(result){
  xgtread("<?=$bh?>");
  document.getElementById("xgtp1").style.display="none";
 });
}
xgtread("<?=$bh?>");

</script>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>