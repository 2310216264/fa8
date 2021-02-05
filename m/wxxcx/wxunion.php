<?
include("../../config/conn.php");
include("../../config/function.php");
$appid="wx18ed767a29994610";

$url ="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=cd9de405a2eb125e02d4619026c51421&js_code=".$_GET[code]."&grant_type=authorization_code";
$userInfo = file_get_contents($url);

$fp= fopen("1.txt","w");
fwrite($fp,$userInfo);
fclose($fp);

$userInfo = json_decode($userInfo, true);
if (!$userInfo['unionid']) {
  $str2=json_encode(array('data'=>'','message'=>'error'));
} else {
  $str2=json_encode(array('data'=> $userInfo['unionid'],'message'=>'success'));
}


?>
