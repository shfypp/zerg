<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Log;

/**
 * 手动记录日志
 * @param $msg
 * @param string $level
 */
function sf_record_error($msg, $level='error'){
    Log::init([
        'type'=>'File',
        'path'=>LOG_PATH,
        'level'=>[$level],
    ]);
    Log::write($msg,$level);
}

/**
 * 发送URL请求 返回请求内容
 * @param $url
 * @param int $httpCode
 * @return mixed
 */
function sf_curl_get($url,&$httpCode=0){
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

    //不做证书校验，部署在linux环境下需改为true
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);

    $file_contents=curl_exec($ch);
    $httpCode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $file_contents;
}

/**
 * 获取指定长度的随机字符串
 * @param $length
 * @return null|string
 */
function sf_getRandChar($length)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;

    for ($i = 0;
         $i < $length;
         $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}