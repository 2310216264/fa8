<?php
/* *
 * ���ܣ���֧���ͷ���ͬ��֪ͨҳ��(��ҳ�治�����κ�ҵ��)
 * �汾��1.0
 * ���ڣ�2016-12-23
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о���֧���ӿ�ʹ�ã�ֻ���ṩһ���ο���


 *************************ҳ�湦��˵��*************************
 * ֧���ɹ���ͻ�Ĭ�ϻ���ת����ҳ�� ��ҳ�����ҵ�� Ҳ�ɲ������� ��ҳ�����ǲ����κ�ҵ����
 * ����ҵ������Ҫ�����������⣺
 * 1������Ҫ�����Ƿ��Ѿ�ִ�гɹ�����Ҫ���첽�ظ�����
 * 2����Ҫ���ǲ���������������Ŀ��ܡ�
   (���޷�����������ⲻ�������ڴ�ҳ����ҵ����)

 * ʲôʱ�����ת��
 * ��ֻҪ��⵽����ɹ��ͻ���ת,ͬ�����첽�ǲ������С�
 *
 * ��ҳ�治����ҵ����ʲôӰ�죿
 * �𣺳�ֵ ����֮���ûӰ�졣 ���ڸ�������Ҫ����չʾ�û���һЩ��ȯ֮�����Ӱ�졣

 */

//��JS�� 3�����ת���û�������ҳ�濴�Ƿ��ˡ� ��÷�ʽ����ʹ������������ֶ��������˶�ҵ�����߼���û����
$gotoUser=(defined('DEBUG') && !DEBUG) ||(!defined('DB_PREFIX') || !defined('DB_USERTABLE'))?"":"window.location = 'user.php?t=' + Date.parse(new Date());";
?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>֧������</title>
    <link href="css/wechat_pay.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">
    <style>
        .text-success {
            color: #468847;
            font-size: 2.33333333em;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-<?php echo (int)$_GET['type']?>"></span>
    </h1>

    <div class="mod-ct">
        <div class="order">
        </div>
        <div class="amount" id="money">��<?php echo (float)$_GET["money"] ?></div>
        <h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> ֧���ɹ�</strong></h1>

        <div class="detail detail-open" id="orderDetail" style="display: block;">
            <dl class="detail-ct" id="desc">
                <dt>���</dt>
                <dd><?php echo (float)$_GET["money"] ?></dd>
                <dt>�̻�������</dt>
                <dd><?php echo htmlentities($_GET["pay_id"]) ?></dd>
                <dt>��ˮ�ţ�</dt>
                <dd><?php echo htmlentities($_GET["pay_no"]) ?></dd>
                <dt>����ʱ�䣺</dt>
                <dd><?php echo date("Y-m-d H:i:s", (int)$_GET["pay_time"]) ?></dd>
                <dt>״̬</dt>
                <dd>֧���ɹ�</dd>
            </dl>


        </div>

        <div class="tip-text">
        </div>


    </div>
    <div class="foot">
        <div class="inner">
            <p>��δ��������ϵ����</p>
        </div>
    </div>

</div>
<div class="copyRight">
    <p>֧��������<a href="http://codepay.fateqq.com/" target="_blank">��֧��</a></p>
</div>
<script>
    alert('֧���ɹ� ��δ��������ϵ����')
    setTimeout(function () {
        //�������дһЩ������ҵ��
        <?php echo $gotoUser;?>
    }, 3000)
</script>
</body>
</html>



