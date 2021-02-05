//这里是友价商城系统全局JS，
//不受模板影响，
//就是任何模板都可以或可能调用的一些通用样式，写在这里
//www.yj99.cn，请勿修改

//手机版判断
function is_mobile() {
  var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
  var u = navigator.userAgent;
  if (null == u) {
   return true;
  }
  var result = regex_match.exec(u);
  if (null == result) {
   return false
  } else {
   return true
  }
}

//头部登录验证
function userCheckses(){
$.get(document.getElementById("webhttp").innerHTML+"tem/sesCheck.php",{},function(result){
 if(result=="0"){
 document.getElementById("notlogin").style.display="";
 document.getElementById("yeslogin").style.display="none";
 return false;
 }else{
 r=result.split(" ");
 document.getElementById("yeslogin").style.display="";
 document.getElementById("notlogin").style.display="none";
 document.getElementById("yesuid").innerHTML=r[0];
 if(r[1]=="yes"){document.getElementById("dontqd").style.display="";document.getElementById("needqd").style.display="none";}
 else{document.getElementById("dontqd").style.display="none";document.getElementById("needqd").style.display="";}
 return false;
 }
});
}


//弹出QQ联系
function opentangqq(x,y,z){
layer.open({
  type: 2,
  shadeClose :true,
  area: ['320px', '170px'],
  title:["联系方式","text-align:left"],
  content:[document.getElementById("webhttp").innerHTML+'tem/tangqq.php?qq='+x+'&wx='+y+'&id='+z, 'no'] 
});
}

//弹出修改服务市场附加费用联系
function servermoney2tang(x){
layer.open({
  type: 2,
  shadeClose :true,
  area: ['308px', '145px'],
  title:["修改附加费用","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:[document.getElementById("webhttp").innerHTML+'tem/servermoney2.php?id='+x, 'no'] 
});
}

//相加
function addNum(num1,num2){ //避免出现小数点多位的情况
var sq1,sq2,m;
try{sq1=num1.toString().split(".")[1].length;} catch(e){sq1=0;}
try{sq2=num2.toString().split(".")[1].length;} catch(e){sq2=0;}
m=Math.pow(10,Math.max(sq1,sq2));
return ( num1 * m + num2 * m ) / m;
}

//相乘
function accMul(arg1,arg2){
 var m=0,s1=arg1.toString(),s2=arg2.toString();
 try{m+=s1.split(".")[1].length}catch(e){}
 try{m+=s2.split(".")[1].length}catch(e){}
 return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m);
}

//提交
function tjwait(){
document.getElementById("tjbtn").style.display="none";
document.getElementById("tjing").style.display="";	
}

//邮箱判断
function isEmail(str){//判断邮箱
var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
return reg.test(str);
}

//回到顶部
function gotoTop(acceleration,stime){acceleration=acceleration||0.1;stime=stime||10;var x1=0;var y1=0;var x2=0;var y2=0;var x3=0;var y3=0;if(document.documentElement){x1=document.documentElement.scrollLeft||0;y1=document.documentElement.scrollTop||0;}
if(document.body){x2=document.body.scrollLeft||0;y2=document.body.scrollTop||0;}
var x3=window.scrollX||0;var y3=window.scrollY||0;var x=Math.max(x1,Math.max(x2,x3));var y=Math.max(y1,Math.max(y2,y3));var speeding=1+ acceleration;window.scrollTo(Math.floor(x/speeding),Math.floor(y/speeding));if(x>0||y>0){var run="gotoTop("+ acceleration+", "+ stime+")";window.setTimeout(run,stime);}}

//对象DIS
function objdis(x,y){
 if(0==x){document.getElementById(y).style.display="none";}	
 else if(1==x){document.getElementById(y).style.display="";}	
}

//跳转
function gourl(x){
 location.href=x;
}

//全选
function xuan(){
 c2=document.getElementsByName("C2");
 c=document.getElementsByName("C1");
 if(c2[0].checked){
 for(i=0;i<c.length;i++){
 c[i].checked="checked";
 }
 }else{
 for(i=0;i<c.length;i++){
 c[i].checked=false;
 }
 }
}
function xuan1(){
 c21=document.getElementsByName("C21");
 c11=document.getElementsByName("C11");
 if(c21[0].checked){
 for(i=0;i<c11.length;i++){
 c11[i].checked="checked";
 }
 }else{
 for(i=0;i<c11.length;i++){
 c11[i].checked=false;
 }
 }
}

function textinto(x,y){
document.getElementById(x).value=y;	
}


//弹出登录窗口
function tclogin(){
layer.open({
  type: 2,
  area: ['650px', '425px'],
  title:false,
  skin: 'layui-layer-rim', //加上边框
  content:['../tem/openw.php', 'no'] 
});
}

//弹出举报窗口
function jbtang(x,y){
layer.open({
  type: 2,
  area: ['650px', '495px'],
  title:["举报窗口","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['../tem/jubao.php?admin='+x+"&id="+y, 'no'] 
});
}

//商品收藏
function profavInto(x,y){
$.get(document.getElementById("webhttp").innerHTML+"tem/favproInto.php",{bh:x},function(result){
 if(result=="err1"){tclogin();return false;}
 else if(result=="err2"){alert("亲~不能收藏自己的商品哦");return false;}
 else if(result=="ok"){
 document.getElementById("favpyes"+y).style.display="";
 document.getElementById("favpno"+y).style.display="none";
 }else{alert("未知错误，请刷新重试");return false;}
});
}

//加入购物车
function carInto(x,y){
if(document.getElementById("tcnum")){if(taocanid==0){alert("请先选择套餐");document.getElementById("utc1").className="utc utc1";return false;}}
if(document.getElementById("tc2div"+taocanid)){if(taocanid2==0){alert("请先选择套餐");document.getElementById("tc2div"+taocanid).className="utc utc1";return false;}taocanid=taocanid2;}
$.get(document.getElementById("webhttp").innerHTML+"tem/carInto.php",{bh:x,tcid:taocanid,kcnum:document.getElementById("tkcnum").value},function(result){
 if(result=="err1"){tclogin();return false;}
 else if(result=="err2"){alert("亲~不能将自己的商品放入购物车哦");return false;}
 else if(result=="ok"){
 document.getElementById("carpyes"+y).style.display="";
 document.getElementById("carpno"+y).style.display="none";
 }else{alert("未知错误，请刷新重试");return false;}
});
}

//套餐选择
var taocanid=0;
var taocanid2=0;
var pretc1id=0;
function taocanonc(a,b,c,d,e,f,g,h){
 document.getElementById("utc1").className="utc";
 document.getElementById("nowkcnum").innerHTML=g;
 taocanid=e;
 taocanid2=0;
 if(pretc1id!=0){if(document.getElementById("tc2div"+pretc1id)){document.getElementById("tc2div"+pretc1id).style.display="none";}}
 if(document.getElementById("tc2div"+e)){document.getElementById("tc2div"+e).style.display="";}
 pretc1id=e;
 tc2re(taocanid);
 document.getElementById("nowmoney").innerHTML=c;
 document.getElementById("nowmoneyY").innerHTML=c;
 document.getElementById("yuanjia").innerHTML="￥"+d+"元";
 for(i=1;i<=b;i++){
 document.getElementById("taocana"+i).className="";
 }
 document.getElementById("taocana"+a).className="a1";
 document.getElementById("zhekou").innerHTML=f+"折";
 if(h!=""){document.getElementById("tupiana").innerHTML="<img src='"+h+"' />";}
}
function taocan2onc(a,b,c,d,e,f,g,h){
 if(taocanid==0){alert("请先选择第一级套餐内容");document.getElementById("utc1").className="utc utc1";return false;}
 document.getElementById("tc2div"+taocanid).className="utc";
 document.getElementById("nowkcnum").innerHTML=g;
 taocanid2=e;
 tc2re(taocanid);
 document.getElementById("nowmoney").innerHTML=c;
 document.getElementById("nowmoneyY").innerHTML=c;
 document.getElementById("yuanjia").innerHTML="￥"+d+"元";
 document.getElementById("taocan2a"+taocanid+"_"+a).className="a1";
 document.getElementById("zhekou").innerHTML=f+"折";
 if(h!=""){document.getElementById("tupiana").innerHTML="<img src='"+h+"' />";}
}
function tc2re(x){
if(document.getElementById("tc2num"+x)){
document.getElementById("tc2div"+x).className="utc";
a=parseInt(document.getElementById("tc2num"+x).innerHTML);
for(i=1;i<=a;i++){
document.getElementById("taocan2a"+x+"_"+i).className="";
}
}
}

//立即购买
function buyInto(x){
if(document.getElementById("tcnum")){if(taocanid==0){alert("请先选择套餐");document.getElementById("utc1").className="utc utc1";return false;}}
if(document.getElementById("tc2div"+taocanid)){if(taocanid2==0){alert("请先选择套餐");document.getElementById("tc2div"+taocanid).className="utc utc1";return false;}taocanid=taocanid2;}
$.get(document.getElementById("webhttp").innerHTML+"tem/buyInto.php",{bh:x,tcid:taocanid,kcnum:document.getElementById("tkcnum").value},function(result){
 if(result=="err1"){tclogin();return false;}
 else if(result=="err2"){alert("亲~不能购买自己的商品哦");return false;}
 else if(result=="ok"){location.href="../user/car.php";}else{alert("未知错误，请刷新重试");return false;}
});
}

//店铺收藏
function shopfavInto(x,y){
$.get(document.getElementById("webhttp").innerHTML+"tem/favshopInto.php",{id:x},function(result){
 if(result=="err1"){tclogin();return false;}
 else if(result=="err2"){alert("亲~不能收藏自己的店铺哦");return false;}
 else if(result=="ok"){
 document.getElementById("favsyes"+y).style.display="";
 document.getElementById("favsno"+y).style.display="none";
 }else{alert("未知错误，请刷新重试");return false;}
});
}

function wendaonc(x){
layer.open({
  type: 2,
  area: ['650px', '405px'],
  title:false,
  skin: 'layui-layer-rim', //加上边框
  content:[document.getElementById("webhttp").innerHTML+'tem/wenda.php?id='+x, 'no'] 
});
}

function setIndexCookie() {
$.get(document.getElementById("webhttp").innerHTML+"tem/indexcookie.php",{admin:2},function(result){
});
};

function getIndexCookie () {
$.get(document.getElementById("webhttp").innerHTML+"tem/indexcookie.php",{admin:1},function(result){
	if(result=="no"){
		layer.open({
			type:1,
			title: ["A8源码网","text-align:left"],
			closeBtn: 1,
			area: ['220px','262px'],
			shadeClose: false,
			skin: 'layui-layer-rim', //加上边框
			content: $('.indexYJTS')
		});
		setIndexCookie();
		}
	});
}

// type: 2,
// shadeClose: false,
// area: ['800px', '500px'],
// offset: ['100px',],
// title:["广告位置预览","text-align:left"],
// skin: 'layui-layer-rim', //加上边框
// content:['product_yulan.php?type='+type, 'no'] 

