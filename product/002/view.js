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
