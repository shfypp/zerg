<?php
/**
 * Created by PhpStorm.
 * User: yuanchao
 * Date: 2018/9/19
 * Time: 16:10
 */

namespace app\api\controller\v1;


use app\api\validate\OrderPlace;

class Order extends Base
{

    protected $beforeActionList = [
        'checkExclusiveScope' => [
            'only' => ['placeOrder']
        ]
    ];

    //获取客户端提交的订单信息
    //检测商品的库存量
    //有库存 生成订单 返回客户端 订单成功 可以支付了
    //客户端调用支付接口 进行支付
    //检测商品的库存量
    //有库存 调用微信支付接口进行支付
    //成功 检测商品的库存量
    //有库存 进行库存扣除 失败 返回支付失败

    /**
     * 下单接口
     */
    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        return 'success';

    }


}