<?php
/**
 * �ӱ��ػ�ȡ��ά�������ר�á�(Ĭ��Ϊ��ʾ�ƶ��ϴ��Ķ�ά��)
 * ע�⣺
 * ������ύ�Ķ���Ϊ100Ԫ ��չʾ����1Ԫ�Ķ�ά�� ��ô�����᲻���� ���·�֪ͨ
 * ��ʹ�õ����Զ�������տ����û�δ�����Լ��֧�� �����Ƕ��������ڡ�
 * Date: 2017/2/14
 * Time: 21:51
 */

$money = number_format((float)$_GET['money'], 2, '.', ''); //���ͳһ����2λСʱ
$tag = (int)$_GET['tag'];
$type = (int)$_GET['type'];
if ($type <= 0) $type = 1;
if ($money <= 0) {//����ʲô״�� ��û�С�չʾno.png
    header('Location: img/no.png');
    exit(0);
}

/**
 * ���ݲ���תΪ��ά���ļ��� (����ֻ��һ���ο� ������ݸ���ʵ�ʿ���)
 * @param $money ���
 * @param int $type  ֧������
 * @param int $tag  ֧������ע
 * @param int $act  ��ά�����ʽ
 * @return string  ���ض�ά��·��
 *
 *Ĭ��·����ʽΪ��qr/֧����ʽ/���_��ע.png ֧������Ϊ��qr/֧����ʽ/���_��ע.png   
 * ���磺100Ԫ ΢��Ϊ/qr/3/100.png  ֧������Ϊqr/1/100.00_0.png   ����100.00_0.png _0��ʾ��ע0 Ĭ��Ϊ0

 *act����Ϊ1���ʽΪ��qr/֧����ʽ/�����������/���С������.png ֧������Ϊ��qr/֧����ʽ/�����������/���С������_��ע.png
 *���磺100Ԫ С����������00 100Ԫ΢��QQ·��Ϊ��qr/3/100/00.png  100Ԫ֧��Ϊ��qr/3/100/00_0.png
 */
function moneyToFileName($money, $type = 1, $tag = 0, $act = 0)
{
    if ($act == 1) { //act����Ϊ1��ʹ�õ��ǽ����ֳɶ���ļ�����ʽ
        $money_arr = explode(".", $money); //�����С������沿�ַֿ�
        $name1 = $money_arr[0];
        $name2 = count($money_arr) <= 1 ? '00' : $money_arr[1];
        $fileName = $type == 1 ? "qr/{$type}/{$name1}/{$name2}_{$tag}.png" : "qr/{$type}/{$name1}/{$name2}.png";
    } else { //Ĭ�Ϸ�ʽ qr/3/100.00.png  ֧������Ϊqr/1/100.00_0.png
        $fileName = $type == 1 ? "qr/{$type}/{$money}_{$tag}.png" : "qr/{$type}/{$money}.png";
    }
    return $fileName;
}


$qrcode_filename = moneyToFileName($money, $type, $tag, 0); //���ݲ�������Ĭ�Ͻ���ά���ַ
if (!file_exists($qrcode_filename)) { //�ý���ά�벻���� �ס�
    //������Ƿ���Ĭ���տ��� ����ʹ��,û���Ǳ��˸����޷�����
    $index_fileName = "qr/{$type}/index.png";
    $qrcode_filename = file_exists($index_fileName) ? $index_fileName : 'img/no.png';
}
header('Location: ' . $qrcode_filename); //��ת����ά����ʵ��ַ