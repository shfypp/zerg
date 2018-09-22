<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/21
 * Time: 23:20
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code=404;    //HTTP 状态吗
    public $msg="请求的Order不存在";    //错误信息
    public $errorCode=80000;    //自定义错误码
}