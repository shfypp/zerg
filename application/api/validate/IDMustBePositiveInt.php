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
        'id'=>'require|isPositiveInteger'
    ];

    protected $message=[
        'id'=>[
            'require'=>'id参数不能为空',
            'isPositiveInteger'=>'id参数必须是正整数'
        ]
    ];
}