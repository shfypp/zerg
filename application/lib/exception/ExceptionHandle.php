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

class ExceptionHandle extends Handle
{

    public function render(Exception $e)
    {
        return json('----');
    }
}