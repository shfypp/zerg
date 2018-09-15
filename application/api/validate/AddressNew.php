<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/15
 * Time: 15:56
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule=[
        'name'=>'require|isNotEmpty',
        'mobile'=>'require|isMobile',
        'province'=>'require|isNotEmpty',
        'city'=>'require|isNotEmpty',
        'country'=>'require|isNotEmpty',
        'detail'=>'require|isNotEmpty',
    ];

}