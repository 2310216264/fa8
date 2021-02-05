<?
if(!empty($rowcontrol[wxpay]) && $rowcontrol[wxpay]!=",,,"){
$wxpay=preg_split("/,/",$rowcontrol[wxpay]);
$str1=htmlget("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$wxpay[0]."&secret=".$wxpay[3]);
$a1=preg_split("/access_token\":\"/",$str1);
$a2=preg_split("/\"/",$a1[1]);
$str2=htmlget("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$a2[0]."&type=jsapi");
$b1=preg_split("/ticket\":\"/",$str2);
$b2=preg_split("/\"/",$b1[1]);
$ticket=$b2[0];
$noncestr=returnbh();
$timestamp=strtotime(getsj());
$signv=sha1("jsapi_ticket=".$ticket."&noncestr=".$noncestr."&timestamp=".$timestamp."&url=".$wxfxurl);
if(check_in("https://",weburl)){$nh="https";}else{$nh="http";}
?>
<script language="javascript" src="<?=$nh?>://res2.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
<script language="javascript">
wx.config({
  debug: false,
  appId: '<?=$wxpay[0]?>',
  timestamp: <?=$timestamp?>,
  nonceStr: '<?=$noncestr?>',
  signature: '<?=$signv?>',
  jsApiList: ['updateTimelineShareData','updateAppMessageShareData']
});

wx.ready(function () {
  wx.updateTimelineShareData({  //分享朋友圈
    title: '<?=$wxfxtit?>',
    link: '<?=$wxfxurl?>',
    imgUrl: '<?=$wxfxtp?>',
    success: function () {
    }
  })

  wx.updateAppMessageShareData({ //分享给朋友
    title: '<?=$wxfxtit?>',
    desc: '<?=$wxfxdes?>',
    link: '<?=$wxfxurl?>',
    imgUrl: '<?=$wxfxtp?>',
    success: function () {
      // 设置成功
    }
  })

});
</script>
<? }?>