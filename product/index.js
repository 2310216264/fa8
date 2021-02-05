//搜索
function psear(x){
m1=document.f1.money1.value;
m2=document.f1.money2.value;
if(isNaN(m1)){alert("价格输入有误！");document.f1.money1.select();return false;}	
if(isNaN(m2)){alert("价格输入有误！");document.f1.money2.select();return false;}	
wz=x+"_b"+m1+"v_c"+m2+"v";
if(document.getElementById("C1").checked){wz=wz+"_a1v";}
if(document.getElementById("C2").checked){wz=wz+"_d1v";}
if(document.getElementById("C3").checked){wz=wz+"_g1v";}
f1.action="../search/index.php?admin=4&getv="+wz;
}

//弹出登录窗口
function tclogin(){
layer.open({
  type: 2,
  area: ['650px', '415px'],
  title:["快捷登录","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['../tem/openw.php', 'no'] 
});
}

//列表页数量调整
function carcha(x,y){
 a=parseInt(document.getElementById("carnum"+y).innerHTML);
 if(x==1){
  if(a>1){z=a-1;}else{z=1;}
 }else if(x==2){
  z=a+1;
 }
 document.getElementById("carnum"+y).innerHTML=z;
}

//列表页加入购物车
var xmlHttpcar1 = false;
var nowdjc;
try {
  xmlHttpcar1 = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttpcar1 = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttpcar1 = false;
  }
}
if (!xmlHttpcar1 && typeof XMLHttpRequest != 'undefined') {
  xmlHttpcar1 = new XMLHttpRequest();
}

function carInto1(x,y){
nowdjc=y;
a=parseInt(document.getElementById("carnum"+y).innerHTML);
url = "../tem/carInto.php?bh="+x+"&kcnum="+a+"&tcid=0";
xmlHttpcar1.open("get", url, true);
xmlHttpcar1.onreadystatechange = updatePagecar1;
xmlHttpcar1.send(null);
}

function updatePagecar1() {
 if(xmlHttpcar1.readyState == 4) {
 response = xmlHttpcar1.responseText;
 response=response.replace(/[\r\n]/g,'');
  if(response=="err1"){tclogin();return false;}
  else if(response=="err2"){alert("亲~不能将自己的商品放入购物车哦");return false;}
  else if(response=="ok"){
  document.getElementById("carimg"+nowdjc+"_1").style.display="none";
  document.getElementById("carimg"+nowdjc+"_2").style.display="";
  }else{alert("未知错误，请刷新重试");return false;}
 }
}






