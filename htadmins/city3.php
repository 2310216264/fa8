<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$sj=date("Y-m-d H:i:s");
$pid=$_GET[pid];
while0("*","yjcode_city where bh='".$pid."' and level=2");if(!$row=mysqli_fetch_array($res)){php_toheader("citylist.php");}
$city2=$row[name1];
while0("*","yjcode_city where bh='".$row[parentid]."' and level=1");if(!$row=mysqli_fetch_array($res)){php_toheader("citylist.php");}
$mbh=$row[bh];
$city1=$row[name1];

//函数开始
if($_GET[control]=="add"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
 zwzr();
 if(panduan("*","yjcode_city where level=3 and name1='".sqlzhuru($_POST[t1])."' and parentid='".$pid."'")==1)
 {Audit_alert("该区域已存在！","city3.php?pid=".$pid);}
 intotable("yjcode_city","bh,name1,level,parentid,xh","'".time()."','".sqlzhuru($_POST[t1])."',3,'".$pid."',".sqlzhuru($_POST[t2])."");
 php_toheader("city3.php?t=suc&pid=".$pid);
 
}elseif($_GET[control]=="update"){
 if(!strstr($adminqx,",0,") && !strstr($adminqx,",0301,")){Audit_alert("权限不够","default.php");}
 zwzr();
 $id=intval($_GET[id]);
 if(panduan("*","yjcode_city where level=3 and name1='".sqlzhuru($_POST[t1])."' and id<>".$id." and parentid='".$pid."'")==1)
 {Audit_alert("该区域已存在！","city3.php?action=update&id=".$id."&pid=".$pid);}
 updatetable("yjcode_city","name1='".sqlzhuru($_POST[t1])."',xh=".sqlzhuru($_POST[t2])." where level=3 and id=".$id);
 php_toheader("city3.php?t=suc&action=update&id=".$id."&pid=".$pid);

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
 
 <? if($_GET[t]=="suc"){systs("恭喜您，操作成功！","city3.php?action=".$_GET[action]."&pid=".$pid."&id=".$_GET[id]);}?>
 
 <div class="bqu1">
 <a href="javascript:void(0);" class="a1"><?=$row[name1]?></a>
 <a href="citylist1.php?pid=<?=$mbh?>">返回列表</a>
 </div> 

 <!--begin-->
 <div class="rkuang">
 <? if($_GET[action]!="update"){?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入名称！");document.f1.t1.focus();return false;}
 if((document.f1.t2.value).replace(/\s/,"")=="" || isNaN(document.f1.t2.value)){alert("请输入有效的排序号！");document.f1.t2.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="city3.php?control=add&pid=<?=$pid?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="uk">
 <li class="l1">一级区域：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" value="<?=$city1?>" /></li>
 <li class="l1">二区域：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" value="<?=$city2?>" /></li>
 <li class="l1">区域名称：</li>
 <li class="l2"><input type="text" class="inp" name="t1" /></li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=returnxh("yjcode_city"," and level=3 and parentid='".$pid."'")?>" /> <span class="fd">序号越小，越靠前</span></li>
 <li class="l3"><input type="submit" value="保存修改" class="btn1" /></li>
 </ul>
 </form>
 
 <? 
 }elseif($_GET[action]=="update"){
 while0("*","yjcode_city where level=3 and id=".$_GET[id]);if(!$row=mysqli_fetch_array($res)){php_toheader("citylist.php");}
 ?>
 <script language="javascript">
 function tj(){
 if((document.f1.t1.value).replace(/\s/,"")==""){alert("请输入名称！");document.f1.t1.focus();return false;}
 if((document.f1.t2.value).replace(/\s/,"")=="" || isNaN(document.f1.t2.value)){alert("请输入有效的排序号！");document.f1.t2.focus();return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="city3.php?control=update&id=<?=$row[id]?>&pid=<?=$pid?>";
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="uk">
 <li class="l1">一级区域：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" value="<?=$city1?>" /></li>
 <li class="l1">二区域：</li>
 <li class="l2"><input type="text" class="inp redony" readonly="readonly" value="<?=$city2?>" /></li>
 <li class="l1">区域名称：</li>
 <li class="l2"><input type="text" class="inp" name="t1" value="<?=$row[name1]?>" /></li>
 <li class="l1">排序：</li>
 <li class="l2"><input type="text" class="inp" name="t2" value="<?=$row[xh]?>" /> <span class="fd">序号越小，越靠前</span></li>
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