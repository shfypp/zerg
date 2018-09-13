<?php
/**
 * Created by PhpStorm.
 * User: 22965
 * Date: 2018/9/11
 * Time: 15:39
 */

namespace app\api\model;


class BannerItem extends Base
{
    protected $hidden=['delete_time','update_time','banner_id','img_id'];

    public function image(){
        return $this->belongsTo('Image','img_id','id');
    }
}