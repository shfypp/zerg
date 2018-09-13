<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 17:43
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code=400;    //HTTP 状态吗
    public $msg="微信服务器接口调用失败";    //错误信息
    public $errorCode=999;    //自定义错误码
}