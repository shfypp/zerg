<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 17:17
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule=[
        'ids'=>'require|checkIDs'
    ];

    protected $message=[
        'ids'=>[
            'require'=>'ids参数不能为空',
            'checkIDs'=>'ids参数必须是以逗号分隔的正整数'
        ]
    ];

    protected function checkIDs($value){
        $values=explode(',',$value);
        if (empty($values)) return false;
        foreach ($values as $v){
            if (!$this->isPositiveInteger($v)) return false;
        }
        return true;
    }
}