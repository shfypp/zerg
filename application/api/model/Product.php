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
    protected $visible=['id','name','price','stock','main_img_url','from','category','img'];

    public function category(){
        return $this->belongsTo('Category','category_id','id');
    }

    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }

    public function getMainImgUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }

}