<?php
//error_reporting(E_ALL & ~ E_NOTICE); //���˽ű�����

//ini_set("display_errors", "On");  //��ʾ�ű�������ʾ
//error_reporting(E_ALL | E_STRICT); //����ȫ���ű�������ʾ
/**
 * ���ܣ���֧���������첽֪ͨҳ�� (�����������)
 * �汾��1.0
 * ���ڣ�2016-12-23
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о���֧���ӿ�ʹ�ã�ֻ���ṩһ���ο���
 *************************ҵ�������˵��*************************
 * 1����ҳ�治�����ڱ������Բ��ԣ��뵽�������������ԡ���ȷ���ⲿ���Է��ʸ�ҳ�档
 * 2��������ʹ�����ǵ�������С��ֶ���ֵ�����е��ԡ�
 * 3����ҳ����Թ�����ʹ��д�ı�����logResult���ú����ѱ�Ĭ�Ͽ�������codepay_notify_class.php�еĺ���verifyNotify
 * 4��������ҳ���ļ�ʱ�������ĸ�ҳ���ļ������κ�HTML���뼰�ո�
 * 5�����û���յ���ҳ�淵�ص� ok����success ��Ϣ����֧������24Сʱ�ڰ�һ����ʱ������ط�֪ͨ
 *************************ע��*****************
 *������ڽӿڼ��ɹ������������⣬���԰��������;�������
 *1�������ĵ����ģ�https://codepay.fateqq.com/apiword/��
 *2���̻��������ģ�https://codepay.fateqq.com/help/��
 *3����ϵ�ͷ���https://codepay.fateqq.com/msg.html��
 */
require_once("codepay_config.php"); //���������ļ�
require_once("includes/MysqliDb.class.php");//����mysqli����
require_once("includes/M.class.php");//����mysqli������
require_once("lib/codepay_notify.class.php"); //����֪ͨ��

/**
 * ҵ������ʾ
 * @param $data ���յ���POST����
 * @return string ���ش���Ľ��
 */
function DemoHandle($data)
{ //ҵ�������� ����һЩ�ַ���
    $pay_id = $data['pay_id']; //��Ҫ��ֵ��ID �򶩵��� ���û���
    $money = (float)$data['money']; //ʵ�ʸ�����
    $price = (float)$data['price']; //������ԭ��
    $type = (int)$data['type']; //֧����ʽ
    $pay_no = $data['pay_no']; //֧����ˮ��
    $param = $data['param']; //�Զ������ ԭ�ⷵ�� �����������ύ���Զ������
    $pay_time = (int)$data['pay_time']; //����ʱ���
    $pay_tag = $data['tag']; //֧����ע ��֧�������� ����֧����ʽȫΪ0���
    $status = 2; //ҵ����״̬ �����ȫ����Ϊ2  ���б�Ҫ�����Ƿ�ҵ��ͬʱ�����˿��Դ������ٸ��¸��ֶ�Ϊ����ֵ
    $creat_time = time(); //�������ݵ�ʱ���


    if ($money <= 0 || empty($pay_id) || $pay_time <= 0 || empty($pay_no)) {
        return 'ȱ�ٱ�Ҫ��һЩ����'; //���������� Ψһ��ʶ���������Щ
    }


    //ʵ����mysqli ������ ����php.ini����mysqli ���÷�����ɾ��extension=php_mysqli.dllǰ��� ; (�ֺ�)����web������
    //MYSQL�û���Ҫӵ��INSERT updateȨ��
    $m = new M();

    //���²���Ϊ��С��ɾ���˵����޷�ִ����׼�� û��̫��ʵ������ ����Щ��ʼֵ

    if (!defined('DB_USERTABLE')) defined('DB_USERTABLE', 'codepay_user');  //Ĭ�ϵ��û����ݱ�
    if (!defined('DB_PREFIX')) defined('DB_PREFIX', 'codepay'); //Ĭ�ϵı�ǰ׺
    if (!defined('DB_AUTOCOMMIT')) defined('DB_AUTOCOMMIT', false); //Ĭ��ʹ������ �ع�
    if (!defined('DEBUG')) defined('DEBUG', false); //Ĭ�����õ���ģʽ ����������������Ͳ�������

    //��ʼ������

    /**
     * ��ⶩ���Ƿ��Ѿ�����
     *
     * ���´�����Ҫ��װ���ǵĲ������ݲſ��������С� ���Ǹ��ο� ������������п���
     * ���п�������ɲο����ǵ�API���б�д�����鰲װ�����������޸�
     * --------------------------------------
     * ���� �Բ��뷽ʽ�ж϶����Ƿ���� Ĭ��ֻ���ݿ�����Ϊ:InnoDB�ŻᲹ�� �ŵ㣺�򵥸�Ч ������ǿ��
     * ---------------------------------------
     * ��������ҵ��ʧ�ܲ���������
     * Ĭ���Ѿ����������ݿ�������ҪΪ:InnoDB ����ҵ��ʧ�ܲ����ٵ�2��ִ��
     * ��codepay_config.php�����ļ�����DB_AUTOCOMMIT�޸�Ϊdefine('DB_AUTOCOMMIT', false);
     *
     * ��ʹ��InnoDB����Ҳ����Ӱ��ʹ�á�ҵ���ⲽ���Ժú󲻳ɹ����ʼ��������ܳ���,�������SQL�������⡣
     *----------------------------------------
     *
     * ��� �Զ���״̬��ʶ�ж��Ƿ��Ѿ����� ������õķ�ʽ��
     * �����跱��(��Ҫ��������Ŀ���) Ϊ�������׶�����ʹ�ò��뷽ʽ
     *---------------------------------------
     *---------------------------------------
     * �Ҳ�����������ҵ����������ʽ��
     * �е�,��ֻ�Ǹ�ʾ��
     */

    $m->db->autocommit(DB_AUTOCOMMIT);//Ĭ�ϲ��Զ��ύ �����￪�� ֻ���InnoDB������Ч

    /**
     * ���뵽�û������¼Ĭ��codepay_order��ʹ����2��Ψһ�����������Ƿ��Ѿ����ڡ�ȷ��ҵ��ִֻ��һ��
     * ����Ϊ��Ϊʶ���Ƿ��Ѿ�ִ�й��˱ʶ��� ���鱣�� ����������ȷ��ҵ���Ѿ�����
     */
    $insertSQL = "INSERT INTO `" . DB_PREFIX . "_order` (`pay_id`, `money`, `price`, `type`, `pay_no`, `param`, `pay_time`, `pay_tag`, `status`, `creat_time`)values(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $m->prepare($insertSQL);//Ԥ����SQL���
    if (!$stmt) {
        return "���ݱ�:" . DB_PREFIX . "_order  ������ ������Ҫ���°�װ";
    }
    $stmt->bind_param('sddissisii', $pay_id, $money, $price, $type, $pay_no, $param, $pay_time, $pay_tag, $status, $creat_time); //��ֹSQLע��
    $rs = $stmt->execute(); //ִ��SQL

    if ($rs && $stmt->affected_rows >= 1) { //����ɹ� ���״�֪ͨ ����ִ��ҵ��
        mysqli_stmt_close($stmt); //�ر��ϴε�Ԥ����
        /**������һ��ִ��
         * ִ��ҵ��
         * ----------------------------------------------------------------
         * ���²ο���������������2��������:
         * 1�������еġ������� �� ������Ĭ�����ݿ�Ϊͬһ����MYSQL�û�ӵ��updateȨ�ޡ�
         * 2��$pay_id������ ���������û�ID �̻������� �û����� ������Ҫ�����Լ�������������
         * ---------------------
         *
         * ��Ҫע�⣺
         * price���û��ύ�Ľ� money���û�ʵ��֧����� ��
         * ���磺�û���ֵ100Ԫ ���ͬһʱ��2�˳�ֵ100Ԫ Ϊ��������˭���� ��ʱ������֧��100.01 ��99.99 �۸�Χ�������õķ�Χ��
         * ʵ��֧�����ܸ�ԭ�ۻ��г���,һ���Ǽ��ֵķ�Χ��  Ҫ���ĸ������������ҵ��������
         *
         *---------------------------------------
         *
         * �������û��������� ��Ϊ�����д����û��ı���
         * �����桾����ֶΡ� ��Ϊ�����д����û������ֶ�
         * �����桾�û�ID�ֶΡ� ��Ϊ�����д����û�ID���ֶ� �����������Ψһ��ʶ�����޸� ���Դ��Զ��������ȡ�û�ID
         *
         * ---------------------
         * ��ֵ:
         * �ο����룺�������Ǳ���ʹ�����ǵĲο����룩
         * ----------------------------------------------------------------
         * $stmt = $m->prepare("update ���� set ����ֶ�=����ֶ�+{$money} where �û�ID�ֶ�=?");
         * $stmt->bind_param('s', $pay_id);  //$pay_id Ϊ�����ݵĲ��� �������û�ID �û��� �����š�
         * $rs=$stmt->execute();
         * ----------------------------------------------------------------
         *
         * ����: (�޸ķ���ͬ��)
         * �ο����룺 �������Ǳ���ʹ�����ǵĲο����룩
         * ----------------------------------------------------------------
         * $stmt = $m->prepare("update ���� set ֧��״̬�ֶ�=1 where ����ID=?");
         * //update ���� set vip=1 where �û�ID=?  //�����Ա����ο����롣
         * $stmt->bind_param('s', $pay_id); //������bind_param�󶨲�����ʽ��Ϊ�˰�ȫ�Է�ֹע�롣
         * $rs=$stmt->execute();
         * ----------------------------------------------------------------
         */


        //����Ϊ��ֵʾ���Ĵ��� ��Ҫ��Ϊ����ҵ����� ����Ѿ�֪��������ֱ��ɾ��
        //Ϊ�û���ֵdemo �޸�Ϊ�Լ�ҵ���뿴���淽��


        $price = $price * 1;//1��ʾ����Ϊ1:1  100���ʾ1Ԫ�ɳ�ֵ100��;
        $sql = "update `" . DB_USERTABLE . "` set " . DB_USERMONEY . "=" . DB_USERMONEY . "+{$price} where " . DB_USERNAME . "=?";


        //Ĭ��sqlΪ��update `codepay_user` set money=money+{$price} where user=?

        //����������һ�ֲ���SQL������ �Ƚϼ� �ʺ�д���Լ���SQLҵ�����
        //$rs = $m->execSQL( $sql, array('s', $pay_id), false);
        //print_r($rs); ��ӡ�Ƿ�ִ�гɹ� ���߷��ز�ѯ���

        //$rs = $m->execSQL( $sql, array(), false); //���ǲ�ʹ�ð󶨲����÷�
        //$rs = $m->runSql("select * from " . DB_USERTABLE . " where user='{$pay_id}'"); //��ʹ�ð󶨲����÷�

        $stmt = $m->prepare($sql); //Ԥ����SQL���
        if(empty($stmt)) return  sprintf("SQL����������һ���ǲ����޸Ĳ���ȷ���   SQL: %s ������%s ",  $sql, createLinkstring($data));

        if ($stmt->error != '') { //������� ��һ�������ݱ��������
            $result = sprintf("���ݱ�������� ��%s SQL: %s ������%s ", $stmt->error, $sql, createLinkstring($data));
            mysqli_stmt_close($stmt); //�ر�Ԥ����
            $m->rollback();//�ع�
            return $result;
        }

        $stmt->bind_param('s', $pay_id); //�󶨲��� ��ֹע��
        $rs = $stmt->execute(); //ִ��SQL���

        if ($rs && $stmt->affected_rows >= 1) {

            if (!DB_AUTOCOMMIT) $m->db->commit(); //�ύ����
            mysqli_stmt_close($stmt); //�ر�Ԥ����
            return 'ok'; //ҵ������� ��

        } else { //����´λ�Ҫ������Ӧ�ÿ������� ���ݿ�����ΪInnoDB ��֧������ñʶ������޷���ִ�е�ҵ����������������ʹ�ö���״̬��ʶ����
            $error_msg = $stmt->error;
            if ($error_msg == '' && $stmt->affected_rows <= 0) {
                $error_msg = '���û����ܲ����� ��˶� ���Ĭ�ϵ���ʾֻ����admin�û� ��Ҫ�����codepay_config.php ����3������';
            }
            $result = sprintf("ҵ����ʧ���� ��%s SQL: %s ������%s ", $error_msg, $sql, createLinkstring($data));
            $m->rollback();//�ع�
        }

    } else if ($stmt->errno == 1062) {

        return 'success';
        //�Ѿ����� ��ʾ�Ѿ�ִ�й� ֱ�ӷ���ok��success ��Ҫ��֪ͨ��.
        //�����֧������ ����֮ǰִ��ʧ����Ҳ��ֱ�ӷ��سɹ���

    } else {
        $m->rollback();//����ع�
        if ($stmt->errno == 1146) { //�����ڲ������ݱ�
            $result = '����δ��װ�������� �޷�ʹ��ҵ����ʾ��'; //������ҳִ�� install.php ��װ�������� ����ʣ�http://������վ/codepay/install.php
        } else {
            $result = sprintf("�Ƚ����صĴ�����봦�� ��%s SQL: %s ������%s \r\nMYSQL��Ϣ��%s", $stmt->error, $insertSQL, createLinkstring($data), createLinkstring($stmt));
        }
    }
    mysqli_stmt_close($stmt); //�ر�Ԥ����
    return $result;
}


//����ó�֪ͨ��֤���
$codepayNotify = new CodepayNotify($codepay_config);
$verify_result = $codepayNotify->verifyNotify();

if ($verify_result && $_POST['pay_no']) { //��֤�ɹ�
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //������������̻���ҵ���߼������

    //�������������ҵ���߼�����д�������´�������ο�������
    //��ȡ��֧����֪ͨ���ز������ɲο������ĵ����첽֪ͨ�����б�

    $result = DemoHandle($_POST); //����ʾ��ҵ����� ����ҵ���÷���ֵ

    if ($result == 'ok' || $result == 'success') { //���ص���ҵ�������


include("../../config/conn.php");
function while0($wzd,$wses){global $res;$sql="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res=mysql_query($sql);}function while1($wzd,$wses){global $res1;$sql1="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res1=mysql_query($sql1);}function while2($wzd,$wses){global $res2;$sql2="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res2=mysql_query($sql2);}function while3($wzd,$wses){global $res3;$sql3="select ".$wzd." from ".$wses;mysql_query("SET NAMES 'GBK'");$res3=mysql_query($sql3);}
function intotable($itable,$zdarr,$resarr){global $conn;$sqlinto="insert into ".$itable."(".$zdarr.")values(".$resarr.")";mysql_query("SET NAMES 'GBK'");mysql_query($sqlinto,$conn);}
function updatetable($utable,$ures){global $conn;$sqlupdate="update ".$utable." set ".$ures;mysql_query("SET NAMES 'GBK'");mysql_query($sqlupdate,$conn);}
function PointUpdateM($c_uid,$c_money){global $conn;$m=sprintf("%.2f",$c_money);updatetable("yjcode_user","money1=money1+(".$m.") where id=".$c_uid);}
function deletetable($dsql){global $conn;$sqldelete="delete from ".$dsql;mysql_query("SET NAMES 'GBK'");mysql_query($sqldelete,$conn);}
function PointIntoM($c_uid,$c_tit,$c_money){global $conn;$m=sprintf("%.2f",$c_money);intotable("yjcode_moneyrecord","bh,userid,tit,moneynum,sj,uip","'".time()."',".$c_uid.",'".$c_tit."',".$m.",'".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."'");}
function rnd_num($num){$seedarray =microtime();$seedstr =preg_split("/\s/",$seedarray,5);$seed =$seedstr[0]*10000;srand($seed);return rand(1,$num);}

  $sj=date("Y-m-d H:i:s");
  $uip=$_SERVER["REMOTE_ADDR"];
  while1("*","yjcode_dingdang where ddbh='".$_POST[pay_id]."' and ifok=0");if($row1=mysql_fetch_array($res1)){
   updatetable("yjcode_dingdang","sj='".$sj."',uip='".$uip."',alipayzt='TRADE_SUCCESS',ddzt='���׳ɹ�',ifok=1,bz='��֧��' where id=".$row1[id]);
   $money1=$_POST[money];
   PointIntoM($row1[userid],"��֧�����߳�ֵ".$money1."Ԫ",$money1);
   PointUpdateM($row1[userid],$money1);
   if(!empty($row1[sxf])){
   $sxf=$row1[sxf]*(-1);
   PointIntoM($row1[userid],"֧���ӿ�������",$sxf);
   PointUpdateM($row1[userid],$sxf);
   }
   $caridarr=$row1[carid];
   if(!empty($caridarr)){
   include("../buy.php");
   }
  }
	
	
        exit($result); //ҵ������� ���治ִ����
    } else {
        echo(defined('DEBUG') && DEBUG ? $result : 'no'); //��ʽ���� ֱ�Ӵ�ӡno �������κδ�����Ϣ
        //logResult($result); //����д�뵽��־�ı��� ����׷������
    }


//�������������ҵ���߼�����д�������ϴ�������ο�������
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

} else {  //��֤ʧ��
    echo "fail";
    //�����ã�д�ı�������¼������������Ƿ�����
//    logResult("��֤ʧ����");
}

?>