//顶部搜索
var nsi=1;


// 搜索
function topover(){
document.getElementById("topdiv").style.display="";
}
function topout(){
document.getElementById("topdiv").style.display="none";
}

function topsety(x){
nsi=x;
}


function topjconc(x,y){
nsi=x;
document.getElementById("topnwd").innerHTML=y;
topout();
}


// function topftj(){
// if((document.topf1.topt.value).replace("/\s/","")==""){alert("请输入搜索关键词");document.topf1.topt.focus();return false;}
// topf1.action="../search/index.php?admin="+nsi;
// }

//下拉菜单
function yhifdis(x){
if(x==0){dis="none";}else{dis="";}
if(document.getElementById("typeallnum")){
 for(i=9;i<=document.getElementById("typeallnum").innerHTML;i++){
  document.getElementById("yhmenu"+i).style.display=dis;	 
 }
}	
}
function leftmenuover(){
 document.getElementById("leftmenu").style.display="";
 if(document.getElementById("leftnone")){yhifdis(1);}
}

function leftmenuout(){
 if(!document.getElementById("leftnone")){
  document.getElementById("leftmenu").style.display="none";	
 }else{
  yhifdis(0);	 
 }
}

function yhmenuover(x){
document.getElementById("yhmenu"+x).className="menu1 menu2";	
document.getElementById("rmenu"+x).style.display="";	
}

function yhmenuout(x){
document.getElementById("yhmenu"+x).className="menu1";	
document.getElementById("rmenu"+x).style.display="none";	
}
