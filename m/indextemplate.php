<?
include("../config/conn.php");
include("../config/function.php");
$mb=$rowcontrol[wapmb];
if(empty($mb)){$mb="default";}
echo htmlget(weburl."m/tem/moban/".$mb."/indextemplate.php");
?>