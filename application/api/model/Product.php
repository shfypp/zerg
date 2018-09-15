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

    /**
     * 获取最近新品
     * @param $count
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getRecentProducts($count)
    {
        return self::limit($count)
            ->order('create_time desc')
            ->select();
    }

    /**
     * 获取分类商品
     * @param int $id Category ID
     * @return Product[]|false
     * @throws \think\exception\DbException
     */
    public static function getCategoryProducts($id=0){
        return self::all(['category_id'=>$id]);
    }

    /**
     * 获取商品详情
     * @param $id Product ID
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getProductDetail($id){
        return self::with([
            'images'=>function($query){
                $query->with('image')
                    ->order('order','asc');
            }
        ])
            ->with('properties')
            ->where('id','eq',$id)
            ->find();
    }

}