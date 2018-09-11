<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 17:05
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;

class Banner
{
    public function index(){
        return "v1.Banner/index";
    }

    public function getBanner(){
        (new IDMustBePositiveInt())->goCheck();
        return "v1.Banner/getBanner";
    }
}