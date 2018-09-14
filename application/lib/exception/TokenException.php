<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 17:43
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code=401;    //HTTP 状态吗
    public $msg="Token过期或无效";    //错误信息
    public $errorCode=10001;    //自定义错误码
}