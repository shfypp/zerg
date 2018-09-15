<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/15
 * Time: 17:31
 */

namespace app\lib\exception;


class SuccessMessage
{
    public $code = 201;    //HTTP 状态吗
    public $msg = "ok";    //错误信息
    public $errorCode = 0;    //自定义错误码
}