<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 16:54
 */

namespace app\lib\exception;


use Exception;
use think\exception\Handle;
use think\Request;

class ExceptionHandle extends Handle
{
    private $code = 400;    //HTTP 状态吗
    private $msg = "参数错误";    //错误信息
    private $errorCode = 10000;    //自定义错误码

    public function render(Exception $e)
    {
        $request = Request::instance();

        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
            if (config('app_debug')) {
                return parent::render($e);
            }

            $this->code = 500;
            $this->msg = '服务器内部错误';
            $this->errorCode = '999';

            $errorData = [
                'error_msg' => $e->getMessage(),
                'request_url' => $request->url(),
                'request_ip' => $request->ip(),
            ];

            sf_record_error(json($errorData), 'error');
        }

        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url(),
        ];
        return json($result, $this->code);
    }
}