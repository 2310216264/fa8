//底部焦点
function bottomjd(x){
document.getElementById("bottom"+x).className="dm dm1";
document.getElementById("bottom"+x+"img").src=document.getElementById("webhttp").innerHTML+"m/img/bottom"+x+"_1.png";
}

function topxiala(){
 d=document.getElementById("topzhezhao");
 if(d.style.display=="block"){
 document.getElementById("topzhezhao").style.display="none";
 document.getElementById("topxialam").style.display="none";
 }else{
 document.getElementById("topzhezhao").style.display="block";
 document.getElementById("topxialam").style.display="";
 }
}



var xmlHttpses = false;
try {
  xmlHttpses = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttpses = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttpses = false;
  }
}
if (!xmlHttpses && typeof XMLHttpRequest != 'undefined') {
  xmlHttpses = new XMLHttpRequest();
}
function userCheckses(){
    url ="../../m/tem/sjcl.php";
    xmlHttpses.open("get", url, true);
    xmlHttpses.onreadystatechange = updatePageses;
    xmlHttpses.send(null);
	}
function updatePageses() {
  if (xmlHttpses.readyState == 4) {
   response = xmlHttpses.responseText;
   response=response.replace(/[\r\n]/g,'');
   if(response=="0"){document.getElementById("notlogin").style.display="";document.getElementById("yeslogin").style.display="none";return false;}
   else{
   r=response.split(" ");
   document.getElementById("yeslogin").style.display="";
   document.getElementById("notlogin").style.display="none";
   document.getElementById("yesuid").innerHTML=r[0];
   document.getElementById("sjcl1").innerHTML=r[1];
   document.getElementById("sjcl2").src=r[2];
   document.getElementById("sjcl3").src=r[2];
    document.getElementById("messageSystem").style.display="";
   if(r[1]=="yes"){document.getElementById("dontqd").style.display="";document.getElementById("needqd").style.display="none";}
   else{document.getElementById("dontqd").style.display="none";document.getElementById("needqd").style.display="";}
   return false;
   }
  }
}