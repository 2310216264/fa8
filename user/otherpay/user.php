<?php
/**
 * ���ǲ��Գ�ֵ����ʾ�û���ǰ���.
 * ������ʾ�û���ֵ�Ƿ�ɹ���
 * Date: 2017/2/14
 * Time: 21:11
 *
 */

require_once("codepay_config.php"); //���������ļ�
require_once("includes/MysqliDb.class.php");//����mysqli����
require_once("includes/M.class.php");//����mysqli������
if (!defined('DEBUG') || !DEBUG || !defined('DB_PREFIX') || !defined('DB_USERTABLE')) {
    exit('��ҳ���Ѿ��ر� ��������޸������ļ�');
}

/**
 * ע�⣺������Ϊ��ֱ����ʾ��ֵ����ı仯�� �ڵ���ģʽ��û��֤Ȩ����ʾ���û���
 * ��ȷ�������������к�Ӧ�رյ���ģʽ����֤��¼״̬ ��ֱ��ɾ����ѯ�����ش��롣��ҪӦ�õ�ʵ��ҵ���С�
 *
 */
echo('<script>alert("��ҳ���Ϊֱ����ʾ��ֵ���� �������޸Ļ�ɾ����ҳ��")</script>');

$m = new M();
$pay_id = 'admin'; //���session��û��Ĭ����ʾ���ǲ��������еĵ�һ���û���
$rs = $m->runSql("select * from " . DB_USERTABLE . " where user='{$pay_id}'"); //ִ��SQL
if (!$rs || $rs->num_rows < 1) {
    echo(sprintf("���ݿ���û�ҵ�IDΪ��%u ��Ϊ�û�.", $pay_id));
} else {
    $userData = $rs->fetch_assoc();
    echo sprintf("����Ϊ�������� �������������ʾ��ֵҵ��ɹ�ִ��</br>  <h3>�û�����{$userData["user"]} ��ǰ��{$userData["money"]} vip�ֶΣ�{$userData["vip"]}</h3>");
}
?>

