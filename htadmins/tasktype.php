<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$sj=date("Y-m-d H:i:s");

//函数开始
if($_GET[control]=="add"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if(panduan("*","yjcode_tasktype where admin=1 and name1='".sqlzhuru($_POST[t1])."'")==1){Audit_alert("该分组已存在！","tasktype.php");}
 intotable("yjcode_tasktype","name1,xh,sj,admin,seokey,seodes","'".sqlzhuru($_POST[t1])."',".sqlzhuru($_POST[t2]).",'".$sj."',1,'".sqlzhuru($_POST[tseokey])."','".sqlzhuru($_POST[tseodes])."'");$id=mysqli_insert_id($conn);
 php_toheader("tasktype.php?t=suc");
 
}elseif($_GET[control]=="update"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if(panduan("*","yjcode_tasktype where admin=1 and name1='".sqlzhuru($_POST[t1])."' and id<>".$_GET[id])==1)
 {Audit_alert("该分组已存在！","tasktype.php?action=update&id=".$_GET[id]);}
 updatetable("yjcode_tasktype","name1='".sqlzhuru($_POST[t1])."' where name1='".sqlzhuru($_POST[oldty1])."'");
 updatetable("yjcode_tasktype","sj='".$sj."',xh=".sqlzhuru($_POST[t2]).",seokey='".sqlzhuru($_POST[tseokey])."',seodes='".sqlzhuru($_POST[tseodes])."' where id=".$_GET[id]);
 php_toheader("tasktype.php?t=suc&action=update&id=".$_GET[id]);

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
 
 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","tasktype.php?action=".$_GET[action]."&id=".$_GET[id]);}?>
 <div class="bqu1">
 <a href="javascript:void(0);" class="a1">任务分组</a>
 <a href="tasktypelist.php">返回列表</a>
 </div> 
 
 <!--begin-->
 <div class="rkuang">
 <? if($_GET[action]!="update"){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入名称！");document.f1.t1.focus();return false;}
 if((document.f1.t2.value).replace(/\s/,"")=="" || isNaN(document.f1.t2.value)){alert("请输入有效的排序号！");document.f1.t2.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="tasktype.php?control=add";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <ul class="uk">
 <li class="l1">分组名称：</li>
 <li class="l2"><input type="text" class="inp" name="t1" /></li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=returnxh("yjcode_tasktype","")?>" /> <span class="fd">序号越小，越靠前</span></li>
 <li class="l1">SEO关键词：</li>
 <li class="l2"><input type="text" class="inp" size="70" name="tseokey" /></li>
 <li class="l4">SEO描述：</li>
 <li class="l5"><textarea name="tseodes"></textarea></li>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /></li>
 </ul>
 </form>
 
 <? 
 }elseif($_GET[action]=="update"){
 while0("*","yjcode_tasktype where id=".$_GET[id]);if(!$row=mysqli_fetch_array($res)){php_toheader("tasktypelist.php");}
 ?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入名称！");document.f1.t1.focus();return false;}
 if((document.f1.t2.value).replace(/\s/,"")=="" || isNaN(document.f1.t2.value)){alert("请输入有效的排序号！");document.f1.t2.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="tasktype.php?control=update&id=<?=$row[id]?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <input type="hidden" value="<?=$row[name1]?>" name="oldty1" />
 <ul class="uk">
 <li class="l1">分组名称：</li>
 <li class="l2"><input type="text" value="<?=$row[name1]?>" class="inp" name="t1" /></li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=$row[xh]?>" /> <span class="fd">序号越小，越靠前</span></li>
 <li class="l1">SEO关键词：</li>
 <li class="l2"><input type="text" value="<?=$row[seokey]?>" class="inp" size="70" name="tseokey" /></li>
 <li class="l4">SEO描述：</li>
 <li class="l5"><textarea name="tseodes"><?=$row[seodes]?></textarea></li>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /></li>
 </ul>
 </form>
 <? }?>
 </div>
 <!--end-->
 
</div>
</div>
<?php include("bottom.php");?>
</body>
</html>