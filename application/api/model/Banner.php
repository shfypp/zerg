<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/11
 * Time: 15:39
 */

namespace app\api\model;


class Banner extends Base
{
    protected $visible=['name','description','banner_items'];

    public function bannerItems(){
        return $this->hasMany('BannerItem','banner_id','id');
    }

    public static function getBannerById($id){
        return self::get($id, 'banner_items.image' );
    }
}