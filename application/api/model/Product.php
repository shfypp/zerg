<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/12
 * Time: 12:04
 */

namespace app\api\model;


class Product extends Base
{
    public function category(){
        return $this->belongsTo('Category','category_id','id');
    }
}