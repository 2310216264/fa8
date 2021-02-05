//套餐选择
var taocanid=0;
var taocanid2=0;
var pretc1id=0;
function taocanonc(a,b,c,e,h){
 document.getElementById("utc1").className="utc";
 taocanid=e;
 taocanid2=0;
 if(pretc1id!=0){if(document.getElementById("tc2div"+pretc1id)){document.getElementById("tc2div"+pretc1id).style.display="none";}}
 if(document.getElementById("tc2div"+e)){document.getElementById("tc2div"+e).style.display="";}
 pretc1id=e;
 tc2re(taocanid);
 document.getElementById("nowmoney").innerHTML=c;
 document.getElementById("nowmoneyY").innerHTML=c;
 for(i=1;i<=b;i++){
 document.getElementById("taocana"+i).className="";
 }
 document.getElementById("taocana"+a).className="a1";
 if(h!=""){document.getElementById("tupiana").innerHTML="<img src='"+h+"' />";}
}
function taocan2onc(a,b,c,e,h){
 if(taocanid==0){alert("请先选择第一级套餐内容");document.getElementById("utc1").className="utc utc1";return false;}
 document.getElementById("tc2div"+taocanid).className="utc";
 taocanid2=e;
 tc2re(taocanid);
 document.getElementById("nowmoney").innerHTML=c;
 document.getElementById("nowmoneyY").innerHTML=c;
 document.getElementById("taocan2a"+taocanid+"_"+a).className="a1";
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

//搜索
function psear(x){
m1=document.f1.money1.value;
m2=document.f1.money2.value;
if(isNaN(m1)){alert("价格输入有误！");document.f1.money1.select();return false;}	
if(isNaN(m2)){alert("价格输入有误！");document.f1.money2.select();return false;}	
wz=x+"_b"+m1+"v_c"+m2+"v";
f1.action="../search/index.php?admin=6&getv="+wz;
}

function shujia(){
 a=parseInt(document.getElementById("tbuynum").value);
 if(isNaN(a)){document.getElementById("tbuynum").value=1;a=1;}
 if(a<0){document.getElementById("tbuynum").value=1;}
 else{
 document.getElementById("tbuynum").value=a+1;
 }
 moneycha();
}

function shujian(){
 a=parseInt(document.getElementById("tbuynum").value);
 if(isNaN(a)){document.getElementById("tbuynum").value=1;a=1;}
 if(a<=1){document.getElementById("tbuynum").value=1;}
 else{
 document.getElementById("tbuynum").value=a-1;
 }
 moneycha();
}

function numcheng(arg1,arg2)
{
var m=0,s1=arg1.toString(),s2=arg2.toString();
try{m+=s1.split(".")[1].length}catch(e){}
try{m+=s2.split(".")[1].length}catch(e){}
return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
}

function moneycha(){
a=numcheng(parseFloat(document.getElementById("nowmoneyY").innerHTML),parseInt(document.getElementById("tbuynum").value));
document.getElementById("nowmoney").innerHTML=a.toFixed(2);
}

//特色
function tscapover(x){
for(i=1;i<=2;i++){
if(document.getElementById("tscap"+i)){
document.getElementById("tscap"+i).className="";
document.getElementById("tsmain"+i).style.display="none";
}
}
document.getElementById("tscap"+x).className="a1";
document.getElementById("tsmain"+x).style.display="";
}

//立即购买
var xmlHttpbuy = false;
try {
  xmlHttpbuy = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttpbuy = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttpbuy = false;
  }
}
if (!xmlHttpbuy && typeof XMLHttpRequest != 'undefined') {
  xmlHttpbuy = new XMLHttpRequest();
}

function buyserve(x){
if(document.getElementById("tcnum")){if(taocanid==0){alert("请先选择套餐");document.getElementById("utc1").className="utc utc1";return false;}}
if(document.getElementById("tc2div"+taocanid)){if(taocanid2==0){alert("请先选择套餐");document.getElementById("tc2div"+taocanid).className="utc utc1";return false;}taocanid=taocanid2;}
url = "../tem/serveBuy.php?bh="+x+"&buynum="+document.getElementById("tbuynum").value+"&tcid="+taocanid;
xmlHttpbuy.open("get", url, true);
xmlHttpbuy.onreadystatechange = updatePagebuy;
xmlHttpbuy.send(null);
}

function updatePagebuy() {
 if(xmlHttpbuy.readyState == 4) {
 response = xmlHttpbuy.responseText;
 response=response.replace(/[\r\n]/g,'');
 response=response.split("|");
  if(response[0]=="err1"){tclogin();return false;}
  else if(response[0]=="err2"){alert("亲~不能购买自己的服务哦");return false;}
  else if(response[0]=="ok"){location.href="../user/servebuy.php?orderbh="+response[1];}else{alert("未知错误，请刷新重试");return false;}
 }
}
