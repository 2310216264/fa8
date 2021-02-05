<?
include("../config/conn.php");
include("../config/function.php");
sesCheck();
$userid=returnuserid($_SESSION[SHOPUSER]);
//入库操作开始
if($_POST[yjcode]=="yunfei"){
 zwzr();
 deletetable("yjcode_yfsz where userid=".$userid);
 $num1=($_POST[yfnum]);
 for($i=1;$i<$num1;$i++){
  $bh=$userid."-".$i;
  $pbh=sqlzhuru($_POST["bh_".$i]);
  $money1=sqlzhuru($_POST["money1_".$i]);
  $money2=sqlzhuru($_POST["money2_".$i]);
  $name1=sqlzhuru($_POST["name1_".$i]);
  intotable("yjcode_yfsz","bh,userid,city1bh,city1name,money1,money2","'".$bh."',".$userid.",'".$pbh."','".$name1."',".$money1.",".$money2."");
 }
 php_toheader("yunfei.php?t=suc");
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
<script language="javascript">
function tj(){
 if(!confirm("确定要提交保存吗？")){return false;}
 layer.msg('正在提交', {icon: 16  ,time: 0,shade :0.25});
 f1.action="yunfei.php";
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
 
 <? include("sellzf.php");?>
 <? include("rcap16.php");?>
 <script language="javascript">
 document.getElementById("rcap1").className="l1 l2";
 </script>

 <!--白B-->
 <div class="rkuang">
 
 <? systs("恭喜您，操作成功!","yunfei.php")?>
 <ul class="yunfeicap">
 <li class="l1">省</li>
 <li class="l2">首重(元/KG)</li>
 <li class="l2">续重(元/KG)</li>
 <li class="l1">省</li>
 <li class="l2">首重(元/KG)</li>
 <li class="l2">续重(元/KG)</li>
 <li class="l1">省</li>
 <li class="l2">首重(元/KG)</li>
 <li class="l2">续重(元/KG)</li>
 </ul>
 
 <?
 if(panduan("*","yjcode_yfsz where userid=".$rowuser[id])==0){
  while1("*","yjcode_city where level=1 order by id asc");while($row1=mysqli_fetch_array($res1)){
   $bh=$rowuser[id]."-".$row1[id];
   intotable("yjcode_yfsz","bh,userid,city1bh,city1name,money1,money2","'".$bh."',".$rowuser[id].",'".$row1[bh]."','".$row1[name1]."',0,0");
  }
 }
 ?>
 <form name="f1" method="post" onsubmit="return tj()">
 <ul class="yunfeilist">
 <? $i=1;while1("*","yjcode_yfsz where userid=".$rowuser[id]." order by id asc");while($row1=mysqli_fetch_array($res1)){?>
 <li class="l1">
 <?=$row1[city1name]?>
 <input type="hidden" value="<?=$row1[city1bh]?>" name="bh_<?=$i?>" />
 <input type="hidden" value="<?=$row1[city1name]?>" name="name1_<?=$i?>" />
 </li>
 <li class="l2"><input type="text" name="money1_<?=$i?>" value="<?=$row1[money1]?>" /></li>
 <li class="l2"><input type="text" name="money2_<?=$i?>" value="<?=$row1[money2]?>" /></li>
 <? $i++;}?>
 </ul>
 <input type="hidden" value="yunfei" name="yjcode" />
 <input type="hidden" value="<?=$i?>" name="yfnum" />
 <div class="yunfeifb"><input type="submit" value="提交保存" /></div>
 </form>

 <div class="clear clear15"></div>
 
 </div>
 <!--白E-->

</div> 
<!--RE-->

</div>

<div class="clear clear15"></div>
<? include("../tem/bottom.html");?>
</body>
</html>