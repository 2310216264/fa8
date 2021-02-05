<?php

/**
 * ���� Mysqli �����ݿ�������
 * author Lee.
 * Last modify $Date: 2012-11-30 $
 */
class  M
{
    public $db;
    public $rs;

    public function __construct()
    {   //Ӧ�ù��캯���������е����Խ��г�ʼ��
        $this->db = MysqliDb::getDB();
    }


    public function cache_obj($cache)
    {
        $this->cache = $cache;
    }

    public function prepare($sql) //��sql
    {
        return $this->db->prepare($sql);
    }

    /**
     *
     * @param $sql SQL���
     * @param $params ��������
     * @param $close ִ�к��Ƿ������ر�
     * @return array|int �������� ���� 0|1
     */
    public function execSQL($sql, $params, $close)
    {
        $mysqli = $this->db;
        $stmt = $mysqli->prepare($sql) or die ('����SQL�����˴���' . defined('DEBUG') && DEBUG ? $sql : '');
        call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
        $stmt->execute();
        if ($close) {
            $result = $mysqli->affected_rows;
        } else {
            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];
            }
            $results = array();
            call_user_func_array(array($stmt, 'bind_result'), $this->refValues($parameters));
            while ($stmt->fetch()) {
                $x = array();
                foreach ($row as $key => $val) {
                    $x[$key] = $val;
                }
                $results[] = $x;
            }
            $result = $results;
        }
        if (defined('DEBUG') && DEBUG && $stmt->error != '') { //�������
            print_r($stmt->error);
        }
        mysqli_stmt_close($stmt); //�ر��ϴε�Ԥ����
        return $result;
    }

    public function refValues($arr)
    {
        if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach ($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }

    //������������Ҫ�����ͷŽ�����͹ر����ݿ�����
    public function __destruct()
    {
        try {
            $this->close();
            $this->my_free();
        } catch (Exception $e) {
//            print $e;
        }

    }

    //�ͷŽ������ռ��Դ
    protected function my_free()
    {
//        @$this->rs->free();
        $this->rs = null;
    }

    //�ر����ݿ�����
    protected function close()
    {
        $this->db->close();
    }


    /**
     * ��������Ƿ����
     * @param string $tName ���� || SQL ���
     * @param string $condition ����
     * @return bool �з��� true,û�з��� false
     */
    public function IsExists($tName, $condition)
    {
        if (!is_string($tName) || !is_string($condition)) exit($this->getError(__FUNCTION__, __LINE__));
        if ($this->Total($tName, $condition)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * ִ�е��� SQL ���
     * @param string $sql SQL���
     * @return bool
     */
    public function runSql($sql)
    {
        if (!is_string($sql)) exit($this->getError(__FUNCTION__, __LINE__));
        $bool = $this->db->query($sql);
//        $this->printSQLError($this->db);
        return $bool;

    }

    /**
     * ��ӡ���ܳ��ֵ� SQL ����
     * @param Object $db ���ݿ������
     */

    private function printSQLError($db)
    {
        if ($db->errno) {
            echo("���棺SQL�������<br />������룺<font color='red'>{$db->errno}</font>��<br /> ������Ϣ��<font color='red'>{$db->error}</font>");
        }
    }

    /**
     * ����ع�
     */
    public function rollback()
    {
        try {
            $this->db->rollback();
            $this->db->autocommit(true);
        } catch (Exception $e) {

        }

    }


    /**
     * ������ʾ
     * @param string $fun
     * @return string
     */
    private function getError($fun, $line, $other = "")
    {
        return __CLASS__ . '->' . $fun . '() line<font color="red">' . $line . '</font> ERROR! ' . $other;
    }
}

?>