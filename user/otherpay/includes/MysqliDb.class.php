<?php
/** 
* Mysqli �������ݿ���
* author Lee. 
* Last modify $Date: 2012-11-30 $ 
*/

class MysqliDb {
    //��ȡ������
    static public function getDB() {
        $_mysqli = @new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);
        if (mysqli_connect_errno()) {
                die('���ݿ����Ӵ��󣡴�����룺'.mysqli_connect_error());
                exit(0);
        }
        $_mysqli->set_charset(DB_ENCODE);
        return $_mysqli;
    }

    //�����ͷ���Դ
    static public function unDB(&$_result, &$_db) {
        try{
            if (is_object($_result)) {
                $_result->free();
                $_result = null;
            }
            if (is_object($_db)) {
                $_db->close();
                $_db = null;
            }
        }catch (Exception $e){

        }

    }

}

?>