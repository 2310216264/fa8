//登录验证
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





//获取登录信息
function userCheckses(){
    url =document.getElementById("webhttp").innerHTML+"/tem/sesCheck.php";
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
		// document.getElementById("messageSystem").style.display="";
		if(r[1]=="yes"){
			// document.getElementById("dontqd").style.display="";document.getElementById("needqd").style.display="none";
			
		}else{
			// document.getElementById("dontqd").style.display="none";document.getElementById("needqd").style.display="";
			
		}
		return false;
		}
  	}
}



//弹出登录窗口
function toptclogin(){
layer.open({
	type: 2,
		area: ['700px', '450px'],
		title:["快捷登录","text-align:left"],
		skin: 'layui-layer-rim', //加上边框
		content:['/tem/openw.php', 'no'] 
	});
}


$(function(){

	
	$(".fenlei").on("click", function(e) {
		$('#leftmenu').css('z-index',0);
		e.stopPropagation(), $(".search-result").hide(), $(this).siblings(".search-classify").show();
	});
	$('#search-text').focus(function(){
		$('#leftmenu').css('z-index',0);
		$('.search-result').show();
		$('#leftmenu').css('z-index',0);
	});
	 $('#search-text').bind('keyup', function(event) {
        if (event.keyCode == "13") {
            //回车执行查询
            $('#search_btn').click();
        }
    });
	$('#search-text').blur(function(){
		//$('.search-result').hide();
		$('#leftmenu').css('z-index',60);
	});
	$(".fenlei1").on("click", function(e) {
		$('#leftmenu').css('z-index',0);
		e.stopPropagation(), $(".search-classify").hide(), $(this).siblings(".search-type").show();
	});
	$(".fenlei2").on("click", function(e) {
		$('#leftmenu').css('z-index',0);
		e.stopPropagation(), $(".search-classify").hide(), $(this).siblings(".search-type1").show();
	});


	$(".search-type dd").click(function(){
		$('#w_show').text($(this).text());
		$('#w_search').val($(this).attr('data-id'));
		$(".search-type").hide();
		
		$('#w_a').text($(this).text());
		$('#w_search').val($(this).attr('data-id'));
		$(".search-type1").hide();
	});
	$(".search-type1 dd").click(function(){
		$('#w_show').text($(this).text());
		$('#w_search').val($(this).attr('data-id'));
		$(".search-type").hide();
		
		$('#w_a').text($(this).text());
		$('#w_search').val($(this).attr('data-id'));
		$(".search-type1").hide();
	});


	$('#search_btn').click(function(){
		var s = $('#w_search').val();
		if($('#search-text').val().replace(/[\ |\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\_|\+|\=|\||\\|\[|\]|\{|\}|\;|\:|\"|\'|\,|\<|\.|\>|\/|\?\u3002|\uff1f|\uff01|\uff0c|\u3001|\uff1b|\uff1a|\u201c|\u201d|\u2018|\u2019|\uff08|\uff09|\u300a|\u300b|\u3008|\u3009|\u3010|\u3011|\u300e|\u300f|\u300c|\u300d|\ufe43|\ufe44|\u3014|\u3015|\u2026|\u2014|\uff5e|\ufe4f|\uffe5]/g,"")==""){
			alert("请输入搜索关键词");return false;
			
		}else{
			//中文字符
			//var reg = /[\u3002|\uff1f|\uff01|\uff0c|\u3001|\uff1b|\uff1a|\u201c|\u201d|\u2018|\u2019|\uff08|\uff09|\u300a|\u300b|\u3008|\u3009|\u3010|\u3011|\u300e|\u300f|\u300c|\u300d|\ufe43|\ufe44|\u3014|\u3015|\u2026|\u2014|\uff5e|\ufe4f|\uffe5]/;

			$('#w_text').val($('#search-text').val().replace(/[\ |\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\_|\+|\=|\||\\|\[|\]|\{|\}|\;|\:|\"|\'|\,|\<|\.|\>|\/|\?\u3002|\uff1f|\uff01|\uff0c|\u3001|\uff1b|\uff1a|\u201c|\u201d|\u2018|\u2019|\uff08|\uff09|\u300a|\u300b|\u3008|\u3009|\u3010|\u3011|\u300e|\u300f|\u300c|\u300d|\ufe43|\ufe44|\u3014|\u3015|\u2026|\u2014|\uff5e|\ufe4f|\uffe5]/g,""));
			
		}
		$('#w_submit').attr('action',"/search/index.php?admin="+s);
		$('#w_submit').submit();
	});
	$('#search_btn2').click(function(){
		var s = $('#w_search').val();
		if($('#search-text1').val().replace(/[\ |\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\_|\+|\=|\||\\|\[|\]|\{|\}|\;|\:|\"|\'|\,|\<|\.|\>|\/|\?\u3002|\uff1f|\uff01|\uff0c|\u3001|\uff1b|\uff1a|\u201c|\u201d|\u2018|\u2019|\uff08|\uff09|\u300a|\u300b|\u3008|\u3009|\u3010|\u3011|\u300e|\u300f|\u300c|\u300d|\ufe43|\ufe44|\u3014|\u3015|\u2026|\u2014|\uff5e|\ufe4f|\uffe5]/g,"")==""){
			alert("请输入搜索关键词");return false;
			
		}else{
			$('#w_text').val($('#search-text1').val().replace(/[\ |\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\_|\+|\=|\||\\|\[|\]|\{|\}|\;|\:|\"|\'|\,|\<|\.|\>|\/|\?\u3002|\uff1f|\uff01|\uff0c|\u3001|\uff1b|\uff1a|\u201c|\u201d|\u2018|\u2019|\uff08|\uff09|\u300a|\u300b|\u3008|\u3009|\u3010|\u3011|\u300e|\u300f|\u300c|\u300d|\ufe43|\ufe44|\u3014|\u3015|\u2026|\u2014|\uff5e|\ufe4f|\uffe5]/g,""));
			
		}
		$('#w_submit').attr('action',"/search/index.php?admin="+s);
		$('#w_submit').submit();
	});
	$('#search-text1').focus(function(){
		$('#leftmenu').css('z-index',0);
		$(this).parent().parent().siblings('.search-result').show();
		$('#leftmenu').css('z-index',0);
		$('.header-sm-container').addClass('on');
	});
	 $('#search-text1').bind('keyup', function(event) {
        if (event.keyCode == "13") {
            //回车执行查询
            $('#search_btn2').click();
        }
    });
	$('#search-text1').blur(function(){
		$(this).parent().parent().siblings('.search-result').hide();
		$('.header-sm-container').removeClass('on');
		$('#leftmenu').css('z-index',60);
	});
	$('.result-all a').each(function(e){
		$(this).click(function(e){
			e.stopPropagation();
			// console.log($(this));
			//return false;
		});
	});
	
	$("body").click(function(){
		$('.search-classify').hide();
		if(!$('#search-text').is(':focus') ){
			$('#search-text').parent().parent().siblings(".search-result").hide();
			$('#leftmenu').css('z-index',60);
		}else{
			$('#search-text').parent().parent().siblings(".search-result").show();
			$('#leftmenu').css('z-index',0);
		}
		if( $('#search-text1').is(':focus') ){
			$('#search-text1').parent().parent().siblings('.search-result').show();
			$('#leftmenu').css('z-index',0);
			$('.header-sm-container').addClass('on');
		}else{
			$('#search-text1').parent().parent().siblings('.search-result').hide();
			$('.header-sm-container').removeClass('on');
			$('#leftmenu').css('z-index',60);
		}
	});

	$(window).scroll($(".header-sm-container").hasClass("header-sm-fixed") ?
	function() {
		$(this).scrollTop() >= 200 && ($(".search-classify").hasClass("active") || $(".search-classify").hide())
	} : function() {
		$(this).scrollTop() < 200 ? $(".header-sm-container").removeClass("header-sm-fixed") : ($(".search-classify").hasClass("active") || $(".search-classify").hide(), $(".header-sm-container").addClass("header-sm-fixed"))
	}), $(".search-classify").hover(function() {
		$(this).addClass("active")
	}, function() {
		$(this).removeClass("active")
	}) 
	});


// function topgetc(){
// $.get("https://www.a8zhan.com/user/getcar.php",{},function(result){
//     carstr=result.split("yjcodeA");
//      document.getElementById("topcar").innerHTML=carstr[0];
//      document.getElementById("topcarnum").innerHTML=carstr[1];
//     });
// }
// topgetc();
// function topdelcar(){
	
// if(!confirm("确定要清空购物车吗")){return false;}
// $.get("https://www.a8zhan.com/user/delcar.php?id=0",{},function(result){
//      topgetc();
//     });
// }
// function topdelone(x){
// $.get("https://www.a8zhan.com/user/delcar.php?id="+x,{},function(result){
//      topgetc();
//     });
// }



// url =document.getElementById("webhttp").innerHTML+"/tem/sesCheck.php";

function userinfo(){

var weburls =document.getElementById("webhttp").innerHTML+"user/userinfo.php";
$.get(weburls,{},function(result){
	// console.log(result);
	var obj = eval('('+result+')');
	document.getElementById("topmoney").innerHTML=obj.money1;
	document.getElementById("topjf").innerHTML=obj.jf;
	document.getElementById("topuimg").src=obj.topuimg;
	document.getElementById("topurz").innerHTML=obj.topurz;
	document.getElementById("topudj").innerHTML=obj.topudj;
	
	dj=parseInt(obj.topdj);
    for(i=0;i<=dj;i++){
	    if(document.getElementById("tdjxh"+i)){
	    if(i==dj){
	        document.getElementById("tdjxh"+i).innerHTML="已开通";
	    }else{
	        document.getElementById("tdjxh"+i).style.display="none";}
	    }
    }
});

}


// $.get(document.getElementById("webhttp").innerHTML+"/inf.php",{},function(result){
//     tstr=result.split("yjcode");
//     console.log(result);
// 	document.getElementById("topmoney").innerHTML=tstr[0];
// 	document.getElementById("topjf").innerHTML=tstr[1];
// 	document.getElementById("topudj").innerHTML=tstr[2];
// 	document.getElementById("topuimg").src=tstr[3];
// 	document.getElementById("topurz").innerHTML=tstr[4];
// 	dj=parseInt(tstr[5]);
// 	for(i=0;i<=dj;i++){
// 	if(document.getElementById("tdjxh"+i)){
// 	if(i==dj){
// 	 	document.getElementById("tdjxh"+i).innerHTML="已开通";
// 	}else{
// 		document.getElementById("tdjxh"+i).style.display="none";}
// 	}
// 	}
// });


$(function(){
	$("#returnTop").click(function () {
	    var speed = 200;
	    $('body,html').animate({
	        scrollTop: 0
	    }, speed);
	    return false;
	});

});


