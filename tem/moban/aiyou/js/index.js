//轮播切换
function banner(){	
var bn_id = 0;
var bn_id2= 1;
var speed33=4000;
var qhjg = 1;
var MyMar33;
$("#banner .d1").hide();
$("#banner .d1").eq(0).fadeIn("slow");
if($("#banner .d1").length>1)
{
    $("#banner_id li").eq(0).addClass("nuw");
    function Marquee33(){
        bn_id2 = bn_id+1;
        if(bn_id2>$("#banner .d1").length-1)
        {
            bn_id2 = 0;
        }
        $("#banner .d1").eq(bn_id).css("z-index","2");
        $("#banner .d1").eq(bn_id2).css("z-index","1");
        $("#banner .d1").eq(bn_id2).show();
        $("#banner .d1").eq(bn_id).fadeOut("slow");
        $("#banner_id li").removeClass("nuw");
        $("#banner_id li").eq(bn_id2).addClass("nuw");
        bn_id=bn_id2;
    };

    MyMar33=setInterval(Marquee33,speed33);
    
    $("#banner_id li").click(function(){
        var bn_id3 = $("#banner_id li").index(this);
        if(bn_id3!=bn_id&&qhjg==1)
        {
            qhjg = 0;
            $("#banner .d1").eq(bn_id).css("z-index","2");
            $("#banner .d1").eq(bn_id3).css("z-index","1");
            $("#banner .d1").eq(bn_id3).show();
            $("#banner .d1").eq(bn_id).fadeOut("slow",function(){qhjg = 1;});
            $("#banner_id li").removeClass("nuw");
            $("#banner_id li").eq(bn_id3).addClass("nuw");
            bn_id=bn_id3;
        }
    })
    $("#banner_id").hover(
        function(){
            clearInterval(MyMar33);
        }
        ,
        function(){
            MyMar33=setInterval(Marquee33,speed33);
        }
    )	
}
else
{
    $("#banner_id").hide();
}
}

//轮播切换





//任务
function taskover(x){
for(i=1;i<=2;i++){
 document.getElementById("taska"+i).className="l1";
 document.getElementById("taskm"+i).style.display="none";
}
 document.getElementById("taska"+x).className="l1 l11";
 document.getElementById("taskm"+x).style.display="";
}

function idldl(){
 $.get("tem/sesCheck.php",{},function(result){
  if(result=="0"){
  document.getElementById("idlno").style.display="";
  document.getElementById("idlyes").style.display="none";
  }else{
  document.getElementById("idlno").style.display="none";
  document.getElementById("idlyes").style.display="";
  a=result.split(" ");
  document.getElementById("itouxiang").src=a[3];
  document.getElementById("imoney").innerHTML=a[2];
  document.getElementById("iuserid").innerHTML=a[0];
  }
 });
}

//团购倒计时开始
var responsesj;
var time_server_client,timerID,xs,time_end1,time_end2,time_end3,time_end4,time_end5,timerID1,timerID2,timerID3,timerID4,timerID5;

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
   document.getElementById("djs"+djsid).innerHTML=""+tv;
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

time_now_server=new Date(responsesj);time_now_server=time_now_server.getTime();
time_now_client=new Date();time_now_client=time_now_client.getTime();
time_server_client=time_now_server-time_now_client;

   if(document.getElementById("dqsj1")){timerID1=setTimeout("show_time(1)",100);}
   if(document.getElementById("dqsj2")){timerID2=setTimeout("show_time(2)",100);}
   if(document.getElementById("dqsj3")){timerID3=setTimeout("show_time(3)",100);}
   if(document.getElementById("dqsj4")){timerID4=setTimeout("show_time(4)",100);}
   if(document.getElementById("dqsj5")){timerID5=setTimeout("show_time(5)",100);}
  }
}



function userChecksj(){
	if(document.getElementById("dqsj1")){
    var url = document.getElementById("webhttp").innerHTML+"tem/sjCheck.php";
    xmlHttpsj.open("post", url, true);
    xmlHttpsj.onreadystatechange = updatePagesj;
    xmlHttpsj.send(null);
	}
	}
//团购倒计时结束

//切换代码开始
var Class = {
  create: function() {
	return function() {
	  this.initialize.apply(this, arguments);
	}
  }
}

Object.extend = function(destination, source) {
	for (var property in source) {
		destination[property] = source[property];
	}
	return destination;
}

var TransformView = Class.create();
TransformView.prototype = {
  //容器对象,滑动对象,切换参数,切换数量
  initialize: function(container, slider, parameter, count, options) {
	if(parameter <= 0 || count <= 0) return;
	var oContainer = document.getElementById(container), oSlider = document.getElementById(slider), oThis = this;

	this.Index = 0;//当前索引
	
	this._timer = null;//定时器
	this._slider = oSlider;//滑动对象
	this._parameter = parameter;//切换参数
	this._count = count || 0;//切换数量
	this._target = 0;//目标参数
	
	this.SetOptions(options);
	
	this.Up = !!this.options.Up;
	this.Step = Math.abs(this.options.Step);
	this.Time = Math.abs(this.options.Time);
	this.Auto = !!this.options.Auto;
	this.Pause = Math.abs(this.options.Pause);
	this.onStart = this.options.onStart;
	this.onFinish = this.options.onFinish;
	
	oContainer.style.overflow = "hidden";
	oContainer.style.position = "relative";
	
	oSlider.style.position = "absolute";
	oSlider.style.top = oSlider.style.left = 0;
  },
  //设置默认属性
  SetOptions: function(options) {
	this.options = {//默认值
		Up:			true,//是否向上(否则向左)
		Step:		5,//滑动变化率
		Time:		10,//滑动延时
		Auto:		true,//是否自动转换
		Pause:		2000,//停顿时间(Auto为true时有效)
		onStart:	function(){},//开始转换时执行
		onFinish:	function(){}//完成转换时执行
	};
	Object.extend(this.options, options || {});
  },
  //开始切换设置
  Start: function() {
	if(this.Index < 0){
		this.Index = this._count - 1;
	} else if (this.Index >= this._count){ this.Index = 0; }
	
	this._target = -1 * this._parameter * this.Index;
	this.onStart();
	this.Move();
  },
  //移动
  Move: function() {
	clearTimeout(this._timer);
	var oThis = this, style = this.Up ? "top" : "left", iNow = parseInt(this._slider.style[style]) || 0, iStep = this.GetStep(this._target, iNow);
	
	if (iStep != 0) {
		this._slider.style[style] = (iNow + iStep) + "px";
		this._timer = setTimeout(function(){ oThis.Move(); }, this.Time);
	} else {
		this._slider.style[style] = this._target + "px";
		this.onFinish();
		if (this.Auto) { this._timer = setTimeout(function(){ oThis.Index++; oThis.Start(); }, this.Pause); }
	}
  },
  //获取步长
  GetStep: function(iTarget, iNow) {
	var iStep = (iTarget - iNow) / this.Step;
	if (iStep == 0) return 0;
	if (Math.abs(iStep) < 1) return (iStep > 0 ? 1 : -1);
	return iStep;
  },
  //停止
  Stop: function(iTarget, iNow) {
	clearTimeout(this._timer);
	this._slider.style[this.Up ? "top" : "left"] = this._target + "px";
  }
};




// window.onload=function(){
// 	function Each(list, fun){
// 		for (var i = 0, len = list.length; i < len; i++) { fun(list[i], i); }
// 	};
	
// 	var objs = document.getElementById("idNum").getElementsByTagName("li");
	
// 	var tv = new TransformView("idTransformView", "idSlider", 271, document.getElementById("qhai").innerHTML, {
// 		onStart : function(){ Each(objs, function(o, i){ o.className = tv.Index == i ? "on" : ""; }) }//按钮样式
// 	});
	
// 	tv.Start();
	
// 	Each(objs, function(o, i){
// 		o.onmouseover = function(){
// 			o.className = "on";
// 			tv.Auto = false;
// 			tv.Index = i;
// 			tv.Start();
// 		}
// 		o.onmouseout = function(){
// 			o.className = "";
// 			tv.Auto = true;
// 			tv.Start();
// 		}
// 	})
	
	
// }
//切换代码结束
