<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/13
 * Time: 16:01
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule=[
        'code'=>'require|isNotEmpty'
    ];

    protected $message=[
        'code'=>'没有code无法获取Token'
    ];
}