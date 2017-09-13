<?php
/**
 * Created by PhpStorm.
 * User: yujie.feng
 * Date: 2017/9/1
 * Time: 10:35
 */
function getCoding()
{
    $agent = PHP_OS;
    if (false !== stripos(strtoupper($agent), strtoupper('win'))) {   //Windows操作系统编码
        return 'gb2312';
    } else if (false!==stripos(strtoupper($agent), strtoupper('linux'))) {
        return 'utf-8';
    }
}