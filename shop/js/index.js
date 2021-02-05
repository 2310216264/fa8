function topd2over(){
document.getElementById("lkuang").style.display="";
document.getElementById("d2div").className="d2 d21";
}
function topd2out(){
document.getElementById("lkuang").style.display="none";
document.getElementById("d2div").className="d2";
}

function ser(x){
 t1v=document.f1.t1.value;
 if(t1v==""){alert("请输入搜索关键词");document.f1.t1.focus();return false;}
 f1.action="../search/index.php?admin=5&id="+x;
}

function sser(x){
 t1v=document.f1.t1.value;
 if(t1v==""){alert("请输入搜索关键词");document.f1.t1.focus();return false;}
 f1.action="../search/index.php?admin=7&id="+x;
}
//店铺收藏
var xmlHttpfavs = false;
try {
  xmlHttpfavs = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttpfavs = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttpfavs = false;
  }
}
if (!xmlHttpfavs && typeof XMLHttpRequest != 'undefined') {
  xmlHttpfavs = new XMLHttpRequest();
}

function shopfavInto(x){
url = "../tem/favshopInto.php?id="+x;
xmlHttpfavs.open("get", url, true);
xmlHttpfavs.onreadystatechange = updatePagefavs;
xmlHttpfavs.send(null);
}

function updatePagefavs() {
 if(xmlHttpfavs.readyState == 4) {
 response = xmlHttpfavs.responseText;
 response=response.replace(/[\r\n]/g,'');
  if(response=="err1"){topd2out();tclogin();return false;}
  else if(response=="err2"){alert("亲~不能收藏自己的店铺哦");return false;}
  else if(response=="ok"){
  document.getElementById("favsyes").style.display="";
  document.getElementById("favsno").style.display="none";
  document.getElementById("favsyes1").style.display="";
  document.getElementById("favsno1").style.display="none";
  }else{alert("未知错误，请刷新重试");return false;}
 }
}

function topm2over(x){
document.getElementById("topm2_"+x).style.display="";
}
function topm2out(x){
document.getElementById("topm2_"+x).style.display="none";
}

//弹出登录窗口
function tclogin(){
layer.open({
  type: 2,
  area: ['650px', '415px'],
  title:["快捷登录","text-align:left"],
  skin: 'layui-layer-rim', //加上边框
  content:['/tem/openw.php', 'no'] 
});
}
//切换
function banner(){	
	var bn_id = 0;
	var bn_id2= 1;
	var speed33=10000;
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
