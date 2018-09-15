<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/12
 * Time: 17:34
 */

namespace app\api\controller\v1;

use app\api\validate\CountValidate;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ProductMissException;

class Product
{
    /**
     * 最近新品
     * @param int $count
     * @return false|\PDOStatement|string|\think\Collection|\think\model\Collection
     * @throws ProductMissException
     * @throws \app\lib\exception\ParameterException
     */
    public function getRecent($count = 5)
    {
        (new CountValidate())->goCheck();
        $products = ProductModel::getRecentProducts($count);
        if (!$products) throw new ProductMissException();
        $products = collection($products);
        $products->hidden(['summary']);
        return $products;
    }

    /**
     * 分类列表
     * @param string $id 分类Category ID
     * @return ProductModel[]|false|\think\Collection|\think\model\Collection
     * @throws ProductMissException
     * @throws \app\lib\exception\ParameterException
     */
    public function getByCategoryId($id = '')
    {
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getCategoryProducts($id);
        if (!$products) throw new ProductMissException();
        if (!$products instanceof ProductModel) {
            $products = collection($products);
        }
        $products->hidden(['summary']);
        return $products;
    }


    /**
     * 商品详情
     * @param $id 商品ID
     * @return ProductModel
     * @throws ProductMissException
     * @throws \app\lib\exception\ParameterException
     */
    public function getOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $product=ProductModel::getProductDetail($id);
        if (!$product) throw new ProductMissException();
        return $product;
    }


}