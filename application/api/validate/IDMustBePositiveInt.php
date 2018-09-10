<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 17:17
 */

namespace app\api\validate;


class IDMustBePositiveInt extends BaseValidate
{
    protected $rule=[
        'id'=>'require|number|between:0,4294967295'
    ];
}