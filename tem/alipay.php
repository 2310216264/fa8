<?
include("../config/conn.php");
include("../config/function.php");
$par=$_GET[par];
$sec=$_GET[sec];
if(empty($par) || empty($sec)){echo "err1";exit;}
while1("*","yjcode_control where partner='".$par."' and security_code='".$sec."'");if(!$row1=mysqli_fetch_array($res1)){echo "err2";exit;}
echo "ok";
?>
