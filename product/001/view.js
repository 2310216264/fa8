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

