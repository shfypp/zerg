<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/11
 * Time: 15:39
 */

namespace app\api\model;


use think\Model;

class Banner extends Model
{
    public static function getBanner($id){
        $banner=self::get($id);
        return $banner;
    }

}