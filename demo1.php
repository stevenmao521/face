<?php

/* 
* 冒泡查询
*/

/*
$arr = array(40,23,55,32,1,7,4);
function func_maopao($arr) {
    $len_arr = count($arr);
    for($i=1; $i<$len_arr; $i++) {
        for ($k=0; $k<$len_arr-1; $k++) {
            if ($arr[$k] > $arr[$k+1]) {
                $tmp = $arr[$k+1];
                $arr[$k+1] = $arr[$k];
                $arr[$k] = $tmp;
            }
        }
    }
    return $arr;
}
$res = func_maopao($arr);
*/



/* 
*二分查找
*数组必须为排好续
*/

/*
$bin_array = array(1, 3, 5, 11, 13, 21, 44);
function func_binary($arr, $low, $top, $target) {
    while ($low <= $top) {
        $mid = floor(($low+$top)/2);
        if ($arr[$mid] == $target) {
            return $arr[$mid];
        } elseif ($arr[$mid] < $target) {
            $low = $mid + 1;
        } else {
            $top = $mid - 1; 
        }
    }
    return -1;
}
echo func_binary($bin_array, 0, count($bin_array), 21);
*/


/* 
 *  快速查找
 *  快速查找原理：已查找对象中其中一个元素作为标尺，小于标尺的与大于标尺的分别存于不同数组，再利用递归
 *  求出最终结果
*/

/*
$arr = array(2,31,1,23,12,5,11,26,102,333,56);

function quick_sort($arr) {
    
    #数组长度
    $lenth = count($arr);
    
    #数组长度为1退出
    if ($lenth <= 1) {
        return $arr;
    }
    
    #数组标尺
    $target = $arr[0];
    #左数组
    $left_arr = array();
    #右数组
    $right_arr = array();
    
    #遍历数组根据标尺分组
    for ($i=1;$i<$lenth;$i++) {
        if ($target > $arr[$i]) {
            $left_arr[] = $arr[$i];
        } else {
            $right_arr[] = $arr[$i];
        }
    }
    
    #递归
    $left_arr = quick_sort($left_arr);
    $right_arr = quick_sort($right_arr);
    
    #合并数组
    return array_merge($left_arr, array($target), $right_arr);
}
print_r(quick_sort($arr));
*/



/* 
 * PHP分段读取大文件并统计
 * 传统方法 消耗内存，遍历时间长
 * 采用多线程
*/


/*
$read_file = 'log/prod.log';
$write_file = 'log/write.log';

function anlayLog($read_file, $write_file) {
    $st = microtime(true);
    $sm = memory_get_usage();
    echo $st."----";
    $contents = file_get_contents($read_file);
    $contents_arr = explode('\n', $contents);
    #写文件
    $fwrite = fopen($write_file,'a+');
    
    #锁文件
    flock($fwrite, LOCK_EX);
    foreach ($contents_arr as $row) {
        if (strpos($row, "2018-08-02 15:34:27") !== false) {
            fwrite($fwrite, $row);
        }
    }
    flock($fwrite, LOCK_UN);
    fclose($fwrite);
    $em = memory_get_usage();
    $et = microtime(true);
    echo '耗时'.round($et-$st,3).'秒';
}
anlayLog($read_file, $write_file);
*/





/* 
 #合并数组
$arr1 = array("m1");
$arr2 = array("m2");
$arr3 = array_merge($arr1, $arr2);
print_r($arr3);
$arr4 = array_merge_recursive($arr1, $arr2);
print_r($arr4);
*/




/*
#防止SQL注入
mysql_real_escape_string($unescaped_string);
#跨站点脚本攻击
strip_tags($str);
#远程表单提交
#定义csrf_token
*/




/*
字符串”\r”,”\n”,”\t”,”\x20”分别代表什么
\n \r换行到下一行最开始位置
\t 表示TAB
\x20 表示32在ASCII 16进制的表示
*/




/*
以下语句输出的结果是什么 
$a = 3;
echo "$a",'$a',"\\\$a","${a}","$a"."$a","$a"+"$a";

"$a" = 3;
'$a' = $a;
"\\\$a" = \$a;
"${a}" = 3;
"$a" . "$a" = 33;
"$a" + "$a" = 6;
*/




/*
在类的方法中，如何调用其父类的同名方法？ 
 parent::方法();
*/


/*
如何取得客户端的ip(要求取得一个int) 
$_SEVER['REMOTE_ADDR'];
*/


/*
include,require区别
include 直接包含文件内容，如有错误不会中断
require 包含文件执行错误程序会中断
*/


/*
 * <?php echo count(strlen(“http://php.net”)); ?>的执行结果是？
*/
/*
 * 答案：1，count为统计数组或对象长度，普通变量返回1
*/

/*
 * php5中魔术方法有哪几个？请举例说明各自的用法
 * 
 * __construct()实例化对象时调用
 * __destruct()对象销毁时调用
 * __call()对象方法不存在时调用
 * __get()获取对象不存在属性时调用
 * __set()设置对象不存在属性时调用
 * 
 */


/*
 * php实现双向队列
*/
/*
class Que {
    public $queue = array();
    
    #尾部入队
    public function addLast($value) {
        return array_push($this->queue, $value);
    }
    #头部入队
    public function addFirst($value) {
        return array_unshift($this->queue, $value);
    }
    #尾部出队
    public function outLast() {
        return array_pop($this->queue);
    }
    #头部出队
    public function outFirst() {
        return array_shift($this->queue);
    }
    #清空队列
    public function clearQue() {
        unset($this->queue);
    }
    #获取队头
    public function getFirst() {
        #reset() 函数将内部指针指向数组中的第一个元素，并输出
        return reset($this->queue);
    }
    #获取队尾
    public function getEnd() {
        return end($this->queue);
    }
}

$que = new Que();
$que->addFirst(3);
$que->addFirst(4);
$que->addLast(55);
print_r($que->queue);
*/

/*
 * mysql优化方案
 */
/*
 *  1.表设计尊崇3NF原则
 *  2.添加适当的索引，特别实在where order by涉及到的列，主要有主键索引，index索引，全文索引，唯一索引
 *  3.采用分表技术，水平分表，垂直分割主要指分库，根据业务把数据分配到不同库中，分表主要是指大数据量的表几种在一个表采用逻辑规则将数据分布到
 *  相同结构的子表中以达到数据分散的目的
 *  4.采用读写分离，主服务器主要实现数据库的insert,update操作，从数据库主要实现表数据查询，然后主从数据库配置数据同步
 *  5.调整mysql缓存配置大小
 * 
 *  3NF
 *  1NF,表的列字段保持原子性不可再分解
 *  2NF，表中的记录达到唯一性就是2NF，通常采用主键来实现
 *  3NF，表中不要有冗余数据，比如表的信息能够被推导出来就不要单独设一个字段去存储
 * 
 *  SQL语句的优化
 *  如何从一个大项目中迅速定位到慢查询
 *  首先了解mysql的一些运行状态如何查询比如mysql运行的时间执行多少次 select,update,当前连接
 *  用 show status;查看
 *  show_status like uptime
 *  show_status like com_select
 *  show_status like connections
 * 
 *  构建大表->大表中记录有要求, 记录是不同才有用，否则测试效果和真实的相差大.
 * 
 */

/*
 * 什么是composer
 */
/*
 * composer是一种依赖管理工具，能方便的帮我们解决自动加载问题，不用每次都去new对象
 */

/*
 * PHP如何实现静态化
 */
/*
 * ob_start()打开输出缓冲区
 * ob_get_contents()返回输出缓冲区内容
 * ob_get_clean()得到当前缓冲区并清空缓冲区内容
 */

