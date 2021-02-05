<?
 //自动识别B
 while1("*","yjcode_chajian where cjbh='cj002' and zt=0");if($row1=mysqli_fetch_array($res1)){
 if(!empty($row1[var1]) && !empty($row1[var2])){
 $str=yjImgToBase64($sfztp1);
 $str1=preg_split("/,/",$str);
 $showapi_appid = $row1[var1];
 $showapi_secret = $row1[var2];
 $paramArr = array('showapi_appid'=> $showapi_appid,'imgData'=> $str1[1],'type'=> "1");
 $paraStr = "";
 $signStr = "";
 ksort($paramArr);
 foreach ($paramArr as $key => $val) {
 if ($key != '' && $val != '') {
 $signStr .= $key.$val;
 $paraStr .= $key.'='.urlencode($val).'&';
 }
 }
 $signStr .= $showapi_secret;
 $sign = strtolower(md5($signStr));
 $paraStr .= 'showapi_sign='.$sign;
 $arrv = array('showapi_appid'=> $showapi_appid,'imgData'=> $str1[1],'showapi_sign'=> $sign,'type'=> "1");
 $url = 'http://route.showapi.com/1429-1?';
 $result = httpPost($url,$arrv);
 $jg1 = json_decode($result,true);
 $jg2 = $jg1["showapi_res_body"];
 $Gname=iconv("gb2312","utf-8",$jg2["name"]) ;
 if($jg2["ret_code"]=="0" && $uname==$Gname && $sfz==$jg2["idNo"]){updatetable("yjcode_user","sfzrz=1 where id=".$rowuser[id]);}
 else{updatetable("yjcode_user","sfzrz=2 where id=".$rowuser[id]);}
 }
 }
 //自动识别E
?>