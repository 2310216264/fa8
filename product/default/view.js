function motewmover(){
document.getElementById("motewm").style.display="";
}
function motewmout(){
document.getElementById("motewm").style.display="none";
}

//视频点击
function videodian(x,y){
videofr.location="../video/index.php?id="+x;
for(i=1;i<document.getElementById("videoall").innerHTML;i++){
document.getElementById("videoa"+i).className="";
}
document.getElementById("videoa"+y).className="a1";
}

function djmonc(){
layer.open({
  type:1,
  title: "不同会员等级享受优惠价格说明",
  closeBtn: 1,
  area: '302px',
  skin: 'layui-layer-nobg', //没有背景色
  shadeClose: true,
  content: $('#vipmoney')
});
}


function shujia(){
 a=parseInt(document.getElementById("tkcnum").value);
 if(isNaN(a)){document.getElementById("tkcnum").value=1;a=1;}
 if(a<0){document.getElementById("tkcnum").value=1;}
 else{
 document.getElementById("tkcnum").value=a+1;
 }
 moneycha();
}

function shujian(){
 a=parseInt(document.getElementById("tkcnum").value);
 if(isNaN(a)){document.getElementById("tkcnum").value=1;a=1;}
 if(a<=1){document.getElementById("tkcnum").value=1;}
 else{
 document.getElementById("tkcnum").value=a-1;
 }
 moneycha();
}

function moneycha(){
a=accMul(parseFloat(document.getElementById("nowmoneyY").innerHTML),parseInt(document.getElementById("tkcnum").value));
document.getElementById("nowmoney").innerHTML=a;
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

function simgover(x){
document.getElementById("bimg").src=x;
}

//标签按钮
function bqonc(x){
 for(i=1;i<=5;i++){
  if(document.getElementById("bqcap"+i)){
  document.getElementById("bqcap"+i).className="l0";
  document.getElementById("bqdiv"+i).style.display="none";
  }
 }
 document.getElementById("bqcap"+x).className="l1 g_bc0_h";
 document.getElementById("bqdiv"+x).style.display="";
 if(x==1){
  document.getElementById("bqdiv2").style.display="";
  document.getElementById("bqdiv3").style.display="";
  document.getElementById("bqdiv4").style.display="";
  document.getElementById("bqdiv5").style.display="";
 }
}
