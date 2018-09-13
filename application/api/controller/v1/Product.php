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
    public function getRecent($count = 5)
    {
        (new CountValidate())->goCheck();
        $products = ProductModel::getRecentProducts($count);
        if (!$products) throw new ProductMissException();
        $products = collection($products);
        $products->hidden(['summary']);
        return $products;
    }

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
}