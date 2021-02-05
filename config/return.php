<?php
/*
2014年起，友价团队全部源码不再做加密处理，全部开源，方便用户二次开发。
同时我们仅对正规渠道购买的用户提供技术支持。
另：如果源码购买后有转卖行为，我们即删除你的认证帐号，同时也不再提供任何支持。
www.yj99.cn
友价源码
*/

require("return1.php");
function panduan($pzd,$ptable){
global $conn;
$sqlpd="select ".$pzd." from ".$ptable;mysqli_set_charset($conn,"utf8");$respd=mysqli_query($conn,$sqlpd);
if($rowpd=mysqli_fetch_array($respd)){return 1;}else{return 0;}
}

function returnxh($tabxh,$sesxh=""){
global $conn;
$sqlxh="select * from ".$tabxh." where id<>0 ".$sesxh." order by xh desc";mysqli_set_charset($conn,"utf8");$resxh=mysqli_query($conn,$sqlxh);
if($rowxh=mysqli_fetch_array($resxh)){$nxh=$rowxh[xh]+1;}else{$nxh=1;}
return $nxh;
}

//统计
function returncount($ctable){
global $conn;
$sqlcount="select count(*) as id from ".$ctable;
mysqli_set_charset($conn,"utf8");$rescount=mysqli_query($conn,$sqlcount);$rowcount=mysqli_fetch_array($rescount);return intval($rowcount[id]);
}


//统计计数
function returnsum($zd,$t){
global $conn;
$sqlb="select sum(".$zd.") as allzd from ".$t;mysqli_set_charset($conn,"utf8");$resb=mysqli_query($conn,$sqlb);$rowb=mysqli_fetch_array($resb);
if(empty($rowb[allzd])){return "0";}else{return $rowb[allzd];}
}




function returnhelptype($tv,$tid){
global $conn;
$sqltype="select * from yjcode_helptype where id=".intval($tid)."";mysqli_set_charset($conn,"utf8");$restype=mysqli_query($conn,$sqltype);
$rowtype=mysqli_fetch_array($restype);
if($tv==1){return $rowtype[name1];}else{return $rowtype[name2];}
}

function returnnewstype($tyid,$wv){
global $res3;
if($tyid==1){while3("id,name1","yjcode_newstype where id=".intval($wv));if($row3=mysqli_fetch_array($res3)){return $row3[name1];}else{return "";}}
if($tyid==2){while3("id,name2","yjcode_newstype where id=".intval($wv));if($row3=mysqli_fetch_array($res3)){return $row3[name2];}else{return "";}}
}

function returntasktype($tv,$tid){
global $conn;
if(empty($tid)){return "";}
$sqltype="select * from yjcode_tasktype where id=".intval($tid)."";mysqli_set_charset($conn,"utf8");$restype=mysqli_query($conn,$sqltype);
$rowtype=mysqli_fetch_array($restype);
if($tv==1){return $rowtype[name1];}else{return $rowtype[name2];}
}

function returntype($jbid,$aid){
global $conn;
if(empty($aid)){$aid=0;}
$sqlp="select * from yjcode_type where id=".intval($aid);mysqli_set_charset($conn,"utf8");$resp=mysqli_query($conn,$sqlp);
if($rowp=mysqli_fetch_array($resp)){
if($jbid==1){return $rowp[type1];}	
elseif($jbid==2){return $rowp[type2];}	
elseif($jbid==3){return $rowp[type3];}	
elseif($jbid==4){return $rowp[type4];}	
elseif($jbid==5){return $rowp[type5];}	
}else{return "";}
}

function returnservertype($jbid,$aid){
global $conn;
if(empty($aid)){$aid=0;}
$sqlp="select * from yjcode_servertype where id=".intval($aid);mysqli_set_charset($conn,"utf8");$resp=mysqli_query($conn,$sqlp);
if($rowp=mysqli_fetch_array($resp)){
if($jbid==1){return $rowp[name1];}	
elseif($jbid==2){return $rowp[name2];}	
}else{return "";}
}

function returntypem($jbid,$aid){
global $conn;
if(empty($aid)){$aid=0;}
$sqlp="select * from yjcode_protype where id=".intval($aid);mysqli_set_charset($conn,"utf8");$resp=mysqli_query($conn,$sqlp);
if($rowp=mysqli_fetch_array($resp)){
if($jbid==1){return $rowp[name1];}	
elseif($jbid==2){return $rowp[name2];}	
}else{return "";}
}

function returnshopname($u){
global $conn;
$u=intval($u);
$sqltype="select id,shopname from yjcode_user where id=".intval($u)."";mysqli_set_charset($conn,"utf8");$restype=mysqli_query($conn,$sqltype);
if($rowtype=mysqli_fetch_array($restype)){return $rowtype[shopname];}else{return "";}
}

function returnuserid($u){
global $conn;
if(empty($u)){return 0;}else{
$sqlother="select id,uid from yjcode_user where uid='".$u."'";mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
if($rowother=mysqli_fetch_array($resother)){return $rowother[id];}else{return 0;}
}
}

function returnadmin($u){
global $conn;
$sqlother="select id,adminuid from yjcode_admin where id=".intval($u);mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
if($rowother=mysqli_fetch_array($resother)){return $rowother[adminuid];}else{return "";}
}

function returnsellbl($u,$pbh){
global $rowcontrol;
global $conn;
$sbl=0;
$sqlother="select id,sellbl from yjcode_user where id=".intval($u);mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);$rowother=mysqli_fetch_array($resother);
if(!empty($rowother[sellbl])){$sbl=$rowother[sellbl];}else{
$sqlt1="select bh,ty1id from yjcode_pro where bh='".$pbh."'";mysqli_set_charset($conn,"utf8");$rest1=mysqli_query($conn,$sqlt1);
if($rowt1=mysqli_fetch_array($rest1)){
$sqlt2="select id,sellbl from yjcode_type where id=".$rowt1[ty1id];mysqli_set_charset($conn,"utf8");$rest2=mysqli_query($conn,$sqlt2);
if($rowt2=mysqli_fetch_array($rest2)){
if(!empty($rowt2[sellbl])){$sbl=$rowt2[sellbl];}
}
}
}
if(!empty($sbl)){return $sbl;}else{return $rowcontrol[sellbl];}
}

function returnuser($uid){
global $conn;
if(empty($uid)){return "";}
$sqlother="select id,uid from yjcode_user where id=".intval($uid);mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
$rowother=mysqli_fetch_array($resother);
return $rowother[uid];
}

function returnemail($uid){
global $conn;
if(empty($uid)){return "";}
$sqlother="select uid,email from yjcode_user where uid='".intval($uid)."'";mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
if($rowother=mysqli_fetch_array($resother)){return $rowother[email];}else{return "";}
}

function returnqq($u){
global $conn;
$sqlother="select id,uqq from yjcode_user where id=".intval($u);mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
$rowother=mysqli_fetch_array($resother);
return $rowother[uqq];
}

function returnweixin($u){
global $conn;
$sqlother="select id,weixin from yjcode_user where id=".intval($u);mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
$rowother=mysqli_fetch_array($resother);
return $rowother[weixin];
}

function returntjuserid($u){
global $conn;
$sqlother="select id,tjuserid from yjcode_user where id=".intval($u);mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
$rowother=mysqli_fetch_array($resother);
if(empty($rowother[tjuserid])){$v=0;}else{$v=$rowother[tjuserid];}
return $v;
}

function returnnc($u){
global $conn;
$sqlother="select id,nc from yjcode_user where id=".intval($u);mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
$rowother=mysqli_fetch_array($resother);
return $rowother[nc];
}

function returnproid($b){
global $conn;
$sqlother="select id,bh from yjcode_pro where bh='".$b."'";mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
$rowother=mysqli_fetch_array($resother);
return $rowother[id];
}

function returnserverid($b){
global $conn;
$sqlother="select id,bh from yjcode_server where bh='".$b."'";mysqli_set_charset($conn,"utf8");$resother=mysqli_query($conn,$sqlother);
$rowother=mysqli_fetch_array($resother);
return $rowother[id];
}

function returnxy($u,$t){ //1卖家 2买家
global $conn;
if(1==$t){$sqlxy="select count(*) as id from yjcode_order where selluserid=".$u." and ddzt='suc'";}
elseif(2==$t){$sqlxy="select count(*) as id from yjcode_order where userid=".$u." and ddzt='suc'";}
mysqli_set_charset($conn,"utf8");$resxy=mysqli_query($conn,$sqlxy);
$rowxy=mysqli_fetch_array($resxy);
return $rowxy[id];
}

function adwhile($adbh,$adnum=0,$w=0,$h=0){
global $rowcontrol;
global $conn;
autoAD($adbh);
$li="";
if($adnum!=0){$li=" limit ".$adnum;}
$sqlad="select * from yjcode_ad where zt=0 and adbh='".$adbh."' order by xh asc".$li;
mysqli_set_charset($conn,"utf8");
$resad=mysqli_query($conn,$sqlad);
while($rowad=mysqli_fetch_array($resad)){
switch($rowad[type1]){
case "代码":
echo "<div class=\"ad1\">$rowad[txt]</div>";
break;
case "图片":
$s="";
if($w!=0){$s=" width=\"".$w."px;\"";}
if($h!=0){$s=$s." height=\"".$h."px;\"";}
echo "<div class=\"ad1\"><a href=\"".$rowad[aurl]."\" target=_blank><img alt=\"".$rowad[tit]."\"".$s." border=0 src=".weburl.returnjgdw($rowcontrol[addir],"","gg")."/".$rowad[bh].".".$rowad[jpggif]."></a></div>";
break;
case "文字":
echo "<div class=\"ad1\">·<a href=\"".$rowad[aurl]."\" target=_blank>".$rowad[utit]."</a></div>";
break;
case "动画":
echo "<div class=\"ad1\"><embed src=\"".weburl."/".returnjgdw($rowcontrol[addir],"","gg")."/".$rowad[bh].".swf\" quality=\"high\" width=\"".$rowad[aw]."\" height=\"".$rowad[ah]."\" wmode=transparent type=\"application/x-shockwave-flash\"></embed></div>";
break;
}
}
}

function adread($adbh,$w,$h){
global $rowcontrol;
global $conn;
autoAD($adbh);
$sqlad="select * from yjcode_ad where zt=0 and adbh='".$adbh."'";
mysqli_set_charset($conn,"utf8");
$resad=mysqli_query($conn,$sqlad);
if($rowad=mysqli_fetch_array($resad)){
switch($rowad[type1]){
case "代码":
echo "$rowad[txt]";
break;
case "图片":
if($h==0 || $w==0){
echo "<a href=\"".$rowad[aurl]."\" target=_blank><img border=0 src=".weburl.returnjgdw($rowcontrol[addir],"","gg")."/".$rowad[bh].".".$rowad[jpggif]."></a>";
}else{
echo "<a href=$rowad[aurl] target=_blank><img border=0 src=".weburl.returnjgdw($rowcontrol[addir],"","gg")."/$rowad[bh].$rowad[jpggif] width=$w height=$h></a>";
}
break;
case "文字":
echo "<a href=\"".$rowad[aurl]."\" target=_blank>".$rowad[tit]."</a>";
break;
case "动画":
echo "<div class=\"ad\"><embed src=\"".weburl.returnjgdw($rowcontrol[addir],"","gg")."/".$rowad[bh].".swf\" quality=\"high\" width=\"".$rowad[aw]."\" height=\"".$rowad[ah]."\" wmode=transparent type=\"application/x-shockwave-flash\"></embed></div>";
break;
}
}
}

function adreadID($adid,$w,$h){
global $rowcontrol;
global $conn;
$sqlad="select * from yjcode_ad where zt=0 and id=".intval($adid);
mysqli_set_charset($conn,"utf8");
$resad=mysqli_query($conn,$sqlad);
if($rowad=mysqli_fetch_array($resad)){
switch($rowad[type1]){
case "代码":
echo "$rowad[txt]";
break;
case "图片":
if($h==0 || $w==0){
echo "<a href=\"".$rowad[aurl]."\" target=_blank><img border=0 src=".weburl.returnjgdw($rowcontrol[addir],"","gg")."/".$rowad[bh].".".$rowad[jpggif]."></a>";
}else{
echo "<a href=$rowad[aurl] target=_blank><img border=0 src=".weburl.returnjgdw($rowcontrol[addir],"","gg")."/$rowad[bh].$rowad[jpggif] width=$w height=$h></a>";
}
break;
case "文字":
echo "·<a href=\"".$rowad[aurl]."\" target=_blank>".$rowad[utit]."</a>";
break;
case "动画":
echo "<div class=\"ad\"><embed src=\"".weburl.returnjgdw($rowcontrol[addir],"","gg")."/".$rowad[bh].".swf\" quality=\"high\" width=\"".$rowad[aw]."\" height=\"".$rowad[ah]."\" wmode=transparent type=\"application/x-shockwave-flash\"></embed></div>";
break;
}
}
}

function returntp($tsql,$a=""){
global $conn;
$sqltp="select * from yjcode_tp where ".$tsql;mysqli_set_charset($conn,"utf8");$restp=mysqli_query($conn,$sqltp);
if($rowtp=mysqli_fetch_array($restp)){
if(empty($rowtp[upty])){
$t=preg_split("/\./",$rowtp[tp]);return weburl.$t[0].$a.".".$t[1];
}else{
return returnnotp($rowtp[tp],$a);
}
}else{
return "";
}
}

function returnuserdj($u){
global $conn;
$fdj="";
$sqld="select * from yjcode_userdj where zt=0 order by xh asc";mysqli_set_charset($conn,"utf8");$resd=mysqli_query($conn,$sqld);
if($rowd=mysqli_fetch_array($resd)){$fdj=$rowd[name1];}else{$fdj="";}

$sqlu="select * from yjcode_user where id=".$u;mysqli_set_charset($conn,"utf8");$resu=mysqli_query($conn,$sqlu);$rowu=mysqli_fetch_array($resu);
if(empty($rowu[userdj])){
$ldj=$fdj;
}else{
$ldj=$rowu[userdj];
}

if(!empty($rowu[userdjdq])){
$sj1=date("Y-m-d H:i:s");
if($rowu[userdjdq]<$sj1){$ldj=$fdj;$dq=date('Y-m-d H:i:s',strtotime ("-10 second",strtotime($sj1)));updatetable("yjcode_user","userdj='".$fdj."',userdjdq=NULL where id=".intval($u));}
}

return $ldj;

}


function returnarea($abh){
global $conn;
if(0==$abh){return "";}else{
$sqlarea="select bh,name1 from yjcode_city where bh='".$abh."'";mysqli_set_charset($conn,"utf8");$resarea=mysqli_query($conn,$sqlarea);
$rowarea=mysqli_fetch_array($resarea);
return $rowarea[name1];
}
}

function returnyunfei($u,$zl,$area){
global $conn;
if($zl==0){return 0;}
$m=0;
$sqlarea="select * from yjcode_yfsz where city1bh='".$area."' and userid=".intval($u);mysqli_set_charset($conn,"utf8");$resarea=mysqli_query($conn,$sqlarea);
if($rowarea=mysqli_fetch_array($resarea)){
$m=$rowarea[money1];
if($zl>1){$m=$m+($zl-1)*$rowarea[money2];}
}
return $m;
}

function returntjmoney($pbh){
global $rowcontrol;
global $conn;
$tjmv=0;
$sqlt1="select bh,ty1id from yjcode_pro where bh='".$pbh."'";mysqli_set_charset($conn,"utf8");$rest1=mysqli_query($conn,$sqlt1);
if($rowt1=mysqli_fetch_array($rest1)){
$sqlt2="select id,tjmoney from yjcode_type where id=".$rowt1[ty1id];mysqli_set_charset($conn,"utf8");$rest2=mysqli_query($conn,$sqlt2);
if($rowt2=mysqli_fetch_array($rest2)){
if(!empty($rowt2[tjmoney])){$tjmv=$rowt2[tjmoney];}
}
}
if(!empty($tjmv)){return $tjmv;}else{return $rowcontrol[tjmoney];}
}

function returnvideo($a,$w,$h){
global $conn;
$sqlt1="select * from yjcode_provideo where id=".intval($a);mysqli_set_charset($conn,"utf8");$rest1=mysqli_query($conn,$sqlt1);
if($rowt1=mysqli_fetch_array($rest1)){
 
if($rowt1[admin]==1){$u=$rowt1[url];}else{$u=str_replace("../upload/","upload/",weburl.$rowt1[url]);}

if($rowt1[gs]=="flv"){
$str="
<script type=\"text/javascript\">var swf_width=".$w.";var swf_height=".$h.";var texts='';var files='".$u."';
document.write('<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\"   codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\">');
document.write('<param name=\"movie\" value=\"".weburl."config/flv.swf\"><param name=\"quality\" value=\"high\">');
document.write('<param name=\"menu\" value=\"false\"><param name=\"allowFullScreen\" value=\"true\" />');
document.write('<param name=\"FlashVars\" value=\"vcastr_file='+files+'&IsAutoPlay=1\">');
document.write('<embed src=\"".weburl."config/flv.swf\" allowFullScreen=\"true\" FlashVars=\"vcastr_file='+files+'&vcastr_title='+texts+'\" menu=\"false\" quality=\"high\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />'); 
document.write('</object>');
</script>
";

}elseif($rowt1[gs]=="swf"){
$str="<embed type=\"application/x-shockwave-flash\" class=\"edui-faked-video\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" src=\"".$u."\" width=\"".$w."\" height=\"".$h."\" style=\"float: none\" wmode=\"transparent\" play=\"true\" loop=\"false\" menu=\"false\" allowscriptaccess=\"never\" allowfullscreen=\"true\"/>";

}

}
return $str;
}

?>