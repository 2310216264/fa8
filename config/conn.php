<?

session_start();

header("Content-type: text/html; charset=utf-8"); 

include_once("config.php");

include("mysql.class.php");
include_once("sql.php");



$mysqldk=sqldk;if(empty($mysqldk)){$mysqldk="3306";}

if(sqlhost=="localhost"){$dkv=":".$mysqldk;}else{$dkv="";}



$conn=mysqli_connect(sqlhost.$dkv,root,123456) or die("ERR001,联系技术人员处理");

mysqli_select_db($conn,fa8zhan) or die("ERR002,联系技术人员处理");

date_default_timezone_set('Asia/Shanghai');



$sqlcontrol="select * from yjcode_control";mysqli_set_charset($conn,"utf8");$rescontrol=mysqli_query($conn,$sqlcontrol);

if(!$rowcontrol=mysqli_fetch_array($rescontrol)){echo "<h1>站点未进行基本配置，导致网站无法运行,联系技术人员处理，错误代码ERR004。</h1>";exit;}

define("weburl",$rowcontrol["weburlv"]); 

define("webname",$rowcontrol["webnamev"]);

define("websypos",$rowcontrol["websyposv"]);



/*关站B*/

if(!empty($rowcontrol["ifclose"])){

 if(!is_file("default.php")){

 echo "<h3 align='center' style='margin-top:100px;'>".$rowcontrol["closesm"]."</h1>";exit;

 }

}

/*关站E*/



/*

    function mysql_connect($dbhost, $dbuser, $dbpass){

        global $dbport;

        global $dbname;

        global $mysqli;

        $mysqli = mysqli_connect("$dbhost:$dbport", $dbuser, $dbpass, $dbname);

        return $mysqli;

        }

    function mysql_select_db($dbname){

        global $mysqli;

        return mysqli_select_db($mysqli,$dbname);

        }

    function mysql_fetch_array($result){

        return mysqli_fetch_array($result);

        }

    function mysql_fetch_assoc($result){

        return mysqli_fetch_assoc($result);

        }

    function mysql_fetch_row($result){

        return mysqli_fetch_row($result);

        }

    function mysql_query($query){

        global $mysqli;

        return mysqli_query($mysqli,$query);

        }

    function mysql_escape_string($data){

        global $mysqli;

        return mysqli_real_escape_string($mysqli, $data);

        }

    function mysql_real_escape_string($data){

        return mysql_real_escape_string($data);

        }

    function mysql_close(){

        global $mysqli;

        return mysqli_close($mysqli);

        }

*/





?>