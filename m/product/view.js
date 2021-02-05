//套餐选择
var taocanid=0;
var taocant="";
var taocanid2=0;
var pretc1id=0;
function taocanonc(a,b,c,d,e,f,g,h,j){
 document.getElementById("nowkcnum").innerHTML=g;
 taocanid=e;
 taocanid2=0;
 taocant=h;
 if(pretc1id!=0){if(document.getElementById("tc2div"+pretc1id)){document.getElementById("tc2div"+pretc1id).style.display="none";}}
 if(document.getElementById("tc2div"+e)){document.getElementById("tc2div"+e).style.display="";}
 pretc1id=e;
 tc2re(taocanid);
 document.getElementById('nowmoney').innerHTML=c;
 document.getElementById("yuanjia").innerHTML="￥"+d+"元";
 for(i=1;i<=b;i++){
 document.getElementById("taocana"+i).className="taocan box";
 }
 document.getElementById("taocana"+a).className="a1";
 document.getElementById("zhekou").innerHTML=f+"折";
}
function taocan2onc(a,b,c,d,e,f,g,h,j){
 if(taocanid==0){alert("请先选择第一级套餐内容");return false;}
 document.getElementById("nowkcnum").innerHTML=g;
 taocanid2=e;
 tc2re(taocanid);
 document.getElementById("nowmoney").innerHTML=c;
 document.getElementById("yuanjia").innerHTML="￥"+d+"元";
 document.getElementById("taocan2a"+taocanid+"_"+a).className="a1";
 document.getElementById("zhekou").innerHTML=f+"折";
}
function tc2re(x){
if(document.getElementById("tc2num"+x)){
a=parseInt(document.getElementById("tc2num"+x).innerHTML);
for(i=1;i<=a;i++){
document.getElementById("taocan2a"+x+"_"+i).className="taocan box";
}
}
}


//特色
function tscapover(x){
for(i=1;i<=3;i++){
if(document.getElementById("tscap"+i)){
document.getElementById("tscap"+i).className="";
document.getElementById("tsmain"+i).style.display="none";
}
}
document.getElementById("tscap"+x).className="a1";
document.getElementById("tsmain"+x).style.display="";
}

//标签按钮
function bqonc(x){
 for(i=1;i<=3;i++){
  if(document.getElementById("bqcap"+i)){
  document.getElementById("bqcap"+i).className="d1 flex";
  document.getElementById("bqdiv"+i).style.display="none";
  }
 }
 document.getElementById("bqcap"+x).className="d1 flex d11";
 document.getElementById("bqdiv"+x).style.display="";
}
