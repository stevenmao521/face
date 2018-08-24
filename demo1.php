<?php

/* 
 * 冒泡
*/
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
//$res = func_maopao($arr);

/* 
 * 二分查找
 * 数组必须为排好续
*/
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
//echo func_binary($bin_array, 0, count($bin_array), 21);

/* 
 * PHP分段读取大文件并统计
 * 传统方法 消耗内存，遍历时间长
 * 采用多线程
*/
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
//        if (strpos($row, "2018-08-02 15:34:27") !== false) {
//            fwrite($fwrite, $row);
//        }
    }
    flock($fwrite, LOCK_UN);
    fclose($fwrite);
    $em = memory_get_usage();
    $et = microtime(true);
    echo '耗时'.round($et-$st,3).'秒';
}
//anlayLog($read_file, $write_file);

/* 
 * 合并数组
*/
$arr1 = array("m1");
$arr2 = array("m2");

$arr3 = array_merge($arr1, $arr2);
//print_r($arr3);
$arr4 = array_merge_recursive($arr1, $arr2);
//print_r($arr4);


/* 
 * 合并数组
*/
function mystrtoupper($str) {
    #按每个字节切割
    $s_arr = str_split($str, 1);
    
    foreach ($s_arr as $v) {
        echo $v;
    }
}
$str = "asb毛子";
mystrtoupper($str);