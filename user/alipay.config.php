<?php
$alipay_config['partner']		= $rowcontrol[partner];;
$alipay_config['seller_email']	=  $rowcontrol[seller_email];
$alipay_config['key']			=$rowcontrol[security_code];;
$alipay_config['sign_type']    = strtoupper('MD5');
$alipay_config['input_charset']= strtolower('utf-8');
$alipay_config['cacert']    = getcwd().'\\cacert.pem';
$alipay_config['transport']    = 'http';
?>