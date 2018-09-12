<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/10
 * Time: 17:05
 */

namespace app\api\controller\v2;


class Banner
{
    public function index($version)
    {
        return $version.".Banner/index";
    }

    public function getBanner($id)
    {
        return "getBanner".$id;
    }
}