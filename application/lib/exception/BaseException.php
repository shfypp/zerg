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

    public function __construct($param=[])
    {
        if (!is_array($param)) return;

        if (key_exists('code',$param)) $this->code=$param['code'];
        if (key_exists('msg',$param)) $this->msg=$param['msg'];
        if (key_exists('error_code',$param)) $this->errorCode=$param['error_code'];
    }
}