<style type="text/css">
.fenxiang{width: 148px;padding:0 0 0 0;font-size:12px;float:left;}
.fenxiang #weixinfx{float:left;border:#D2D8D8 solid 1px;width:347px;padding:0 0 10px 0;margin:30px 0 0 -39px;background-color:#fff;position:absolute;}
.fenxiang #weixinfx .s1{float:left;margin:10px 0 0 5px;width:250px;height:25px;border-bottom: #FF3C00 solid 2px;font-size:14px;font-weight:700;}
.fenxiang #weixinfx .s2{float:left;margin:15px 0 0 0;width:87px;height:20px;border-bottom: #FF3C00 solid 2px;text-align:right;}
.fenxiang #weixinfx .s2 img{cursor:pointer;}
.fenxiang #weixinfx .s3{float:left;width:150px;margin:10px 0 0 0;text-align:center;}
.fenxiang #weixinfx .s4{float:left;width:190px;line-height:24px;margin:17px 0 0 0;}
.fenxiang a{float:left;width:24px;height:24px;margin:0 5px 0 0;}
.fenxiang .a1{background:url(<?=weburl?>img/fenxiang/fx1.gif) left top no-repeat;}
.fenxiang .a2{background:url(<?=weburl?>img/fenxiang/fx2.gif) left top no-repeat;}
.fenxiang .a3{background:url(<?=weburl?>img/fenxiang/fx3.gif) left top no-repeat;}
.fenxiang .a4{background:url(<?=weburl?>img/fenxiang/fx4.gif) left top no-repeat;}
</style>
<script language="javascript">
function weixinfxonc(x){
if(0==x){document.getElementById("weixinfx").style.display="none";}
else{document.getElementById("weixinfx").style.display="";}
}
</script>
<div class="fenxiang">
        <div id="weixinfx" style="display:none;">
         <span class="s1">扫描二维码，分享到微信</span>
         <span class="s2"><img src="<?=weburl?>img/fenxiang/clo.gif" onClick="weixinfxonc(0)" /></span>
         <span class="s3"><img src="<?=weburl?>tem/getqr.php?u=<?=$fxurl?>&size=4" width="110"></span>
         <span class="s4">打开微信<br>使用"扫一扫"<br>再点击微信界面右上角三个点标志<br>分享到微信朋友和朋友圈。</span>
        </div>
        <a href="javascript:void(0)" onClick="weixinfxonc(1)" class="a3"></a>
        <a href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?=$fxurl?>&title=<?=$fxtit?>&pics=<?=$fxtp?>" class="a1" target="_blank"></a>
        <script type="text/javascript">
        (function(){
        var p = {
        url:'<?=$fxurl?>', /*获取URL，可加上来自分享到QQ标识，方便统计*/
        desc:'', /*分享理由(风格应模拟用户对话),支持多分享语随机展现（使用|分隔）*/
        title:'<?=$fxtit?>', /*分享标题(可选)*/
        summary:'', /*分享摘要(可选)*/
        pics:'<?=$fxtp?>', /*分享图片(可选)*/
        flash: '', /*视频地址(可选)*/
        site:'QQ分享', /*分享来源(可选) 如：QQ分享*/
        style:'202',
        width:24,
        height:24
        };
        var s = [];
        for(var i in p){
        s.push(i + '=' + encodeURIComponent(p[i]||''));
        }
        document.write(['<a class="a2" href="https://connect.qq.com/widget/shareqq/index.html?',s.join('&'),'" target="_blank"></a>'].join(''));
        })();
        </script>
        <script src="static/loadqq.js" widget="shareqq" charset="utf-8"></script>
        <? if(check_in("https:",weburl)){$sinatp=$fxtp;}?>
        <a href="https://service.weibo.com/share/share.php?title=<?=$fxtit?>&url=<?=$fxurl?>&pic=<?=$sinatp?>" class="a4" target="_blank"></a>
</div>