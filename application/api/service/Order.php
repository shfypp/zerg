<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/21
 * Time: 20:08
 */

namespace app\api\service;

use app\api\model\Product as ProductModel;
use app\lib\exception\OrderException;

class Order
{
    protected $orderProducts;   //客户端请求中的订单产品
    protected $products;    //数据库中查询出的订单产品
    protected $uid;

    public function __construct($uid, $orderProducts)
    {
        $this->orderProducts = $orderProducts;
        $this->uid = $uid;
    }

    /**
     * 下单
     * @throws \think\exception\DbException
     */
    public function place()
    {
        $products = $this->getProductsByOP();

        $status = $this->getOrderStatus($products);

        if (!$status['pass']){
            $status['order_id']=-1;
            return $status;
        }

        //创建订单

    }

    private function getOrderStatus($products)
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'pStatusArray' => []
        ];

        foreach ($this->orderProducts as $orderProduct) {
            $productStatus = $this->getProductStatus($orderProduct, $products);

            if (!$productStatus['haveStock']) $status['pass'] = false;
            $status['orderPrice'] += $productStatus['totalPrice'];
            array_push($status['pStatusArray'], $productStatus);
        }

        return $status;
    }

    private function getProductStatus($orderProduct, $products)
    {
        $productStatus = [
            'id' => null,
            'haveStock' => false, //是否有库存
            'count' => 0,
            'name' => '',
            'totalPrice' => 0,
        ];

        $pIndex = -1;

        for ($i = 0; $i < count($products); $i++) {
            if ($orderProduct['product_id'] == $products[$i]['id']) $pIndex = $i;
        }

        if ($pIndex == -1) throw new OrderException([
            'msg' => 'ID为：' . $orderProduct['product_id'] . '的商品不存在或已下架，创建订单失败'
        ]);

        $product = $products[$pIndex];

        $productStatus['id'] = $product['id'];
        $productStatus['name'] = $product['name'];
        $productStatus['count'] = $orderProduct['count'];
        $productStatus['totalPrice'] = $product['price'] * $orderProduct['count'];
        if ($orderProduct['count'] <= $product['stock']) $productStatus['totalPrice'] = true;

        return $productStatus;
    }

    /**
     * 根据客户端请求中的订单商品查询数据库中对应的商品信息
     * @throws \think\exception\DbException
     */
    private function getProductsByOP()
    {
        $productIds = [];
        foreach ($this->orderProducts as $orderProduct) {
            array_push($productIds, $orderProduct['product_id']);
        }
        $products = ProductModel::all($productIds);
        return $products;
    }
}