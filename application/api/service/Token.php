<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/14
 * Time: 9:48
 */

namespace app\api\service;


class Token
{
    /**
     * 用三组字符串进行MD5加密生成唯一KEY
     */
    public static function generateToken()
    {
        $randChars = sf_getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME'];
        $salt = config('secure.token_salt');
        return md5($randChars . $timestamp . $salt);
    }

}