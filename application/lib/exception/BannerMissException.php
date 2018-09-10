<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 18:19
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code=404;    //HTTP 状态吗
    public $msg="请求的Banner不存在";    //错误信息
    public $errorCode=40000;    //自定义错误码
}