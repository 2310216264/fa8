<?php
/**
 * Created by CodePay.
 * �����ļ�
 * �汾��1.8
 * �޸����ڣ�2017/8/2
 *
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о��ӿ�ʹ�ã�ֻ���ṩһ���ο���
 *
 * ע�⣺UTF-8���벻Ҫ�ڼ��±��±༭ ��������һЩ��������� ��ȷ����Ӧ�ڿ������ߴ򿪱༭
 */

//�����������������������������������Ļ�����Ϣ������������������������������
//codepayƽ̨��ID���ɴ�������ɵ��ַ������鿴��ַ��https://codepay.fateqq.com/admin/#/dataSet.html
error_reporting(E_ALL & ~E_NOTICE); //���˽ű�����
date_default_timezone_set('PRC'); //ʱ������ ���ĳЩ��������
$codepay_config['id'] = '38595';
/**
 * MD5��Կ����ȫ�����룬�����ֺ���ĸ����ַ�������Ҫ�������һ��
 * ���õ�ַ��https://codepay.fateqq.com/admin/#/dataSet.html
 * ��ֵ�ǳ���Ҫ �벻Ҫй¶ �����Ӱ��֧���İ�ȫ�� ��й¶�����µ��ƶ�����
 */
$codepay_config['key'] = '6HWAIg5thHgC6NyCSC43Fyu5Jq7m9x0n';

//�ַ������ʽ Ŀǰ֧�� gbk GB2312 �� utf-8 ��֤���ĵ�����һ�� ����ʹ��utf-8
$codepay_config['chart'] = strtolower('utf-8');
header('Content-type: text/html; charset=' . $codepay_config['chart']);

//�Ƿ�������һ�ģʽ 1Ϊ����. δ��ͨ������ķ����ʽ��޷���ʱ����
$codepay_config['act'] = ''; //��֤������ һ�������Ϊ0

/**����֧��ҳ����ʾ��ʽ
 * 1: GET����ƶ�֧�� (�� ������ǿ �Զ����� 1���ӿɼ���)
 * 2: POST�����ƶ�֧�� (�� ������ǿ �Զ�����)
 * 3���Զ��忪��ģʽ (Ĭ�� ���� ��Ҫһ���������� �ֶ����� html/codepay_diy_order.php�޸�����̨����)
 * 4���߼�ģʽ(���� ��Ҫ��ǿ�Ŀ������� �ֶ����� html/codepay_supper_order.php�޸�����̨����)
 */
$codepay_config['page'] = 3; //֧��ҳ��չʾ��ʽ

//֧��ҳ������ʽ �����$codepay_config['page'] ����Ϊ 1��2 �Ż����á�
$codepay_config['style'] = 1; //��ʱ�����Ĺ��� ���ڻ���Ч ������������ķ����


//��ά�볬ʱ����  ��λ����
$codepay_config['outTime'] = 360;//360��=6���� ��Сֵ60  ������̫�� �����Ӱ��������֧��

//��ͽ������
$codepay_config['min'] = 0.01;

//����֧�����ٷ��ӿ� ��Ա����Ȩ����Ч
$codepay_config['pay_type'] = 1;

$codepay_config['user']='admin'; //����Ĭ�ϵĳ�ֵ�û� ��Ϊ������ʾ�����ݿ��ֵ ֻ�и��û��� ����ʽʹ����Ϊ��

define('HTTPS', false);  //�Ƿ�HTTPSվ�� falseΪHTTP trueΪHTTPS


//�����ж��Ƿ�HTTPS
function isHTTPS()
{
    if (defined('HTTPS') && HTTPS) return true;
    if (!isset($_SERVER)) return FALSE;
    if (!isset($_SERVER['HTTPS'])) return FALSE;
    if ($_SERVER['HTTPS'] === 1) {  //Apache
        return TRUE;
    } elseif ($_SERVER['HTTPS'] === 'on') { //IIS
        return TRUE;
    } elseif ($_SERVER['SERVER_PORT'] == 443) { //����
        return TRUE;
    }
    return FALSE;
}

$codepay_config['path'] = (isHTTPS() ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['REQUEST_URI']); //API��װ·�� ����Ϊhttp://����/codepay


//��ά�뱾��ʵ�� ����http://baidu.com �����http://baidu.com/?money=1&tag=0&type=1
// qrcode.php Ϊ���ǵ���ʾ���ƶ�ά����� ɾ������ע�͡�//���������ñ��ض�ά�� ��ά���ϴ���qr Ŀ¼�µ�1 2 3
// $codepay_config['qrcode_url'] = $codepay_config['path'].'/qrcode.php';

/**
 * ͬ��֪ͨ���ã�
 * ͬ��֪ͨ�û��ر���ҳ���򲻻�֪ͨ ֪ͨ��ַ������
 * ���صĲ���ͨ��MD5���ܴ��� ����target����Ϊget ��Ϊͬ��֪ͨ����
 * ����֪ͨ��ַ���ܸ����κβ�������������Ҫ������֤ǩ������������֤����ǩ��ǰ��$_GET['ͬ����ַ�еĲ�����']ȥ��
 * ����Ϊ����ͬ����ַ��(����·��)
 * http://�������/codepay/return.php
 */
$codepay_config['return_url'] = $codepay_config['path'] . '/return.php'; //�Զ�������ת��ַ

//����ɾ�����桾//���ĳ��Լ��� ����Ϊ��

//$codepay_config['return_url'] ='';

/**
 * �첽֪ͨ���ã�
 * �����첽֪ͨҲ���Ե����������֧���ƶ����á� ��������������ƶ�Ĭ�ϵ�֪ͨ��ַ
 * (�첽֪ͨ�ɱ�֤֪ͨ�Ŀɿ��Լ������� ����������ƶ����ú���������ƶ�֪�� ��ȫ�������)
 */

//$codepay_config['notify_url'] = $codepay_config['path'] . '/notify.php'; //�Զ�����֪ͨ��ַ ���ȼ���߲�������Ϊϵͳ����������

//����ɾ�����桾//���ĳ��Լ��� ����Ϊ��

$codepay_config['notify_url'] ='https://www.a8zhan.com/user/otherpay/notify.php';


/**
 * ����Ϊ�����Ƿ�������ģʽ ��ʹ�ò������ݽ��г�ֵʾ������Ҫ����install.php��װ���ݺ����Ч
 */
define('ROOT_PATH', dirname(__FILE__)); //���ǳ���Ŀ¼����
define('DEBUG', true);  //����ģʽ����
define('LOG_PATH', ROOT_PATH . '/log.txt');  //��־�ļ�·�� ����д�뵽��webĿ¼ ����c:/log.txt ��ΪWEBĿ¼�κ��˿ɷ���
define('DB_PREFIX', 'codepay');  //�������ݱ�ǰ׺ ��Ҫ�Ƕ�����¼��ǰ׺ ɾ�����н�ͣ�ò�������

/**
 * ����ȫ������Ϊ��ֵʾ���ӿ��е�������� Ϊ���˽���֧���ӿڵ����ʵ�ֲ�����ͨ�õ�
 *
 * ����ΪMYSQL���ݿ������ ��Ҫ���ڲ������ݳ�ֵҵ��demo ���Ǳ�Ҫ��װ����ز����ڰ�װ���Զ����ɡ�
 */
define('DB_HOST', 'localhost'); //���ݿ��������ַ
define('DB_USER', 'a8zhan_com');  //���ݿ��û���
define('DB_PWD', 'mYyNTswZzXHEZdij');//���ݿ�����
define('DB_NAME', 'a8zhan_com');  //���ݿ�����
define('DB_PORT', '3306');  //���ݿ�˿�

define('DB_AUTOCOMMIT', false);  //Ĭ��falseʹ������ع� ���Զ��ύֻ��InnoDB��Ч��
define('DB_ENCODE', $codepay_config['chart'] == 'utf-8' ? 'utf8' : $codepay_config['chart']);  //���ݿ����


/**
 * ����ΪMYSQL���ݿ������ �޸��������,�ֶ� ����ʵ�ּ򵥵ĳ�ֵҵ�� Ϊ�������ֿ�������
 * codepay_user Ϊ���ݿ�ı��޸ĳ����
 * ��ȡ������ ��¼phpmyadmin--��������վ�����ݿ�--�ҳ��û����ڱ�
 *
 * money Ϊ��Ҫ���ӵĽ����߻���
 * ��ȡ��������¼phpmyadmin--��������վ�����ݿ�--�ҳ��û����ڱ�--�������������ߡ��ṹ���ܿ��� ���û��������ֶ�
 *
 * user Ϊ�û���ʶ �����������û� �����û����ֶ��� ���ΪID ����ID�ֶ���
 * ��ȡ��������¼phpmyadmin--��������վ�����ݿ�--�ҳ��û����ڱ�--�������������ߡ��ṹ���ܿ��� ���û�Ψһ��ʶ����ֶ�
 *
 */
define('DB_USERTABLE', 'codepay_user');  //��ֵ�û��������ݿ����
define('DB_USERMONEY', 'money');  //��ֵ�û����ڱ��еĽ���ֶ���
define('DB_USERNAME', 'user');  //��ֵ�û������ֶ��� �����û���ת��Ϊid


?>