<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/11
 * Time: 15:39
 */

namespace app\api\model;


use think\Model;

class Base extends Model
{

    protected function prefixImgUrl($value, $data)
    {
        if ($data['from'] == 1) return config('setting.img_prefix') . $value;
        return $value;
    }
}