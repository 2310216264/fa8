<?
include("../../config/conn.php");
include("../../config/function.php");
$xcxpay=preg_split("/,/",$rowcontrol[xcxpay]);
$wxpay=preg_split("/,/",$rowcontrol[wxpay]);
$fp= fopen("1.txt","w");
fwrite($fp,$rowcontrol[xcxpay]);
fclose($fp);
function getOpenid($code){ // $code为小程序提供
        global $rowcontrol;
        $xcxpay=preg_split("/,/",$rowcontrol[xcxpay]);
        $appid = $xcxpay[0]; // 小程序APPID
        $secret = $xcxpay[1]; // 小程序secret
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

while0("*","yjcode_dingdang where ddbh='".$_GET[ddbh]."' and userid=".intval($_GET[userid])."");$row=mysqli_fetch_array($res);
$appid=$xcxpay[0];
$str=getOpenid($_GET[code]);
$a1=preg_split("/\"openid\":\"/",$str);
$a2=preg_split("/\"/",$a1[1]);
$openid=$a2[0];
$timeStamp=time();
$out_trade_no=$row[ddbh];
$nonce_str=MD5($out_trade_no);
$key=$wxpay[2];
$body="微信支付";
$mch_id=$wxpay[1];
if($_GET[bk]=="pay"){
$notify_url = weburl."m/user/wxpay/example/notify.php";
}elseif($_GET[bk]=="carpay"){
$notify_url = weburl."m/user/wxpay/example/buy_notify.php";
}
$scene_info ='{"h5_info":{"type":"Wap","wap_url":"'.weburl.'","wap_name":"支付"}}';//场景信息 必要参数
$spbill_create_ip = getIp(); //IP
$total_fee =$row[money1]*100; //金额
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

echo $timeStamp.",".$nonce_str.",".$preid.",".$paySign;
exit;
?>
