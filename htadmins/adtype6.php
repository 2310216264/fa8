<?php
include("../config/conn.php");
include("../config/function.php");
AdminSes_audit();
$mb=$rowcontrol[wapmb];
if(empty($mb)){$mb="default";}
@include("../m/tem/moban/".$mb."/yjadmin/adtype.php");
?>
