<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/16
 * Time: 10:22
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code=403;    //HTTP 状态吗
    public $msg="权限不够";    //错误信息
    public $errorCode=10002;    //自定义错误码
}