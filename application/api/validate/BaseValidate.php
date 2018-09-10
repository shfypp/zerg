<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 17:15
 */

namespace app\api\validate;


use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        $request=Request::instance();
        $params=$request->param();

        $result=$this->check($params);
        if (!$result){
            throw new Exception($this->error);
        }else{
            return true;
        }
    }
}