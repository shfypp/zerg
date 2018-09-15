<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/14
 * Time: 9:48
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

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

    public static function getCurrentTokenValue($key)
    {
        $token = Request::instance()
            ->header('token');
        $vals = Cache::get($token);
        if (!$vals) throw new TokenException();
        if (!is_array($vals)) $vals = json_decode($vals, true);
        if (array_key_exists($key, $vals)) return $vals[$key];
        throw new Exception('请求的Token信息不存在');
    }

}