<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/15
 * Time: 17:15
 */

namespace app\lib\exception;


class UserMissException extends BaseException
{
    public $code = 404;    //HTTP 状态吗
    public $msg = "请求的User不存在";    //错误信息
    public $errorCode = 60000;    //自定义错误码
}