<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$bh=$_GET[bh];
while0("*","yjcode_servertype where bh='".$bh."'");if(!$row=mysqli_fetch_array($res)){php_toheader("servertypelist.php");}
//函数开始
if($_GET[control]=="update"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if(panduan("*","yjcode_servertype where admin=1 and name1='".sqlzhuru($_POST[t1])."' and bh<>'".$bh."' and zt=0")==1){Audit_alert("该服务分类已存在！","servertype1.php?action=update&bh=".$bh);}
 $oldname1=sqlzhuru($_POST[toldname1]);
 if(!empty($oldname1)){
 updatetable("yjcode_servertype","name1='".sqlzhuru($_POST[t1])."' where name1='".$oldname1."'");
 }
 updatetable("yjcode_servertype","name1='".sqlzhuru($_POST[t1])."',sj='".getsj()."',xh=".sqlzhuru($_POST[t2]).",zt=0 where bh='".$bh."'");
 php_toheader("servertype1.php?t=suc&bh=".$bh);

}
//函数结果
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理后台</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu1").className="a1";
</script>
<? if(!strstr($adminqx,",0,") && !strstr($adminqx,",0302,")){echo "<div class='noneqx'>无权限</div>";exit;}?>

<div class="yjcode">
 <? $leftid=1;include("menu_quan.php");?>

<div class="right">
 
 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！[<a href='servertype1lx.php'>添加新分组</a>]","servertype1.php?bh=".$bh);}?>
 <div class="bqu1">
 <a href="javascript:void(0);" class="a1">编辑服务市场分组</a>
 <a href="servertypelist.php">返回列表</a>
 </div> 
 
 <!--begin-->
 <div class="rkuang">
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入任务分类名称！");document.f1.t1.focus();return false;}
 if((document.f1.t2.value).replace(/\s/,"")=="" || isNaN(document.f1.t2.value)){alert("请输入有效的排序号！");document.f1.t2.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="servertype1.php?control=update&bh=<?=$bh?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <input type="hidden" value="<?=$row[name1]?>" name="toldname1" />
 <ul class="uk">
 <li class="l1">分类名称：</li>
 <li class="l2"><input type="text" value="<?=$row[name1]?>" class="inp" name="t1" /></li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=$row[xh]?>" /> <span class="fd">序号越小，越靠前</span></li>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /></li>
 </ul>
 </form>
 </div>
 <!--end-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>