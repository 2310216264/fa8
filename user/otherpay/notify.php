<?php
//error_reporting(E_ALL & ~ E_NOTICE); //过滤脚本错误

//ini_set("display_errors", "On");  //显示脚本错误提示
//error_reporting(E_ALL | E_STRICT); //开启全部脚本错误提示
/**
 * 功能：码支付服务器异步通知页面 (建议放置外网)
 * 版本：1.0
 * 日期：2016-12-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究码支付接口使用，只是提供一个参考。
 *************************业务处理调试说明*************************
 * 1：该页面不建议在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 2：您可以使用我们的软件端中【手动充值】进行调试。
 * 3：该页面调试工具请使用写文本函数logResult，该函数已被默认开启，见codepay_notify_class.php中的函数verifyNotify
 * 4：创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 5：如果没有收到该页面返回的 ok或者success 信息，码支付会在24小时内按一定的时间策略重发通知
 *************************注意*****************
 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
 *1、开发文档中心（https://codepay.fateqq.com/apiword/）
 *2、商户帮助中心（https://codepay.fateqq.com/help/）
 *3、联系客服（https://codepay.fateqq.com/msg.html）
 */
require_once("codepay_config.php"); //导入配置文件
require_once("includes/MysqliDb.class.php");//导入mysqli连接
require_once("includes/M.class.php");//导入mysqli操作类
require_once("lib/codepay_notify.class.php"); //导入通知类

/**
 * 业务处理演示
 * @param $data 接收到的POST参数
 * @return string 返回处理的结果
 */
function DemoHandle($data)
{ //业务处理例子 返回一些字符串
    $pay_id = $data['pay_id']; //需要充值的ID 或订单号 或用户名
    $money = (float)$data['money']; //实际付款金额
    $price = (float)$data['price']; //订单的原价
    $type = (int)$data['type']; //支付方式
    $pay_no = $data['pay_no']; //支付流水号
    $param = $data['param']; //自定义参数 原封返回 您创建订单提交的自定义参数
    $pay_time = (int)$data['pay_time']; //付款时间戳
    $pay_tag = $data['tag']; //支付备注 仅支付宝才有 其他支付方式全为0或空
    $status = 2; //业务处理状态 这里就全设置为2  如有必要区分是否业务同时处理了可以处理完再更新该字段为其他值
    $creat_time = time(); //创建数据的时间戳


    if ($money <= 0 || empty($pay_id) || $pay_time <= 0 || empty($pay_no)) {
        return '缺少必要的一些参数'; //测试数据中 唯一标识必须包含这些
    }


    //实例化mysqli 操作库 需在php.ini启用mysqli 启用方法：删除extension=php_mysqli.dll前面的 ; (分号)重启web服务器
    //MYSQL用户需要拥有INSERT update权限
    $m = new M();

    //以下参数为不小心删除了导致无法执行做准备 没有太多实际意义 就是些初始值

    if (!defined('DB_USERTABLE')) defined('DB_USERTABLE', 'codepay_user');  //默认的用户数据表
    if (!defined('DB_PREFIX')) defined('DB_PREFIX', 'codepay'); //默认的表前缀
    if (!defined('DB_AUTOCOMMIT')) defined('DB_AUTOCOMMIT', false); //默认使用事物 回滚
    if (!defined('DEBUG')) defined('DEBUG', false); //默认启用调试模式 但这里如果读不到就不启用了

    //初始化结束

    /**
     * 检测订单是否已经处理
     *
     * 以下代码需要安装我们的测试数据才可正常运行。 仅是个参考 请根据需求自行开发
     * 如有开发经验可参考我们的API自行编写否则建议安装测试数据来修改
     * --------------------------------------
     * ★★★ 以插入方式判断订单是否存在 默认只数据库引擎为:InnoDB才会补单 优点：简单高效 兼容性强。
     * ---------------------------------------
     * 开启处理业务失败补单方法：
     * 默认已经开启但数据库引擎需要为:InnoDB 否则业务失败不会再第2次执行
     * 打开codepay_config.php配置文件搜索DB_AUTOCOMMIT修改为define('DB_AUTOCOMMIT', false);
     *
     * 不使用InnoDB引擎也不会影响使用。业务这步调试好后不成功几率几乎不可能出现,除非你的SQL存在问题。
     *----------------------------------------
     *
     * ★★ 以订单状态标识判断是否已经处理 这是最常用的方式。
     * 但步骤繁多(需要考虑脏读的可能) 为了新手易懂下面使用插入方式
     *---------------------------------------
     *---------------------------------------
     * 我不想这样处理业务有其他方式吗？
     * 有的,这只是个示范
     */

    $m->db->autocommit(DB_AUTOCOMMIT);//默认不自动提交 即事物开启 只针对InnoDB引擎有效

    /**
     * 插入到用户付款记录默认codepay_order表使用了2种唯一索引来区分是否已经存在。确保业务只执行一次
     * 以下为作为识别是否已经执行过此笔订单 建议保留 否则您必须确保业务已经处理
     */
    $insertSQL = "INSERT INTO `" . DB_PREFIX . "_order` (`pay_id`, `money`, `price`, `type`, `pay_no`, `param`, `pay_time`, `pay_tag`, `status`, `creat_time`)values(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $m->prepare($insertSQL);//预编译SQL语句
    if (!$stmt) {
        return "数据表:" . DB_PREFIX . "_order  不存在 可能需要重新安装";
    }
    $stmt->bind_param('sddissisii', $pay_id, $money, $price, $type, $pay_no, $param, $pay_time, $pay_tag, $status, $creat_time); //防止SQL注入
    $rs = $stmt->execute(); //执行SQL

    if ($rs && $stmt->affected_rows >= 1) { //插入成功 是首次通知 可以执行业务
        mysqli_stmt_close($stmt); //关闭上次的预编译
        /**订单第一次执行
         * 执行业务：
         * ----------------------------------------------------------------
         * 以下参考代码需满足以下2个条件、:
         * 1：代码中的【表名】 跟 本程序默认数据库为同一个且MYSQL用户拥有update权限。
         * 2：$pay_id参数： 我们允许用户ID 商户订单号 用户名。 所以需要根据自己需求来开发。
         * ---------------------
         *
         * 需要注意：
         * price是用户提交的金额。 money是用户实际支付金额 。
         * 比如：用户充值100元 如果同一时间2人充值100元 为了区分是谁付款 此时会让他支付100.01 或99.99 价格范围在您设置的范围内
         * 实际支付可能跟原价会有出入,一般是几分的范围。  要用哪个金额参数请根据业务来决定
         *
         *---------------------------------------
         *
         * 将下面用户【表名】 改为您现有储存用户的表名
         * 将下面【金额字段】 改为您现有储存用户金额的字段
         * 将下面【用户ID字段】 改为您现有储存用户ID的字段 如果传递其他唯一标识按需修改 可以从自定义参数中取用户ID
         *
         * ---------------------
         * 充值:
         * 参考代码：（并不是必须使用我们的参考代码）
         * ----------------------------------------------------------------
         * $stmt = $m->prepare("update 表名 set 金额字段=金额字段+{$money} where 用户ID字段=?");
         * $stmt->bind_param('s', $pay_id);  //$pay_id 为您传递的参数 可以是用户ID 用户名 订单号。
         * $rs=$stmt->execute();
         * ----------------------------------------------------------------
         *
         * 购买: (修改方法同上)
         * 参考代码： （并不是必须使用我们的参考代码）
         * ----------------------------------------------------------------
         * $stmt = $m->prepare("update 表名 set 支付状态字段=1 where 订单ID=?");
         * //update 表名 set vip=1 where 用户ID=?  //购买会员服务参考代码。
         * $stmt->bind_param('s', $pay_id); //用这种bind_param绑定参数方式是为了安全性防止注入。
         * $rs=$stmt->execute();
         * ----------------------------------------------------------------
         */


        //以下为充值示范的代码 需要改为您的业务代码 如果已经知道开发可直接删除
        //为用户充值demo 修改为自己业务请看上面方法


        $price = $price * 1;//1表示比率为1:1  100则表示1元可充值100分;
        $sql = "update `" . DB_USERTABLE . "` set " . DB_USERMONEY . "=" . DB_USERMONEY . "+{$price} where " . DB_USERNAME . "=?";


        //默认sql为：update `codepay_user` set money=money+{$price} where user=?

        //下面是另外一种操作SQL的做法 比较简单 适合写入自己的SQL业务语句
        //$rs = $m->execSQL( $sql, array('s', $pay_id), false);
        //print_r($rs); 打印是否执行成功 或者返回查询结果

        //$rs = $m->execSQL( $sql, array(), false); //这是不使用绑定参数用法
        //$rs = $m->runSql("select * from " . DB_USERTABLE . " where user='{$pay_id}'"); //不使用绑定参数用法

        $stmt = $m->prepare($sql); //预编译SQL语句
        if(empty($stmt)) return  sprintf("SQL语句存在问题一般是参数修改不正确造成   SQL: %s 参数：%s ",  $sql, createLinkstring($data));

        if ($stmt->error != '') { //捕获错误 这一般是数据表不存在造成
            $result = sprintf("数据表存在问题 ：%s SQL: %s 参数：%s ", $stmt->error, $sql, createLinkstring($data));
            mysqli_stmt_close($stmt); //关闭预编译
            $m->rollback();//回滚
            return $result;
        }

        $stmt->bind_param('s', $pay_id); //绑定参数 防止注入
        $rs = $stmt->execute(); //执行SQL语句

        if ($rs && $stmt->affected_rows >= 1) {

            if (!DB_AUTOCOMMIT) $m->db->commit(); //提交事物
            mysqli_stmt_close($stmt); //关闭预编译
            return 'ok'; //业务处理完成 。

        } else { //如果下次还要处理则应该开启事物 数据库引擎为InnoDB 不支持事物该笔订单是无法再执行到业务处理这个步骤除非是使用订单状态标识区分
            $error_msg = $stmt->error;
            if ($error_msg == '' && $stmt->affected_rows <= 0) {
                $error_msg = '该用户可能不存在 请核对 如果默认的演示只存在admin用户 需要你更改codepay_config.php 下面3个参数';
            }
            $result = sprintf("业务处理失败了 ：%s SQL: %s 参数：%s ", $error_msg, $sql, createLinkstring($data));
            $m->rollback();//回滚
        }

    } else if ($stmt->errno == 1062) {

        return 'success';
        //已经存在 表示已经执行过 直接返回ok或success 不要再通知了.
        //如果不支持事物 就算之前执行失败了也是直接返回成功。

    } else {
        $m->rollback();//错误回滚
        if ($stmt->errno == 1146) { //不存在测试数据表
            $result = '您还未安装测试数据 无法使用业务处理示范'; //需在网页执行 install.php 安装测试数据 如访问：http://您的网站/codepay/install.php
        } else {
            $result = sprintf("比较严重的错误必须处理 ：%s SQL: %s 参数：%s \r\nMYSQL信息：%s", $stmt->error, $insertSQL, createLinkstring($data), createLinkstring($stmt));
        }
    }
    mysqli_stmt_close($stmt); //关闭预编译
    return $result;
}


//计算得出通知验证结果
$codepayNotify = new CodepayNotify($codepay_config);
$verify_result = $codepayNotify->verifyNotify();

if ($verify_result && $_POST['pay_no']) { //验证成功
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //请在这里加上商户的业务逻辑程序代

    //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取码支付的通知返回参数，可参考技术文档中异步通知参数列表

    $result = DemoHandle($_POST); //调用示例业务代码 处理业务获得返回值

    if ($result == 'ok' || $result == 'success') { //返回的是业务处理完成


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
   updatetable("yjcode_dingdang","sj='".$sj."',uip='".$uip."',alipayzt='TRADE_SUCCESS',ddzt='交易成功',ifok=1,bz='码支付' where id=".$row1[id]);
   $money1=$_POST[money];
   PointIntoM($row1[userid],"码支付在线充值".$money1."元",$money1);
   PointUpdateM($row1[userid],$money1);
   if(!empty($row1[sxf])){
   $sxf=$row1[sxf]*(-1);
   PointIntoM($row1[userid],"支付接口手续费",$sxf);
   PointUpdateM($row1[userid],$sxf);
   }
   $caridarr=$row1[carid];
   if(!empty($caridarr)){
   include("../buy.php");
   }
  }
	
	
        exit($result); //业务处理完成 下面不执行了
    } else {
        echo(defined('DEBUG') && DEBUG ? $result : 'no'); //正式环境 直接打印no 不返回任何错误信息
        //logResult($result); //错误写入到日志文本中 用于追查问题
    }


//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

} else {  //验证失败
    echo "fail";
    //调试用，写文本函数记录程序运行情况是否正常
//    logResult("验证失败了");
}

?>