<?
include("../config/conn.php");
include("../config/function.php");
function getOpenid($code){ // $code为小程序提供
        $appid = 'wx18ed767a29994610'; // 小程序APPID
        $secret = 'cd9de405a2eb125e02d4619026c51421'; // 小程序secret
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret='.$secret.'&js_code='.$code.'&grant_type=authorization_code';    
            
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。    
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        
        return $res; // 这里是获取到的信息
    }

function getIp(){    
    $ip = '';    
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){        
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];    
    }elseif(isset($_SERVER['HTTP_CLIENT_IP'])){        
        $ip = $_SERVER['HTTP_CLIENT_IP'];    
    }else{        
        $ip = $_SERVER['REMOTE_ADDR'];    
    }
    $ip_arr = explode(',', $ip);
    return $ip_arr[0];
 }
 
function curl_post_https($url,$data){ // 模拟提交数据函数
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        echo 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据，json格式
}

$appid="wx18ed767a29994610";

$str=getOpenid($_GET[code]);
$a1=preg_split("/\"openid\":\"/",$str);
$a2=preg_split("/\"/",$a1[1]);
$openid=$a2[0];
$b1=preg_split("/\"session_key\":\"/",$str);
$b2=preg_split("/\"/",$b1[1]);
$session_key=$b2[0];


//登录注册验证B

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


//登录注册验证B


$timeStamp=time();
$out_trade_no=returnbh();
$nonce_str=MD5($out_trade_no);
$key="AX52156789754wxXES945POIWX85990a";
$body="yjweixin";
$mch_id="1428088802";
$notify_url = weburl."m/user/wxpay/example/buy_notify.php"; //回调地址
$scene_info ='{"h5_info":{"type":"Wap","wap_url":"'.weburl.'","wap_name":"支付"}}';//场景信息 必要参数
$spbill_create_ip = getIp(); //IP
$total_fee =100; //金额
$trade_type = 'JSAPI';//交易类型 具体看API 里面有详细介

$signA ="appid=$appid&body=$body&mch_id=$mch_id&nonce_str=$nonce_str&notify_url=$notify_url&openid=$openid&out_trade_no=$out_trade_no&scene_info=$scene_info&spbill_create_ip=$spbill_create_ip&total_fee=$total_fee&trade_type=$trade_type";
$strSignTmp = $signA."&key=$key"; //拼接字符串  注意顺序微信有个测试网址 顺序按照他的来 直接点下面的校正测试 包括下面XML  是否正确
$sign = strtoupper(MD5($strSignTmp)); // MD5 后转换成大写
$post_data = "<xml>
                        <appid>$appid</appid>
                        <body>$body</body>
                        <mch_id>$mch_id</mch_id>
                        <nonce_str>$nonce_str</nonce_str>
                        <notify_url>$notify_url</notify_url>
						<openid>$openid</openid>
                        <out_trade_no>$out_trade_no</out_trade_no>
                        <scene_info>$scene_info</scene_info>
                        <spbill_create_ip>$spbill_create_ip</spbill_create_ip>
                        <total_fee>$total_fee</total_fee>
                        <trade_type>$trade_type</trade_type>
                        <sign>$sign</sign>
                    </xml>";//拼接成XML 格式
$url = "https://api.mch.weixin.qq.com/pay/unifiedorder";//微信传参地址
$dataxml = curl_post_https($url,$post_data); //后台POST微信传参地址  同时取得微信返回的参数    POST 方法我写下面了
$objectxml = (array)simplexml_load_string($dataxml, 'SimpleXMLElement', LIBXML_NOCDATA); //将微信返回的XML 转换成数组
$preid=$objectxml["prepay_id"];


$paySign = strtoupper(MD5("appId=".$appid."&nonceStr=".$nonce_str."&package=prepay_id=".$preid."&signType=MD5&timeStamp=".$timeStamp."&key=".$key.""));

$url="../wxpay/wxpay?timeStamp=".$timeStamp."&nonceStr=".$nonce_str."&prepay_id=".$preid."&paySign=".$paySign;
echo $timeStamp.",".$nonce_str.",".$preid.",".$paySign;
//$fp= fopen("1.txt","w");
//fwrite($fp,$url);
//fclose($fp);
exit;
?>
