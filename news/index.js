//资讯评论
var xmlHttppj = false;
try {
  xmlHttppj = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
    xmlHttppj = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (e2) {
    xmlHttppj = false;
  }
}
if (!xmlHttppj && typeof XMLHttpRequest != 'undefined') {
  xmlHttppj = new XMLHttpRequest();
}

function newspj(x){
t=document.getElementById("pjt").value;
if(t==""){alert("请输入评价内容");document.getElementById("pjt").focus();return false;}
url = "newspj.php?bh="+x+"&pj="+escape(t);
xmlHttppj.open("get", url, true);
xmlHttppj.onreadystatechange = updatePagepj;
xmlHttppj.send(null);
}

function updatePagepj() {
 if(xmlHttppj.readyState == 4) {
 response = xmlHttppj.responseText;
 response=response.replace(/[\r\n]/g,'');
  if(response=="err1"){tangc(1);return false;}
  else if(response=="err2"){alert("亲~评论过于频繁，请稍候再发");return false;}
  else if(response=="ok"){location.reload();}else{alert("未知错误，请刷新重试");return false;}
 }
}
