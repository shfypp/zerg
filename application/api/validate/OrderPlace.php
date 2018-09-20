<?php
/**
 * Created by PhpStorm.
 * User: yuanchao
 * Date: 2018/9/20
 * Time: 10:43
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
    protected $rule = [
        'products' => 'checkProducts'
    ];

    /**
     * @param $values
     * @return bool
     * @throws ParameterException
     */
    protected function checkProducts($values)
    {
        if (!is_array($values)) throw new ParameterException([
            'msg' => '商品参数有误'
        ]);

        if (empty($values)) throw new ParameterException([
            'msg' => '商品列表不能为空'
        ]);

        foreach ($values as $value) {
            $this->checkProduct($value);
        }

        return true;
    }

    /**
     * @param $value
     * @throws ParameterException
     */
    protected function checkProduct($value)
    {
        $singleRule = [
            'product_id' => 'require|isPositiveInteger',
            'count' => 'require|isPositiveInteger'
        ];
        $validate = new BaseValidate($singleRule);
        $result=$validate->check($value);
        if (!$result) throw new ParameterException([
            'msg'=>'商品列表参数有误'
        ]);
    }


}