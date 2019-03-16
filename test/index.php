<?php

$start = microtime(true);
echo '开始运行时间' . '【' . $start . '】<br>';
$start_usage = memory_get_usage() / 1024;
echo '运行内存【' . ($start_usage) . 'KB】<br>';
include "../autoload.php";






$end = microtime(true);
echo '<br>结束运行时间' . '【' . $end . '】<br>';
echo '运行时间' . '【' . ($end - $start) . '】<br>';
$end_usage = memory_get_usage() / 1024;
echo '运行内存【' . ($end_usage) . 'KB】<br>';
echo '系统运行内存【' . ($end_usage - $start_usage) . 'KB】';





