<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 16:51
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    public $code=400;    //HTTP 状态吗
    public $msg="参数错误";    //错误信息
    public $errorCode=10000;    //自定义错误码
}