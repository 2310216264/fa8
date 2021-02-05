<?php
/**
 * 充值示范页面 
 * Created by codepay.
 * Date: 2017/8/2
 * Time: 15:03
 */
error_reporting(E_ALL & ~E_NOTICE);
session_start(); //开启session
require_once("codepay_config.php"); //导入配置文件
require_once("lib/codepay_core.function.php"); //导入所需函数库
require_once("lib/codepay_md5.function.php"); //导入MD5函数库


$a=str_replace(" ","",microtime());$a=str_replace(".","",$a);$user=$a;

//print_r($_SESSION);// 打印全部SESSION  需要先开启session
//print_r($_COOKIE);// 打印全部cookie  

//$user可以从$_SESSION或者$_COOKIE里取出当前登录的用户。 不同网站未必都有保存 也许保存的用户ID

//比如session中数组名为username取到了当前登录的用户名  则为 $user = $_SESSION['username'];


//$_SESSION["uuid"]=guid();//生成UUID 添加到网页表单 防止使用部分软件恶意提交订单
//$salt=md5($_SESSION["uuid"]); //这是用于表单防跨站提交

if ((int)$codepay_config['id'] <= 1) { //未修改配置文件
    exit('<h3>您需要修改配置文件：codepay_config.php 或者安装码支付接口 才能显示该页面。 <a href="install.php">点击安装</a></h3>');
} 

?>

<?
include("../../config/conn.php");
function returnuserid($u){
if(empty($u)){return 0;}else{
$sqlother="select id,uid from yjcode_user where uid='".$u."'";mysql_query("SET NAMES 'GBK'");$resother=mysql_query($sqlother);
if($rowother=mysql_fetch_array($resother)){return $rowother[id];}else{return 0;}
}
}
function updatetable($utable,$ures){global $conn;$sqlupdate="update ".$utable." set ".$ures;mysql_query("SET NAMES 'GBK'");mysql_query($sqlupdate,$conn);}
function intotable($itable,$zdarr,$resarr){global $conn;$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";mysql_query("SET NAMES 'GBK'");mysql_query($sqlinto,$conn);}
function while0($wzd,$wses){global $res;$sql="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res=mysql_query($sql);}function while1($wzd,$wses){global $res1;$sql1="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res1=mysql_query($sql1);}function while2($wzd,$wses){global $res2;$sql2="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res2=mysql_query($sql2);}function while3($wzd,$wses){global $res3;$sql3="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res3=mysql_query($sql3);}
function php_toheader($nurlx){echo "<script>";echo "location.href='".$nurlx."';";echo "</script>";exit;}
function Audit_alert($alertStr,$alertUrl,$par=""){echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=gb2312\"><script>";echo "alert('".$alertStr."');".$par."location.href='".$alertUrl."';";echo "</script>";exit;}define("CHR",weburl);
function returnyhmoney($m,$m2,$m3,$s1,$s2,$s3,$d){if(2==$m){if($s1>=$s2 && $s1<=$s3){$mv=$m3;}else{$mv=$m2;}if($s1>$s3){updatetable("yjcode_pro","yhxs=1 where id=".$d);}}else{$mv=$m2;}return $mv;}
function returnyunfei($u,$s,$sl,$p){//u商家 s买家收货ID sl数量 p商品编号
 $resu=0;
 if(empty($s)){$resu=0;}
 $sqlyf="select * from yjcode_shdz where id=".$s;mysql_query("SET NAMES 'GBK'");$resyf=mysql_query($sqlyf);
 if($rowyf=mysql_fetch_array($resyf)){$a1=$rowyf[add1];$a2=$rowyf[add2];$a3=$rowyf[add3];}

 $s="|".$a1.",".$a2.",".$a3."|";
 $sqlyf="select * from yjcode_yunfei where cityid like '%".$s."%' and userid=".$u." order by money1 asc";mysql_query("SET NAMES 'GBK'");$resyf=mysql_query($sqlyf);
 if($rowyf=mysql_fetch_array($resyf)){$m1=$rowyf[money1];$m2=$rowyf[money2];}

 $s="|".$a1.",".$a2.",0|";
 $sqlyf="select * from yjcode_yunfei where cityid like '%".$s."%' and userid=".$u." order by money1 asc";mysql_query("SET NAMES 'GBK'");$resyf=mysql_query($sqlyf);
 if($rowyf=mysql_fetch_array($resyf)){$m1=$rowyf[money1];$m2=$rowyf[money2];}

 $s="|".$a1.",0,0|";
 $sqlyf="select * from yjcode_yunfei where cityid like '%".$s."%' and userid=".$u." order by money1 asc";mysql_query("SET NAMES 'GBK'");$resyf=mysql_query($sqlyf);
 if($rowyf=mysql_fetch_array($resyf)){$m1=$rowyf[money1];$m2=$rowyf[money2];}

 $s="|0,0,0|";
 $sqlyf="select * from yjcode_yunfei where cityid like '%".$s."%' and userid=".$u." order by money1 asc";mysql_query("SET NAMES 'GBK'");$resyf=mysql_query($sqlyf);
 if($rowyf=mysql_fetch_array($resyf)){$m1=$rowyf[money1];$m2=$rowyf[money2];}
 
 $sqlp="select * from yjcode_pro where bh='".$p."'";mysql_query("SET NAMES 'GBK'");$resp=mysql_query($sqlp);$rowp=mysql_fetch_array($resp);
 if(5==$rowp[fhxs]){
  $zz=$rowp[zl]*$sl;//总量
  if($zz<=1){$resu=$m1;}else{
  $resu=ceil($zz-1)*$m2+$m1;
  }
 }else{$resu=0;}
 
 if(is_numeric($resu)){return $resu;}else{return 0;}
 
}
$sqluser="select * from yjcode_user where uid='".$_SESSION[SHOPUSER]."'";mysql_query("SET NAMES 'GBK'");$resuser=mysql_query($sqluser,$conn);
if(!$rowuser=mysql_fetch_array($resuser)){php_toheader($lj."user/reg/");}

$userid=returnuserid($_SESSION["SHOPUSER"]);
$sj=date("Y-m-d H:i:s");
include("../buycheck.php");
$bh=time();
$ddbh=$user;	
$uip=$_SERVER["REMOTE_ADDR"];


$money1=sprintf("%.2f",($needmoney*10-$usermoney*10)/10);

intotable("yjcode_dingdang","bh,ddbh,userid,sj,uip,money1,ddzt,alipayzt,bz,ifok,carid,sxf","'".$bh."','".$ddbh."',".$userid.",'".$sj."','".$uip."',".$money1.",'等待买家付款','','码支付',0,'".$caridarr."',".$sxf."");
intotable("codepay_user","user,money,vip,status","'".$ddbh."',".$money1.",0,0");
?>

<!DOCTYPE html>
<html>
<head><title>
        在线充值
    </title>
     <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $codepay_config['chart'] ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" type="text/css" href="css/userPay.css">

    <style>
        a:link {
            text-decoration: none;
        }

        　　 a:active {
            text-decoration: blink
        }

        　　 a:hover {
            text-decoration: underline;
        }

        　　 a:visited {
            text-decoration: none;
        }

        *, :after, :before {
            /* -webkit-box-sizing: border-box; */
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        button, html input[type=button], input[type=reset], input[type=submit] {
            -webkit-appearance: button;
            cursor: pointer;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="loadingPicBlock" style="max-width: 720px;margin:0 auto;" class="pay">
    <header class="g-header">

        <div class="head-r">
            <a href="/" class="z-HReturn" data-dismiss="modal" aria-hidden="true"><s></s><b>首页</b></a>
        </div>
    </header>

    <section class="clearfix g-member">
        <div class="g-Recharge" style="display:none;">
            <ul id="ulOption">
                <!--注意修改金额 需要修改前面的值 money="10" -->
                <li money="10"><a href="javascript:;">10元<s></s></a></li>
                <li money="20"><a href="javascript:;">20元<s></s></a></li>
                <li money="50"><a href="javascript:;">50元<s></s></a></li> <!--class="z-sel" 表示默认选中50元-->
                <li money="100"><a href="javascript:;">100元<s></s></a></li>
                <li money="200"><a href="javascript:;">200元<s></s></a></li>
                <li money="500"><a href="javascript:;">500元<s></s></a></li>
            </ul>
        </div>
        <form action="codepay.php" method="post">
            <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
                <ul id="ulBankList">
                    <li class="gray6" style="width: 100%;padding: 5px 0px 0px 10px;height: 50px;">支付费用：<label class="input" style="border: 1px solid #EAEAEA;height: 35px;font-size:30px;">
                            <input type="text" name="price" id="price" placeholder="如：50" value="<?=$money1?>" style="width: 170px;color: red;font-size:20px;">   <!--默认输入金额值50-->
                        </label> 元
                    </li>
                    <li class="gray6" style="width: 100%;padding: 5px 0px 0px 10px;display: none;height: 50px;">充值用户名：<label class="input" style="border: 1px solid #EAEAEA;height: 30px;font-size: 30px;">
                            <input type="text" name="user" id="user" placeholder="用户名" value="<? echo $user;?>" style="width: 180px;font-size: 16px;">
                        </label></li>
                    <li paytype="1" class="gray9" type="codePay" style="width: 33%">
                        <a href="javascript:;" class="z-initsel"><img src="img/alipay.jpg"><s></s></a>

                    </li>

                </ul>
            </article>
            <input type="hidden" id="pay_type" value="1" name="type"> <!--值1表示支付宝默认-->
            <input type="hidden" value="<?php echo $salt; ?>" name="salt">

            <div class="mt10 f-Recharge-btn">

                <button id="btnSubmit" type="submit" href="javascript:;" class="orgBtn">确认支付</button>
            </div>
        </form>
    </section>

    <input id="hidIsHttps" type="hidden" value="0"/>
    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">

        $(function () {
            var c;
            var g = false;
            var a = null;
            var e = function () {
                $("#ulOption > li").each(function () {
                    var n = $(this);
                    n.click(function () {
                        g = false;
                        c = n.attr("money");
                        n.children("a").addClass("z-sel");
                        n.siblings().children().removeClass("z-sel").removeClass("z-initsel");
                        var needMoney = parseFloat(n.attr("money")).toFixed(2);
                        if (needMoney <= 0)needMoney = 0.01;
                        $("#price").val(needMoney);
                    })
                });
                $("#ulBankList > li").each(function (m) {
                    var n = $(this);
                    n.click(function () {
                        if (m < 2)return;
                        $("#pay_type").val(n.attr("payType"));
                        n.children("a").addClass("z-initsel");
                        n.siblings().children().removeClass("z-initsel");
                    })
                });

            };
            e()
        });

    </script>


</div>
</body>
</html>

