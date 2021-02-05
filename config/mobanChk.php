<?
include("../config/conn.php");
include("../config/function.php");
$name1=sqlzhuru($_GET[name1]);
if(!empty($name1)){
 if(is_file("../tem/moban/".$name1."/indextemplate.php")){
 updatetable("yjcode_control","nowmb='".$name1."'");
 $sqlcontrol="select * from yjcode_control";mysql_query("SET NAMES 'utf8'");$rescontrol=mysql_query($sqlcontrol,$conn);
 if(!$rowcontrol=mysql_fetch_array($rescontrol)){echo "<h1>站点未进行基本配置，导致网站无法运行,联系技术人员处理，错误代码ERR004。</h1>";exit;}
 html1();
 }
}
?>
