<?php
/**
 * ���ܣ���֧������˵���֪ͨ (�����ר��)
 * �汾��1.0
 * ���ڣ�2016-12-23
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о���֧���ӿ�ʹ�ã�ֻ���ṩһ���ο���
 *************************ע��*****************
 *������ڽӿڼ��ɹ������������⣬���԰��������;�������
 *1�������ĵ����ģ�https://codepay.fateqq.com/apiword/��
 *2���̻��������ģ�https://codepay.fateqq.com/help/��
 *3����ϵ�ͷ���https://codepay.fateqq.com/msg.html��
 */
require_once("codepay_config.php"); //���������ļ�
require_once("lib/email.class.php");
require_once("lib/codepay_core.function.php");
function sendEmail($mailtitle, $mailcontent)
{
    /**
     * ע�����ʼ��඼�Ǿ����Ҳ��Գɹ��˵ģ������ҷ����ʼ���ʱ��������ʧ�ܵ����⣬������¼����Ų飺
     * 1. �û����������Ƿ���ȷ��
     * 2. ������������Ƿ�������smtp����
     * 3. �Ƿ���php���������⵼�£�
     * 4. ��smtp->debug = false��Ϊtrue��������ʾ������Ϣ��Ȼ����Ը��Ʊ�����Ϣ��������һ�´����ԭ��
     * 5. ������ǲ��ܽ�������Է��ʣ�http://codepay.fateqq.com
     *
     */
    //******************** ������Ϣ ********************************
    $smtpserver = "smtp.163.com";//SMTP������ QQ������Ҫʹ����֤�������QQ����
    $smtpserverport = 25;//SMTP�������˿�
    $smtpusermail = "codepay@163.com";//SMTP���������û�����
    $smtpemailto = '13888888888@qq.com';//����յ����� ����QQ���� QQ�ֻ������� 139�ƶ�����
    $smtpuser = "codepay@163.com";//SMTP���������û��ʺ�
    $smtppass = "123456";//SMTP���������û�����
    $mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�

    //************************ ������Ϣ ****************************
    $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
    $smtp->debug = false;//�Ƿ���ʾ���͵ĵ�����Ϣ
    $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
    if ($state == "") {
        echo "�Բ����ʼ�����ʧ�ܣ�����������д�Ƿ�����";
        exit();
    }
    echo "��ϲ���ʼ����ͳɹ�����";
}

if ($_GET['key'] != $codepay_config['key']) { //��֤��Կ
    DEBUG ? exit('��Կ����') : exit(0); //�ǵ���ģʽ�����������Ϣ
}
$line = (int)$_GET['line'];
$type = (int)$_GET['typeID']; //1��֧���� 2��QQǮ����Ƹ�ͨ 3:΢��֧��
$type_name = getTypeName($type);
//��lineΪ3 ��������Ϊ��Ҫɨ��Ķ�ά��
//��֧�����򿪸õ�ַ��֤�����ɶ�ά����֧����ɨ��
//��ʾ�ö�ά��ķ�ʽ��echo ('http://codepay.fateqq.com:52888/showqrcode.html?'.$_GET['data']);
$data = $_GET['data'];

//���緢�͵�139�����ʵ���˶�������. ΢�� QQ����Ҳ����ʵ��
if ($line == 0) { //����
    sendEmail($type_name . '������', "���� {$type_name}�����˲�֪��ʲôʱ�������");
} elseif ($line == 1) { //��¼�ɹ�
    sendEmail($type_name . '������', "���� ����Ŷ�����˲�Ҫ��������");
} elseif ($line == 3) {// ��Ҫ�ֻ�ɨ������Զ���¼���ȡ�˵� �����������ȷ����Ӱ��ҵ����
    sendEmail($type_name . 'Ҫɨ����', '������ʱ����˵�� ����û�ա�ɨ����Ҫ�ĵ�ַ��' . $_GET['data'] . "<img src='http://codepay.fateqq.com:52888/showqrcode.html?{$_GET["data"]}'>");
}
?>