<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 18:19
 */

namespace app\lib\exception;


class CategoryMissException extends BaseException
{
    public $code=404;    //HTTP 状态吗
    public $msg="请求的Category不存在";    //错误信息
    public $errorCode=50000;    //自定义错误码
}