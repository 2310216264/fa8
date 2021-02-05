<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();

//函数开始
if($_GET[control]=="add"){
 if(!strstr($adminqx,",0,")){Audit_alert("权限不够","default.php");}
 zwzr();
 deletetable("yjcode_chajian where cjbh='cj001'");
 intotable("yjcode_chajian","bh,sj,cjbh,tit,var1,var2,zt","'".returnbh()."','".getsj()."','cj001','快递查询接口（showapi.com）','".sqlzhuru($_POST[t1])."','".sqlzhuru($_POST[t2])."',0");
 php_toheader("chajian_kdcx.php?t=suc");
}

while0("*","yjcode_chajian where cjbh='cj001'");if($row=mysqli_fetch_array($res)){$var1=$row[var1];$var2=$row[var2];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=webname?>管理系统</title>
<link href="css/basic.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script language="javascript" src="js/basic.js"></script>
<script language="javascript" src="js/layer.js"></script>
</head>
<body>
<? include("top.php");?>
<script language="javascript">
document.getElementById("menu7").className="a1";
</script>

<div class="yjcode">
 <? $leftid=1;include("menu_chajian.php");?>

<div class="right">
 <!--B-->
 <? systs("恭喜您，操作成功!","chajian_kdcx.php")?>
 <div class="bqu1">
 <a href="javascript:void(0);" class="a1">快递查询接口</a>
 </div> 
 <div class="rkuang">
 <script language="javascript">
 function tj(){
  layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
  f1.action="chajian_kdcx.php?control=add"; 
 }
 </script>
 <form name="f1" method="post" onsubmit="return tj()" enctype="multipart/form-data">
 <ul class="uk">
 <li class="l1">接口来源：</li>
 <li class="l21"><a href="https://www.showapi.com/api/view/64" target="_blank">https://www.showapi.com/api/view/64</a></li>
 <li class="l1">接口appid：</li>
 <? if(!strstr($adminqx,",0,")){$sv="机密数据,权限不够";}else{$sv=$var1;}?>
 <li class="l2"><input type="text" value="<?=$sv?>" class="inp" size="20" name="t1" /></li>
 <li class="l1">接口secret：</li>
 <? if(!strstr($adminqx,",0,")){$sv="机密数据,权限不够";}else{$sv=$var2;}?>
 <li class="l2"><input type="text" value="<?=$sv?>" class="inp" size="40" name="t2" /></li>
 <li class="l3"><input type="submit" value="保存" class="btn1" /></li>
 </ul>
 </form>

 </div>
 <!--E-->
 
</div>

</div>

<?php include("bottom.php");?>
</body>
</html>