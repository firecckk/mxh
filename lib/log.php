<?php
/**
 * @param  string,array  $data 需要输出到日志中的数据
 * @return null 
 */
function logOutPut($path,$data) {
    //数据类型检测
    if (is_array($data)) {
        $data = json_encode($data);
    }
    $filename = $path . date("Y-m-d").".log";
    $str = date("Y-m-d H:i:s")."   $data"."\n";
    file_put_contents($filename, $str, FILE_APPEND|LOCK_EX);
    return null;
}
?>