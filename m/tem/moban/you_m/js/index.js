//团购倒计时开始
var responsesj;
var time_server_client,timerID,xs,time_end1,time_end2,time_end3,time_end4,time_end5,time_end6,time_end7,time_end8,time_end9,time_end10,timerID1,timerID2,timerID3,timerID4,timerID5,timerID6,timerID7,timerID8,timerID9,timerID10;

function show_time(djsid)
{
 var time_now,time_distance,str_time;
 var int_day,int_hour,int_minute,int_second;
 var time_now=new Date();
 time_now=time_now.getTime()+time_server_client;
 if(djsid==1){time_end=time_end1;timerID=timerID1;}
 else if(djsid==2){time_end=time_end2;timerID=timerID2;}
 else if(djsid==3){time_end=time_end3;timerID=timerID3;}
 else if(djsid==4){time_end=time_end4;timerID=timerID4;}
 else if(djsid==5){time_end=time_end5;timerID=timerID5;}
 else if(djsid==6){time_end=time_end6;timerID=timerID6;}
 else if(djsid==7){time_end=time_end7;timerID=timerID7;}
 else if(djsid==8){time_end=time_end8;timerID=timerID8;}
 else if(djsid==9){time_end=time_end9;timerID=timerID9;}
 else if(djsid==10){time_end=time_end10;timerID=timerID10;}
 
 time_distance=time_end-time_now;
 if(time_distance>0)
 {
  int_day=parseInt(Math.floor(time_distance/86400000))
  time_distance-=int_day*86400000;
  int_hour=parseInt(Math.floor(time_distance/3600000))
  time_distance-=int_hour*3600000;
  int_minute=parseInt(Math.floor(time_distance/60000))
  time_distance-=int_minute*60000;
  int_second=parseInt(Math.floor(time_distance/1000))
  mm = Math.floor((time_distance % 1000)/100);
   tv=int_day+"<span class='s1'>天</span>";
   tv=tv+int_hour+"<span class='s1'>时</span>";
   tv=tv+int_minute+"<span class='s1'>分</span>";
   tv=tv+int_second+"." + mm+"<span class='s1'>秒</span>";
   document.getElementById("djs"+djsid).innerHTML="剩"+tv;
   setTimeout("show_time("+djsid+")",100);
  }
  else
 {
  tv="<span class='feng'>已结束</span>";
  document.getElementById("djs"+djsid).innerHTML=tv;
  document.getElementById("s"+djsid+"sj1").innerHTML=0;
  document.getElementById("s"+djsid+"sj2").innerHTML=0;
  document.getElementById("s"+djsid+"sj3").innerHTML=0;
  clearTimeout(timerID)
 }
}

var xmlHttpsj = false;
try {
  xmlHttpsj = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttpsj = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttpsj = false;
  }
}
if (!xmlHttpsj && typeof XMLHttpRequest != 'undefined') {
  xmlHttpsj = new XMLHttpRequest();
}


function updatePagesj() {
  if (xmlHttpsj.readyState == 4) {
   responsesj = xmlHttpsj.responseText;
   if(document.getElementById("dqsj1")){dsj1=document.getElementById("dqsj1").innerHTML;time_end1=new Date(dsj1);time_end1=time_end1.getTime();}//结束的时间
   if(document.getElementById("dqsj2")){dsj2=document.getElementById("dqsj2").innerHTML;time_end2=new Date(dsj2);time_end2=time_end2.getTime();}//结束的时间
   if(document.getElementById("dqsj3")){dsj3=document.getElementById("dqsj3").innerHTML;time_end3=new Date(dsj3);time_end3=time_end3.getTime();}//结束的时间
   if(document.getElementById("dqsj4")){dsj4=document.getElementById("dqsj4").innerHTML;time_end4=new Date(dsj4);time_end4=time_end4.getTime();}//结束的时间
   if(document.getElementById("dqsj5")){dsj5=document.getElementById("dqsj5").innerHTML;time_end5=new Date(dsj5);time_end5=time_end5.getTime();}//结束的时间
   if(document.getElementById("dqsj6")){dsj6=document.getElementById("dqsj6").innerHTML;time_end6=new Date(dsj6);time_end6=time_end6.getTime();}//结束的时间
   if(document.getElementById("dqsj7")){dsj7=document.getElementById("dqsj7").innerHTML;time_end7=new Date(dsj7);time_end7=time_end7.getTime();}//结束的时间
   if(document.getElementById("dqsj8")){dsj8=document.getElementById("dqsj8").innerHTML;time_end8=new Date(dsj8);time_end8=time_end8.getTime();}//结束的时间
   if(document.getElementById("dqsj9")){dsj9=document.getElementById("dqsj9").innerHTML;time_end9=new Date(dsj9);time_end9=time_end9.getTime();}//结束的时间
   if(document.getElementById("dqsj10")){dsj10=document.getElementById("dqsj10").innerHTML;time_end10=new Date(dsj10);time_end10=time_end10.getTime();}//结束的时间

time_now_server=new Date(responsesj);time_now_server=time_now_server.getTime();
time_now_client=new Date();time_now_client=time_now_client.getTime();
time_server_client=time_now_server-time_now_client;

   if(document.getElementById("dqsj1")){timerID1=setTimeout("show_time(1)",100);}
   if(document.getElementById("dqsj2")){timerID2=setTimeout("show_time(2)",100);}
   if(document.getElementById("dqsj3")){timerID3=setTimeout("show_time(3)",100);}
   if(document.getElementById("dqsj4")){timerID4=setTimeout("show_time(4)",100);}
   if(document.getElementById("dqsj5")){timerID5=setTimeout("show_time(5)",100);}
   if(document.getElementById("dqsj6")){timerID6=setTimeout("show_time(6)",100);}
   if(document.getElementById("dqsj7")){timerID7=setTimeout("show_time(7)",100);}
   if(document.getElementById("dqsj8")){timerID8=setTimeout("show_time(8)",100);}
   if(document.getElementById("dqsj9")){timerID9=setTimeout("show_time(9)",100);}
   if(document.getElementById("dqsj10")){timerID10=setTimeout("show_time(10)",100);}
  }
}

function userChecksj(){
	if(document.getElementById("dqsj1")){
    var url = "/tem/sjCheck.php";
    xmlHttpsj.open("post", url, true);
    xmlHttpsj.onreadystatechange = updatePagesj;
    xmlHttpsj.send(null);
	}
	}
//团购倒计时结束
