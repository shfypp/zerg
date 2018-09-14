<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/12
 * Time: 12:04
 */

namespace app\api\model;


class ProductImage extends Base
{
    protected $hidden = ['delete_time', 'product_id', 'img_id'];

    public function image(){
        return $this->belongsTo('Image','img_id','id');
    }
}