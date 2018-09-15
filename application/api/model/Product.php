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
    protected $hidden = ['delete_time', 'create_time', 'update_time', 'img_id'];

    public function category()
    {
        return $this->belongsTo('Category', 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }
    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }


    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getRecentProducts($count)
    {
        return self::limit($count)
            ->order('create_time desc')
            ->select();
    }

    public static function getCategoryProducts($id=0){
        return self::all(['category_id'=>$id]);
    }

    public static function getProductDetail($id){
        return self::get($id,['images.image','properties']);
    }

}