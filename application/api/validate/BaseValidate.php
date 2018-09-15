<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 17:15
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);
        if (!$result) {
            throw new ParameterException(['msg' => $this->error]);
        } else {
            return true;
        }
    }

    /**
     * 根据验证器规则获取参数
     * @param $params
     * @return array
     * @throws ParameterException
     */
    public function getDataByRule($params)
    {
        if ((array_key_exists('user_id', $params)) | array_key_exists('uid', $params)) {
            throw new ParameterException([
                'msg'=>'参数中包含非法参数名user_id或者uid'
            ]);
        }
        $data=[];
        foreach ($this->rule as $key=>$value){
            $data[$key]=$params[$key];
        }
        return $data;
    }

    /**
     * 自定义验证规则 正整数
     * @param $value
     * @return bool
     */
    protected function isPositiveInteger($value)
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) return true;
        return false;
    }

    /**
     * 自定义验证规则 非空
     * @param $value
     * @return bool
     */
    protected function isNotEmpty($value)
    {
        if (empty($value)) return false;
        return true;
    }

    /**
     * 自定义验证规则 手机号
     * @param $value
     * @return bool
     */
    protected function isMobile($value){
        $rule='^1(3|4|5|6|7|8)[0-9]\d{8}$^';
        $result=preg_match($rule,$value);
        if ($result) return true;
        return false;
    }


}