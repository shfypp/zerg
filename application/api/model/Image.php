<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/11
 * Time: 15:39
 */

namespace app\api\model;


class Image extends Base
{
    protected $hidden=['delete_time','update_time','id','from'];


    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value,$data);
    }
}